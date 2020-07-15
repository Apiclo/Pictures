<?php get_header(); ?>
<style>
.bg-grey {background-color: #fff !important;}
</style>
<article class="main-content page-page" itemscope itemtype="http://schema.org/Article">
    <div class="post-header">
        <h1 class="post-title" itemprop="name headline"><?php the_title_attribute(); ?></h1>			
		<div class="post-data">
                <img src="/wp-includes/images/avatar.jpg" class="avatar single-avatar photo" width="30" height="30">&nbsp;&nbsp;&nbsp;
                <b><?php echo get_the_author() ?></b>
			<time datetime="<?php the_time('Y-m-d h:m:s') ?>" itemprop="datePublished"><?php the_time('Y-m-d') ?></time>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#comments"><?php comments_number('0 条评论', '1 条评论', '% 条评论'); ?></a>
		</div>
    </div>
    <div id="post-content" class="post-content" itemprop="articleBody">
        <p class="post-tags">
            <?php the_tags('', ' ', ''); ?>
		</p>
	<?php while( have_posts() ): the_post(); $p_id = get_the_ID(); ?>
		<?php the_content(); ?>
	<?php endwhile; ?>
        <p class="post-info">本文由
            <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ) ?>"><?php echo get_the_author() ?> </a>整理，若发现侵权内容请通知管理员，收到通知后管理员将会在第一时间删除侵权内容！
            <br>最后编辑时间为: <?php the_modified_time('Y-m-d H:i l'); ?></p></div>
</article>
<div id="post-bottom-bar" class="post-bottom-bar">
    <div class="bottom-bar-inner">
        <div class="bottom-bar-items social-share left">
            <span class="bottom-bar-item">Share :</span>
            <span class="bottom-bar-item bottom-bar-weibo">
				<a href="http://service.weibo.com/share/share.php?url=<?php the_permalink(); ?>&amp;title=<?php the_title_attribute(); ?>&amp;" target="_blank" rel="nofollow">Weibo</a></span>
            <span class="bottom-bar-item bottom-bar-twitter">
                <a href="http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?url=<?php the_permalink(); ?>&title=<?php the_title_attribute(); ?>&" target="_blank" rel="nofollow">Qzone</a></span>
            <span class="bottom-bar-item bottom-bar-facebook weixin">
                <a href="javascript:void(0);" title="<?php the_title_attribute(); ?>">WeChat</a>
				<div class="weixin-Qr-code" style="opacity: 1; display: none;">
					<img src="https://pan.baidu.com/share/qrcode?w=300&h=300&url=<?php the_permalink(); ?>">
				</div>	
			</span>
        </div>
        <div class="bottom-bar-items right">
		<?php
			$prev_post = get_previous_post();
			if(!empty($prev_post)):?>
			<span class="bottom-bar-item"><a href="<?php echo get_permalink($prev_post->ID);?>" title="上一篇：<?php echo $prev_post->post_title;?>">←</a></span>
		<?php endif;?>
		<?php
			$next_post = get_next_post();
			if(!empty($next_post)):?>
			<span class="bottom-bar-item"><a href="<?php echo get_permalink($next_post->ID);?>" title="下一篇：<?php echo $next_post->post_title;?>">→</a></span>
		<?php endif;?>
            <span class="bottom-bar-item">
                <a href="#footer">↓</a></span>
            <span class="bottom-bar-item">
                <a href="#">↑</a></span>
        </div>
    </div>
</div>
<script type="text/javascript">
	$('.weixin').mouseover(function(){
	$('.weixin-Qr-code').css({"opacity":"1","display":"block"}),
	$('.weixin').addClass('disabled')
    // alert('fdafdsa');
    });
    $('.weixin').mouseout(function(){
	$('.weixin-Qr-code').css({"opacity":"1","display":"none"}),
	$('.weixin').removeClass('disabled')
	// alert('fdafdsa');
	});
</script>
<div class="comment-container">
    <?php comments_template( '', true ); ?>
	<div class="lists-navigator clearfix"> </div>
</div>
<?php get_footer();?>
