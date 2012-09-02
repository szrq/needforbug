/**
 * Jquery文本框自动适应高度 
 *
 * <使用方法
 *  $(".chackTextarea-area").autoTextarea({
 *     maxHeight:220,
 *     minHeight:20
 *  })
 * >
 *
 * 来源：http://www.hujuntao.com/archives/jquery-plug-autotextarea.html
 */
(function($){
    $.fn.autoTextarea = function(options) {
        var defaults={
            maxHeight:null,
            minHeight:$(this).height()
        };
        var opts = $.extend({},defaults,options);
        return $(this).each(function() {
            $(this).bind("paste cut keydown keyup focus blur",function(){
                var height,style=this.style;
                this.style.height =  opts.minHeight + 'px';
                if (this.scrollHeight > opts.minHeight) {
                    if (opts.maxHeight && this.scrollHeight > opts.maxHeight) {
                        height = opts.maxHeight;
                        style.overflowY = 'scroll';
                    } else {
                        height = this.scrollHeight;
                        style.overflowY = 'hidden';
                    }
                    style.height = height  + 'px';
                }
            });
        });
    };
})(jQuery);
