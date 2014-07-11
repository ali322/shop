(function(e,t){var n="om-accordion-panel-"+((1+Math.random())*65536|0).toString(16).substring(1)+"-",r=0;e.omWidget("om.omAccordion",{options:{active:0,autoPlay:!1,collapsible:!1,disabled:!1,height:"auto",header:"> ul:first li",iconCls:null,interval:1e3,switchEffect:!1,switchMode:"click",width:"auto",onActivate:function(e,t){},onBeforeActivate:function(e,t){},onBeforeCollapse:function(e,t){},onCollapse:function(e,t){}},activate:function(e){var t=this.options;clearInterval(t.autoInterId),this._activate(e),this._setAutoInterId(this)},disable:function(){var t=this.element,n=this.options,r;n.autoPlay&&clearInterval(n.autoInterId),n.disabled=!0,(r=t.find(">.om-accordion-disable")).length===0&&e("<div class='om-accordion-disable'></div>").css({position:"absolute",top:0,left:0}).width(t.outerWidth()).height(t.outerHeight()).appendTo(t),r.show()},enable:function(){this.options.disabled=!1,this.element.find(">.om-accordion-disable").hide()},getActivated:function(){var t=e.data(this.element,"panels");for(var n=0,r=t.length;n<r;n++)if(!t[n].omPanel("option","collapsed"))return t[n].prop("id");return null},getLength:function(){return e.data(this.element,"panels").length},reload:function(t){var n=e.data(this.element,"panels");if(this.options.disabled!==!1||n.length===0)return this;t=this._correctIndex(t),n[t].omPanel("reload")},resize:function(){var t=this.element,n=this.options,r=e.data(this.element,"panels"),i=0;this._initWidthOrHeight("width"),this._initWidthOrHeight("height"),e.each(r,function(e,t){i+=t.prev().outerHeight()}),e.each(r,function(e,r){n.height==="auto"?r.css("height",""):r.outerHeight(t.height()-i)})},setTitle:function(t,n){var r=e.data(this.element,"panels");if(this.options.disabled!==!1||r.length===0)return this;t=this._correctIndex(t),r[t].omPanel("setTitle",n)},url:function(t,n){var r=e.data(this.element,"panels");if(!n||this.options.disabled!==!1||r.length===0)return;t=this._correctIndex(t),r[t].omPanel("option","url",n)},_create:function(){var t=this.element,n=this.options;t.addClass("om-widget om-accordion").css("position","relative"),this._renderPanels(),n.active=this._correctIndex(n.active),this.resize(),this._buildEvent(),e(window).bind("resize",function(){var r=e.data(t,"panels"),i=0;e.each(r,function(e,t){i+=t.prev().outerHeight()}),e.each(r,function(e,r){n.height==="auto"&&r.css("height",""),n.height==="fit"&&r.outerHeight(t.height()-i)})}),n.disabled!==!1&&this.disable()},_correctIndex:function(t){var n=this.element,r=e.data(this.element,"panels"),i=n.children().find(">div#"+t),s=r.length,o=t;t=i.length?n.find(">.om-panel").index(i.parent()):t,t=t==-1?o:t;var u=parseInt(t);return u=(isNaN(u)&&"0"||u)-0,s==0||u===-1&&this.options.collapsible!==!1?-1:u<0?0:u>=s?s-1:u},_panelCreateCollapse:function(e,t){var n=this.element,r=this.options,i,s;if(r.active===-1&&r.collapsible===!0)return!0;i=n.find(">div#"+r.active),s=n.children().index(i),s=s==-1?r.active:s;var o=parseInt(s);return o=(isNaN(o)&&"0"||o)-0,o=o<0?0:o>=e?e-1:o,o!==t},_renderPanels:function(){var t=this.element,i=this,s=[],o=this.options,u=t.find(o.header),a=[],f;u.find("a").each(function(s){var u=this.getAttribute("href",2),l=u.split("#")[0],c;l&&(l===location.toString().split("#")[0]||(c=e("base")[0])&&l===c.href)&&(u=this.hash,this.href=u);var h=e(this);a[s]={title:h.text(),iconCls:h.attr("iconCls"),onExpand:function(e){i._trigger("onActivate",e,s)},tools:[{id:"collapse",handler:function(e,t){clearInterval(o.autoInterId),i._activate(s,!0),i._setAutoInterId(i),t.stopPropagation()}}],onCollapse:function(e){i._trigger("onCollapse",e,s)},onSuccess:function(){i.resize()},onError:function(){i.resize()}};var p=e(">"+u,t),d=p.prop("id");p[0]?(d||p.prop("id",d=n+r++),p.appendTo(t)):(a[s].url=h.attr("href"),e("<div></div>").prop("id",d=h.prop("id")||n+r++).appendTo(t)),f=f||d}),f&&t.find("#"+f).prevAll().remove(),u.remove(),e.each(a,function(e,t){t.collapsed=i._panelCreateCollapse(a.length,e)}),e.each(t.children(),function(e,t){s.push(i._createPanel(t,a[e]));if(e===0){var n=s[0].prev();n.css("border-top-width",n.css("border-bottom-width"))}}),e.data(t,"panels",s)},_initWidthOrHeight:function(e){var t=this.element,n=this.options,r=this.element.attr("style"),i=n[e];i=="fit"?t.css(e,"100%"):i!=="auto"?t.css(e,i):r&&r.indexOf(e)!=-1?n[e]=t.css(e):t.css(e,"")},_createPanel:function(t,n){return e(t).omPanel(n)},_buildEvent:function(){var t=this.options,n=this;this.element.children().find(">div.om-panel-header").each(function(r){var i=e(this);i.unbind(),t.switchMode=="mouseover"?i.bind("mouseenter.omaccordions",function(i){clearInterval(t.autoInterId);var s=e.data(n.element,"expandTimer");typeof s!="undefined"&&clearTimeout(s),s=setTimeout(function(){n._activate(r,!0),n._setAutoInterId(n)},200),e.data(n.element,"expandTimer",s)}):t.switchMode=="click"&&i.bind("click.omaccordions",function(e){clearInterval(t.autoInterId),n._activate(r,!0),n._setAutoInterId(n)}),i.hover(function(){e(this).toggleClass("om-panel-header-hover")})}),t.autoPlay&&(clearInterval(t.autoInterId),n._setAutoInterId(n))},_setAutoInterId:function(e){var t=e.options;t.autoPlay&&(t.autoInterId=setInterval(function(){e._activate("next")},t.interval))},_setOption:function(t,n){e.OMWidget.prototype._setOption.apply(this,arguments);var r=this.options;switch(t){case"active":this.activate(n);break;case"disabled":n===!1?this.enable():this.disable();break;case"width":r.width=n,this._initWidthOrHeight("width");break;case"height":r.height=n,this._initWidthOrHeight("height")}},_activate:function(t,n){var r=e.data(this.element,"panels"),i=r.length,s=this.options,o=this,u=!1,a=-1,f=!1,l;if(s.disabled!==!1&&i===0)return;t=t==="next"?(s.active+1)%i:o._correctIndex(t),s.switchEffect&&(f=!0,l="fast");for(var c=0;c<i;c++)e(r[c]).stop(!0,!0);var h=o.getActivated();u=!!h,u?(a=o._correctIndex(h),a==t?n===!0&&s.collapsible!==!1&&o._trigger("onBeforeCollapse",null,a)!==!1?(e(r[a]).omPanel("collapse",f,l),s.active=-1):s.active=a:t===-1?o._trigger("onBeforeCollapse",null,a)!==!1?(e(r[a]).omPanel("collapse",f,l),s.active=-1):s.active=a:o._trigger("onBeforeCollapse",null,a)!==!1&&(canAct=o._trigger("onBeforeActivate",null,t)!==!1)?(e(r[a]).omPanel("collapse",f,l),e(r[t]).omPanel("expand",f,l),s.active=t):s.active=a):t==="-1"?s.active=-1:o._trigger("onBeforeActivate",null,t)!==!1&&(e(r[t]).omPanel("expand",f,l),s.active=t)}})})(jQuery);