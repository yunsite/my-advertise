<?php
$this->breadcrumbs=array(
	'Templates',
);

$this->menu=array(
	array('label'=>'Create Template', 'url'=>array('create')),
	array('label'=>'Manage Template', 'url'=>array('admin')),
);

 //   UtilHelper::dump(Template::model()->getDataTemplate(Template::ADVERTISEMENT_TEMPLATE));
?>
        <?php
        
        $html = '        
        <h1 class = " here dkdk " id="dk" classd="sdkfjfkdsa();">&lt;:{Advertisement.findByPk.title|pk=:id}:&gt;</h1>Template_code<p class="here-content">其实什么也没有的</p>Template_code<p>&lt;:{Advertisement.findByPk.content|pk=:id}:&gt;</p>


        '; 
        
        echo UtilLabel::getTemplateClass($html);
        
        die();
        
        
        function addPrefix(&$val, $key,$prefix)
        {
            $val = $prefix.'-'.$val;
        }
        
        $test = 'Hello everyone';
        
        $arr = explode(' ', $test);
        
        array_walk($arr,'addPrefix', 'light');
        UtilHelper::dump($arr);
        
        $id = 1; 
        
        $cname = 'light';    
        
        echo $html;   

        //替换参数
        $html = str_replace(':id',':'.$id,$html);
        //替换正则
        $pattern = '/class="(.*)"?/i';
        
        preg_match_all($pattern,$html,$matches);
        
        UtilHelper::dump($matches);
        
        $result = '';
        foreach($matches[1] as $item)
        {
            $result .= '.'.$item."{\n}";
        }
        
        echo $result;
        
        die();
        
        //替换匹配内容
        $html = preg_replace($pattern,'class="'.$cname.'-\1"',$html);
        
        echo $html;        

        //为匹配出来的内容添加首尾的双引号“""”
        $html = '$html= "'.$html.'";';
        //把字符串转化为可以执行的代码，得到需要的处理结果$html;
 //       eval($html);

        //输出处理结果
        echo $html;
        
       

   

        

        
            
        ?>
<h1>Templates</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
