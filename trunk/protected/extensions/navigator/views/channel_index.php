<?php $pinyin = new PinYin();?>
<section class="container adRoundSection" id="channelBanner">
	频道类型:
	<a href="<?php echo Yii::app()->createUrl('/channel/index',array('id'=>Channel::CHANNEL_MARKET));?>" data-id="<?php echo UtilHelper::words2PinYin(Channel::model()->getChannel(Channel::CHANNEL_MARKET));?>" class="adRoundSection active">交易</a>
	<a href="<?php echo Yii::app()->createUrl('/channel/index',array('id'=>Channel::CHANNEL_FREIND));?>" data-id="<?php echo UtilHelper::words2PinYin(Channel::model()->getChannel(Channel::CHANNEL_FREIND));?>" class="adRoundSection">交友</a>
	<a href="<?php echo Yii::app()->createUrl('/channel/index',array('id'=>Channel::CHANNEL_JOB));?>" data-id="<?php echo UtilHelper::words2PinYin(Channel::model()->getChannel(Channel::CHANNEL_JOB));?>" class="adRoundSection">招聘</a>
	<a href="<?php echo Yii::app()->createUrl('/channel/index',array('id'=>Channel::CHANNEL_SERVICE));?>" data-id="<?php echo UtilHelper::words2PinYin(Channel::model()->getChannel(Channel::CHANNEL_SERVICE));?>" class="adRoundSection">服务</a>
	显示方式:
	<a href="" class="adRoundSection">图标显示</a>
	<a href="" class="adRoundSection">文字显示</a>
</section>