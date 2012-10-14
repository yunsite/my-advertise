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
                <th>用户名</th>
                <th>真实姓名</th>
                <th>权限分组</th>
                <th>现居地</th>
            </tr>
          </thead>
        <tbody>
            <?php $i = 0;?>
            <?php foreach($dataProvider as $line):?>
            <tr class="<?php echo fmod($i,2)==0?'even':'odd'; $i++; ?>" id="<?php echo $line->id; ?>">
                <td><input type="checkbox" name="id[]" value="<?php echo $line->id; ?>" /></td>
                <td><?php echo $line->username; ?></td>
                <td><?php echo User::model()->getRoleName($line->role); ?></td>
                <td><?php echo Profile::model()->getUserTrueName($line->id);?></td>                
                <td><?php echo Profile::model()->getUserAddress($line->id); ?></td>
            </tr>
            <?php endforeach;?>
        </tbody>             
    </table>   
    <hr />
    <?php $this->widget('CLinkPager', array('pages' => $pagination)); ?> 
    <hr class="space" />