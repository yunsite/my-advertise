<script type="text/javascript">
$(function(){
    
    $("#Comment_count").text($("#Comment_content").attr('maxlength'));
    
     <?php if(Yii::app()->user->isGuest): ?>
        $("#Comment_content").attr('readonly','readonly').after($('<div>请先<?php echo CHtml::link('登录',array('/site/login')); ?>,然后才能说话哦~</div>').css({
            'position':'relative',
            'text-align':'center',
            'top':'-50px',
            'height':'20px'            
        }));
     <?php endif;?>   
    
   
    
    $("#Comment_content").keyup(function(){
        $("#Comment_count").text($(this).attr('maxlength')-$(this).val().length);
    }); 
    
    $("#comment-form").submit(function(){
        
        if($("#Comment_content").val() == ''){
            uu.alert('评论内容不能为空~');
            return false;
        }
        
        
        var approved = 0;
        
        var that = $(this);
        
        $.post('<?php echo $this->createUrl('/comment/commentfilter'); ?>',{'content':$("#Comment_content").val()},function(msg){
            console.log(msg);           
            
            if(parseInt(msg) == 1){
                $.post('<?php echo $this->createUrl('/comment/create'); ?>',that.serializeArray(),function(data){
                   uu.alert(data);
                   $("#Comment_content").val('');
                   loadComments();
                   
                }); 
            }else{
                uu.alert('亲，你提交的含有非法字符哦~');
            }
        });        

        
        return false;
    });
});
</script>
<div class="form">
<?php new CActiveForm ?>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'comment-form',
    'action'=>$this->createUrl('/comment/create'),
	'enableAjaxValidation'=>true,
)); ?>

	<?php echo $form->errorSummary($model); ?>
	<div class="row">
		<?php echo $form->hiddenField($model,'aid',array('value'=>$_GET['id'])); ?>
		<?php echo $form->error($model,'aid'); ?>
	</div>

	<div class="row span-13">
		<?php echo $form->textArea($model,'content',array('size'=>60,'maxlength'=>512,'style'=>'height:54px;margin-top:-1px;','class'=>'span-13')); ?>
		<?php echo $form->error($model,'content'); ?>
        <hr class="space"/>
        <div style="text-align: right;">
            <span id="Comment_success"></span>还可以再写<span id="Comment_count"></span>字
        </div>
	</div>

	<div class="row" style="margin-left: 515px;">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'OK' : 'Save',array('class'=>'button','style'=>'width:64px;height:64px;font-size:24px;')); ?>
	</div>
    <hr class="space" />
    

<?php $this->endWidget(); ?>

</div><!-- form -->