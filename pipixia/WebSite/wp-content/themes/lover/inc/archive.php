<?php if ( has_post_format( 'aside' )) { //日志?>
	<div class="post-list-item">
		<div class="post-list-item-container ">
			<div class="item-label ">
				<div class="item-title">
					<a href="<?php the_permalink(); ?>"><?php the_title_attribute(); ?></a>
				</div>
				<div class="item-meta clearfix">
					<div class="item-meta-ico bg-ico-book" style="background: url(<?php bloginfo('template_directory'); ?>/images/bg-ico.png) no-repeat;background-size: 40px auto;">
					</div>
					<div class="item-meta-date">
						<?php the_time('Y-m-d l') ?>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php }elseif( has_post_format( 'chat' )){ //聊天?>
	<div class="post-list-item">
		<div class="post-list-item-container ">
			<div class="item-label ">
				<div class="item-title">
					<a href="<?php the_permalink(); ?>"><?php the_title_attribute(); ?></a>
				</div>
				<div class="item-meta clearfix">
					<div class="item-meta-ico bg-ico-chat" style="background: url(<?php bloginfo('template_directory'); ?>/images/bg-ico.png) no-repeat;background-size: 40px auto;">
					</div>
					<div class="item-meta-date">
						<?php the_time('Y-m-d l') ?>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php }elseif( has_post_format( 'image' )){ //相册?>
	<div class="post-list-item">
		<div class="post-list-item-container ">
			<div class="item-label ">
				<div class="item-title">
					<a href="<?php the_permalink(); ?>"><?php the_title_attribute(); ?></a>
				</div>
				<div class="item-meta clearfix">
					<div class="item-meta-ico bg-ico-image" style="background: url(<?php bloginfo('template_directory'); ?>/images/bg-ico.png) no-repeat;background-size: 40px auto;">
					</div>
					<div class="item-meta-date">
						<?php the_time('Y-m-d l') ?>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php }elseif( has_post_format( 'link' )){ //链接?>
	<div class="post-list-item">
		<div class="post-list-item-container ">
			<div class="item-label ">
				<div class="item-title">
					<a href="<?php the_permalink(); ?>"><?php the_title_attribute(); ?></a>
				</div>
				<div class="item-meta clearfix">
					<div class="item-meta-ico bg-ico-link" style="background: url(<?php bloginfo('template_directory'); ?>/images/bg-ico.png) no-repeat;background-size: 40px auto;">
					</div>
					<div class="item-meta-date">
						<?php the_time('Y-m-d l') ?>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php }elseif( has_post_format( 'quote' )){ //代码?>
	<div class="post-list-item">
		<div class="post-list-item-container ">
			<div class="item-label ">
				<div class="item-title">
					<a href="<?php the_permalink(); ?>"><?php the_title_attribute(); ?></a>
				</div>
				<div class="item-meta clearfix">
					<div class="item-meta-ico bg-ico-code" style="background: url(<?php bloginfo('template_directory'); ?>/images/bg-ico.png) no-repeat;background-size: 40px auto;">
					</div>
					<div class="item-meta-date">
						<?php the_time('Y-m-d l') ?>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php } else{ //标准 ?>
	<div class="post-list-item">
		<div class="post-list-item-container ">
			<div class="item-label ">
				<div class="item-title">
					<a href="<?php the_permalink(); ?>"><?php the_title_attribute(); ?></a>
				</div>
				<div class="item-meta clearfix">
					<div class="item-meta-ico bg-ico-note" style="background: url(<?php bloginfo('template_directory'); ?>/images/bg-ico.png) no-repeat;background-size: 40px auto;">
					</div>
					<div class="item-meta-date">
						<?php the_time('Y-m-d l') ?>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php } ?>