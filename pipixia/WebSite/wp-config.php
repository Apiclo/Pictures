<?php
/**
 * WordPress基础配置文件。
 *
 * 这个文件被安装程序用于自动生成wp-config.php配置文件，
 * 您可以不使用网站，您需要手动复制这个文件，
 * 并重命名为“wp-config.php”，然后填入相关信息。
 *
 * 本文件包含以下配置选项：
 *
 * * MySQL设置
 * * 密钥
 * * 数据库表名前缀
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/zh-cn:%E7%BC%96%E8%BE%91_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL 设置 - 具体信息来自您正在使用的主机 ** //
/** WordPress数据库的名称 */
define( 'DB_NAME', 'sec' );

/** MySQL数据库用户名 */
define( 'DB_USER', 'sec' );

/** MySQL数据库密码 */
define( 'DB_PASSWORD', '0933' );

/** MySQL主机 */
define( 'DB_HOST', 'localhost' );

/** 创建数据表时默认的文字编码 */
define( 'DB_CHARSET', 'utf8mb4' );

/** 数据库整理类型。如不确定请勿更改 */
define( 'DB_COLLATE', '' );

/**#@+
 * 身份认证密钥与盐。
 *
 * 修改为任意独一无二的字串！
 * 或者直接访问{@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org密钥生成服务}
 * 任何修改都会导致所有cookies失效，所有用户将必须重新登录。
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '!UsL+lw%;%ogYS][S#;uVUwDIV,USoRik%ElBH_*y+-AXMIIPH.>*<kzYbTHe-fM' );
define( 'SECURE_AUTH_KEY',  'w>)nDVF-:e7)EuicNr|z<#Rc$|Mlo^c=jF|Zu?.p]7a_Y_TG.s)|}C=uz}H2b,YG' );
define( 'LOGGED_IN_KEY',    'fb^3= -+F:8NP6KdhCwEJ)#OQ7Ou8W?z7Pu2[cNqpz~OEi<B$/uqNRP?&7i?u6EC' );
define( 'NONCE_KEY',        'o491#VS)TokL17JNo>@HM(iI9V{3%CqlSndQl^Z]SYZE;?`$9tnj1g[4cG#|n[7W' );
define( 'AUTH_SALT',        'C`=u +>_e ,wei|9HhGVU,>^<>/(Nv6)}u,XBE2GcY/9+0t(w9:Dr@v&q@;d}x|N' );
define( 'SECURE_AUTH_SALT', '##$qZaj<@9TGB!(ftg946xi=y[[_hOE71 yaj/)h`w@E<:Nre{yH_f_W)F:IZo6a' );
define( 'LOGGED_IN_SALT',   '6VIvB6QXz6i;QCD/L_Olt<sc:=le=WMi#[H.F]f`3!r-<Hf 9X5bNbXy/C_nu71A' );
define( 'NONCE_SALT',       'jf R~[[~&Vx`@k{3<WE>[eiN9G.pXnzV+q)E-Nu2#{C7xE)xva .t*otDA6VN- !' );

/**#@-*/

/**
 * WordPress数据表前缀。
 *
 * 如果您有在同一数据库内安装多个WordPress的需求，请为每个WordPress设置
 * 不同的数据表前缀。前缀名只能为数字、字母加下划线。
 */
$table_prefix = 'wp_';

/**
 * 开发者专用：WordPress调试模式。
 *
 * 将这个值改为true，WordPress将显示所有用于开发的提示。
 * 强烈建议插件开发者在开发环境中启用WP_DEBUG。
 *
 * 要获取其他能用于调试的信息，请访问Codex。
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* 好了！请不要再继续编辑。请保存本文件。使用愉快！ */

/** WordPress目录的绝对路径。 */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** 设置WordPress变量和包含文件。 */
require_once( ABSPATH . 'wp-settings.php' );
