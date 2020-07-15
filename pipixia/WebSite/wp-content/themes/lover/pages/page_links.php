<?php
/*
Template Name: 友情链接
*/
?>
<?php get_header(); ?>
<article class="main-content page-page">
<div class="post-header">
	<h1 class="post-title" itemprop="name headline"><?php the_title(); ?></h1>
	<div class="post-data">
		<time datetime="<?php the_time('Y-m-d h:m:s') ?>" itemprop="datePublished">Published on <?php the_time('Y-m-d') ?></time>
	</div>
</div>
<div id="post-content" class="post-content">
	<h3>友情链接</h3>
	<ul class="flinks">
		<?php $default_ico=get_template_directory_uri().'/images/link.ico';$bookmarks=get_bookmarks('title_li=&orderby=id&category='.get_option("blog_link_page").'');if(!empty($bookmarks)){foreach($bookmarks as $bookmark){echo'<li><img src="',$bookmark->link_url,'/favicon.ico" onerror="javascript:this.src=\'',$default_ico,'\'" width="16" height="16" /><a href="',$bookmark->link_url,'" title="',$bookmark->link_description,'"',$bookmark->link_notes,' target="_blank">',$bookmark->link_name,'</a></li>';}}?>
	</ul>
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