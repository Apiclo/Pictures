<?php

//主题启动后进仪表盘
add_action( 'load-themes.php', 'Init_theme' );
function Init_theme(){
  global $pagenow;

  if ( 'themes.php' == $pagenow && isset( $_GET['activated'] ) ) {
    // options-general.php 改成你的主题设置页面网址
    wp_redirect( admin_url( '/index.php' ) );
    exit;
  }
}

//主题教程
function rc_my_welcome_panel() { ?>
<script type="text/javascript">
	/* 隐藏默认的欢迎信息 */
	jQuery(document).ready( function($) 
	{
		$('div.welcome-panel-content').hide();
	});
</script>
<!-- 添加自定义信息 -->
<div class="ybpjc">
	<h3>主题教程</h3>
	<ol class="jcbox">
		<li>主题安装后，请在后台，外观，自定义中进行设置</li>
		<li>主题安装好第一件事不是去设置主题选项，而是创建好网站里的【<a href="/wp-admin/edit-tags.php?taxonomy=category" target="_blank">分类</a>】和【<a href="/wp-admin/edit.php?post_type=page" target="_blank">页面</a>】！（已有内容的老站除外）</li>
		<li>主题增加有：友情链接、文章归档、搜索页面，后台-页面-编辑，右侧栏，页面属性里面选择模板</li>
		<li>注意：搜索页面的固定链接请改为：域名/search</li>
		<li>导航菜单如何添加？通过【<a href="/wp-admin/nav-menus.php" target="_blank">菜单</a>】的【<a href="/wp-admin/nav-menus.php?action=edit&menu=0" target="_blank">创建</a>】功能可以创建出很多的菜单组，设置好菜单组的菜单内容，选择好菜单所要显示的位置！！！</li>
		<li>以上是主题使用方面最基础的操作，如需要修改主题里某些写死了的文字或链接，可以尝试下外观里的【<a href="/wp-admin/theme-editor.php" target="_blank">编辑</a>】 来对细节文件的修改！</li>
		<li>贴上详细的WordPress方面的教程贴供大家查阅吧！详尽请进【<a href="http://ztmao.com/jiaocheng" target="_blank">GO</a>】</li>
		<li>最后，该主题免费共享，遇到问题请到主题猫官网（https://ztmao.com）提交工单，不接受QQ咨询！</li>

	</ol>
</div>
<?php } add_action( 'welcome_panel', 'rc_my_welcome_panel' );

//自定义后台版权
function remove_footer_admin () {
echo '感谢选择 <a href="http://ztmao.com" target="_blank">主题猫WP建站</a> 为您设计！</p>';
}
add_filter('admin_footer_text', 'remove_footer_admin');

