<?php
class Category extends Channel
{
	public function categoryItem($model) {

		$id = $model->id;

		echo "<div class=\"".$category->item."\">";
		echo "<h4>".$model->name."</h4>";
		
		$item = Channel::model()->getChildrenArray($id);

		$item = Channel::model()->getChannelList($item, $id);

		foreach($item as $child){
			

			$id = $child['id'];
			$nodeType = Channel::model()->nodeType($id);

			self::categoryItemChildren($child, $nodeType);

		}

	}

	public function categoryItemChildren($item, $nodeType) {

		$link = CHtml::link($item['name'], array('/info/list','id'=>$item['id']));
		$link .= "&nbsp;&nbsp;&nbsp;&nbsp;";
		
		if ($item['deep'] == 1 && $nodeType == 1)
			echo "<span class=\"category-pop\">".$link."</span><ul>";
 		elseif ($item['deep'] == 1 && $nodeType == 3){
			echo "</ul>";
		}else{
			if ($nodeType == 1)
				echo "<li><span style=\"color:red\">".$link."</span>";	
			elseif ($nodeType == 2){
				echo $link;
			}else
				echo $link."</li>";
									
		}			

	}
}
?>