jQuery(document).ready(function ($) {
    var mediaUploader;

    $("#picture-avatar-upload").on("click", function (e) {
        e.preventDefault();
        if (mediaUploader) {
            mediaUploader.open();
            return;
        }
        mediaUploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose a Profile Picture',
            button: {
                text: 'Choose Profile Picture'
            },
            multiple: false,
        });
        mediaUploader.on("select", function () {
            attachment = mediaUploader.state().get('selection').first().toJSON();
            $("#profile-picture").val(attachment.url);
        });

        mediaUploader.open();
    });
})