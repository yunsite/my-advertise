            <div class="breadCrumbHolder module">
                <div id="breadCrumb0" class="breadCrumb module">
                    <ul>
                    	<?php if ($this->homeLink === null):?>
                        <li>
                            <?php echo CHtml::link('首页', Yii::app()->homeUrl);?>
                        </li>
                        <?php endif;?>
                        <?php foreach ($this->links as $label=>$url):?>
                        <li>
                        	<?php if(is_string($label) || is_array($url)):?>
                            	<?php echo CHtml::link($this->encodeLabel ? CHtml::encode($label) : $label, $url);?>
                            <?php else:?>
                            	<?php echo '<span>'.($this->encodeLabel ? CHtml::encode($url) : $url).'</span>'; ?>
                            <?php endif;?>
                        </li>
                        	
                        <?php endforeach;?>

                    </ul>
                </div>
            </div>