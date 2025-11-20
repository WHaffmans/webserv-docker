<?php
/**
 * Init Configuration
 *
 * @author Jegstudio
 * @package unibiz
 */

namespace Unibiz;

use WP_Query;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Plugin Notice Class
 *
 * @package unibiz
 */
class Plugin_Notice {

	/**
	 * Instance variable
	 *
	 * @var $instance
	 */
	private static $instance;

	/**
	 * Class instance.
	 *
	 * @return Init
	 */
	public static function instance() {
		if ( null === static::$instance ) {
			static::$instance = new static();
		}

		return static::$instance;
	}

	/**
	 * Class constructor.
	 */
	public function __construct() {
		$this->load_hooks();
	}

	/**
	 * Load initial hooks.
	 */
	private function load_hooks() {
		add_action( 'admin_notices', array( $this, 'notice_install_plugin' ) );
		add_action( 'wp_ajax_gutenverse_companion_unibiz_dismiss_notice', array( $this, 'dismiss_notice' ) );
	}

	/**
	 * Show notification to install Gutenverse Plugin.
	 */
	public function notice_install_plugin() {
		// Skip if gutenverse block activated.
		if ( ( defined( 'GUTENVERSE' ) && defined( 'GUTENVERSE_PRO' ) ) || get_option( 'gutenverse_companion_unibiz_notice_dismissed' ) ) {
			return;
		}

		$screen = get_current_screen();
		if ( isset( $screen->parent_file ) && 'themes.php' === $screen->parent_file && 'appearance_page_unibiz-dashboard' === $screen->id ) {
			return;
		}

		if ( isset( $screen->parent_file ) && 'plugins.php' === $screen->parent_file && 'update' === $screen->id ) {
			return;
		}

		if ( 'true' === get_user_meta( get_current_user_id(), 'gutenverse_install_notice', true ) ) {
			return;
		}

        $active_plugins = get_option( 'active_plugins' );
		$plugins = array();
		foreach( $active_plugins as $active ) {
			$plugins[] = explode( '/', $active)[0];
		}
		$all_plugin = get_plugins();
		$plugins_required    = array(
            array(
					'slug'       		=> 'gutenverse',
					'title'      		=> 'Gutenverse',
					'short_desc' 		=> 'GUTENVERSE – GUTENBERG BLOCKS AND WEBSITE BUILDER FOR SITE EDITOR, TEMPLATE LIBRARY, POPUP BUILDER, ADVANCED ANIMATION EFFECTS, COMPLETE FEATURE ECOSYSTEM, 45+ FREE USER-FRIENDLY BLOCKS',
					'active'    		=> in_array( 'gutenverse', $plugins, true ),
					'installed'  		=> $this->is_installed( 'gutenverse' ),
					'icons'      		=> array (
  '1x' => 'https://ps.w.org/gutenverse/assets/icon-128x128.gif?rev=3132408',
  '2x' => 'https://ps.w.org/gutenverse/assets/icon-256x256.gif?rev=3132408',
),
					'download_url'      => '',
				),
				array(
					'slug'       		=> 'gutenverse-companion',
					'title'      		=> 'Gutenverse Companion',
					'short_desc' 		=> 'A companion plugin designed specifically to enhance and extend the functionality of Gutenverse base themes. This plugin integrates seamlessly with the base themes, providing additional features, customization options, and advanced tools to optimize the overall user experience and streamline the development process.',
					'active'    		=> in_array( 'gutenverse-companion', $plugins, true ),
					'installed'  		=> $this->is_installed( 'gutenverse-companion' ),
					'icons'      		=> array (
  '1x' => 'https://ps.w.org/gutenverse-companion/assets/icon-128x128.png?rev=3162415',
),
					'download_url'      => '',
				)
        );
		$actions    = array();
		$count_plugin_active = 0;
		foreach ( $plugins_required as $plugin ) {
			$slug   = $plugin['slug'];
			$path   = "$slug/$slug.php";
			$active = in_array($path, $active_plugins);

			if ( isset( $all_plugin[ $path ] ) ) {
				if ( $active ) {
					$actions[ $slug ] = 'active';
					++$count_plugin_active;
				} else {
					$actions[ $slug ] = 'inactive';
				}
			} else {
				$actions[ $slug ] = '';
			}
		}

		if ( $count_plugin_active === count( $plugins_required ) ) {
			return;
		}

		?>
		<style>
            .gutenverse-companion-base-theme-notice{
				background : url(<?php echo esc_url( trailingslashit( get_template_directory_uri() ) ) . "assets/img/unibiz-bg-banner-gradient.png"; ?>);
				background-position: center;
				background-repeat: no-repeat;
				background-size: cover;
				position: relative;
			}
			.gutenverse-companion-base-theme-notice .unibiz-gutenverse-badge{
				position: absolute;
				bottom: 0;
				right: 0;
				width: 121px;
				margin: 0 15px 15px 0;
			}
			.notice.gutenverse-companion-base-theme-notice{
				border: none;
				padding: 0px;
			}
			.gutenverse-companion-base-theme-notice .content-wrapper{
				width: 100%;
				height: 100%;
				display: flex;
				overflow: hidden;
				position: relative;
			}

			.gutenverse-companion-base-theme-notice .content-wrapper .close-button{
				position: absolute;
				top: 5px;
				right: 5px;
				cursor: pointer;
				transition: transform .3s ease;
				z-index: 5;
			}
			.gutenverse-companion-base-theme-notice .content-wrapper .close-button:hover{
				transform: scale(.93);
			}
			
			.gutenverse-companion-base-theme-notice .content-wrapper .col-1{
				width: 50%;
				position: relative;
				z-index: 3;
			}
			.gutenverse-companion-base-theme-notice .content-wrapper .col-1 .content{
				margin: 40px 0px 40px 60px;
			}

			.gutenverse-companion-base-theme-notice .content-wrapper .col-1 .title{
				font-family: Host Grotesk;
				font-weight: 700;
				font-size: 24px;
				line-height: 1.14;
				background: linear-gradient(93.32deg, #00223D 0.65%, #371C73 68.04%);
				background-clip: text;
				-webkit-background-clip: text;
				-webkit-text-fill-color: transparent;
			}

			.gutenverse-companion-base-theme-notice .content-wrapper .col-1 .title .highlight-title{
				background: linear-gradient(84.2deg, #7032FF 15.94%, #4B8EFF 97.2%);
				background-clip: text;
				-webkit-background-clip: text;
				-webkit-text-fill-color: transparent;
			}
			.gutenverse-companion-base-theme-notice .content-wrapper .col-1 .description{
				font-family: Host Grotesk;
				font-weight: 400;
				font-size: 14px;
				color: #00223D99;
			}
			.gutenverse-companion-base-theme-notice .content-wrapper .col-1 .feature-wrapper{
				display: flex;
				gap: 10px;
				text-wrap: nowrap;
				align-items: center;
			}
			.gutenverse-companion-base-theme-notice .content-wrapper .col-1 .feature-wrapper .feature-item{
				display: flex;
				gap: 5px;
				align-items: center;
				font-family: Host Grotesk;
				font-weight: 500;
				font-size: 12px;
				color: #5C51F3;
				border-radius: 24px;
				padding: 3px 10px 3px 5px;
				background: #FFFFFF;
				border: 1px solid #5C51F34D
			}
			.gutenverse-companion-base-theme-notice .content-wrapper .col-1 .button-wrapper{
				display: flex;
				align-items: center;
				margin-top: 20px;
			}

			.gutenverse-companion-base-theme-notice .content-wrapper .col-1 .button-wrapper .button-install{
				width: 142;
				height: 36;
				border-radius: 8px;
				padding: 10px 16px;
				background: radial-gradient(103.69% 112% at 51.27% 100%, #4992FF 0%, #7722FF 100%);
				border: 1px solid #9760FF;
				color: white;
				cursor: pointer;
				transition: transform .3s ease;
			}
			.gutenverse-companion-base-theme-notice .content-wrapper .col-1 .button-wrapper .button-install svg {
				animation: infinite rotate 2s linear;
			}
			.gutenverse-companion-base-theme-notice .content-wrapper .col-1 .button-wrapper .button-install:hover{
				transform: scale(.93);
			}
			.gutenverse-companion-base-theme-notice .content-wrapper .col-1 .button-wrapper .arrow-wrapper{
				position: relative;
			}
			.gutenverse-companion-base-theme-notice .content-wrapper .col-1 .button-wrapper .unibiz-arrow{
				position: absolute;
				top: -35px;
				right: -128px;
				width: 100px;
			}

			.gutenverse-companion-base-theme-notice .content-wrapper .col-2{
				position: relative;
				width: 100%;
				display: flex;
				justify-content: center;
			}

			.gutenverse-companion-base-theme-notice .content-wrapper .col-2 .unibiz-wave{
				position:absolute;
				right: 0;
			}
			.gutenverse-companion-base-theme-notice .content-wrapper .col-2 .mockup-wrapper{
				display: flex;
				justify-content: center;
				position: relative;
			}
			.gutenverse-companion-base-theme-notice .content-wrapper .col-2 .mockup-wrapper .unibiz-mockup{
				z-index: 2;
				max-width: 550px;
			}
			.gutenverse-companion-base-theme-notice .content-wrapper .col-2 .mockup-wrapper .unibiz-confetti{
				z-index: 2;
				position: absolute;
				top: -10px;
				bottom: 0;
				height: 110%;
			}
			.gutenverse-companion-base-theme-notice .content-wrapper .col-2 .mockup-wrapper .unibiz-wave{
				z-index: 2;
				position: absolute;
				top: -200%;
				right: -70%;
			}
			@media screen and (max-width: 1440px) {
				.gutenverse-companion-base-theme-notice .content-wrapper .col-2{
					position: relative;
					width: 100%;
					display: flex;
					justify-content: end;
				}
			}
			@media screen and (max-width: 1300px) {
				.gutenverse-companion-base-theme-notice .content-wrapper .col-1{
					width: 100%;
				}
				.gutenverse-companion-base-theme-notice .content-wrapper .col-2{
					display: none;
				}
			}
			@media screen and (max-width: 765px) {
				.gutenverse-companion-base-theme-notice .content-wrapper .col-1 .title {
					font-size: 20px;
				}
				.gutenverse-companion-base-theme-notice .content-wrapper .col-1 .description {
					font-size: 12px;
				}
				.gutenverse-companion-base-theme-notice .content-wrapper .col-1 .content{
					margin: 20px;
				}
				.gutenverse-companion-base-theme-notice .content-wrapper .col-1 .button-wrapper .button-install{
					font-size: 12px;
				}
			}
			@media screen and (max-width: 530px) {
				.gutenverse-companion-base-theme-notice .content-wrapper .col-1 .button-wrapper .arrow-wrapper{
					display: none;
				}
			}
			@media screen and (max-width: 425px) {
				.gutenverse-companion-base-theme-notice .content-wrapper .col-1 .button-wrapper .button-install{
					padding: 6px 10px;
					font-size: 10px;
				}
				.gutenverse-companion-base-theme-notice .unibiz-gutenverse-badge{
					width: 100px;
					margin: 0 10px 15px 0;
				}
			}
			@keyframes rotate {
				from {
					transform: rotate(0deg);
				}

				to {
					transform: rotate(360deg);
				}
			}
        </style>
		<script>
        var promises = [];
        var actions = <?php echo wp_json_encode( $actions ); ?>;
        let site_url = window.location.origin;

		const versionCompare = (v1, v2, operator) => {
			const a = v1.split('.').map(Number);
			const b = v2.split('.').map(Number);
			const len = Math.max(a.length, b.length);

			for (let i = 0; i < len; i++) {
				const num1 = a[i] || 0;
				const num2 = b[i] || 0;
				if (num1 > num2) {
					switch (operator) {
						case '>': case '>=': case '!=': return true;
						case '<': case '<=': case '==': return false;
					}
				}
				if (num1 < num2) {
					switch (operator) {
						case '<': case '<=': case '!=': return true;
						case '>': case '>=': case '==': return false;
					}
				}
			}

			// If equal so far
			switch (operator) {
				case '==': case '>=': case '<=': return true;
				case '!=': return false;
				case '>': case '<': return false;
			}
		};

        function sequenceInstall(plugin, pluginsInstalled) {
			return new Promise((resolve, reject) => {
				if (!plugin) return resolve();

				const slug = plugin.slug;
				const path = `${slug}/${slug}`;
				const needUpdate = plugin.installed
					? versionCompare(plugin.version, pluginsInstalled[`${path}.php`].Version, '>')
					: false;

				let request;

				if (needUpdate) {
					wp.apiFetch({
						path: `wp/v2/plugins/plugin?plugin=${path}`,
						method: 'PUT',
						data: { status: 'inactive' }
					})
						.then(() => {
							return wp.apiFetch({
								path: `wp/v2/plugins/plugin?plugin=${path}`,
								method: 'DELETE'
							});
						})
						.then(() => {
							return wp.apiFetch({
								path: 'wp/v2/plugins',
								method: 'POST',
								data: { slug, status: 'active' }
							});
						})
						.then(() => resolve())
						.catch((error) => {
							console.error(`Failed to update plugin ${slug}:`, error);
							resolve();
						});
				} else {
					switch (actions[slug]) {
						case 'active':
							return resolve();

						case 'inactive':
							request = wp.apiFetch({
								path: `wp/v2/plugins/plugin?plugin=${path}`,
								method: 'POST',
								data: { status: 'active' }
							});
							break;

						default:
							request = wp.apiFetch({
								path: 'wp/v2/plugins',
								method: 'POST',
								data: { slug, status: 'active' }
							});
							break;
					}

					request
						.then(() => resolve())
						.catch((error) => {
							console.error(`Failed to install/activate ${slug}:`, error);
							resolve();
						});
				}
			});
		}
		
		document.addEventListener('DOMContentLoaded', () => {
			const closeBtn = document.querySelector('#gutenverse-companion-base-theme-notice-close');
			const notice   = document.querySelector('.gutenverse-companion-base-theme-notice');

			if (closeBtn && notice) {
				closeBtn.addEventListener('click', () => {
				// fadeOut effect in pure JS
				notice.style.transition = 'opacity 0.5s';
				notice.style.opacity = '0';

				jQuery.post(ajaxurl, {
					action: 'gutenverse_companion_unibiz_dismiss_notice',
					_ajax_nonce: '<?php echo esc_js( wp_create_nonce( 'gutenverse_companion_unibiz_dismiss' ) ); ?>'
				});

				setTimeout(() => {
					notice.style.display = 'none';
				}, 500); // match the transition duration
				});
			}
		});
		document.addEventListener('DOMContentLoaded', function () {
			const button = document.getElementById('gutenverse-install-plugin');
			
			if (!button) return;

			button.addEventListener('click', function (e) {
				button.innerHTML = `<svg width='17' height='17' viewBox='0 0 17 17' fill='none' xmlns='http://www.w3.org/2000/svg'>
					<path d='M8.69737 1V2.89873M8.69737 12.962V16M3.76316 8.40506H1M16 8.40506H14.8158M13.7951 13.3092L13.2368 12.7722M13.9586 3.40439L12.8421 4.47848M3.10914 13.7811L5.34211 11.6329M3.27264 3.2471L4.94737 4.85823' stroke='white' strokeWidth='1.5' strokeLinecap='round' strokeLinejoin='round' />
				</svg>`;
				const hasFinishClass = button.classList.contains('finished');

				if (!hasFinishClass) {
					e.preventDefault(); // stop navigation
				}
				if (!hasFinishClass) {
					const pluginsRequired = <?php echo wp_json_encode( $plugins_required ); ?>;
					const plugins = [
						{ name: 'Gutenverse', slug: 'gutenverse', version: '3.2.0', url: '' },
						{ name: 'Gutenverse Companion', slug: 'gutenverse-companion', version: '2.0.0', url: '' },
					];

					const combinedPlugins = plugins.map(plugin => {
						const match = pluginsRequired.find(req => req.slug === plugin.slug);
						return { ...plugin, ...match };
					});

					const pluginsInstalled = <?php echo wp_json_encode( $all_plugin ); ?>;
					let sequence = Promise.resolve();

					combinedPlugins.forEach(plugin => {
						sequence = sequence.then(() => sequenceInstall(plugin, pluginsInstalled));
					});

					sequence.then(() => {
						
						window.location.href = site_url + '/wp-admin/themes.php?page=gutenverse-companion-wizard';
		
					});
				}
			});
		});
        </script>
		<div class="notice gutenverse-companion-base-theme-notice">
			<div class="content-wrapper">
				<div class="close-button" id="gutenverse-companion-base-theme-notice-close">
					<svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
						<foreignObject x="-3" y="-3" width="20" height="20"><div xmlns="http://www.w3.org/1999/xhtml" style="backdrop-filter:blur(1.5px);clip-path:url(#bgblur_0_23210_9188_clip_path);height:100%;width:100%"></div></foreignObject><g data-figma-bg-blur-radius="3">
						<rect width="14" height="14" rx="2" fill="#4F389C" fill-opacity="0.3"/>
						<path d="M9 5L5 9M5 5L9 9" stroke="white" stroke-width="0.8" stroke-linecap="round"/>
						</g>
						<defs>
						<clipPath id="bgblur_0_23210_9188_clip_path" transform="translate(3 3)"><rect width="14" height="14" rx="2"/>
						</clipPath></defs>
					</svg>

				</div>
				<div class="col-1">
					<div class="content">
						<h3 class="title"><?php esc_html_e( "Thankyou For Installing", "unibiz" ); ?> <span class="highlight-title"><?php esc_html_e( "Unibiz Theme!", "unibiz" ); ?></span></h3>
						<p class="description"><?php esc_html_e( "Unlock the full potential of your website with the Required plugins. Activate it to explore exclusive extensions, ready-to-use demo templates, and powerful features that make building your site easier and more enjoyable.", "unibiz" ); ?></p>
						<div class="button-wrapper">
							<div class="button-install" id="gutenverse-install-plugin"><?php esc_html_e( "Install Required Plugins", "unibiz" ); ?></div>
							<div class="arrow-wrapper">
								<img class="unibiz-arrow" src="<?php echo esc_url( trailingslashit( get_template_directory_uri() ) ) . "assets/img/unibiz-arrow.png"; ?>"  alt="image arrow unibiz"/>
							</div>
						</div>
					</div>
				</div>
				<div class="col-2">
					<div class="mockup-wrapper">
						<img class="unibiz-wave" src="<?php echo esc_url( trailingslashit( get_template_directory_uri() ) ) . "assets/img/unibiz-bg-banner-circle-full.png"; ?>" alt="wave"/>
						<img class="unibiz-confetti" src="<?php echo esc_url( trailingslashit( get_template_directory_uri() ) ) . "assets/img/unibiz-confetti.png"; ?>"  alt="image confetti"/>
						<img class="unibiz-mockup" src="<?php echo esc_url( trailingslashit( get_template_directory_uri() ) ) . "assets/img/unibiz-mockup.png"; ?>"  alt="image mockup"/>
					</div>
				</div>
			</div>
			<img class="unibiz-gutenverse-badge" src="<?php echo esc_url( trailingslashit( get_template_directory_uri() ) ) . "assets/img/unibiz-gutenverse-badge.png"; ?>"  alt="image gutenverse badge"/>
		</div>
		<?php
	}

	/**
	 * Dismiss Notice After closed.
	 */
	public function dismiss_notice() {
		check_ajax_referer( 'gutenverse_companion_unibiz_dismiss' );

		if ( ! get_option( 'gutenverse_companion_unibiz_notice_dismissed' ) ) {
			update_option( 'gutenverse_companion_unibiz_notice_dismissed', true );
		}

		wp_send_json_success();
	}
    
    /**
	 * Check if plugin is installed.
	 *
	 * @param string $plugin_slug plugin slug.
	 * 
	 * @return boolean
	 */
	public function is_installed( $plugin_slug ) {
		$all_plugins = get_plugins();
		foreach ( $all_plugins as $plugin_file => $plugin_data ) {
			$plugin_dir = dirname($plugin_file);

			if ($plugin_dir === $plugin_slug) {
				return true;
			}
		}

		return false;
	}
}
