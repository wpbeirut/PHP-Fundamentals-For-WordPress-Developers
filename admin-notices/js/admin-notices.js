jQuery(document).ready(function($) {

    $(document).on('click', '#an1 .notice-dismiss', function( event ) {

        data = {
            action : 'display_dismissible_admin_notice',
        };

        $.post(ajaxurl, data, function (response) {
            console.log(response, 'DONE!');
        });
    });
});