<button onclick="uu.popLayout();">Pop</button>
<button onclick="uu.destroyLayout();">Destory</button>
<script type="text/javascript">
$(function(){
    $("#hello").load('<?php echo $this->createUrl('style/index'); ?>');
});
</script>
<div id="hello"></div>

