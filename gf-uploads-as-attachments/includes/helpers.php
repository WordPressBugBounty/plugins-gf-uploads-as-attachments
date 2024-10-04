<?php

function gf_uploads_as_attachments_upgrades( $is_notice = false ) {
	?>
	<style>
		.syncs3-upgrade {
			background-color: #fff;
			padding: 30px;
			margin-bottom: 30px;
			border: 1px solid #eee;
			box-shadow: 0 1px 1px rgba(0,0,0,.04);
			position: relative;
		}
		.syncs3-upgrade:after {
			content: "";
			position: absolute;
			top: 0;
			left: 0;
			height: 100%;
			width: 4px;
			background: radial-gradient(circle at top left,#002dd2 0,#fb3ab6 100%);
		}
		.syncs3-upgrade__cta,
		.syncs3-upgrade__title {
			display: flex;
			align-items: center;
			justify-content: center;
		}
		.syncs3-upgrade__title h2 {
			font-size: 24px !important;
		}
		.syncs3-addon__title {
			font-size: 18px !important;
			margin-bottom: 20px;
		}
		.syncs3-upgrade__addons .addons {
			display: grid;
			grid-template-columns: 1fr 1fr;
			grid-column-gap: 30px;
			grid-row-gap: 10px;
			align-items: center;
			justify-content: center;
			text-align: left;
			padding: 30px;
		}
		.syncs3-upgrade__addons .addons .addon {
			background: #f5f5f5;
			padding: 30px;
			text-align: center;
			border-radius: 3px;
			box-shadow: 0 0 3px #ccc;
		}
		.syncs3-upgrade__addons .addons .addon svg {
			width: 50px;
			display: block;
			margin: 0 auto 20px;
		}
		.syncs3-upgrade__addons .desc {
			font-size: 18px;
			text-align: center;
		}
		.syncs3-upgrade .upgrade-button {
			color: #fff;
			background-color: #63c384;
			padding: 15px 30px;
			border-radius: 300px;
			text-decoration: none;
		}
	</style>
	<div class="syncs3-upgrade <?php echo $is_notice ? 'notice is-dismissible' : ''; ?>">
		<div class="syncs3-upgrade__title">
			<h2>Get More Out of Gravity Forms</h2>
		</div>
		<div class="syncs3-upgrade__addons">
			<p class="desc">Need more from Gravity Forms? Here are a couple Gravity Forms add-ons you might like...</p>
			<div class="addons">
				<div class="addon">
					<svg clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 55 55" xmlns="http://www.w3.org/2000/svg"><g fill="#e15343" fill-rule="nonzero" transform="translate(-22.641 -21.806)"><path d="m49.995 21.806c15.113 0 27.363 2.877 27.363 6.424 0 3.562-12.25 6.431-27.363 6.431-15.105 0-27.354-2.868-27.354-6.431.001-3.547 12.249-6.424 27.354-6.424z"/><path d="m49.995 39.095c14.088 0 25.684-2.49 27.193-5.707l-8.947 38.199c0 2.372-8.166 4.28-18.246 4.28-10.07 0-18.234-1.908-18.234-4.28l-8.949-38.199c1.511 3.216 13.105 5.707 27.183 5.707z"/></g></svg>
					<h3 class="syncs3-addon__title">SyncS3 for Gravity Forms</h3>
					<p>Push and sync Gravity Forms file uploads to your Amazon S3 buckets.</p>
					<div class="syncs3-upgrade__cta">
						<a href="https://elegantmodules.com/modules/syncs3-gravity-forms/?utm_source=gf_uploads_as_attachments_plugin&utm_medium=link&utm_campaign=notification_settings&utm_content=syncs3_upgrade" class="upgrade-button">Get SyncS3</a>
					</div>
				</div>
				<div class="addon">
					<svg viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg"><path fill="#4785FB" d="m776 205c-.907313 0-1.774308-.13563-2.569936-.382494-.812299.633481-2.181289 1.513598-3.517466 1.513598.700094-.662648.898145-1.946912.941619-2.902361-1.151052-.980157-1.854217-2.28993-1.854217-3.728743 0-3.037566 3.134007-5.5 7-5.5s7 2.462434 7 5.5-3.134007 5.5-7 5.5zm0-4c.552285 0 1-.447715 1-1s-.447715-1-1-1-1 .447715-1 1 .447715 1 1 1zm-3 0c.552285 0 1-.447715 1-1s-.447715-1-1-1-1 .447715-1 1 .447715 1 1 1zm6 0c.552285 0 1-.447715 1-1s-.447715-1-1-1-1 .447715-1 1 .447715 1 1 1zm0 0" fill-rule="evenodd" transform="translate(-768 -192)"/></svg>
					<h3 class="syncs3-addon__title">Canned Replies for Gravity Forms</h3>
					<p>Create canned replies, and send them in response to any form submission.</p>
					<div class="syncs3-upgrade__cta">
						<a href="https://elegantmodules.com/modules/canned-replies-for-gravity-forms/?utm_source=gf_uploads_as_attachments_plugin&utm_medium=link&utm_campaign=notification_settings&utm_content=canned_replies_upgrade" class="upgrade-button">Get Canned Replies</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php if ( $is_notice ) : ?>
		<script>
			jQuery(document).ready(function($) {
				$('body').on('click', '.syncs3-upgrade.notice.is-dismissible .notice-dismiss', function(event) {
					$.ajax({
						url: ajaxurl,
						type: 'POST',
						data: {
							action: 'gfuaa_dismiss_upgrade_notice',
							nonce: "<?php echo wp_create_nonce( 'gfuaa_dismiss_upgrade_notice' ); ?>"
						},
					})
					.done(function(data) {
						console.log(data);
					});
				});
			});
		</script>
	<?php endif; ?>
	<?php
}