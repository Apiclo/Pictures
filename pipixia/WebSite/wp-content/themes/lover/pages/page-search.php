<?php
/*
Template Name: 搜索页面
*/
get_header(); ?>
<div class="main-content page-page">
    <div class="search-page">
        <form id="search" class="search-form" method="get" action="<?php echo get_option('home'); ?>" role="search">
            <span class="search-box clearfix">
                <input type="text" id="input" class="input" name="s" required="true" placeholder="Search..." maxlength="30" autocomplete="off">
                <button type="submit" class="spsubmit"><i class="icon-search"></i></button>
            </span>
        </form>		
        <div class="search-tags">
			<p>👇 The following tabs can help you!</p>
			<?php 
				$tags_list = get_tags('orderby=count&order=DESC&number=30');
				if ($tags_list) { 
					foreach($tags_list as $tag) {
						echo '<a class="bg-white" href="'.get_tag_link($tag).'"># '. $tag->name .' ('. $tag->count .')</a>'; 
					} 
				} 
			?>
        <div class="search-tags-hr"></div>
        </div>
    </div>
</div>
<?php get_footer();?>