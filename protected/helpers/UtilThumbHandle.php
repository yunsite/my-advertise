<?php
class UtilThumbHandle extends ThumbHandler
{
	public function __construct($src)
	{
		parent::__construct();
		
		$this->setSrcImg($src);
	}
	
	function createImg($desinfo, $x, $y, $w, $h, $cuttype=2)
	{
//		$width = 500;
//		
//		$temp = './public/temp.jpg';
//		$this->setSrcImg($src);		
//		
//		$this->setCutType(1);//指明为手工裁切
//		$this->setDstImg($temp);
//		
//		$w = $this->getSrcImgWidth();
//		$h = $this->getSrcImgHeight();
//		
//		//宽度缩放比例
//		$num = ($width/$w)*100;
//		
//		parent::createImg($num);
		
		
		
		$this->setCutType($cuttype);//指明为手工裁切
		$this->setSrcCutPosition($x, $y);// 源图起点坐标
		$this->setRectangleCut($desinfo['width'], $desinfo['height']);// 裁切尺寸
		$this->setImgDisplayQuality(90);
		$this->setDstImg($desinfo['path']);
		parent::createImg($w, $h);		
	}
	
	function deleteImg($src)
	{
		if (file_exists($src))
			unlink($src);
	}
}