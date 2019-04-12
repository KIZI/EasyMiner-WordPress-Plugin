jQuery(document).ready(function($) {
    var url = window.location.href;
    if (/#blockId=/.test(url)) {
        var blockId = url.replace(/(.*)#blockId=(.*)$/,'$2');
        var selector = "[data-easyminer-block-id=" + blockId + "]";
        var searched = $(selector).get(0);
        if (searched) {
            var y = searched.getBoundingClientRect().top;
            window.scroll({
                top: y,
                behavior: 'auto',
            });
        }
    }
});
