<script>

</script>

<script>
var uploader = mw.files.uploader({
    filetypes: ".xlsx, .xls",
    multiple: false,
    element: mw.$("#mw_uploader")
});

_mw_log_reload_int = false;
$(document).ready(function () {


    $(uploader).on("FileUploaded", function (obj, data) {
    	$('#mw_uploader').fadeIn();
    	$('#upload_file_info').hide();
    	mw.notification.success("Moving uploaded file...");

    	postData = {}
    	postData.src = data.src;

		$.post("<?php echo route('admin.language.import'); ?>", postData,
			function(msg) {
				if (msg.success) {
			    	mw.reload_module('.js-language-edit-browse-<?php echo $_POST['namespaceMD5'];?>');
			    }
				mw.notification.msg(msg);
		});
    });

    $(uploader).on('progress', function (up, file) {
        $('#mw_uploader').hide();
        $('#upload_file_info').show();
        mw.$("#upload_file_info").html("<b>Uploading file " + file.percent + "%</b><br /><br />");
    });

    $(uploader).on('error', function (up, file) {
        mw.notification.error("The template must be zip.");
    });

});
</script>

<div class="mb-5">
<h5>If you have a .xlsx translated file you can import it by uploading it here.</h5>
<br />

<span id="upload_file_info" style="font-size:14px;"></span>

 <span id="mw_uploader" class="mw-ui-btn mw-ui-btn-info">
	<i class="mw-icon-upload"></i> &nbsp;
	<span><?php _e("Upload file"); ?></span>
</span>

</div>
