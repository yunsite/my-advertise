/**
 *如下为使用方法，先判断浏览器的版本
 *<!--[if lt IE 9]>
 *<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
 *< ![endif]-->
 */

var e=("abbr,article,aside,audio,canvas,datalist,details,"+
  "figure,footer,header,hgroup,mark,menu,meter,nav,output,"+
  "progress,section,time,video").split(',');
  for(var i=0;i<e .length;i++){
    document.createElement(e[i]);
  }