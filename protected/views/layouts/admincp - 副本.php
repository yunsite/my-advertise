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
											CHtml::link('创建模板', '#template_create', array('class'=>'history')),
											CHtml::link('创建主题', '#style_create', array('class'=>'history')),
                                            CHtml::link('创建主题','#theme_create',array('class'=>'history')),
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




<?php $this->endContent(); ?>