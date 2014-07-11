(function(e,t){e.omWidget("om.omDraggable",e.om.omMouse,{widgetEventPrefix:"drag",options:{axis:!1,containment:!1,cursor:"auto",_scope:"default",handle:!1,helper:"original",revert:!1,scroll:!0},_create:function(){this.options.helper=="original"&&!/^(?:r|a|f)/.test(this.element.css("position"))&&(this.element[0].style.position="relative"),this.element.addClass("om-draggable"),this.options.disabled&&this.element.addClass("om-draggable-disabled"),this._mouseInit()},destroy:function(){if(!this.element.data("omDraggable"))return;return this.element.removeData("omDraggable").unbind(".draggable").removeClass("om-draggable om-draggable-dragging om-draggable-disabled"),this._mouseDestroy(),this},_mouseCapture:function(t){var n=this.options;return this.helper||n.disabled||e(t.target).is(".om-resizable-handle")?!1:(this.handle=this._getHandle(t),this.handle?!0:!1)},_mouseStart:function(t){var n=this.options;return this.helper=this._createHelper(t),this._cacheHelperProportions(),e.om.ddmanager&&(e.om.ddmanager.current=this),this._cacheMargins(),this.cssPosition=this.helper.css("position"),this.scrollParent=this.helper.scrollParent(),this.offset=this.positionAbs=this.element.offset(),this.offset={top:this.offset.top-this.margins.top,left:this.offset.left-this.margins.left},e.extend(this.offset,{click:{left:t.pageX-this.offset.left,top:t.pageY-this.offset.top},parent:this._getParentOffset(),relative:this._getRelativeOffset()}),this.originalPosition=this.position=this._generatePosition(t),this.originalPageX=t.pageX,this.originalPageY=t.pageY,n.containment&&this._setContainment(),this._trigger("onStart",t)===!1?(this._clear(),!1):(this._cacheHelperProportions(),e.om.ddmanager&&!n.dropBehaviour&&e.om.ddmanager.prepareOffsets(this,t),this.helper.addClass("om-draggable-dragging"),this._mouseDrag(t,!0),e.om.ddmanager&&e.om.ddmanager.dragStart(this,t),!0)},_mouseDrag:function(t,n){this.position=this._generatePosition(t),this.positionAbs=this._convertPositionTo("absolute");if(!n){var r=this._uiHash();if(this._trigger("onDrag",t,r)===!1)return this._mouseUp({}),!1;this.position=r.position}if(!this.options.axis||this.options.axis!="y")this.helper[0].style.left=this.position.left+"px";if(!this.options.axis||this.options.axis!="x")this.helper[0].style.top=this.position.top+"px";return e.om.ddmanager&&e.om.ddmanager.drag(this,t),!1},_mouseStop:function(t){var n=!1;e.om.ddmanager&&!this.options.dropBehaviour&&(n=e.om.ddmanager.drop(this,t)),this.dropped&&(n=this.dropped,this.dropped=!1);if((!this.element[0]||!this.element[0].parentNode)&&this.options.helper=="original")return!1;if(this.options.revert=="invalid"&&!n||this.options.revert=="valid"&&n||this.options.revert===!0||e.isFunction(this.options.revert)&&this.options.revert.call(this.element,n)){var r=this;e(this.helper).animate(this.originalPosition,500,function(){r._trigger("onStop",t)!==!1&&r._clear()})}else this._trigger("onStop",t)!==!1&&this._clear();return!1},_mouseUp:function(t){return e.om.ddmanager&&e.om.ddmanager.dragStop(this,t),e.om.omMouse.prototype._mouseUp.call(this,t)},cancel:function(){return this.helper.is(".om-draggable-dragging")?this._mouseUp({}):this._clear(),this},_getHandle:function(t){var n=!this.options.handle||!e(this.options.handle,this.element).length?!0:!1;return e(this.options.handle,this.element).find("*").andSelf().each(function(){this==t.target&&(n=!0)}),n},_createHelper:function(t){var n=this.options,r=e.isFunction(n.helper)?e(n.helper.apply(this.element[0],[t])):n.helper=="clone"?this.element.clone().removeAttr("id"):this.element;return r.parents("body").length||r.appendTo(this.element[0].parentNode),r[0]!=this.element[0]&&!/(fixed|absolute)/.test(r.css("position"))&&r.css("position","absolute"),r},_getParentOffset:function(){this.offsetParent=this.helper.offsetParent();var t=this.offsetParent.offset();this.cssPosition=="absolute"&&this.scrollParent[0]!=document&&e.contains(this.scrollParent[0],this.offsetParent[0])&&(t.left+=this.scrollParent.scrollLeft(),t.top+=this.scrollParent.scrollTop());if(this.offsetParent[0]==document.body||this.offsetParent[0].tagName&&this.offsetParent[0].tagName.toLowerCase()=="html"&&e.browser.msie)t={top:0,left:0};return{top:t.top+(parseInt(this.offsetParent.css("borderTopWidth"),10)||0),left:t.left+(parseInt(this.offsetParent.css("borderLeftWidth"),10)||0)}},_getRelativeOffset:function(){if(this.cssPosition=="relative"){var e=this.element.position();return{top:e.top-(parseInt(this.helper.css("top"),10)||0)+this.scrollParent.scrollTop(),left:e.left-(parseInt(this.helper.css("left"),10)||0)+this.scrollParent.scrollLeft()}}return{top:0,left:0}},_cacheMargins:function(){this.margins={left:parseInt(this.element.css("marginLeft"),10)||0,top:parseInt(this.element.css("marginTop"),10)||0,right:parseInt(this.element.css("marginRight"),10)||0,bottom:parseInt(this.element.css("marginBottom"),10)||0}},_cacheHelperProportions:function(){this.helperProportions={width:this.helper.outerWidth(),height:this.helper.outerHeight()}},_setContainment:function(){var t=this.options;t.containment=="parent"&&(t.containment=this.helper[0].parentNode);if(t.containment=="document"||t.containment=="window")this.containment=[t.containment=="document"?0:e(window).scrollLeft()-this.offset.relative.left-this.offset.parent.left,t.containment=="document"?0:e(window).scrollTop()-this.offset.relative.top-this.offset.parent.top,(t.containment=="document"?0:e(window).scrollLeft())+e(t.containment=="document"?document:window).width()-this.helperProportions.width-this.margins.left,(t.containment=="document"?0:e(window).scrollTop())+(e(t.containment=="document"?document:window).height()||document.body.parentNode.scrollHeight)-this.helperProportions.height-this.margins.top];if(!/^(document|window|parent)$/.test(t.containment)&&t.containment.constructor!=Array){var n=e(t.containment),r=n[0];if(!r)return;var i=n.offset(),s=e(r).css("overflow")!="hidden";this.containment=[(parseInt(e(r).css("borderLeftWidth"),10)||0)+(parseInt(e(r).css("paddingLeft"),10)||0),(parseInt(e(r).css("borderTopWidth"),10)||0)+(parseInt(e(r).css("paddingTop"),10)||0),(s?Math.max(r.scrollWidth,r.offsetWidth):r.offsetWidth)-(parseInt(e(r).css("borderLeftWidth"),10)||0)-(parseInt(e(r).css("paddingRight"),10)||0)-this.helperProportions.width-this.margins.left-this.margins.right,(s?Math.max(r.scrollHeight,r.offsetHeight):r.offsetHeight)-(parseInt(e(r).css("borderTopWidth"),10)||0)-(parseInt(e(r).css("paddingBottom"),10)||0)-this.helperProportions.height-this.margins.top-this.margins.bottom],this.relative_container=n}else t.containment.constructor==Array&&(this.containment=t.containment)},_convertPositionTo:function(t,n){n||(n=this.position);var r=t=="absolute"?1:-1,i=this.options,s=this.cssPosition!="absolute"||this.scrollParent[0]!=document&&!!e.contains(this.scrollParent[0],this.offsetParent[0])?this.scrollParent:this.offsetParent,o=/(html|body)/i.test(s[0].tagName);return{top:n.top+this.offset.relative.top*r+this.offset.parent.top*r-(e.browser.safari&&e.browser.version<526&&this.cssPosition=="fixed"?0:(this.cssPosition=="fixed"?-this.scrollParent.scrollTop():o?0:s.scrollTop())*r),left:n.left+this.offset.relative.left*r+this.offset.parent.left*r-(e.browser.safari&&e.browser.version<526&&this.cssPosition=="fixed"?0:(this.cssPosition=="fixed"?-this.scrollParent.scrollLeft():o?0:s.scrollLeft())*r)}},_generatePosition:function(t){var n=this.options,r=this.cssPosition!="absolute"||this.scrollParent[0]!=document&&!!e.contains(this.scrollParent[0],this.offsetParent[0])?this.scrollParent:this.offsetParent,i=/(html|body)/i.test(r[0].tagName),s=t.pageX,o=t.pageY;if(this.originalPosition){var u;if(this.containment){if(this.relative_container){var a=this.relative_container.offset();u=[this.containment[0]+a.left,this.containment[1]+a.top,this.containment[2]+a.left,this.containment[3]+a.top]}else u=this.containment;t.pageX-this.offset.click.left<u[0]&&(s=u[0]+this.offset.click.left),t.pageY-this.offset.click.top<u[1]&&(o=u[1]+this.offset.click.top),t.pageX-this.offset.click.left>u[2]&&(s=u[2]+this.offset.click.left),t.pageY-this.offset.click.top>u[3]&&(o=u[3]+this.offset.click.top)}}return{top:o-this.offset.click.top-this.offset.relative.top-this.offset.parent.top+(e.browser.safari&&e.browser.version<526&&this.cssPosition=="fixed"?0:this.cssPosition=="fixed"?-this.scrollParent.scrollTop():i?0:r.scrollTop()),left:s-this.offset.click.left-this.offset.relative.left-this.offset.parent.left+(e.browser.safari&&e.browser.version<526&&this.cssPosition=="fixed"?0:this.cssPosition=="fixed"?-this.scrollParent.scrollLeft():i?0:r.scrollLeft())}},_clear:function(){this.helper.removeClass("om-draggable-dragging"),this.helper[0]!=this.element[0]&&!this.cancelHelperRemoval&&this.helper.remove(),this.helper=null,this.cancelHelperRemoval=!1},_trigger:function(t,n,r){return r=r||this._uiHash(),e.om.plugin.call(this,t,[n,r]),t=="onDrag"&&(this.positionAbs=this._convertPositionTo("absolute")),e.OMWidget.prototype._trigger.call(this,t,n,r)},plugins:{},_uiHash:function(e){return{helper:this.helper,position:this.position,originalPosition:this.originalPosition,offset:this.positionAbs}}}),e.om.plugin.add("omDraggable","cursor",{onStart:function(t,n){var r=e("body"),i=e(this).data("omDraggable").options;r.css("cursor")&&(i._cursor=r.css("cursor")),r.css("cursor",i.cursor)},onStop:function(t,n){var r=e(this).data("omDraggable");if(r){var i=r.options;i._cursor&&e("body").css("cursor",i._cursor)}}}),e.om.plugin.add("omDraggable","scroll",{onStart:function(t,n){var r=e(this).data("omDraggable");r.scrollParent[0]!=document&&r.scrollParent[0].tagName!="HTML"&&(r.overflowOffset=r.scrollParent.offset())},onDrag:function(t,n){var r=e(this).data("omDraggable"),i=r.options,s=!1,o=20,u=20;if(r.scrollParent[0]!=document&&r.scrollParent[0].tagName!="HTML"){if(!i.axis||i.axis!="x")r.overflowOffset.top+r.scrollParent[0].offsetHeight-n.pageY<o?r.scrollParent[0].scrollTop=s=r.scrollParent[0].scrollTop+u:n.pageY-r.overflowOffset.top<o&&(r.scrollParent[0].scrollTop=s=r.scrollParent[0].scrollTop-u);if(!i.axis||i.axis!="y")r.overflowOffset.left+r.scrollParent[0].offsetWidth-n.pageX<o?r.scrollParent[0].scrollLeft=s=r.scrollParent[0].scrollLeft+u:n.pageX-r.overflowOffset.left<o&&(r.scrollParent[0].scrollLeft=s=r.scrollParent[0].scrollLeft-u)}else{if(!i.axis||i.axis!="x")n.pageY-e(document).scrollTop()<o?s=e(document).scrollTop(e(document).scrollTop()-u):e(window).height()-(n.pageY-e(document).scrollTop())<o&&(s=e(document).scrollTop(e(document).scrollTop()+u));if(!i.axis||i.axis!="y")n.pageX-e(document).scrollLeft()<o?s=e(document).scrollLeft(e(document).scrollLeft()-u):e(window).width()-(n.pageX-e(document).scrollLeft())<o&&(s=e(document).scrollLeft(e(document).scrollLeft()+u))}s!==!1&&e.om.ddmanager&&!i.dropBehaviour&&e.om.ddmanager.prepareOffsets(r,n)}})})(jQuery);