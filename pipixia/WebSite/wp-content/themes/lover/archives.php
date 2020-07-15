<?php 
/**
 * Template name: 文章归档
 */

get_header();

?>

<div class="main-content archive-page clearfix">
            <?php
            $previous_year = $year = 0;
            $previous_month = $month = 0;
            $ul_open = false;

            $myposts = get_posts('numberposts=-1&orderby=post_date&order=DESC');
            
            foreach($myposts as $post) :
                setup_postdata($post);
             
                $year = mysql2date('Y', $post->post_date);
                $month = mysql2date('n', $post->post_date);
                $day = mysql2date('j', $post->post_date);
                
                if($year != $previous_year || $month != $previous_month) :
                    if($ul_open == true) : 
                        echo '</div></div>';
                    endif;
                    echo '<div class="categorys-item"><div class="categorys-title">'; echo the_time('M Y'); echo '</div>';
                    echo '<div class="post-lists">';
                    $ul_open = true;
             
                endif;
                $previous_year = $year; $previous_month = $month;
            ?>
				<div class="post-list-item">
					<div class="post-list-item-container">
						<div class="item-label">
							<div class="item-title">
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							</div>
							<div class="item-meta clearfix">
								<div class="item-meta-date">
									<?php the_time('Y-m-d l') ?>&nbsp;&nbsp;&nbsp;<?php comments_number('', '（1 条评论）', '（% 条评论）'); ?>
								</div>
							</div>
						</div>
					</div>
				</div>
            <?php endforeach; ?>
            </div>
        </div>
</div>
<?php get_footer();?>