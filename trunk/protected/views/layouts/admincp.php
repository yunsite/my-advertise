<?php $this->beginContent('//layouts/main'); ?>
<div class="container">
	<aside class="span-3">		
		<?php		
		
			$links = array(
				 '基本设置'=>implode('', array(
                                            CHtml::link('实验页','#admincp_lab',array('class'=>'history')),
											CHtml::link('今日更新', array('index','#'=>'admincp_update'),array('class'=>'history')),
											CHtml::link('广告栏', '#admincp_brand',array('class'=>'history')),
											CHtml::link('广告排行榜', '#info_admin',array('class'=>'history')),
											CHtml::link('用户信息', '#user_admin',array('class'=>'history')),
											CHtml::link('所有频道', '#channel_admin',array('class'=>'history')),
											CHtml::link('所有行业', '#job_admin', array('class'=>'history')),
											CHtml::link('所有专业', '#job_expertise', array('class'=>'history')),
											CHtml::link('发送邮件', '#admincp_email',array('class'=>'history')),
											CHtml::link('添加频道', '#channel_create',array('class'=>'history')),
											CHtml::link('地域管理', array('index','#'=>'region_admin'), array('class'=>'history')),
											CHtml::link('添加地域', array('index','#'=>'region_create'), array('class'=>'history')),
										)
									),
				 '模板管理'=>implode('', array(				 							
											CHtml::link('广告主题', '#theme_create_'.Template::ADVERTISEMENT_TEMPLATE, array('class'=>'history')),
											CHtml::link('邮件主题', '#theme_create_'.Template::EMAIL_TEMPLATE, array('class'=>'history')),
                                            CHtml::link('摘要主题', '#theme_create_'.Template::NOTE_TEMPLATE,array('class'=>'history')),
                                            CHtml::link('名片主题', '#theme_create_'.Template::CARD_TEMPLATE, array('class'=>'history')),
											CHtml::link('主题管理', '#theme_index', array('class'=>'history'))

										)
									),
				 '主题管理'=>implode('', array(
											CHtml::link('广告主题', '#admincp_theme', array('class'=>'history')),
										)								
									),
                '权限控制'=>implode('',array(
                
                                            CHtml::link('AuthItem','#srbac_authitem_manage',array('class'=>'history'))
                )),
		         '系统设置'=>implode('', array(
											CHtml::link('参数设置', '#admincp_variables',array('class'=>'history')),
											CHtml::link('数据备份', '#template_index',array('class'=>'history')),
											CHtml::link('数据还原', '#admincp_recovery',array('class'=>'history')),
											CHtml::link('系统日志', '#template_create',array('class'=>'history')),
											CHtml::link('服务器参数', '#admincp_sysinfo',array('class'=>'history'))
										)
									),
		         // panel 3 contains the content rendered by a partial view
		         'panel 3'=>'content',
			);

			$this->widget('zii.widgets.jui.CJuiAccordion', array(
			     'panels'=>$links,
			     // additional javascript options for the accordion plugin
			     'options'=>array(
			        'animated'=>'bounceslide',
					'autoHeight'=>false,
					 'active'=>intval(Yii::app()->request->cookies['accordionId']->value)
			     ),
			     'htmlOptions'=>array(
			     	'class'=>'cpanelAccordion',
			     	'style'=>'width:150px;overflow:hidden;'
			     )
			));
			
		?>		
		
	</aside>
	<div class="adSection right" id="blankArea">
		<?php echo $content; ?>
	</div>
</div>

<script type="text/javascript">
<!--
(function($){
	var origContent = '';
	
	function load(hash){
		
	
		if(hash != ''){
			if(origContent == ''){
				origContent = $("#blankArea").html();
			}

	
			url = '/'+hash.split("_").join("/") + '.html';

			console.log(url);
	
			$("#blankArea").load(url);
			
		} else if(origContent != ''){
			
			$("#blankArea").html(origContent);
		
		}

		
	}
	
	$(function(){

		//为accordion的每一个链接添加一个分组标识
		$(".history").each(function(i){
			$(this).attr("name",$(this).parent().prev("h3").index()/2);
			$(this).attr("sid",$(this).index());
		});

		//根据两个特征参数选定当然页面标题标签<a class="history">xxxx</a>
		$(".breadCrumb li:last span").html($(".history[name="+$.cookies.get("accordionId")+"]:eq("+$.cookies.get("historyId")+")").text())
				
		
		$.history.init(load);		
		
		
		$(".history").click(function(){
	
			$(".breadCrumb").find(".last").find("span").html($(this).text());

			//设置accordionId变量用于标识当前在哪个组
			$.cookies.set("accordionId",$(this).attr("name"));
			//设置historyId变量用于标识当前是在哪一个页面下
			$.cookies.set("historyId", $(this).index());

			console.log($.cookies.get("historyId"));
	
	        var url = $(this).attr('href');

	        
	               

	        <?php if (Yii::app()->user->isGuest):?>
			url = 'admincp_login';
			<?php else:?>
			url = url.replace(/^.*#/, ''); 
	    	<?php endif;?>

	        $.history.load(url);
			console.log(url);
			return false;
		});
		
	});
})(jQuery);

//-->
</script>
<?php $this->endContent(); ?>