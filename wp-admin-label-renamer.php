<?php
/**
 * Plugin Name: WP Admin Label Renamer
 * Description: Rename WordPress admin labels like Posts, Pages, Users, Media, Plugins, and Comments without touching code.
 * Version: 1.0.0
 * Author: Sai Varshith
 * License: GPLv2 or later
 * Text Domain: wp-admin-label-renamer
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/*--------------------------------------------------------------
# Admin Menu
--------------------------------------------------------------*/
add_action( 'admin_menu', 'alr_add_admin_menu' );
function alr_add_admin_menu() {
	add_menu_page(
		'Admin Label Renamer',
		'Admin Label Renamer',
		'manage_options',
		'admin-label-renamer',
		'alr_settings_page',
		'dashicons-editor-textcolor',
		60
	);
}

/*--------------------------------------------------------------
# Settings Page
--------------------------------------------------------------*/
function alr_settings_page() {
	?>
	<div class="wrap">
		<h1>WP Admin Label Renamer</h1>
		<p>Rename common WordPress admin labels to match your workflow. This plugin only changes visible labels and does not modify permissions, URLs, or post types.</p>

		<form method="post" action="options.php">
			<?php
			settings_fields( 'alr_group' );
			do_settings_sections( 'admin-label-renamer' );
			submit_button();
			?>
		</form>
	</div>
	<?php
}

/*--------------------------------------------------------------
# Register Settings
--------------------------------------------------------------*/
add_action( 'admin_init', 'alr_register_settings' );
function alr_register_settings() {

	register_setting(
		'alr_group',
		'alr_labels',
		[
			'sanitize_callback' => 'alr_sanitize_labels',
			'default'           => [],
		]
	);

	add_settings_section(
		'alr_section',
		'Rename Admin Labels',
		'__return_false',
		'admin-label-renamer'
	);

	$fields = [
		'posts'    => 'Posts',
		'pages'    => 'Pages',
		'users'    => 'Users',
		'comments' => 'Comments',
		'media'    => 'Media',
		'plugins'  => 'Plugins',
	];

	foreach ( $fields as $key => $label ) {
		add_settings_field(
			"alr_$key",
			"$label label",
			function () use ( $key ) {
				$options = get_option( 'alr_labels', [] );
				?>
				<input
					type="text"
					name="alr_labels[<?php echo esc_attr( $key ); ?>]"
					value="<?php echo esc_attr( $options[ $key ] ?? '' ); ?>"
					placeholder="Custom name"
				/>
				<?php
			},
			'admin-label-renamer',
			'alr_section'
		);
	}
}

/*--------------------------------------------------------------
# Sanitization
--------------------------------------------------------------*/
function alr_sanitize_labels( $input ) {
	$output = [];

	if ( ! is_array( $input ) ) {
		return $output;
	}

	foreach ( $input as $key => $value ) {
		$output[ $key ] = sanitize_text_field( $value );
	}

	return $output;
}

/*--------------------------------------------------------------
# Rename Admin Menu Labels
--------------------------------------------------------------*/
add_action( 'admin_menu', 'alr_rename_admin_menu_labels', 999 );
function alr_rename_admin_menu_labels() {

	$options = get_option( 'alr_labels', [] );
	if ( empty( $options ) ) {
		return;
	}

	global $menu;

	foreach ( $menu as $i => $item ) {

		if ( $item[2] === 'edit.php' && ! empty( $options['posts'] ) ) {
			$menu[ $i ][0] = esc_html( $options['posts'] );
		}

		if ( $item[2] === 'edit.php?post_type=page' && ! empty( $options['pages'] ) ) {
			$menu[ $i ][0] = esc_html( $options['pages'] );
		}

		if ( $item[2] === 'users.php' && ! empty( $options['users'] ) ) {
			$menu[ $i ][0] = esc_html( $options['users'] );
		}

		if ( $item[2] === 'edit-comments.php' && ! empty( $options['comments'] ) ) {
			$menu[ $i ][0] = esc_html( $options['comments'] );
		}

		if ( $item[2] === 'upload.php' && ! empty( $options['media'] ) ) {
			$menu[ $i ][0] = esc_html( $options['media'] );
		}

		if ( $item[2] === 'plugins.php' && ! empty( $options['plugins'] ) ) {
			$menu[ $i ][0] = esc_html( $options['plugins'] );
		}
	}
}

/*--------------------------------------------------------------
# Rename Labels (Scoped gettext)
--------------------------------------------------------------*/
add_filter( 'gettext', 'alr_rename_labels_gettext', 20, 3 );
function alr_rename_labels_gettext( $translated, $text, $domain ) {

	if ( ! is_admin() || $domain !== 'default' ) {
		return $translated;
	}

	$screen = function_exists( 'get_current_screen' ) ? get_current_screen() : null;
	if ( empty( $screen ) ) {
		return $translated;
	}

	$allowed_screens = [
		'dashboard',
		'edit-post',
		'edit-page',
		'users',
		'edit-comments',
		'upload',
		'plugins',
	];

	if ( ! in_array( $screen->base, $allowed_screens, true ) ) {
		return $translated;
	}

	$options = get_option( 'alr_labels', [] );
	if ( empty( $options ) ) {
		return $translated;
	}

	$map = [
		'Post'     => $options['posts']    ?? '',
		'Posts'    => $options['posts']    ?? '',
		'Page'     => $options['pages']    ?? '',
		'Pages'    => $options['pages']    ?? '',
		'User'     => isset( $options['users'] ) ? rtrim( $options['users'], 's' ) : '',
		'Users'    => $options['users']    ?? '',
		'Comment'  => isset( $options['comments'] ) ? rtrim( $options['comments'], 's' ) : '',
		'Comments' => $options['comments'] ?? '',
		'Media'    => $options['media']    ?? '',
		'Plugin'   => isset( $options['plugins'] ) ? rtrim( $options['plugins'], 's' ) : '',
		'Plugins'  => $options['plugins']  ?? '',
	];

	foreach ( $map as $from => $to ) {
		if ( $to ) {
			$translated = str_replace( $from, $to, $translated );
		}
	}

	return $translated;
}
