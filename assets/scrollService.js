jQuery(document).ready(function($) {
    var url = window.location.href;
    if (/#blockId=/.test(url)) {
        var blockId = url.replace(/(.*)#blockId=(.*)$/,'$2');
        var selector = "[data-easyminer-block-id=" + blockId + "]";
        var selector = "[class=foundRulesCount]";
        var searched = $(selector).get(0);
        if (searched) {
            var y = searched.getBoundingClientRect().top;
            //kvuli chromu (https://stackoverflow.com/questions/15691569/javascript-issue-with-scrollto-in-chrome)
            setTimeout(function () {
                window.scroll({
                    top: y,
                    behavior: 'auto',
                });
            }, 0);
        }  else {
            console.log("neděju se");
        }
    }
});
