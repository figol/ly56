<?php  
/* 
Template Name:guestbook
*/  
?> 


<?php get_header(); ?>


<div class="container " >


	<div class="container">
		<div class="row">
			
			<div class="col-md-9">
			<div class="guestbook global">
				<div class="title"><p>有问题请再下面留言,扫描二维码加入QQ群。更多信息<a href="http://www.cnsecer.com/me">点我</a><a href=""></a></p></div>	
				 <p style="text-align:center"><img src="<?php bloginfo('template_directory'); ?>/images/qun.png" alt="扫描加入QQ群"></p> 		
				<div class="reader">
					<h4>读者墙</h4>
					<?php
					$query="SELECT COUNT(comment_ID) AS cnt, comment_author, comment_author_url, comment_author_email FROM (SELECT * FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->posts.ID=$wpdb->comments.comment_post_ID) WHERE comment_date > date_sub( NOW(), INTERVAL 24 MONTH ) AND user_id='0' AND comment_author_email != '改成你的邮箱账号' AND post_password='' AND comment_approved='1' AND comment_type='') AS tempcmt GROUP BY comment_author_email ORDER BY cnt DESC LIMIT 39";//大家把管理员的邮箱改成你的,最后的这个39是选取多少个头像，大家可以按照自己的主题进行修改,来适合主题宽度
					$wall = $wpdb->get_results($query);
					$maxNum = $wall[0]->cnt;
					foreach ($wall as $comment){
					    $width = round(40 / ($maxNum / $comment->cnt),2);//此处是对应的血条的宽度
					    if( $comment->comment_author_url )
					    $url = $comment->comment_author_url;
					    else $url="#";
							$avatar = get_avatar( $comment->comment_author_email, $size = '36', $default = 'http://0.gravatar.com/avatar/default.jpg' );
					    $tmp = "<li><a target=\"_blank\" href=\"".$comment->comment_author_url."\">".$avatar."<em>".$comment->comment_author."</em> <strong>+".$comment->cnt."</strong></br>".$comment->comment_author_url."</a></li>";
					    $output .= $tmp;
					 }
					$output = "<ul class=\"readers-list\">".$output."</ul>";
					echo $output ;
					?>			
				</div>				
				<div id="comments"><?php comments_template(); ?></div>
			

			</div>
			</div>
			<div class="col-md-3 hidden-xs global">
				<?php get_sidebar(); ?>
			</div>
		</div>
	</div>
	<div class="top"  style="height:150px;margin-top:10px;">
	</div>
	
</div>

<?php get_footer(); ?>