<!DOCTYPE html>
<html>
<head>
    <link rel="shortcut icon" type="image/png" href="favicon.png"/>
    <link rel="icon" type="image/png" href="favicon.png"/>
    <link rel="stylesheet" type="text/css" href="/public/kendoui/kendoui/styles/kendo.common.min.css" />
    <link rel="stylesheet" type="text/css" href="/public/kendoui/kendoui/styles/kendo.default.min.css" />
    <link rel="stylesheet" type="text/css" href="/public/kendoui/styles/main.css" />
    <script type="text/javascript" src="/public/kendoui/kendoui/js/jquery.min.js"></script>
    <script type="text/javascript" src="/public/kendoui/kendoui/js/kendo.web.min.js"></script>
    <script type="text/javascript" src="/public/js/jquery.history.js"></script>
    <script type="text/javascript" src="/public/kendoui/scripts/common.js"></script>
    <script type="text/javascript">
    $(function(){        
        $.menu(<?php echo json_encode(Yii::app()->params->adminMenu); ?>);
    })
    </script>
</head>
<body>
    <div style="position: fixed; right:0; top:0; width:30px;height:30px; background: #000;" onclick="$.test();"></div>
    <div id="menu"></div>
    <div id="page">
    <?php echo $content; ?>
    </div>
    
    <div id="loading" style="display: none;"><img src="/public/images/loading.gif" /></div>
</body>
</html>