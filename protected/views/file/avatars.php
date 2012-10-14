<?php 
    $avatar = null;
    
    $type = $_GET['type'];

    if($type == Lookup::USER_ADTHEME_PIC_FOLDER)    
        $avatar = '_themeavatar';
    else{
        $avatar = '_avatar';
        $this->widget('zii.widgets.CMenu', array());
    }
        

    
    
    $this->widget('zii.widgets.CListView', array(
    	'dataProvider'=>$dataProvider,
    	'itemView'=>$avatar,
    ));
?>
<script type="text/javascript">

</script>
