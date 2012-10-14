<!-- 此文件用于显示用户个人爱好相关资料 -->
<style type="text/css">
.tips{
	border:1px solid #efefef;
	background:#e8f8f8;
}
.tips h5{
	padding-left:20px;
}
.tips .tipsContent{
	padding:0px 20px 20px 20px;
	line-height:1em;
}
.tips .tipsContent .tags a,.tips .tipsContent .items a,.row .selectItems a {
	display:inline-block;
	border:1px solid grey;
	color:grey;
	padding:2px;
	margin:2px;
}
.tips .tipsContent .input,.tips .tipsContent .tags,.tips .tipsContent .items{
	width:400px;

}
.tips .tipsContent .input input{
	width:390px;;

}
.tips .tipsContent .items{
	background:white;
	margin-top:1px;
}
.row input{
	color:grey;
}
.row .selectItems{
	width:510px;
}

</style>
<section>
<h4 class="span-10">我的爱好<span class="ico ico_back"></span><a href="#archiver_favorite" class="more proedit">返回</a></h4>

<div class="form span-18 last">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'profile-form',
	'enableAjaxValidation'=>true,
)); ?>


	<?php echo $form->errorSummary($model); ?>
	<hr class="space" />
	<div class="row">
		<?php echo $form->labelEx($model,'favoriteStar'); ?>
		<?php echo $form->textField($model,'favoriteStar',array('size'=>60,'maxlength'=>100,'alt'=>Tag::TAG_STAR,'value'=>'你是大米，玉米？是凉粉还是冰粉？你丫喜欢啥星？','class'=>'span-13  poshy','title'=>'喜欢的明星')); ?>
		<div class="selectItems">
			<?php echo Tag::model()->generateTags($model->favoriteStar);?>
		</div>
		<?php echo $form->error($model,'favoriteStar'); ?>
	</div>
	<hr class="space" />
	<div class="row">
		<?php echo $form->labelEx($model,'favoriteFood'); ?>
		<?php echo $form->textField($model,'favoriteFood',array('size'=>60,'maxlength'=>100,'alt'=>Tag::TAG_FOOD,'value'=>'什么东西让你丫一想到就流哈喇子呢？泡菜，羊肉泡膜还是……','class'=>'span-13  poshy','title'=>'喜欢的美食')); ?>
		<div class="selectItems">
			<?php echo Tag::model()->generateTags($model->favoriteFood);?>
		</div>
		<?php echo $form->error($model,'favoriteFood'); ?>
	</div>
	<hr class="space" />
	<div class="row">
		<?php echo $form->labelEx($model,'favoriteMusic'); ?>
		<?php echo $form->textField($model,'favoriteMusic',array('size'=>60,'maxlength'=>100,'alt'=>Tag::TAG_MUSIC,'value'=>'你丫喜欢什么类型的音乐？R&B，乡村民乐，还是……','class'=>'span-13  poshy','title'=>'喜欢的音乐')); ?>
		<div class="selectItems">
			<?php echo Tag::model()->generateTags($model->favoriteMusic);?>
		</div>
		<?php echo $form->error($model,'favoriteMusic'); ?>
	</div>
	<hr class="space" />
	<div class="row">
		<?php echo $form->labelEx($model,'favoriteMovie'); ?>
		<?php echo $form->textField($model,'favoriteMovie',array('size'=>60,'maxlength'=>100,'alt'=>Tag::TAG_MOVIE, 'value'=>'你喜欢哪些电影？哪种类型？武侠，美国大片，还是……','class'=>'span-13  poshy','title'=>'喜欢的影视')); ?>
		<div class="selectItems">
			<?php echo Tag::model()->generateTags($model->favoriteMovie);?>
		</div>
		<?php echo $form->error($model,'favoriteMovie'); ?>
	</div>
	<hr class="space" />
	<div class="row">
		<?php echo $form->labelEx($model,'favoriteGames'); ?>
		<?php echo $form->textField($model,'favoriteGames',array('size'=>60,'maxlength'=>100,'alt'=>Tag::TAG_GAME,'value'=>'你平时玩网游，单机版的小游戏？','class'=>'span-13  poshy','title'=>'喜欢的游戏')); ?>
		<div class="selectItems">
			<?php echo Tag::model()->generateTags($model->favoriteGames);?>
		</div>
		<?php echo $form->error($model,'favoriteGames'); ?>
	</div>
	<hr class="space" />
	<div class="row">
		<?php echo $form->labelEx($model,'favoriteSports'); ?>
		<?php echo $form->textField($model,'favoriteSports',array('size'=>60,'maxlength'=>100,'alt'=>Tag::TAG_SPORT,'value'=>'你平时喜欢一些什么样的运动？蓝球，乒乓球，游泳……','class'=>'span-13  poshy','title'=>'喜欢的运动')); ?>
		<div class="selectItems">
			<?php echo Tag::model()->generateTags($model->favoriteSports);?>
		</div>
		<?php echo $form->error($model,'favoriteSports'); ?>
	</div>
	<hr class="space" />
	<div class="row">
		<?php echo $form->labelEx($model,'favoriteBooks'); ?>
		<?php echo $form->textField($model,'favoriteBooks',array('size'=>60,'maxlength'=>100,'alt'=>Tag::TAG_BOOK,'value'=>'你平时看书吗？不管生活节奏有多快，平时有多忙，一定要多看一点书噢～','class'=>'span-13  poshy','title'=>'喜欢的的书籍')); ?>
		<div class="selectItems">
			<?php echo Tag::model()->generateTags($model->favoriteBooks);?>
		</div>
		<?php echo $form->error($model,'favoriteBooks'); ?>
	</div>
	<hr class="space" />
	<div class="row">
		<?php echo $form->labelEx($model,'favoriteTourism'); ?>
		<?php echo $form->textField($model,'favoriteTourism',array('size'=>60,'maxlength'=>100,'alt'=>Tag::TAG_TOURISM,'value'=>'每一个人都有一个向往的圣地，你的圣地在何方？','class'=>'span-13  poshy','title'=>'喜欢的旅游圣地')); ?>
		<div class="selectItems">
			<?php echo Tag::model()->generateTags($model->favoriteTourism);?>
		</div>
		<?php echo $form->error($model,'favoriteTourism'); ?>
	</div>
	<hr class="space" />
	<div class="row">
		<?php echo $form->labelEx($model,'favoriteDigital'); ?>
		<?php echo $form->textField($model,'favoriteDigital',array('size'=>60,'maxlength'=>100,'alt'=>Tag::TAG_DIGIT,'value'=>'你喜欢摄影吗？想要一款好的手机吗？你会特别想要什么品牌的数码产品呢？','class'=>'span-13  poshy','title'=>'喜欢的数码产品')); ?>
		<div class="selectItems">
			<?php echo Tag::model()->generateTags($model->favoriteDigital);?>
		</div>
		<?php echo $form->error($model,'favoriteDigital'); ?>
	</div>
	<hr class="space" />
	<div class="row">
		<?php echo $form->labelEx($model,'favoriteOther'); ?>
		<?php echo $form->textField($model,'favoriteOther',array('size'=>60,'maxlength'=>100,'alt'=>Tag::TAG_OTHER,'value'=>'你还有其他的什么爱好吗？与大家分享一下呸','class'=>'span-13  poshy','title'=>'其他的爱好')); ?>
		<div class="selectItems">
			<?php echo Tag::model()->generateTags($model->favoriteOther);?>
		</div>
		<?php echo $form->error($model,'favoriteOther'); ?>
	</div>

	<hr class="space" />

	<div class="row clear buttons">
		<?php //echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'button','style'=>'width:100px;height:30px;')); ?>
		<?php  
		$url = $model->isNewRecord ? 'create':'updatefavorite';
		echo CHtml::ajaxSubmitButton($model->isNewRecord ? 'Create' : 'Save',CHtml::normalizeUrl(array($url,'render'=>true,'id'=>$model->id)),array('success'=>'js:function(html){addMessage(html);$("#todo").html(html);}'),array('class'=>'button','style'=>'width:100px;height:30px;'));
		?>
	</div>
	<div class="row span-8" style="height:auto;">
		<div id="StatusBar">
		
		</div>			
		<div id="Notification">
		
		</div>
	</div>


