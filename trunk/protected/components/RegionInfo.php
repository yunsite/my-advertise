<?php
class RegionInfo extends CWidget
{
	
	public $isList = true;
	
	private function getData()
	{
		$data = Region::model()->findAll(array(
			'condition'=>'pid = :pid',
			'params'=>array(
				':pid'=>0
			)
		));
		
	
		return $data;
	}
	
	private function showList()
	{
		$pinyin = new PinYin();

		$data = $this->getData();
		echo '<ul>';
		foreach ($data as $item) {
			echo '<li>';
			echo CHtml::link($item->region,array('/region/view','id'=>$item->id,'area'=>$pinyin->words2Short($item->region,1)));
			echo '</li>';
		}
		echo '</ul>';		
	} 
	
	private function showLinks()
	{
		
		$pinyin = new PinYin();

		$data = $this->getData();
		foreach ($data as $item) {
			echo CHtml::link($item->region,array('/region/view','id'=>$item->id,'area'=>$pinyin->words2Short($item->region,1)),array('onclick'=>'uu.loadRegion($(this));return false;'));
		}
		
	}
	
	
	public function run()
	{
		if ($this->isList)
		{
			$this->showList();
		}
		else 
		{
			$this->showLinks();
		}
	}
}
?>