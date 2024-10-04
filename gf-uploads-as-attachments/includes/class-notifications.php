<?php

namespace ElegantModules\GFUploadsAttachments;
use GFCommon, RGFormsModel;

class Notifications {

	public function __construct() {
		add_filter( 'gform_notification', array( $this, 'maybe_add_attachments' ), 10, 3 );
	}

	/**
	 * Add the fileupload files as attachments if the option is enabled for this notification
	 */
	public function maybe_add_attachments( $notification, $form, $entry ) {

		if ( isset( $notification['jbl_gfuaa_enable'] ) && $notification['jbl_gfuaa_enable'] == 1 ) {

			$fileuploadfields = GFCommon::get_fields_by_type( $form, array( 'fileupload' ) );

			if ( is_array( $fileuploadfields ) && ! empty( $fileuploadfields ) ) {

				$attachments = array();
				$upload_root = RGFormsModel::get_upload_root();

				$isS3Enabled = false;

				foreach ( $fileuploadfields as $field ) {
					$url = $entry[ $field['id'] ];

					// If S3 is enabled for any field, we don't want to delete the files because we need them to upload to S3
					if ( false === $isS3Enabled ) {
						$isS3Enabled = ! empty( $field->enableS3Field );
					}

					if ( ! empty( $url ) ) {

		                if ( $field['multipleFiles'] ) {
			                $uploaded_files = json_decode( stripslashes( $url ), true );
			                foreach ( $uploaded_files as $uploaded_file ) {
			                    $attachment = preg_replace( '|^(.*?)/gravity_forms/|', $upload_root, $uploaded_file );
			                    $attachments[] = $attachment;
			               	}
			            } else {
			                $attachment = preg_replace( '|^(.*?)/gravity_forms/|', $upload_root, $url );
			                $attachments[] = $attachment;
			            }
			        }

		        }

		        $notification['attachments'] = $attachments;
			}

			// Maybe delete the files after email
			if ( false === $isS3Enabled && isset( $notification['jbl_gfuaa_delete_files_after'] ) && $notification['jbl_gfuaa_delete_files_after'] == 1 ) {
				add_action( 'gform_after_email', array( $this, 'delete_files' ), 10, 12 );
			}
		}

		return $notification;
	}

	/**
	 * Delete uploaded files from server after sending the notification if the option is enabled.
	 */
	public function delete_files( $is_success, $to, $subject, $message, $headers, $attachments, $message_format, $from, $from_name, $bcc, $reply_to, $entry ) {
		if ( $is_success ) {
			foreach ( $attachments as $attachment ) {
				unlink( $attachment );
			}
		}
	}
}

new Notifications;
