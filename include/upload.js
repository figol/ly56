
function uploadImg(name){

    jQuery('.upload_button').click(function() {
         targetfield = jQuery(this).prev('#'+name);
         tb_show('', 'media-upload.php?type=image&TB_iframe=true');
         return false;
    });

	window.send_to_editor = function(html) {
			 imgurl = jQuery('img',html).attr('src');
			 jQuery("#"+name).val(imgurl);
			 tb_remove();
		}
}

function clearImgDir(name){
	jQuery('.del_button').click(function(event) {
		jQuery("#"+name).val(null);
	});
}