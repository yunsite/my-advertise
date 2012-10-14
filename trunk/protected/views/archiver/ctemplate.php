<link type="text/css" rel="stylesheet" href="/public/css/templates.css" />
<?php Yii::app()->clientScript->registerCssFile('/public/css/tabs.css');?>
<script type="text/javascript">
<!--

$("header").slideUp();

// initialisation
editAreaLoader.init({
	id: "example_1"	// id of the textarea to transform		
	,start_highlight: true	// if start with highlight
	,allow_resize: "both"
	,allow_toggle: true
	,word_wrap: true
	,language: "en"
	,syntax: "php"	
});

$(function(){
	/**Tabs**/	
	$('ul.tabs').each(function() {
		$(this).find('li').each(function(i) {
			$(this).click(function(){
				$(this).addClass('current').siblings().removeClass('current')
					.parents('div.section').find('div.box').hide().end().find('div.box:eq('+i+')').fadeIn(150);
			});
		});
	});
});
//-->
</script>
<section>
<h3 class="pagetitle">
	<span class="title"><a href="<?php echo $this->createUrl('release');?>">预览模板</a></span> <span class="lightview">|</span> <span class="title" onclick="$('#tempateTools').slideToggle();">模板工具箱</span>
	<span class="text right"><a href="">草稿箱</a> | <a href="">使用说明</a></span>
</h3>
<!-- 模板工具栏 -->
<div id="tempateTools" class="hide">
	<br />	
	<div class="section vertical" style="width:100%;">
		<ul class="tabs">
			<li class="current">选择页面类型</li>
			<li onclick="loadUpload();">选择内容类型</li>
		</ul>
		<div class="box visible" id="templateLayouts">
			<a href=" "><img src="/public/images/templates/layouts/default.gif" /></a>
			<hr />
			<a href="<?php echo $this->createUrl('cconponent',array('type'=>Adcomponent::COMPONENT_PAGE));?>">添加页面模板</a>
		</div>			
		<div class="box" id="templateContents">
			222222222222222222222
		</div>	
		<hr class="space" />		
	</div>	
</div>
<hr class="space"/>
<!-- 模板预览区 -->
<div id="templatePreview">
	<div class="span-4">
		<ul>
			<li>Hello</li>
		</ul>
	</div>	
	<div class="span-19 right">
		<?php $this->widget('ext.editor.editarea.editareaWidget');?>
		<textarea id="example_1"  style="height: 350px; width: 100%;" name="test_1">
	
		$authors	= array();
		$news		= array();
		/* this is a long long long long long long long long long long long long long long long long long long long long long long long long long long long long long long long long long long comment for showing word-wrap feature */
		$query	= "SELECT author, COUNT(id) as 'nb_news' FROM news_messages GROUP BY author";
		$result	= mysql_query($query, $DBnews);
		while( $line = mysql_fetch_assoc($result) ){
			$authors[$line["author"]]	= $line["author"];
			$news[$line["author"]]		= $line['nb_news'];
		}
		
		$list= sprintf("('%s')", implode("', '", $authors));
		
		
		$query="SELECT p.people_id, p.name, p.fname, p.status, team_name, t.leader_id=p.people_id as 'team_leader', w.name as 'wp_name', w.type
				FROM people p, teams t, wppartis wp, wps w
				WHERE p.people_id IN $list AND p.org_id=t.team_id AND wp.team_id=t.team_id AND wp.wp_id=w.wp_id 
				GROUP BY p.people_id";
		if(isset($_GET["order"]) && $_GET["order"]!="nb_news")
			$query.=" ORDER BY ".$_GET["order"];
			
		$result=mysql_query($query, $DBkal);
		while($line = mysql_fetch_assoc($result)){
			printf("<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>", $line["name"], $line["fname"],
				$news[$line["people_id"]], $line["status"], $line["team_name"], ($line["team_leader"]=="1")?"yes":"no", $line["type"], $line["wp_name"]);
		
		}
		printf("</table>");
	
			</textarea>	
	</div>

</div>

</section>