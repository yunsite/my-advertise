<?php foreach($data as $key=>$value):?>
    <a href="javscript:void();" onclick="insertData($(this));" id="<?php echo "<:{{$value}}:>"; ?>"><?php echo $key; ?></a>
<?php endforeach;?>