//后台强制css
function custom_logo() {
  echo '<style type="text/css">
    #wp-admin-bar-wp-logo { display: none !important; }
	.form-field td img{width: 200px;}
	*{text-shadow:none!important;}
	.ybpjc{}
	.ybpjc h3{margin-top: -10px;background: #f3f2f2;padding: 2px 10px;}
	.jcbox li{padding-bottom:10px;line-height:26px;}
    </style>';
}
add_action('admin_head', 'custom_logo');

//禁止WordPress自动生成缩略图
function ztmao_remove_image_size($sizes) {
unset( $sizes['small'] );
unset( $sizes['medium'] );
unset( $sizes['large'] );
return $sizes;
}
add_filter('image_size_names_choose', 'ztmao_remove_image_size');

//禁用 auto-embeds
remove_filter( 'the_content', array( $GLOBALS['wp_embed'], 'autoembed' ), 8 );

//头像
function replace_avatar_url($avatar) {
    $avatar = str_replace(array("www.gravatar.com","0.gravatar.com","1.gravatar.com","2.gravatar.com"),"ds-gravatar.qiniudn.com",$avatar);
    return $avatar;
}
add_filter( 'get_avatar', 'replace_avatar_url', 10, 3 );

//禁止谷歌字体
function remove_open_sans() {
    wp_deregister_style( 'open-sans' );
    wp_register_style( 'open-sans', false );
    wp_enqueue_style('open-sans','');
}
add_action( 'init', 'remove_open_sans' );

//禁止代码标点转换
remove_filter('the_content', 'wptexturize');

/*激活友情链接后台*/
add_filter( 'pre_option_link_manager_enabled', '__return_true' );

//添加特色缩略图支持
if ( function_exists('add_theme_support') )add_theme_support('post-thumbnails');

//去掉描述P标签
function deletehtml($description) {
$description = trim($description);
$description = strip_tags($description,"");
return ($description);
}
add_filter('category_description', 'deletehtml');

//更多选项卡故障
function Uazoh_remove_help_tabs($old_help, $screen_id, $screen){
    $screen->remove_help_tabs();
    return $old_help;
}
add_filter('contextual_help', 'Uazoh_remove_help_tabs', 10, 3 );

// 屏蔽WordPress默认小工具
add_action( 'widgets_init', 'my_unregister_widgets' );   
function my_unregister_widgets() {   
 
    unregister_widget( 'WP_Widget_Archives' );   
    unregister_widget( 'WP_Widget_Calendar' );   
    unregister_widget( 'WP_Widget_Categories' );   
    unregister_widget( 'WP_Widget_Links' );   
    unregister_widget( 'WP_Widget_Meta' );   
    unregister_widget( 'WP_Widget_Pages' );   
    unregister_widget( 'WP_Widget_Recent_Comments' );   
    unregister_widget( 'WP_Widget_Recent_Posts' );   
    unregister_widget( 'WP_Widget_RSS' );   
    unregister_widget( 'WP_Widget_Search' );   
    unregister_widget( 'WP_Widget_Tag_Cloud' );   
    unregister_widget( 'WP_Nav_Menu_Widget' );   
}

/* 评论作者链接新窗口打开 */
function specs_comment_author_link() {
    $url    = get_comment_author_url();
    $author = get_comment_author();
    if ( empty( $url ) || 'http://' == $url )
        return $author;
    else
        return "<a target='_blank' href='$url' rel='external nofollow' class='url'>$author</a>";
}
add_filter('get_comment_author_link', 'specs_comment_author_link');

//修复 WordPress 找回密码提示“抱歉，该key似乎无效”

function reset_password_message( $message, $key ) {
 if ( strpos($_POST['user_login'], '@') ) {
 $user_data = get_user_by('email', trim($_POST['user_login']));
 } else {
 $login = trim($_POST['user_login']);
 $user_data = get_user_by('login', $login);
 }
 $user_login = $user_data->user_login;
 $msg = __('有人要求重设如下帐号的密码：'). "\r\n\r\n";
 $msg .= network_site_url() . "\r\n\r\n";
 $msg .= sprintf(__('用户名：%s'), $user_login) . "\r\n\r\n";
 $msg .= __('若这不是您本人要求的，请忽略本邮件，一切如常。') . "\r\n\r\n";
 $msg .= __('要重置您的密码，请打开下面的链接：'). "\r\n\r\n";
 $msg .= network_site_url("wp-login.php?action=rp&key=$key&login=" . rawurlencode($user_login), 'login') ;
 return $msg;
}
add_filter('retrieve_password_message', 'reset_password_message', null, 2);

/*编辑器添加分页按钮*/
add_filter('mce_buttons','wysiwyg_editor');
function wysiwyg_editor($mce_buttons) {
    $pos = array_search('wp_more',$mce_buttons,true);
    if ($pos !== false) {
        $tmp_buttons = array_slice($mce_buttons, 0, $pos+1);
        $tmp_buttons[] = 'wp_page';
        $mce_buttons = array_merge($tmp_buttons, array_slice($mce_buttons, $pos+1));
    }
    return $mce_buttons;
}

//搜索结果排除所有页面
function search_filter_page($query) {
    if ($query->is_search) {
        $query->set('post_type', 'post');
    }
    return $query;
}
add_filter('pre_get_posts','search_filter_page');

//去掉图片外围标签p
function filter_ptags_on_images($content){
    return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '<div class="post-image">\1\2\3</div>', $content);
}
add_filter('the_content', 'filter_ptags_on_images');
//自定义logo
function puma_customize_register( $wp_customize ) {
    $wp_customize->add_section('header_logo',array(
        'title'     => '站点Logo',
        'priority'  => 50
    ) );
    $wp_customize->add_setting( 'header_logo_image', array(
        'default'   => '',
        "transport" => "postMessage",
        'type'      => 'option'
    ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'header_logo_image', array(
         'label'     => '站点lOGO（建议尺寸：122*22）',
         'section'   => 'header_logo'
    ) ) );
	
    $wp_customize->add_section('footer_logo',array(
        'title'     => '页脚Logo',
        'priority'  => 50
    ) );
    $wp_customize->add_setting( 'footer_logo_image', array(
        'default'   => '',
        "transport" => "postMessage",
        'type'      => 'option'
    ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'footer_logo_image', array(
         'label'     => '页脚lOGO（建议尺寸：110*32）',
         'section'   => 'footer_logo'
    ) ) );
}
add_action( 'customize_register', 'puma_customize_register' );
//
function ms_customize_register( $wp_customize ) {
    $wp_customize->add_section('header_zdgjc',array(
        'title'     => '站点关键词',
        'priority'  => 50
    ) );
    $wp_customize->add_setting( 'header_zdgjc', array(
        'default'   => '',
        "transport" => "postMessage",
        'type'      => 'option'
    ) );
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'header_zdgjc', array(
         'label'     => '多个关键词之间用英文逗号隔开',
         'section'   => 'header_zdgjc'
    ) ) );
}
add_action( 'customize_register', 'ms_customize_register' );
//
function dz_customize_register( $wp_customize ) {
    $wp_customize->add_section('header_zdms',array(
        'title'     => '站点描述',
        'priority'  => 50
    ) );
    $wp_customize->add_setting( 'header_zdms', array(
        'default'   => '',
        "transport" => "postMessage",
        'type'      => 'option'
    ) );
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'header_zdms', array(
         'label'     => '输入站点描述，最好不要超过120个字',
         'section'   => 'header_zdms'
    ) ) );
}
add_action( 'customize_register', 'dz_customize_register' );
//FQ上传头像
function tizipu_ad( $description ) {
$description = '您可以在<a href="https://cn.gravatar.com/">Gravatar</a>修改您的资料图片。<br>当然这是需要翻墙才可以访问的：<a target="_blank" href="https://www.tizipu.net/aff.php?aff=25">点我购买翻墙加速服务【站长必备】</a>';
return $description; 
};
add_filter( 'user_profile_picture_description', 'tizipu_ad', 10, 1 );
//去除后台标题中的“—— WordPress”
add_filter('admin_title', 'wpdx_custom_admin_title', 10, 2);
function wpdx_custom_admin_title($admin_title, $title){
    return $title.' &lsaquo; '.get_bloginfo('name');
}
//禁用REST API、移除wp-json链接
add_filter('rest_enabled', '_return_false');
add_filter('rest_jsonp_enabled', '_return_false');
remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10 );
//禁用embeds
function disable_embeds_init() {  
    global $wp;  
    $wp->public_query_vars = array_diff( $wp->public_query_vars, array(  
        'embed',  
    ) );   
    remove_action( 'rest_api_init', 'wp_oembed_register_route' );  
    add_filter( 'embed_oembed_discover', '__return_false' );  
    remove_filter( 'oembed_dataparse', 'wp_filter_oembed_result', 10 );   
    remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );  
    remove_action( 'wp_head', 'wp_oembed_add_host_js' );  
    add_filter( 'tiny_mce_plugins', 'disable_embeds_tiny_mce_plugin' );  
    add_filter( 'rewrite_rules_array', 'disable_embeds_rewrites' );  
}  
add_action( 'init', 'disable_embeds_init', 9999 );   
function disable_embeds_tiny_mce_plugin( $plugins ) {  
    return array_diff( $plugins, array( 'wpembed' ) );  
}  
function disable_embeds_rewrites( $rules ) {  
    foreach ( $rules as $rule => $rewrite ) {  
        if ( false !== strpos( $rewrite, 'embed=true' ) ) {  
            unset( $rules[ $rule ] );  
        }  
    }  
    return $rules;  
}  
function disable_embeds_remove_rewrite_rules() {  
    add_filter( 'rewrite_rules_array', 'disable_embeds_rewrites' );  
    flush_rewrite_rules();  
}  
register_activation_hook( __FILE__, 'disable_embeds_remove_rewrite_rules' );  
function disable_embeds_flush_rewrite_rules() {  
    remove_filter( 'rewrite_rules_array', 'disable_embeds_rewrites' );  
    flush_rewrite_rules();  
}  
register_deactivation_hook( __FILE__, 'disable_embeds_flush_rewrite_rules' );  
/**
 * Disable the emoji's
 */
