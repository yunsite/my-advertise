/**
 * js页面滚动浮动层智能定位(jQuery)实例页面
 * @see 
 * <div class="float" id="float">
 *  我是个腼腆羞涩的浮动层...
 * </div>
 * 
 * //绑定	$("#float").smartFloat();
 */
$.fn.smartFloat = function() {
    var position = function(element) {
        var top = element.position().top, pos = element.css("position");
        $(window).scroll(function() {
            var scrolls = $(this).scrollTop();
            if (scrolls > top) {
                if (window.XMLHttpRequest) {
                    element.css({
                        position: "fixed",
                        top: 0
                    });
                } else {
                    element.css({
                        top: scrolls
                    });
                }
            }else {
                element.css({
                    position: "absolute",
                    top: top
                });
            }
        });
    };
    return $(this).each(function() {
        position($(this));
    });
};