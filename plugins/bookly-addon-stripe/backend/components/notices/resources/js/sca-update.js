jQuery(function ($) {
    var $notice = $('#bookly-stripe-sca-update-notice');
    $notice.on('click', '[data-dismiss="alert"]', function(e) {
        $.post(ajaxurl, {action: $notice.data('action'), csrf_token: BooklyL10nGlobal.csrf_token});
        $notice.hide();
    });
});