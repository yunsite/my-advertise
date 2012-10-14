<style type="text/css">
<!--
ul.profileOperation
{
	list-style:none;
}
ul.profileOperation li
{
	padding:0 0 10px 20px;
	
	
}
ul.profileOperation li.basic
{
	background-position:-20px 0;
	background:url('/public/images/profile_basic.png') no-repeat;
}
ul.profileOperation li.power
{
	background-position:-20px 0;
	background:url('/public/images/profile_power.png') no-repeat;
}
ul.profileOperation li ul
{
	list-style:none;
	margin:10px 0 0 0;
	padding:0px;
}
ul.profileOperation li ul li
{
	padding:5px 0 5px 0;
}
ul.profileOperation li ul li:hover
{
	background:url('/public/images/profile_hover.png') right no-repeat;
	text-align:center;
	color:#000;
}
ul.profileOperation li ul li:hover a
{
	color:white;
}
-->
</style>

<?php 
/*$menu = $this->widget('zii.widgets.CMenu', array(
    'items'=>array(
        // Important: you need to specify url as 'controller/action',
        // not just as 'controller' even if default acion is used.
        array('label'=>'个人资料', 'items'=>array(
        	array('label'=>'基本资料','url'=>'#archiver_basic'),
        	array('label'=>'我的爱好','url'=>'#archiver_favorite'),
        	array('label'=>'私人资料','url'=>'#archiver_private'),
        	array('label'=>'实名认证','url'=>'#archiver_authentication'),
        ),
        'itemOptions'=>array('class'=>'basic'),
        'active'=>true
        ),
        array('label'=>'权限设置',  'items'=>array(
            array('label'=>'主页访问', 'url'=>'archiver_visite'),
            array('label'=>'评论回复', 'url'=>'archiver_comment'),
        ),
        'itemOptions'=>array('class'=>'power'),
        ),
        array('label'=>'信息发布设置', 'url'=>'', 'visible'=>Yii::app()->user->isGuest),
    ),
    'htmlOptions'=>array('class'=>'profileOperation span-4 history'),
));
*/
?>

<ul class="profileOperation span-4 history">
	<li class="basic active"><span>个人资料</span>
		<ul>
			<li><a href="#archiver_basic">基本资料</a></li>
			<li><a href="#archiver_favorite">我的爱好</a></li>
			<li><a href="#archiver_private">私人资料</a></li>
			<li><a href="#archiver_authentication">实名认证</a></li>
		</ul>
	</li>
	<li class="power"><span>权限设置</span>
		<ul>
			<li><a href="archiver_visite">主页访问</a></li>
			<li><a href="archiver_comment">评论回复</a></li>
		</ul>
	</li>
</ul>