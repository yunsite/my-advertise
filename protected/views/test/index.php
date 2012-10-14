    
<script type="text/javascript">

function test(){

    var tt = $.fancybox('<div style="width:500px;height:500px;background:grey;"></div>');
    console.log(tt);
    return tt;
}

(function($){
    var origContent = "";

    function loadContent(hash) {
        if(hash != "") {
            if(origContent == "") {
                origContent = $('#textcontent').html();
            }
            $('#textcontent').load(hash +".html");
        } else if(origContent != "") {
            $('#textcontent').html(origContent);
        }
    }

    $(document).ready(function() {
            $.history.init(loadContent);
            $('#navigation a').not('.external-link').click(function(e) {
                    var url = $(this).attr('href');
                    url = '/'+url.replace(/^.*#/, '');
                    
                    console.log(url);
                    
                    $.history.load(url);
                    return false;
                });
        });
})(jQuery);

$(function(){
    test();
});
</script>
<div id="navigation">
    <span class="button" onclick="test();">Button-Test</span>
    <a href="#style/index">Style</a>
    <a href="#admincp/lab">Lab</a>
    <a href="#admincp/statistics">Statistics</a>
</div>
<hr />
<div id="textcontent"></div>