function disable_emojis() {
 remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
 remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
 remove_action( 'wp_print_styles', 'print_emoji_styles' );
 remove_action( 'admin_print_styles', 'print_emoji_styles' );
 remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
 remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
 remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
 add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
 }
 add_action( 'init', 'disable_emojis' );
/**
 * Filter function used to remove the tinymce emoji plugin.
 */
 function disable_emojis_tinymce( $plugins ) {
 if ( is_array( $plugins ) ) {
 return array_diff( $plugins, array( 'wpemoji' ) );
 } else {
 return array();
 }
 }
 //
function create_dwb_menu() {
  global $wp_admin_bar;
	$menu_id = 'dwb';
  $content = wp_remote_retrieve_body( wp_remote_get('https://ztmao.com/wp-json/wp/v2/posts?include=2727') );
  $content_obj = json_decode($content); #JSON内容转换为PHP对象
	if($content_obj){
		foreach ($content_obj as $key) {
			$bben = $key->version;
			$downlink = $key->link;
			$my_theme = wp_get_theme();
			$dqbb = $my_theme->get( 'Version' );
			if($dqbb < $bben){
			  $wp_admin_bar->add_menu(array('id' => $menu_id, 'title' => __('<span class="update-plugins count-2" style="display: inline-block;background-color: #d54e21;color: #fff;font-size: 9px;font-weight: 600;border-radius: 10px;z-index: 26;height: 18px;margin-right: 5px;"><span class="update-count" style="display: block;padding: 0 6px;line-height: 17px;">1</span></span>主题有更新，请及时查看！！！'), 'href' => $downlink));	
			}
		} 
	}
}
add_action('admin_bar_menu', 'create_dwb_menu', 2000);
 //禁止头部加载s.w.org
