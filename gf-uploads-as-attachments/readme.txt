=== Gravity Forms - Uploads as Attachments ===
Contributors: elegantmodules
Tags: gravity forms, gravityforms, email, notification, attachment, attachments, uploads
Requires at least: 2.5.0
Tested up to: 5.3.2
Stable tag: 1.3.0
License: GPLv2 or later.

Adds the option to add all fileupload fields to notifications as attachments.

== Description ==

*Requires [Gravity Forms](https://elegantmodules.com/go/gravity-forms/) by Rocketgenius, Inc.*

Need to store your Gravity Forms file uploads to your Amazon S3 buckets? [SyncS3 for Gravity Forms](https://elegantmodules.com/modules/syncs3-gravity-forms/?utm_source=gf_uploads_as_attachments_plugin&utm_medium=link&utm_campaign=readme&utm_content=syncs3_upgrade) pushes your file uploads to any S3 bucket.

This plugin adds an option to notifications to add files uploaded to fileupload fields as attachments to that specific notification.

#### Features

- Add files uploaded with fileupload fields to notifications as attachments.
- Option to delete the files from the server after succesfully sending the notification. This option will delete the files as soon as the notification that has this option enabled is succesfully sent. If you have multiple notifications that send the files as attachments make sure this option is only enabled for the notification that is sent last.

### Other Gravity Forms Add-Ons

- [SyncS3 for Gravity Forms](https://elegantmodules.com/modules/syncs3-gravity-forms/?utm_source=gf_uploads_as_attachments_plugin&utm_medium=link&utm_campaign=readme&utm_content=syncs3_upgrade) - SyncS3 gives Gravity Forms users the ability to push any files to any Amazon S3 bucket. When files are submitted through a form, you can send those files to any Amazon account, and any S3 bucket. Simply add your Amazon AWS credentials, chose which fields should push to S3, and save.
- [Canned Replies for Gravity Forms](https://elegantmodules.com/modules/canned-replies-for-gravity-forms/?utm_source=gf_uploads_as_attachments_plugin&utm_medium=link&utm_campaign=readme&utm_content=canned_replies_upgrade) - Canned Replies for Gravity Forms lets GF users add canned responses, and send them to the submitter of any form entry. Useful for common responses, or just messing with spammers!


== Installation ==

To install this plugin manually, follow these steps:

- From the dashboard of your site, navigate to Plugins --> Add New.
- Select the Upload option and hit "Choose File."
- Navigate to and select the .zip file you can download from this page.
- Follow the instructions and wait till it's finished.
- When it's finished, activate the plugin via the prompt. A message will show confirming activation was successful.

To use the plugin simply go to the notification edit screen in gravity forms.

Further / more instructions on installing WordPress plugins can be found in the codex.
https://codex.wordpress.org/Managing_Plugins#Installing_Plugins

== Frequently Asked Questions ==

== Screenshots ==
1. Notification settings

== Changelog ==

##### 1.3.0
- Gravity Forms - Uploads as Attachments is now owned and maintained by [Elegant Modules](https://elegantmodules.com/)
- Code refactor
- Added support for SyncS3 for Gravity Forms
- Added POT file for translations

##### 1.2.0
- Fixed multiple upload fields.
In certain cases only the file(s) from the last upload field in a form was added as an attachment. This problem is now solved.

##### 1.1.0
- Corrected preparation for i18n localization.

##### 1.0.1
- Fix for hanging AJAX processed forms.

##### 1.0.0
Initial release