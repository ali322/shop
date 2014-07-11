(function(e,t){var n="om-dialog om-widget om-widget-content om-corner-all ",r={buttons:!0,height:!0,maxHeight:!0,maxWidth:!0,minHeight:!0,minWidth:!0,width:!0},i={maxHeight:!0,maxWidth:!0,minHeight:!0,minWidth:!0},s=e.attrFn||{val:!0,css:!0,html:!0,text:!0,data:!0,width:!0,height:!0,offset:!0,click:!0};e.omWidget("om.omDialog",{options:{autoOpen:!0,buttons:{},closeOnEscape:!0,closeText:"close",dialogClass:"",draggable:!0,hide:null,height:"auto",maxHeight:!1,maxWidth:!1,minHeight:150,minWidth:150,modal:!1,position:{my:"center",at:"center",collision:"fit",using:function(t){var n=e(this).css(t).offset().top;n<0&&e(this).css("top",t.top-n)}},resizable:!0,show:null,stack:!0,title:"",width:300,zIndex:1e3},_create:function(){this.originalTitle=this.element.attr("title"),typeof this.originalTitle!="string"&&(this.originalTitle=""),this.options.title=this.options.title||this.originalTitle;var t=this;t.element.show().removeAttr("title").addClass("om-dialog-content om-widget-content").wrap("<div></div>"),t.element.parent().bind("om-remove.omDialog",t.__removeBind=function(){t.element.remove()});var r=t.options,i=r.title||"&#160;",s=e.om.omDialog.getTitleId(t.element),o=(t.uiDialog=t.element.parent()).appendTo(document.body).hide().addClass(n+r.dialogClass).css({zIndex:r.zIndex}).attr("tabIndex",-1).css("outline",0).keydown(function(n){r.closeOnEscape&&n.keyCode&&n.keyCode===e.om.keyCode.ESCAPE&&(t.close(n),n.preventDefault())}).attr({role:"dialog","aria-labelledby":s}).mousedown(function(e){t.moveToTop(!1,e)}),u=(t.uiDialogTitlebar=e("<div></div>")).addClass("om-dialog-titlebar om-widget-header om-corner-all om-helper-clearfix").prependTo(o),a=e('<a href="#"></a>').addClass("om-dialog-titlebar-close om-corner-tr").attr("role","button").hover(function(){a.addClass("om-state-hover")},function(){a.removeClass("om-state-hover")}).focus(function(){a.addClass("om-state-focus")}).blur(function(){a.removeClass("om-state-focus")}).click(function(e){return t.close(e),!1}).appendTo(u),f=(t.uiDialogTitlebarCloseText=e("<span></span>")).addClass("om-icon-closethick").text(r.closeText).appendTo(a),l=e("<span></span>").addClass("om-dialog-title").attr("id",s).html(i).prependTo(u);u.find("*").add(u).disableSelection(),r.draggable&&e.om.omDraggable&&t._makeDraggable(),r.resizable&&e.fn.omResizable&&t._makeResizable(),t._createButtons(r.buttons),t._isOpen=!1,e.fn.bgiframe&&o.bgiframe()},_init:function(){if(this.element.find("iframe").length>0){var e=this.element.find("iframe"),t=e.data("src");e.attr("src",t),e.removeData("src")}this.options.autoOpen&&this.open()},destroy:function(){var e=this;return e.overlay&&e.overlay.destroy(),e.uiDialog.hide(),e.element.unbind(".dialog").removeData("dialog").removeClass("om-dialog-content om-widget-content").hide().appendTo("body"),e.uiDialog.remove(),e.originalTitle&&e.element.attr("title",e.originalTitle),e},widget:function(){return this.uiDialog},close:function(t){var n=this,r,i,s=this.options,o=s.onBeforeClose,u=s.onClose;if(o&&!1===n._trigger("onBeforeClose",t))return;return n.overlay&&n.overlay.destroy(),n.uiDialog.unbind("keypress.om-dialog"),n._isOpen=!1,n.options.hide?n.uiDialog.hide(n.options.hide,function(){u&&n._trigger("onClose",t)}):(n.uiDialog.hide(),u&&n._trigger("onClose",t)),e.om.omDialog.overlay.resize(),n.options.modal&&(r=0,e(".om-dialog").each(function(){this!==n.uiDialog[0]&&(i=e(this).css("z-index"),isNaN(i)||(r=Math.max(r,i)))}),e.om.omDialog.maxZ=r),n},isOpen:function(){return this._isOpen},moveToTop:function(t,n){var r=this,i=r.options,s;return i.modal&&!t||!i.stack&&!i.modal?r._trigger("onFocus",n):(i.zIndex>e.om.omDialog.maxZ&&(e.om.omDialog.maxZ=i.zIndex),r.overlay&&(e.om.omDialog.maxZ+=1,r.overlay.$el.css("z-index",e.om.omDialog.overlay.maxZ=e.om.omDialog.maxZ)),s={scrollTop:r.element.scrollTop(),scrollLeft:r.element.scrollLeft()},e.om.omDialog.maxZ+=1,r.uiDialog.css("z-index",e.om.omDialog.maxZ),r.element.attr(s),r._trigger("onFocus",n),r)},open:function(){if(this._isOpen)return;var t=this,n=t.options,r=t.uiDialog;t.overlay=n.modal?new e.om.omDialog.overlay(t):null,t._size(),t._position(n.position),r.show(n.show),t.moveToTop(!0),n.modal&&r.bind("keypress.om-dialog",function(t){if(t.keyCode!==e.om.keyCode.TAB)return;var n=e(":tabbable",this),r=n.filter(":first"),i=n.filter(":last");if(t.target===i[0]&&!t.shiftKey)return r.focus(1),!1;if(t.target===r[0]&&t.shiftKey)return i.focus(1),!1}),e(t.element.find(":tabbable").get().concat(r.find(".om-dialog-buttonpane :tabbable").get().concat(r.get()))).eq(0).focus(),t._isOpen=!0;var i=n.onOpen;return i&&t._trigger("onOpen"),t},_createButtons:function(t){var n=this,r=!1,i=e("<div></div>").addClass("om-dialog-buttonpane om-helper-clearfix"),o=e("<div></div>").addClass("om-dialog-buttonset").appendTo(i);n.uiDialog.find(".om-dialog-buttonpane").remove(),typeof t=="object"&&t!==null&&e.each(t,function(){return!(r=!0)}),r&&(e.each(t,function(t,r){r=e.isFunction(r)?{click:r,text:t}:r;var i=e('<button type="button"></button>').click(function(){r.click.apply(n.element[0],arguments)}).appendTo(o);e.each(r,function(e,t){if(e==="click")return;e in s?i[e](t):i.attr(e,t)}),e.fn.omButton&&i.omButton()}),i.appendTo(n.uiDialog))},_makeDraggable:function(){function s(e){return{position:e.position,offset:e.offset}}var t=this,n=t.options,r=e(document),i;t.uiDialog.omDraggable({cancel:".om-dialog-content, .om-dialog-titlebar-close",handle:".om-dialog-titlebar",containment:"document",cursor:"move",onStart:function(r,o){i=n.height==="auto"?"auto":e(this).height(),e(this).height(e(this).height()).addClass("om-dialog-dragging"),t._trigger("onDragStart",s(r),o)},onDrag:function(e,n){t._trigger("onDrag",s(e),n)},onStop:function(o,u){n.position=[o.position.left-r.scrollLeft(),o.position.top-r.scrollTop()],e(this).removeClass("om-dialog-dragging").height(i),t._trigger("onDragStop",s(o),u),e.om.omDialog.overlay.resize()}})},_makeResizable:function(n){function u(e){return{originalPosition:e.originalPosition,originalSize:e.originalSize,position:e.position,size:e.size}}n=n===t?this.options.resizable:n;var r=this,i=r.options,s=r.uiDialog.css("position"),o=typeof n=="string"?n:"n,e,s,w,se,sw,ne,nw";r.uiDialog.omResizable({cancel:".om-dialog-content",containment:"document",alsoResize:r.element,maxWidth:i.maxWidth,maxHeight:i.maxHeight,minWidth:i.minWidth,minHeight:r._minHeight(),handles:o,start:function(t,n){e(this).addClass("om-dialog-resizing"),r._trigger("onResizeStart",t,u(n))},resize:function(e,t){r._trigger("onResize",e,u(t))},stop:function(t,n){e(this).removeClass("om-dialog-resizing"),i.height=e(this).height(),i.width=e(this).width(),r._trigger("onResizeStop",t,u(n)),e.om.omDialog.overlay.resize()}}).css("position",s).find(".om-resizable-se").addClass("om-icon om-icon-grip-diagonal-se")},_minHeight:function(){var e=this.options;return e.height==="auto"?e.minHeight:Math.min(e.minHeight,e.height)},_position:function(t){var n=[],r=[0,0],i;if(t){if(typeof t=="string"||typeof t=="object"&&"0"in t)n=t.split?t.split(" "):[t[0],t[1]],n.length===1&&(n[1]=n[0]),e.each(["left","top"],function(e,t){+n[e]===n[e]&&(r[e]=n[e],n[e]=t)}),t={my:n.join(" "),at:n.join(" "),offset:r.join(" ")};t=e.extend({},e.om.omDialog.prototype.options.position,t)}else t=e.om.omDialog.prototype.options.position;i=this.uiDialog.is(":visible"),i||this.uiDialog.show(),this.uiDialog.css({top:0,left:0}).position(e.extend({of:window},t)),i||this.uiDialog.hide()},_setOptions:function(t){var n=this,s={},o=!1;e.each(t,function(e,t){n._setOption(e,t),e in r&&(o=!0),e in i&&(s[e]=t)}),o&&this._size(),this.uiDialog.is(":data(resizable)")&&this.uiDialog.omResizable("option",s)},_setOption:function(t,r){var i=this,s=i.uiDialog;switch(t){case"buttons":i._createButtons(r);break;case"closeText":i.uiDialogTitlebarCloseText.text(""+r);break;case"dialogClass":s.removeClass(i.options.dialogClass).addClass(n+r);break;case"disabled":r?s.addClass("om-dialog-disabled"):s.removeClass("om-dialog-disabled");break;case"draggable":var o=s.is(":data(draggable)");o&&!r&&s.omDraggable("destroy"),!o&&r&&i._makeDraggable();break;case"position":i._position(r);break;case"resizable":var u=s.is(":data(resizable)");u&&!r&&s.omResizable("destroy"),u&&typeof r=="string"&&s.omResizable("option","handles",r),!u&&r!==!1&&i._makeResizable(r);break;case"title":e(".om-dialog-title",i.uiDialogTitlebar).html(""+(r||"&#160;"))}e.OMWidget.prototype._setOption.apply(i,arguments)},_size:function(){var t=this.options,n,r,i=this.uiDialog.is(":visible");this.element.show().css({width:"auto",minHeight:0,height:0}),t.minWidth>t.width&&(t.width=t.minWidth),n=this.uiDialog.css({height:"auto",width:t.width}).height(),r=Math.max(0,t.minHeight-n);if(t.height==="auto")if(e.support.minHeight)this.element.css({minHeight:r,height:"auto"});else{this.uiDialog.show();var s=this.element.css("height","auto").height();i||this.uiDialog.hide(),this.element.height(Math.max(s,r))}else this.element.height(Math.max(t.height-n,0));this.uiDialog.is(":data(resizable)")&&this.uiDialog.omResizable("option","minHeight",this._minHeight())}}),e.extend(e.om.omDialog,{version:"2.0",uuid:0,maxZ:0,getTitleId:function(e){var t=e.attr("id");return t||(this.uuid+=1,t=this.uuid),"ui-dialog-title-"+t},overlay:function(t){this.$el=e.om.omDialog.overlay.create(t)}}),e.extend(e.om.omDialog.overlay,{instances:[],oldInstances:[],maxZ:0,events:e.map("focus,mousedown,mouseup,keydown,keypress,click".split(","),function(e){return e+".dialog-overlay"}).join(" "),create:function(t){this.instances.length===0&&(setTimeout(function(){e.om.omDialog.overlay.instances.length&&e(document).bind(e.om.omDialog.overlay.events,function(t){if(e(t.target).zIndex()<e.om.omDialog.overlay.maxZ)return!1})},1),e(document).bind("keydown.dialog-overlay",function(n){t.options.closeOnEscape&&n.keyCode&&n.keyCode===e.om.keyCode.ESCAPE&&(t.close(n),n.preventDefault())}),e(window).bind("resize.dialog-overlay",e.om.omDialog.overlay.resize));var n=(this.oldInstances.pop()||e("<div></div>").addClass("om-widget-overlay")).appendTo(document.body).css({width:this.width(),height:this.height()});return e.fn.bgiframe&&n.bgiframe(),this.instances.push(n),n},destroy:function(t){t.parent().unbind(this.__removeBind);var n=e.inArray(t,this.instances);n!=-1&&this.oldInstances.push(this.instances.splice(n,1)[0]),this.instances.length===0&&e([document,window]).unbind(".dialog-overlay"),t.remove();var r=0;e.each(this.instances,function(){r=Math.max(r,this.css("z-index"))}),this.maxZ=r},height:function(){var t,n;return e.browser.msie&&e.browser.version<7?(t=Math.max(document.documentElement.scrollHeight,document.body.scrollHeight),n=Math.max(document.documentElement.offsetHeight,document.body.offsetHeight),t<n?e(window).height()+"px":t+"px"):e(document).height()+"px"},width:function(){var t,n;return e.browser.msie?(t=Math.max(document.documentElement.scrollWidth,document.body.scrollWidth),n=Math.max(document.documentElement.offsetWidth,document.body.offsetWidth),t<n?e(window).width()+"px":t+"px"):e(document).width()+"px"},resize:function(){var t=e([]);e.each(e.om.omDialog.overlay.instances,function(){t=t.add(this)}),t.css({width:0,height:0}).css({width:e.om.omDialog.overlay.width(),height:e.om.omDialog.overlay.height()})}}),e.extend(e.om.omDialog.overlay.prototype,{destroy:function(){e.om.omDialog.overlay.destroy(this.$el)}})})(jQuery);