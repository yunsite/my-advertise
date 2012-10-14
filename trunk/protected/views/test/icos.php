<?php 
$icoArray = array(
	array('name'=>'lsDisplayBlockIcos'),
	array('name'=>'lsDisplayFull'),
	array('name'=>'lsDisplayBlockList'),
	array('name'=>'lsDisplayMiddel'),
	array('name'=>'lsDisplayTable'),
	array('name'=>'lsDisplayBlock'),
	array('name'=>'lsDisplayList')
);
?>
<table>
  <tr>
    <th>
    lsDebug<br />
    	<div class="lsIco lsDebug"></div>
	</th>
  </tr>
  <tr>
    <td>

    	<?php foreach ($icoArray as $ico):?>
    		<div style="width: 100px;" class="left">
	     		<?php echo $ico['name'];?><br />
	    		<span class="lsIco <?php echo $ico['name'];?>"><?php if (isset($ico['label'])) echo $ico['label'];?></span>
	
    		</div>
    	<?php endforeach;?>
    </td>
  </tr>
</table>