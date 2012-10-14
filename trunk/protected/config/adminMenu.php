<?php
return array(
    
    array(
        'text'  =>  '排行榜'
    ),
    array(
        'text'  =>  '用户管理',
        'items' =>  array(
            array(
                'text'  =>  '注册用户',  
                'url'   =>  '#/administrator/user/index.html',    
            ),    
            array(
                'text'  =>  'History'
            )    
        )
    ),
    array(
        'text'  =>  '主题管理',
        'url'   =>  '#',
        'items' =>   array(
            array(
                'text'  =>  '所有主题',
                'url'   =>  '#/administrator/theme/index.html'
            ),
            array(            
                'text'  =>  '模板管理',
                'url'   =>  '#/administrator/template/index.html'
            ),
            array(
                'text'  =>  '创建样式',
                'url'   =>  '#/administrator/theme/style.html'
            )            
        
        )   
    ),
    array(
        'text'  =>  '基本数据',
        'items' =>  array(
            array(
                'text'  =>  '国内省市',
                'url'   =>  '#/administrator/data/region.html'
            ),
            array(
                'text'  =>  '国内大学',
                'url'   =>  '#/administrator/data/college.html'
            ),
            array(
                'text'  =>  '学科专业',
                'url'   =>  '#/administrator/data/expertise.html'
            ),
            array(
                'text'  =>  '标签',
                'url'   =>  '#/administrator/data/tags.html'
            )
            
        )
    ),
    array(
        'text'  =>  '统计',
        'items' =>  array(
            array(
                'text'  =>  '在线统计',
                'url'   =>  '#/administrator/statistics/online.html'
            ),
            array(
                'text'  =>  '浏览器统计',
                'url'   =>  '#/administrator/statistics/agent.html'
            ),
            array(
                'text'  =>  '磁盘空间使用统计',
                'url'   =>  '#/administrator/statistics/space.html'
            ),
            array(
                'text'  =>  '系统平台统计',
                'url'   =>  '#/administrator/statistics/platform.html'
            ),
            array(
                'text'  =>  '国内访问统计',
                'url'   =>  '#/administrator/statistics/regionprovince.html'
            ),
            array(
                'text'  =>  '来访国家统计',
                'url'   =>  '#/administrator/statistics/regioncountry.html'
            )
        )
    ),
    array(
        'text'  =>  '设置',
        'items' =>  array(
            array(
                'text'  =>  '磁盘管理'
            )
        )
    ),
    array(
        'text'  =>  '关于我们'
    )
);
?>