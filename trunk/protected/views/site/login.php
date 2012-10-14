<?php
$this->pageTitle= '用户登录 - '.Yii::app()->name;
/*$this->breadcrumbs=array(
	'用户登录',
);
*/
$this->menu=array(
	array('label'=>'我把忘记密码了，怎么办？', 'url'=>array('create')),
	array('label'=>'网站使用操作演示', 'url'=>array('admin')),
	array('label'=>'常见问题集', 'url'=>array('create')),
	array('label'=>'在悦珂谷你能做什么，又能得到什么？', 'url'=>array('admin')),
	array('label'=>'我们的宗旨，我们的期待', 'url'=>array('create')),
	array('label'=>'Manage Lookup', 'url'=>array('admin')),
	
);
?>


<h1>用户登录</h1>

<section class="span-9 adSection" style="opacity:0.8; border:5px;">

<?php if (Yii::app()->user->isGuest):?>
	<p>请使用您的登录凭证填写下表单:</p>
	<?php
		$this->renderPartial('_loginform',array('model'=>$model));
	
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
	    
	?>
<?php else:?>
	<p>亲爱的<?php echo Yii::app()->user->name;?>先生：</p>
	<p>您当前已经登录，如需切换帐户，请点击</p>
	<p><span class="button"><?php echo CHtml::link('切换帐户', array('site/changeacount'));?></span></p>
<?php endif;?>
</section>

<section class="span-5 last right" style="border:1px solid yellow;">
	hello span-6
	
</section>
<script type="text/javascript">
$(function(){   
    
    /**
     * 此处执行了两次，不明白为什么？？
     **/
    $("#login-form").submit(function(){
        
        var check = checkIsLogin($("#LoginForm_username"));
        console.log("check:" + check );
//         console.log($(this).serialize());

    });
    
	$("#LoginForm_username").blur(function(){
        checkIsLogin($(this));
	});
});

var i = 1;
var state = 'false';

function checkIsLogin(object){    
        
		$.get("<?php echo $this->createUrl('/site/checkloginstate');?>",{'username':object.val()},function(data){	
		  
            console.log("back:" + data.msg);
			if(data.msg != "false"){ //已经登录返回false
             
				var msg = data.msg + "<br /><hr /><span class=\"button\" onclick=\"logout('" + data.id + "');\">注销</span>&nbsp;&nbsp;&nbsp;&nbsp;<span class=\"button\" onclick=\"clearForm();\">现在暂时不注销</span><hr class=\"space\" />";
				
				uu.alert(msg,"登录提示",function(){
					clearForm();
				});
                
                return false;
			}
            

		},'json');  
        
        return state;  
}
function logout(id){

	$.get("<?php echo $this->createUrl('/site/forcelogout');?>",{'id':id},function(data){
		if(data== 'true'){
			uu.alert("登录帐号已经强制退出，现在可以在此登录了","登录提示");
		}
	});	

}

function clearForm()
{
	$("#LoginForm_username").val("");
	$("#LoginForm_password").val("");
	$.fancybox.close();
}
</script>
