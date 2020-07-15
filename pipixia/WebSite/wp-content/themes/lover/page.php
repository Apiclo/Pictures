<?php get_header(); ?>
<article class="main-content page-page">
<div class="post-header">
	<h1 class="post-title" itemprop="name headline"><?php the_title(); ?></h1>
	<div class="post-data">
		<time datetime="<?php the_time('Y-m-d h:m:s') ?>" itemprop="datePublished">Published on <?php the_time('Y-m-d') ?></time>
	</div>
</div>
<div id="post-content" class="post-content">
	<?php if(have_posts()):while(have_posts()):the_post(); ?>
		<?php the_content(); ?>
	<?php endwhile;endif; ?>
</div>
</article>
<div class="comment-container">
    <?php comments_template( '', true ); ?>
	<div class="lists-navigator clearfix"> </div>
</div>
<style>
.flinks li img {float: left;width: 16px;height: 16px;margin-right: 8px;margin-top: 3px;}
.bg-grey {background-color: #fff !important;}
</style>
<?php get_footer();?>