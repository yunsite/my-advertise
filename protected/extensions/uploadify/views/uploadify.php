<input id="<?php echo $this->uploadifyID;?>" type="file" name="file_upload" />
<?php if ($this->auto == false):?>
<a href="javascript:$('#<?php echo $this->uploadifyID;?>').uploadifyUpload($('.uploadifyQueueItem').last().attr('id').replace('file_upload',''));"><?php echo $this->label;?></a>
<?php endif;?>