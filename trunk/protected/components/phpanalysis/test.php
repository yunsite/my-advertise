<?php

header('Content-Type: text/html; charset=utf-8');

require_once('phpanalysis.class.php');

$str = "2010年1月，美国国际消费电子展 (CES)上，联想将展出一款基于ARM架构的新产品，这有可能是传统四大PC厂商首次推出的基于ARM架构的消费电子产品，也意味着在移动互联网和产业融合趋势下，传统的PC芯片霸主英特尔正在遭遇挑战。
11月12日，联想集团副总裁兼中国区总裁夏立向本报证实，联想基于ARM架构的新产品正在筹备中。
英特尔新闻发言人孟轶嘉表示，对第三方合作伙伴信息不便评论。
正面交锋
ARM内部人士透露，11月5日，ARM高级副总裁lanDrew参观了联想研究院，拜访了联想负责消费产品的负责人，进一步商讨基于ARM架构的新产品。ARM是英国芯片设计厂商，全球几乎95%的手机都采用ARM设计的芯片。
据悉，这是一款采用高通芯片(基于ARM架构)的新产品，高通产品市场总监钱志军表示，联想对此次项目很谨慎，对于产品细节不方便透露。
夏立告诉记者，联想研究院正在考虑多种方案，此款基于ARM架构的新产品应用邻域多样化，并不是替代传统的PC，而是更丰富的满足用户的需求。目前，客户调研还没有完成，“设计、研发更前瞻一些，最终还要看市场、用户接受程度。";

echo $str;
	$do_fork = $do_unit = true;
	$do_multi = $do_prop = $pri_dict = false;

    //初始化类
    //PhpAnalysis::$loadInit = false;
    $pa = new PhpAnalysis('utf-8', 'utf-8', $pri_dict);
    
    //载入词典
    $pa->LoadDict();
    
    //执行分词
    $pa->SetSource($str);
    $pa->differMax = $do_multi;
    $pa->unitWord = $do_unit;
    
    $pa->StartAnalysis( $do_fork );
    
    $okresult = $pa->GetFinallyResult(' ', $do_prop);
     
    $pa_foundWordStr = $pa->foundWordStr;
    
    $pa = '';
    echo '<pre>';
    
    echo "<hr />";
    echo $okresult;
    
    $okresult = explode('',$okresult);
    var_dump($okresult);
	var_dump(array_count_values($okresult));
    
	echo "<hr />";
	echo $pa_foundWordStr;
	    
    '</pre>';

     



?>
