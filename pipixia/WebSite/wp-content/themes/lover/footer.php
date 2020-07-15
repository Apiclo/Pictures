<footer id="footer" class="footer ">
<div class="footer-social">
	<div class="footer-container clearfix">
		<div class="social-list">
			<?php $menuParameters = array('container'	=> false,'echo'	=> false,'items_wrap' => '%3$s','depth'	=> 0,'theme_location' => 'nav2',);echo strip_tags(wp_nav_menu( $menuParameters ), '<a>' );?>
		</div>
	</div>
</div>
<div class="footer-meta">
	<div class="footer-container">
		<div class="meta-item meta-copyright">
			<div class="meta-copyright-info">
				<a href="<?php echo home_url();?>" class="info-logo"><?php if ( !get_option('footer_logo_image') ) { bloginfo( 'name' ); } else { echo '<img src="' . get_option('footer_logo_image') .'">';} ?></a>
				<div class="info-text">
					<p id="chakhsu"></p>
					<p class="f_bq">
						<img src="http://apiclo.vicp.io/wp-content/uploads/2020/06/xs.png" style="height:1.3rem;font-size:1.5rem; margin-bottom:  -0.35rem;"alt="皮皮虾ID">: GIMP
						</p>
						<p class="f_bq">Powered by 
						<a href="http://www.apiclo.top" target="_blank" rel="nofollow" class="banquan">apiclo</a>
						
					</p>
					<p>&copy; <?php esc_attr_e(date('Y')); ?> 𝖕𝖎𝖕𝖎𝖝𝖎𝖆 <a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a></p>
				</div>
			</div>
		</div>
		<div class="meta-item meta-posts">
			<h3 class="meta-title">最近上架</h3>
			<?php $rand_posts = get_posts('numberposts=5&orderby=date');foreach($rand_posts as $post) : ?>
			<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
			<?php endforeach;?>
		</div>
		<div class="meta-item meta-comments">
			<h3 class="meta-title">最近评论</h3>
			<?php
			$comments = get_comments('status=approve&number=5&order=asc');
			foreach($comments as $comment) :
				$output =  '<li><a href="' . esc_url( get_comment_link($comment->comment_ID) ) . '">' . $comment->comment_content . '</a></li>';
			echo $output;
			endforeach;?>
		</div>
	</div>
</div>
</footer>
<script src="<?php bloginfo('template_directory'); ?>/js/headroom.min.js"></script>
<script src="<?php bloginfo('template_directory'); ?>/js/instantclick.min.js"></script>
<script>//底部特效字
	var chakhsu = function(r) {function t(){return b[Math.floor(Math.random()*b.length)]}function e(){return String.fromCharCode(94*Math.random()+33)}function n(r){for(var n=document.createDocumentFragment(),i=0;r>i;i++){var l=document.createElement("span");l.textContent=e(),l.style.color=t(),n.appendChild(l)}return n}function i(){var t=o[c.skillI];c.step?c.step--:(c.step=g,c.prefixP<l.length?(c.prefixP>=0&&(c.text+=l[c.prefixP]),c.prefixP++):"forward"===c.direction?c.skillP<t.length?(c.text+=t[c.skillP],c.skillP++):c.delay?c.delay--:(c.direction="backward",c.delay=a):c.skillP>0?(c.text=c.text.slice(0,-1),c.skillP--):(c.skillI=(c.skillI+1)%o.length,c.direction="forward")),r.textContent=c.text,r.appendChild(n(c.prefixP<l.length?Math.min(s,s+c.prefixP):Math.min(s,t.length-c.skillP))),setTimeout(i,d)}
		var l = "",
			o = ["天王盖地虎","小鸡炖蘑菇", "宝塔镇河妖", "蘑菇放辣椒", "清风拂杨柳","敢问时段友","滴，滴滴"].map(function(r) {
		
		return r+"."}),a=2,g=1,s=5,d=75,b=["rgb(110,64,170)","rgb(150,61,179)","rgb(191,60,175)","rgb(228,65,157)","rgb(254,75,131)","rgb(255,94,99)","rgb(255,120,71)","rgb(251,150,51)","rgb(226,183,47)","rgb(198,214,60)","rgb(175,240,91)","rgb(127,246,88)","rgb(82,246,103)","rgb(48,239,130)","rgb(29,223,163)","rgb(26,199,194)","rgb(35,171,216)","rgb(54,140,225)","rgb(76,110,219)","rgb(96,84,200)"],c={text:"",prefixP:-s,skillI:0,skillP:0,direction:"forward",delay:a,step:g};i()};chakhsu(document.getElementById('chakhsu'));if('addEventListener'in document){document.addEventListener('DOMContentLoaded',function(){FastClick.attach(document.body)},false)}
</script>
<script data-no-instant>InstantClick.on('change',function(isInitialLoad){var blocks=document.querySelectorAll('pre code');for(var i=0;i<blocks.length;i++){hljs.highlightBlock(blocks[i])}if(isInitialLoad===false){if(typeof ga!=='undefined')ga('send','pageview',location.pathname+location.search);if(typeof MathJax!=='undefined'){MathJax.Hub.Queue(["Typeset",MathJax.Hub])}}});InstantClick.init('mousedown');</script>
<?php wp_footer(); ?>
</body>
</html>
