<?php
if ( post_password_required() ) {
	return;
}
?>
<div id="comments" class="clearfix">
<span class="response">评论区 </span>
	<?php
		if ( ! comments_open() ) :
	?>	
		<div id="respond">
			<p class="tips"><?php echo '评论已关闭。'; ?></p>
		</div>	
	<?php else: ?>
		<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
			<p class="tips"><?php print '您必须';?><a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>"> [ 登录 ] </a>才能发表留言！</p>
		<?php else : ?>
			<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" class="comment-form" method="post" id="comment-form">
				<?php if ( $user_ID ) : ?>
					<div class="user-name row comment-from-main">
						<div class="logged-in-as">你好，<?php echo $user_identity; ?> ！ <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="退出"><?php echo '退出'; ?></a></div>
					</div>
				<?php elseif ( '' != $comment_author ): ?>
					<div class="user-name row comment-from-main">
						<div class="logged-in-as"><?php printf(__('你好，%s，'), $comment_author); ?>
							<a href="javascript:toggleCommentAuthorInfo();" id="toggle-comment-author-info"><i>[ 资料修改 ]</i></a>
						</div>
					</div>
					<!--wp-compress-html--><!--wp-compress-html no compression--> 
					<script type="text/javascript" charset="utf-8">
						//<![CDATA[
						var changeMsg = "<i>[ 资料修改 ]</i>";
						var closeMsg = "<i>[ 收起来 ]</i>";
						function toggleCommentAuthorInfo() {
							jQuery('#comment-author-info').slideToggle('slow', function(){
								if ( jQuery('#comment-author-info').css('display') == 'none' ) {
								jQuery('#toggle-comment-author-info').html(changeMsg);
								} else {
								jQuery('#toggle-comment-author-info').html(closeMsg);
								}
							});
						}
						jQuery(document).ready(function(){
							jQuery('#comment-author-info').hide();
						});
						//]]>
					</script>
					<!--wp-compress-html no compression--><!--wp-compress-html--> 
				<?php endif; ?>
				<?php if ( ! $user_ID ): ?>	
						<input type="text" name="author" id="author" placeholder="昵称" class="form-control input-control clearfix" value="<?php echo $comment_author; ?>" size="22" tabindex="1" />
						<input type="email" name="email" id="email" placeholder="邮箱" class="form-control input-control clearfix" value="<?php echo $comment_author_email; ?>" size="22" tabindex="2" />
						<input type="text" name="url" id="url" placeholder="主页(如果有)" class="form-control input-control clearfix" value="<?php echo $comment_author_url; ?>" size="22" tabindex="3" />
				<?php endif; ?>
				<div class="row comment-from-main">
					<div class="comment-form-textarea ">
						<div class="comment-textarea-box">
							<textarea class="form-control" name="comment" id="textarea" placeholder="说点什么吧..."></textarea>
						</div>
					</div>
					<div class="form-submit">
						<input class="submit" name="submit" type="submit" id="misubmit" tabindex="5" title="提交评论" value="提交评论">
						<?php comment_id_fields(); ?>
						<?php do_action('comment_form', $post->ID); ?>
					</div>
					
				</div>
				<!--wp-compress-html--><!--wp-compress-html no compression-->
				<script type="text/javascript">	//Crel+Enter
				//<![CDATA[
					jQuery(document).keypress(function(e){
						if(e.ctrlKey && e.which == 13 || e.which == 10) { 
							jQuery("#submit").click();
							document.body.focus();
						} else if (e.shiftKey && e.which==13 || e.which == 10) {
							jQuery("#submit").click();
						}          
					});
				// ]]>
				$("#cancel-comment-reply a").addClass("js-comment btn btn-bordered orange btn-normal fr");
				</script>
				<!--wp-compress-html no compression--><!--wp-compress-html--> 
			</form>
		<?php endif; ?>
	<?php if( !have_comments() ): ?>
	<?php else: ?>
		<ol class="comment-list">
			<div id="loading-comments"><span><i class="icon-spin6 animate-spin"></i> 加载中...</span></div>
			
				<?php wp_list_comments('avatar_size=40&type=comment&callback=wpmee_comment&end-callback=wpmee_end_comment&max_depth='.get_option('thread_comments_depth'));	?>

			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
			<div id="comments-navi">
				<?php paginate_comments_links('prev_text=<i class="iconfont icon-fanhui"></i>&next_text=<i class="iconfont icon-gengduo"></i>'); ?>
			</div>
			<?php endif;?>	
		</ol>
	<?php endif;?>
</div>	
<?php endif; ?>