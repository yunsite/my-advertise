    <table>
        <thead>
            <tr style="border-bottom: 2px solid #000;text-align:left;">
                <th style="width: 50px;">
                <select class="left" id="choose">
                    <option value="">操作</option>
                    <option value="all">全选</option>
                    <option value="reverse">反选</option>
                    <option value="delete">删除</option>
                </select></th>
                <th>标题</th>
                <th>类别</th>
                <th>用户名</th>
                <th>剩余时间</th>
                <th>发布时间</th>

            </tr>
          </thead>
        <tbody>
            <?php $i = 0;?>
            <?php foreach($dataProvider as $line):?>
            <tr class="<?php echo fmod($i,2)==0?'even':'odd'; $i++; ?>" id="<?php echo $line->id; ?>">
                <td><input type="checkbox" name="id[]" value="<?php echo $line->id; ?>" /></td>
                <td><?php echo $line->title; ?></td>
                <td><?php echo $line->channel->name;?></td>
                <td><?php echo User::model()->findByPk($line->uid)->username; ?></td>
                <td><?php echo date("d天h时i分",$line->end-$line->start); ?></td>
                <td><?php echo date('m-d h:i',$line->pubdate);?></td>                

            </tr>
            <?php endforeach;?>
        </tbody>             
    </table>   
    <hr />
    <?php $this->widget('CLinkPager', array('pages' => $pagination)); ?> 
    <hr class="space" />