<?php $this->endWidget(); ?>

</div><!-- form -->
<hr class="space" />
</section>
<input type="hidden" id="tempRecord" />

<script type="text/javascript">
var prehtml = '<br /><div class=\"tips hide span-15\"><br /><h5></h5><div class=\"tipsContent\"><p>通过单击以下标签进行选择：<a href=\"javascript:void();\" onclick=\"getTags($(this).parent().siblings(\".input\").find(\"input\"),$(this).parent().next(\".tags\"),20,20*parseInt($(this).attr(\"title\")));$(this).parent().next(\".tags\").html().indexOf(\"a\")>0?$(this).attr(\"title\",parseInt($(this).attr(\"title\"))+1):$(this).attr(\"title\",1);\" title=\"1\">换一下</a></p><div class=\"tags\"></div><hr class=\"space\" /><br /><div class=\"input\"></div><div class=\"items\"></div></div></div>';

</script>
<?php 	

    $this->widget('ext.poshytip.Poshytip', array(
    	"selector"=>".poshy",	
    	'tooltips'=>array(
			'className'=>'tip-yellowsimple',
			'showOn'=>'focus',
			'alignTo'=>'target',
			'alignX'=>'right',
			'alignY'=>'center',
			'offsetX'=>5	
    	)	
    ));

    $this->widget('ext.chosen.chosenWidget');
    // showTips the extension
	$this->widget('ext.jnotify.JNotify', array(
		'statusBarId'=>'StatusBar',
		'notificationId'=>'Notification',
		'notificationHSpace'=>'30px',	
		'notificationWidth'=>'280px',
		'notificationShowAt'=>'topRight',
		//'notificationShowAt'=>'bottomLeft',
		//'notificationAppendType'=>'prepend',
	)); 
	
	$regionUrl = $this->createUrl('/remote/region');
	$tags = $this->createUrl('/tag/tags');
	
	Yii::app()->clientScript->registerScript('archiver-form', "
	function addMessage(data)
	{
	    $('#StatusBar').jnotifyAddMessage({
	        text: data,
	        permanent: false,
	        type: 'error',
	        showIcon: false
	    });
	}
	
//	uu.scrollFollow($('#notice'),15);

	

	function initialize(object)
	{

		//检验文本框所处的位置
		if(object.parent().hasClass('input')){
			
			return ;
		}	
		
		//处理已经加载的对象
		var tip = $('#selectedTips');
		var label = tip.next();
		label.show();
		
		tip.removeAttr('id');
		
		var input = tip.find('.input').find('input');
		
		var items = tip.find('.tipsContent').find('.items').find('a');
		items.find('span').remove();
		
		label.after(input);
		input.siblings('.selectItems').append(items);
		input.val($('#'+input.attr('id')+'hidetip').val());		
		
		$('.tips').addClass('hide');		
				
		var prehtml = '<br /><div class=\"tips span-15\" id=\"selectedTips\"><br /><h5></h5><div class=\"tipsContent\"><p>通过单击以下标签进行选择：<a href=\"javascript:void();\" onclick=\"changeTags($(this));\" title=\"1\">换一下</a></p><div class=\"tags\"></div><hr class=\"space\" /><br /><div class=\"input\"></div><div class=\"items\"></div></div></div>';
		

		//预加载代码
		if(!object.prev().prev().hasClass('tips')){
			object.parent().prepend(prehtml);
			object.after(object.clone().attr('id',object.attr('id')+'hide').val('').hide());
			object.after(object.clone().attr('id',object.attr('id')+'hidetip').val(object.val()).hide());
		}else{
			
			object.parent().find('.tips').removeClass('hide').attr('id','selectedTips');
			
		}
		
		object.val($('#'+object.attr('id')+'hidetip').val());
		
		//显示提示框
		var parent = object.prev('label').hide().prev('.tips').show();
		
		//设置标题
		var title = object.prev('label').text()+':'+$('#'+object.attr('id')+'hidetip').val();
		parent.find('h5').html(title);
		
		//填充标签
		getTags(object,parent.find('.tags'),20,0);	
			
		var html = '<span class=\"ico ico_error\"></span>';
		
		object.siblings('.selectItems').find('a').append(html).appendTo(object.parent().find('.items'));
		object.appendTo(object.parent().find('.input'));
	
	}

	function inputFocus(object){
		object.find('.input').find('input').focus();
	};
	
	function getTags(object,target,limit,offset)
	{

		$.get('{$tags}',{'type':object.attr('alt'),'limit':limit,'offset':offset},function(data){
			target.html(data);
		});
	}
	
	function changeTags(object){
		var type = object.parent().siblings('.input').find('input');
		var target = object.parent().next('.tags');
		var offset = 20*parseInt(object.attr('title'));
		getTags(type,target,20,offset);
		
		if(object.parent().next('.tags').html().indexOf('a')>0){
			object.attr('title',parseInt(object.attr('title'))+1);
		}else{
			object.attr('title',1);
		}
	}

	
	
	$('input[type=\"text\"]').focus(function(){
	
		initialize($(this));
		//清空默认内容
		$('#tempRecord').val($(this).val());
		$(this).val('');
	}).blur(function(){
		if($(this).val() == ''){
			if($('#tempRecord').val() != ''){
				$(this).val($('#tempRecord').val());
			}else{
				$(this).val($('#'+$(this).attr('id')+'hidetip').val());
			}
			
		}else{
			
			//检查填写的标签是否有重复，并把当前填写的标签在下面显示出来
			var val = $(this).val();
			var items = $(this).parent().next('.items');
			var select = items.html();
			val = val.replace(/[\；\;\:\：\|\｜\，]/g,',')			
		
			splits = val.split(',');
			
			var html = select;
			
			for(i=0;i<splits.length;i++){
				if(html.indexOf(splits[i]) < 0){
					html += '<a href=\"javascript:void();\" id=\"tag-'+Math.round(Math.random()*1000)+'\" class=\"selected\" onclick=\"back($(this))\" style=\"display: inline-block;\">'+splits[i]+'<span class=\"ico ico_error\"></span></a>';
	
				}
			}
			

			
			items.html(html);

			getItems(items,$(this).attr('id'));
		}
	});
	
//	initialize($('#Profile_favoriteStar'));	


	function showTips(object)
	{
		var text = object.text();
		target = object.parent().siblings('.items');
		
		var html = '<span class=\"ico ico_error\"></span>';
		
		if(parseInt(target.html().indexOf(text)) > 0)
		{
//			alert(target.html().indexOf(text));

			addMessage('已经有了哈～');
			return ;
		}
		
		
//		if(trim(target.text()) != '' && target.html().indexOf(text) > 0){
//			alert('已经有了');
//			return 
//		}

		if(object.hasClass('select')){
			object.removeClass('select').addClass('selected').append(html);
		}		
		
		object.attr('onclick','back($(this))').hide().appendTo(target);
		object.fadeIn();
		
		getItems(target,target.siblings('.input').find('input').attr('id'));
		
		return false;		
	}
	
	
	function back(object)
	{
		var tags = object.parent().siblings('.tags');
		var id = tags.siblings('.input').find('input').attr('id');
		
		if(tags.text().indexOf(object.text())>0){
			object.remove();
			return ;
		}
		
	
		object.attr('onclick','showTips($(this));return false;').removeAttr('style').removeClass('selected').addClass('select').find('.ico').remove();
		object.appendTo(tags);
		
		getItems(tags.siblings('.items'),id);
	}
	
	function getItems(object,id){
		var result = '';
		object.find('a').each(function(i){
			result += $(this).text()+',';
		});
		
		if(object.text().length > 100){
			alert('不得了了，超标了');
			return ;
		}
		
		$('#'+id+'hide').val(result);
		
		return result;
	}
	


");

?>
<script type="text/javascript">
$(function(){
//	$('#notice').smartFloat();
});
</script>