function remove_dns_prefetch( $hints, $relation_type ) {
if ( 'dns-prefetch' === $relation_type ) {
return array_diff( wp_dependencies_unique_hosts(), $hints );
}
return $hints;
}
add_filter( 'wp_resource_hints', 'remove_dns_prefetch', 10, 2 );
//时间倒计时
function timeago( $ptime ) {
    $ptime = strtotime($ptime);
    $etime = time() - $ptime;
    if($etime < 1) return __('刚刚');
    $interval = array (
        12 * 30 * 24 * 60 * 60  =>  __('年前', 'haoui').' ('.date('Y-m-d', $ptime).')',
        30 * 24 * 60 * 60       =>  __('个月前', 'haoui').' ('.date('m-d', $ptime).')',
        7 * 24 * 60 * 60        =>  __('周前', 'haoui').' ('.date('m-d', $ptime).')',
        24 * 60 * 60            =>  __('天前', 'haoui'),
        60 * 60                 =>  __('小时前', 'haoui'),
        60                      =>  __('分钟前', 'haoui'),
        1                       =>  __('秒前', 'haoui')
    );
    foreach ($interval as $secs => $str) {
        $d = $etime / $secs;
        if ($d >= 1) {
            $r = round($d);
            return $r . $str;
        }
    };
}
//移除顶部多余信息
//remove_action( 'wp_head', 'wp_enqueue_scripts', 1 ); //Javascript的调用
remove_action( 'wp_head', 'feed_links', 2 ); //移除feed
remove_action( 'wp_head', 'feed_links_extra', 3 ); //移除feed
remove_action( 'wp_head', 'rsd_link' ); //移除离线编辑器开放接口
remove_action( 'wp_head', 'wlwmanifest_link' );  //移除离线编辑器开放接口
remove_action( 'wp_head', 'index_rel_link' );//去除本页唯一链接信息
remove_action('wp_head', 'parent_post_rel_link', 10, 0 );//清除前后文信息
remove_action('wp_head', 'start_post_rel_link', 10, 0 );//清除前后文信息
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
remove_action( 'wp_head', 'locale_stylesheet' );
remove_action('publish_future_post','check_and_publish_future_post',10, 1 );
remove_action( 'wp_head', 'noindex', 1 );
//remove_action( 'wp_head', 'wp_print_styles', 8 );//载入css
remove_action( 'wp_head', 'wp_print_head_scripts', 9 );
remove_action( 'wp_head', 'wp_generator' ); //移除WordPress版本
remove_action( 'wp_head', 'rel_canonical' );
remove_action( 'wp_footer', 'wp_print_footer_scripts' );
remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );
remove_action( 'template_redirect', 'wp_shortlink_header', 11, 0 );
//add_action('widgets_init', 'my_remove_recent_comments_style');
//function my_remove_recent_comments_style() {
//global $wp_widget_factory;
//remove_action('wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'] ,'recent_comments_style'));
//}
//禁止加载WP自带的jquery.js
//if ( !is_admin() ) { // 后台不禁止
//function my_init_method() {
//wp_deregister_script( 'jquery' ); // 取消原有的 jquery 定义
//}
//add_action('init', 'my_init_method'); 
//}
//wp_deregister_script( 'l10n' );
//删除仪表盘模块
function example_remove_dashboard_widgets() {
    // Globalize the metaboxes array, this holds all the widgets for wp-admin
    global $wp_meta_boxes;
    // 以下这一行代码将删除 "快速发布" 模块
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
    // 以下这一行代码将删除 "引入链接" 模块
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
    // 以下这一行代码将删除 "插件" 模块
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
    // 以下这一行代码将删除 "近期评论" 模块
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
    // 以下这一行代码将删除 "近期草稿" 模块
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts']);
    // 以下这一行代码将删除 "WordPress 开发日志" 模块
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
    // 以下这一行代码将删除 "其它 WordPress 新闻" 模块
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
    // 以下这一行代码将删除 "概况" 模块
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
}
add_action('wp_dashboard_setup', 'example_remove_dashboard_widgets' );
remove_action('welcome_panel', 'wp_welcome_panel');
function remove_dashboard_meta() {
    remove_meta_box( 'dashboard_activity', 'dashboard', 'normal');//3.8版开始
}
add_action( 'admin_init', 'remove_dashboard_meta' );
