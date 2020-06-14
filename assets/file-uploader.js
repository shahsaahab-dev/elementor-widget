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
            $(".profile-picture-tag").attr("src", attachment.url);
        });

        mediaUploader.open();
    });

    $("#picture-proof-upload").on("click", function (e) {
        e.preventDefault();
        if (mediaUploader) {
            mediaUploader.open();
            return;
        }
        mediaUploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose a Proof Picture',
            button: {
                text: 'Choose Proof Picture'
            },
            multiple: false,
        });
        mediaUploader.on("select", function () {
            attachment = mediaUploader.state().get('selection').first().toJSON();
            $("#proof-picture").val(attachment.url);
            $(".proof-picture-tag").attr("src", attachment.url);
        });

        mediaUploader.open();
    });
})