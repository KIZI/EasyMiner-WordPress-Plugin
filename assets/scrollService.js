(function ($, root) {$(document).ready(function(){
    var url = window.location.href;
    if (/#blockId=/.test(url)) {
        var blockId = url.replace(/(.+)#blockId=(.*)$/, '$2');
        blockId = blockId.replace(/XXX/g, ' ');
        blockId = decodeURI(blockId);
        var selector = "[data-easyminer-block-id='" + blockId + "']";
        var searched = $(selector).get(0);
        if (searched) {
            //https://stackoverflow.com/questions/442404/retrieve-the-position-x-y-of-an-html-element
            var y = searched.getBoundingClientRect().top;
            //kvuli chromu (https://stackoverflow.com/questions/15691569/javascript-issue-with-scrollto-in-chrome)
            setTimeout(function () {
                window.scroll({
                    top: y,
                    behavior: 'auto',
                });
            }, 0);
        }
    }
});})(jQuery, this);
