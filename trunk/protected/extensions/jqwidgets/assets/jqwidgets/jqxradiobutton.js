/*
jQWidgets v2.3.1 (2012-July-23)
Copyright (c) 2011-2012 jQWidgets.
License: http://jqwidgets.com/license/
*/

(function(a){a.jqx.jqxWidget("jqxRadioButton","",{});a.extend(a.jqx._jqxRadioButton.prototype,{defineInstance:function(){this.animationShowDelay=300,this.animationHideDelay=300,this.width=null;this.height=null;this.boxSize="13px";this.checked=false;this.hasThreeStates=false;this.disabled=false;this.enableContainerClick=true;this.locked=false;this.groupName="";this.events=["checked","unchecked","indeterminate","change"]},createInstance:function(b){this.setSize();var d=this;this.propertyChangeMap.width=function(e,g,f,h){d.setSize()};this.propertyChangeMap.height=function(e,g,f,h){d.setSize()};this.radiobutton=a("<div><div><span></span></div></div>");this.host.attr("tabIndex",0);this.host.prepend(this.radiobutton);this.host.append(a('<div style="clear: both;"></div>'));this.checkMark=a(this.radiobutton).find("span");this.box=a(this.radiobutton).find("div");this._supportsRC=true;if(a.browser.msie&&a.browser.version<9){this._supportsRC=false}this.box.addClass(this.toThemeProperty("jqx-fill-state-normal"));this.box.addClass(this.toThemeProperty("jqx-radiobutton-default"));this.host.addClass(this.toThemeProperty("jqx-widget"));if(this.disabled){this.disable()}this.host.addClass(this.toThemeProperty("jqx-radiobutton"));if(this.locked){this.host.css("cursor","auto")}var c=this.element.getAttribute("checked");if(c=="checked"||c=="true"||c==true){this.checked=true}this._render();this._addHandlers()},refresh:function(b){if(!b){this.setSize();this._render()}},setSize:function(){if(this.width!=null&&this.width.toString().indexOf("px")!=-1){this.host.width(this.width)}else{if(this.width!=undefined&&!isNaN(this.width)){this.host.width(this.width)}}if(this.height!=null&&this.height.toString().indexOf("px")!=-1){this.host.height(this.height)}else{if(this.height!=undefined&&!isNaN(this.height)){this.host.height(this.height)}}},_addHandlers:function(){var b=this;this.addHandler(this.box,"click",function(c){if(!b.disabled&&!b.enableContainerClick){b.toggle();c.preventDefault();return false}});this.addHandler(this.host,"keydown",function(c){if(!b.disabled&&!b.locked){if(c.keyCode==32){b.toggle();c.preventDefault();return false}}});this.addHandler(this.host,"click",function(c){if(!b.disabled&&b.enableContainerClick){b.toggle();c.preventDefault();return false}});this.addHandler(this.host,"selectstart",function(c){if(!b.disabled&&b.enableContainerClick){c.preventDefault()}});this.addHandler(this.host,"mouseup",function(c){if(!b.disabled&&b.enableContainerClick){c.preventDefault()}});this.addHandler(this.host,"mousedown",function(c){if(!b.disabled&&b.enableContainerClick){b.host.focus();c.preventDefault();return false}});this.addHandler(this.host,"focus",function(c){if(!b.disabled&&b.enableContainerClick&&!b.locked){b.box.addClass(b.toThemeProperty("jqx-radiobutton-hover"));b.box.addClass(b.toThemeProperty("jqx-fill-state-focus"));c.preventDefault();return false}});this.addHandler(this.host,"blur",function(c){if(!b.disabled&&b.enableContainerClick&&!b.locked){b.box.removeClass(b.toThemeProperty("jqx-radiobutton-hover"));b.box.removeClass(b.toThemeProperty("jqx-fill-state-focus"));c.preventDefault();return false}});this.addHandler(this.host,"mouseenter",function(c){if(!b.disabled&&b.enableContainerClick&&!b.locked){b.box.addClass(b.toThemeProperty("jqx-radiobutton-hover"));b.box.addClass(b.toThemeProperty("jqx-fill-state-hover"));c.preventDefault();return false}});this.addHandler(this.host,"mouseleave",function(c){if(!b.disabled&&b.enableContainerClick&&!b.locked){b.box.removeClass(b.toThemeProperty("jqx-radiobutton-hover"));b.box.removeClass(b.toThemeProperty("jqx-fill-state-hover"));c.preventDefault();return false}});this.addHandler(this.box,"mouseenter",function(){if(!b.disabled&&!b.enableContainerClick){b.box.addClass(b.toThemeProperty("jqx-radiobutton-hover"));b.box.addClass(b.toThemeProperty("jqx-fill-state-hover"))}});this.addHandler(this.box,"mouseleave",function(){if(!b.disabled&&!b.enableContainerClick){b.box.removeClass(b.toThemeProperty("jqx-radiobutton-hover"));b.box.removeClass(b.toThemeProperty("jqx-fill-state-hover"))}})},_removeHandlers:function(){this.removeHandler(this.box,"click");this.removeHandler(this.box,"mouseenter");this.removeHandler(this.box,"mouseleave");this.removeHandler(this.host,"click");this.removeHandler(this.host,"mouseup");this.removeHandler(this.host,"mousedown");this.removeHandler(this.host,"selectstart");this.removeHandler(this.host,"mouseenter");this.removeHandler(this.host,"mouseleave");this.removeHandler(this.host,"keydown");this.removeHandler(this.host,"focus");this.removeHandler(this.host,"blur")},_render:function(){if(this.boxSize==null){this.boxSize=13}this.box.width(this.boxSize);this.box.height(this.boxSize);if(!this.disabled){if(this.enableContainerClick){this.host.css("cursor","pointer")}else{this.host.css("cursor","auto")}}else{this.disable()}this.updateStates()},check:function(){this.checked=true;var b=this;this.checkMark.removeClass();this.checkMark.addClass(this.toThemeProperty("jqx-fill-state-pressed"));if(a.browser.msie){if(!this.disabled){this.checkMark.addClass(this.toThemeProperty("jqx-radiobutton-check-checked"))}else{this.checkMark.addClass(this.toThemeProperty("jqx-radiobutton-check-disabled"))}}else{if(!this.disabled){this.checkMark.addClass(this.toThemeProperty("jqx-radiobutton-check-checked"))}else{this.checkMark.addClass(this.toThemeProperty("jqx-radiobutton-check-disabled"))}this.checkMark.css("opacity",0);this.checkMark.stop().animate({opacity:1},this.animationShowDelay,function(){})}var c=a.find(".jqx-radiobutton");if(this.groupName==null){this.groupName=""}a.each(c,function(){var d=a(this).jqxRadioButton("groupName");if(d==b.groupName&&this!=b.element){a(this).jqxRadioButton("uncheck")}});this._raiseEvent("0");this._raiseEvent("3",{checked:true});if(this.checkMark.height()==0){this.checkMark.height(this.boxSize);this.checkMark.width(this.boxSize)}},uncheck:function(){var c=this.checked;this.checked=false;var b=this;if(a.browser.msie){b.checkMark.removeClass()}else{this.checkMark.css("opacity",1);this.checkMark.stop().animate({opacity:0},this.animationHideDelay,function(){b.checkMark.removeClass()})}if(c){this._raiseEvent("1");this._raiseEvent("3",{checked:false})}},indeterminate:function(){var b=this.checked;this.checked=null;this.checkMark.removeClass();if(a.browser.msie){this.checkMark.addClass(this.toThemeProperty("jqx-radiobutton-check-indeterminate"))}else{this.checkMark.addClass(this.toThemeProperty("jqx-radiobutton-check-indeterminate"));this.checkMark.css("opacity",0);this.checkMark.stop().animate({opacity:1},this.animationShowDelay,function(){})}if(b!=null){this._raiseEvent("2");this._raiseEvent("3",{checked:null})}},toggle:function(){if(this.disabled){return}if(this.locked){return}var b=this.checked;if(this.checked==true){this.checked=this.hasTreeStates?null:true}else{this.checked=true}if(b!=this.checked){this.updateStates()}},updateStates:function(){if(this.checked){this.check()}else{if(this.checked==false){this.uncheck()}else{if(this.checked==null){this.indeterminate()}}}},disable:function(){this.disabled=true;if(this.checked==true){this.checkMark.addClass(this.toThemeProperty("jqx-radiobutton-check-disabled"))}else{if(this.checked==null){this.checkMark.addClass(this.toThemeProperty("jqx-radiobutton-check-indeterminate-disabled"))}}this.box.addClass(this.toThemeProperty("jqx-radiobutton-disabled"));this.host.addClass(this.toThemeProperty("jqx-fill-state-disabled"))},enable:function(){this.host.removeClass(this.toThemeProperty("jqx-fill-state-disabled"));if(this.checked==true){this.checkMark.removeClass(this.toThemeProperty("jqx-radiobutton-check-disabled"))}else{if(this.checked==null){this.checkMark.removeClass(this.toThemeProperty("jqx-radiobutton-check-indeterminate-disabled"))}}this.box.removeClass(this.toThemeProperty("jqx-radiobutton-disabled"));this.disabled=false},destroy:function(){this._removeHandlers()},_raiseEvent:function(g,e){var c=this.events[g];var f=new jQuery.Event(c);f.owner=this;f.args=e;try{var b=this.host.trigger(f)}catch(d){}return b},propertyChangedHandler:function(b,c,e,d){if(this.isInitialized==undefined||this.isInitialized==false){return}if(c==this.enableContainerClick&&!this.disabled&&!this.locked){if(d){this.host.css("cursor","pointer")}else{this.host.css("cursor","auto")}}if(c=="checked"){switch(d){case true:this.check();break;case false:this.uncheck();break;case null:this.indeterminate();break}}if(c=="theme"){a.jqx.utilities.setTheme(e,d,this.host)}if(c=="disable"){if(d){this.disable()}else{this.enable()}}}})})(jQuery);