(function(e,t){var n='<div class="om-messageBox om-widget om-widget-content om-corner-all" tabindex="-1"><div class="om-messageBox-titlebar om-widget-header om-corner-top om-helper-clearfix"><span class="om-messageBox-title"></span><a href="#" class="om-messageBox-titlebar-close om-corner-tr"><span class="om-icon om-icon-closethick"></span></a></div><div class="om-messageBox-content om-widget-content"><table><tr vailgn="top"><td class="om-messageBox-imageTd"><div class="om-messageBox-image"/>&nbsp;</td><td class="om-message-content-html"></td></tr></table></div><div class="om-messageBox-buttonpane om-widget-content om-corner-bottom om-helper-clearfix"><div class="om-messageBox-buttonset"></div></div></div>',r=function(){if(e.browser.msie&&e.browser.version<7){var t=Math.max(document.documentElement.scrollHeight,document.body.scrollHeight),n=Math.max(document.documentElement.offsetHeight,document.body.offsetHeight);return t<n?e(window).height():t}return e(document).height()},i=function(){if(e.browser.msie){var t=Math.max(document.documentElement.scrollWidth,document.body.scrollWidth),n=Math.max(document.documentElement.offsetWidth,document.body.offsetWidth);return t<n?e(window).width():t}return e(document).width()},s=function(e,t,n,r){if(e.hasClass("om-messageBox-waiting"))return;n?n(r):jQuery.noop(),e.remove(),t.remove()},o=function(t){var o=t.onClose,u=e(n).appendTo(document.body).css("z-index",1500).position({of:window,collision:"fit"}).omDraggable({containment:"document",cursor:"move",handle:".om-messageBox-titlebar"}).hide().keydown(function(t){t.keyCode&&t.keyCode===e.om.keyCode.ESCAPE&&(s(u,a,null,!1),t.preventDefault())}),a=e('<div class="om-widget-overlay"/>').appendTo(document.body).show().css({height:r(),width:i()}),f=u.find("span.om-messageBox-title").html(t.title).next().hover(function(){e(this).addClass("om-state-hover")},function(){e(this).removeClass("om-state-hover")}).focus(function(){e(this).addClass("om-state-focus")}).blur(function(){e(this).removeClass("om-state-focus")}).click(function(e){return s(u,a,null,!1),!1}).bind("mousedown mouseup",function(){e(this).toggleClass("om-state-mousedown")});u.find("div.om-messageBox-image").addClass("om-messageBox-image-"+t.type);var l=t.content;t.type=="prompt"&&(l=l||"",l+='<br/><input id="om-messageBox-prompt-input" type="text"/>'),u.find("td.om-message-content-html").html(l);var c=u.find("div.om-messageBox-buttonset");switch(t.type){case"confirm":c.html('<button id="confirm">确定</button><button id="cancel">取消</button>'),e.fn.omButton&&(c.find("button#confirm").omButton({width:60,onClick:function(e){s(u,a,o,!0)}}),c.find("button#cancel").omButton({width:60,onClick:function(e){s(u,a,o,!1)}}));break;case"prompt":c.html('<button id="confirm">确定</button><button id="cancel">取消</button>'),e.fn.omButton&&(c.find("button#confirm").omButton({width:60,onClick:function(t){var n=o?o(e("#om-messageBox-prompt-input").val()):jQuery.noop();n!==!1&&(u.remove(),a.remove())}}),c.find("button#cancel").omButton({width:60,onClick:function(e){s(u,a,o,!1)}}));break;case"waiting":u.addClass("om-messageBox-waiting"),a.addClass("om-messageBox-waiting"),f.hide(),c.parent().hide(),u.find(">.om-messageBox-content").addClass("no-button om-corner-bottom");break;default:c.html('<button id="confirm">确定</button>'),e.fn.omButton&&c.find("button#confirm").omButton({width:60,onClick:function(e){s(u,a,o,!0)}})}var h=e("button",c);h.width("100%"),u.show();var p=h.first()[0];p?p.focus():u.focus()};e.omMessageBox={alert:function(e){e=e||{},e.title=e.title||"提示",e.type=e.type||"alert",o(e)},confirm:function(e){e=e||{},e.title=e.title||"确认",e.type="confirm",o(e)},prompt:function(e){e=e||{},e.title=e.title||"请输入",e.type="prompt",o(e)},waiting:function(t){if(t==="close"){e(".om-messageBox-waiting").remove();return}t=t||{},t.title=t.title||"请等待",t.type="waiting",o(t)}}})(jQuery);