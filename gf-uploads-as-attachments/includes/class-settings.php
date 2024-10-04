<?php

namespace ElegantModules\GFUploadsAttachments;

class Settings {

	public function __construct() {
		add_action( 'admin_notices', array( $this, 'admin_notice' ) );
		add_action( 'admin_notices', array( $this, 'upgrade_notice' ) );
		add_action( 'wp_ajax_gfuaa_dismiss_upgrade_notice', array( $this, 'dismiss_upgrade_notice' ) );
		add_filter( 'gform_notification_ui_settings', array( $this, 'add_notification_settings' ), 10, 3 );
		add_filter( 'gform_pre_notification_save', array( $this, 'save_notification_settings' ), 10, 2 );
	}

	public function admin_notice() {

		// Bail if Gravity Forms is active
		if ( is_plugin_active( 'gravityforms/gravityforms.php' ) ) {
			return;
		}

		?>
		<div class="notice notice-error">
			<p><strong><?php esc_html_e( 'Gravity Forms - Uploads as Attachments', 'gf-uploads-as-attachments' ); ?></strong> <?php esc_html_e( 'requires', 'gf-uploads-as-attachments' ); ?> <a href="https://elegantmodules.com/go/gravity-forms/" target="_blank"><em><?php esc_html_e( 'Gravity Forms', 'gf-uploads-as-attachments' ); ?></em></a> <?php esc_html_e( 'to work.', 'gf-uploads-as-attachments' ); ?></p>
		</div>
		<?php
	}

	public function upgrade_notice() {
		if ( ! get_transient( 'gfuaa_dismiss_upgrade_notice' ) ) {
			gf_uploads_as_attachments_upgrades( true );
		}
	}

	public function dismiss_upgrade_notice() {

		if ( empty( $_POST['nonce'] ) || ! wp_verify_nonce( $_POST['nonce'], 'gfuaa_dismiss_upgrade_notice' ) ) {
			die();
		}

		if ( ! current_user_can( 'manage_options' ) ) {
			die();
		}

		set_transient( 'gfuaa_dismiss_upgrade_notice', 1, YEAR_IN_SECONDS );
		wp_send_json_success( array(
			'dismissed' => true
		) );
	}

	/**
	 * Gravity Forms Notification UI Settings.
	 */
	public function add_notification_settings( $ui_settings, $confirmation, $form ) {

		$checked_enable = '';
		$checked_delete_files_after = '';

		if ( isset( $confirmation['jbl_gfuaa_enable'] ) && $confirmation['jbl_gfuaa_enable'] == 1 ) {
			$checked_enable = ' checked="checked"';
		}

		if ( isset( $confirmation['jbl_gfuaa_delete_files_after'] ) && $confirmation['jbl_gfuaa_delete_files_after'] == 1 ) {
			$checked_delete_files_after = ' checked="checked"';
		}

		ob_start();

		?>

		<tr valign="top">
			<th colspan=2>
				<hr>
				<strong><?php _e( 'Uploads as Attachments settings', 'gf-uploads-as-attachments' ); ?>: </strong>
			</th>
		</tr>
		<tr valign="top">
			<th scope="row">
				<label for="jbl_gfuaa_enable"><?php _e( 'Enable', 'gf-uploads-as-attachments' ); ?></label>
			</th>
			<td>
				<input type="checkbox" id="jbl_gfuaa_enable" name="jbl_gfuaa_enable" value="1" <?php echo $checked_enable; ?>>
				<label for="jbl_gfuaa_enable" class="inline"><?php _e( 'Add fileupload fields from this form as attachments to this notification', 'gf-uploads-as-attachments' ) ?></label>
				<br>
			</td>
		</tr>
		<tr valign="top">
			<th scope="row">
				<label for="jbl_gfuaa_delete_files_after"><?php _e( 'Delete files', 'gf-uploads-as-attachments' ); ?></label>
			</th>
			<td>
				<input type="checkbox" id="jbl_gfuaa_delete_files_after" name="jbl_gfuaa_delete_files_after" value="1" <?php echo $checked_delete_files_after; ?>>
				<label for="jbl_gfuaa_delete_files_after" class="inline"><?php _e( 'Delete uploaded files from server after notification sent?', 'gf-uploads-as-attachments' ); ?></label>
				<br>
			</td>
		</tr>
		<tr valign="top">
			<th scope="row" colspan="2">
				<?php gf_uploads_as_attachments_upgrades(); ?>
			</th>
		</tr>

		<?php

		$ui_settings['jbl_uaa_settings'] = ob_get_clean();

		return $ui_settings;
	}

	/**
	 * Save custom settings to the notification
	 */
	public function save_notification_settings( $notification, $form ) {

		if ( isset( $_POST['jbl_gfuaa_enable'] ) ) {
			$notification['jbl_gfuaa_enable'] = rgpost( 'jbl_gfuaa_enable' );
		}

		if ( isset( $_POST['jbl_gfuaa_delete_files_after'] ) ) {
			$notification['jbl_gfuaa_delete_files_after'] = rgpost( 'jbl_gfuaa_delete_files_after' );
		}

		return $notification;
	}
}

new Settings;
