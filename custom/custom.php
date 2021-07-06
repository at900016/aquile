<?php
add_action( 'admin_menu', 'home_page_setting' );
function home_page_setting(){
	add_menu_page( 
		__( 'Custom Menu Title', 'textdomain' ),
		'Home Page Setting',
		'manage_options',
		'home-page-setting',
		'home_page_setting_html',
		'dashicons dashicons-admin-site',
		6
	); 
}

function home_page_setting_html(){
	$args = array(
		'meta_query' => array(
			array(
				'key' => 'hps_checkbox',
				'value' => 1
			)
		),
		'post_type' => 'page',
		'posts_per_page' => -1
	);
	$posts = get_posts($args);
	
	if(isset($_POST['home_page_setting_submit'])){
		$home_page_id = $_POST['home_page_id'];

		// show_on_front page
		// page_on_front $page->ID

		update_option('show_on_front', 'page');
		update_option('page_on_front', $home_page_id);
	}
	?>
	<form method="post">
		<select name="home_page_id">
			<?php foreach ($posts as $key => $value): ?>

				<option value="<?= $value->ID ?>"><?= $value->post_title ?><?= get_post_meta($value->ID, 'hps_name', true); ?></option>
			<?php endforeach ?>
		</select>
		<input type="submit" name="home_page_setting_submit">
	</form>
	<?php 
}

/**
 * Register meta box(es).
 */
function wpdocs_register_meta_boxes() {
	add_meta_box( 'home_page_setting_meta_box', __( 'Home Page Detail', 'textdomain' ), 'home_page_metabox_htmk', 'page' );
}
add_action( 'add_meta_boxes', 'wpdocs_register_meta_boxes' );

/**
 * Meta box display callback.
 *
 * @param WP_Post $post Current post object.
 */
function home_page_metabox_htmk( $post ) {
	$hps_checkbox = get_post_meta($post->ID, 'hps_checkbox', true);
	$hps_name = get_post_meta($post->ID, 'hps_name', true);
	?>
	Is this page use as a home page :: <input type="checkbox" <?= ($hps_checkbox == 1) ? 'checked' : '' ?>name="hps_checkbox" value="1"> <br>
	Home Pgae name :: <input type="text" name="hps_name" value="<?= $hps_name ?>">
	<input type="hidden" name="hps_form">
	<?php
}

/**
 * Save meta box content.
 *
 * @param int $post_id Post ID
 */
function wpdocs_save_meta_box( $post_id ) {
	if(isset($_POST['hps_form'])){
		$hps_checkbox = (isset($_POST['hps_checkbox'])) ? 1 : 0;
		$hps_name = $_POST['hps_name'];
		update_post_meta($post_id, 'hps_checkbox', $hps_checkbox);
		update_post_meta($post_id, 'hps_name', $hps_name);
	}
}
add_action( 'save_post', 'wpdocs_save_meta_box' );






