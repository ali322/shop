(function(e,t){e.om=e.om||{};var n=/left|center|right/,r=/top|center|bottom/,i="center",s=e.fn.position,o=e.fn.offset;e.fn.position=function(t){if(!t||!t.of)return s.apply(this,arguments);t=e.extend({},t);var o=e(t.of),u=o[0],a=(t.collision||"flip").split(" "),f=t.offset?t.offset.split(" "):[0,0],l,c,h;return u.nodeType===9?(l=o.width(),c=o.height(),h={top:0,left:0}):u.setTimeout?(l=o.width(),c=o.height(),h={top:o.scrollTop(),left:o.scrollLeft()}):u.preventDefault?(t.at="left top",l=c=0,h={top:t.of.pageY,left:t.of.pageX}):(l=o.outerWidth(),c=o.outerHeight(),h=o.offset()),e.each(["my","at"],function(){var e=(t[this]||"").split(" ");e.length===1&&(e=n.test(e[0])?e.concat([i]):r.test(e[0])?[i].concat(e):[i,i]),e[0]=n.test(e[0])?e[0]:i,e[1]=r.test(e[1])?e[1]:i,t[this]=e}),a.length===1&&(a[1]=a[0]),f[0]=parseInt(f[0],10)||0,f.length===1&&(f[1]=f[0]),f[1]=parseInt(f[1],10)||0,t.at[0]==="right"?h.left+=l:t.at[0]===i&&(h.left+=l/2),t.at[1]==="bottom"?h.top+=c:t.at[1]===i&&(h.top+=c/2),h.left+=f[0],h.top+=f[1],this.each(function(){var n=e(this),r=n.outerWidth(),s=n.outerHeight(),o=parseInt(e.curCSS(this,"marginLeft",!0))||0,u=parseInt(e.curCSS(this,"marginTop",!0))||0,p=r+o+(parseInt(e.curCSS(this,"marginRight",!0))||0),d=s+u+(parseInt(e.curCSS(this,"marginBottom",!0))||0),v=e.extend({},h),m;t.my[0]==="right"?v.left-=r:t.my[0]===i&&(v.left-=r/2),t.my[1]==="bottom"?v.top-=s:t.my[1]===i&&(v.top-=s/2),v.left=Math.round(v.left),v.top=Math.round(v.top),m={left:v.left-o,top:v.top-u},e.each(["left","top"],function(n,i){e.om.omPosition[a[n]]&&e.om.omPosition[a[n]][i](v,{targetWidth:l,targetHeight:c,elemWidth:r,elemHeight:s,collisionPosition:m,collisionWidth:p,collisionHeight:d,offset:f,my:t.my,at:t.at})}),e.fn.bgiframe&&n.bgiframe(),n.offset(e.extend(v,{using:t.using}))})},e.om.omPosition={fit:{left:function(t,n){var r=e(window),i=n.collisionPosition.left+n.collisionWidth-r.width()-r.scrollLeft();t.left=i>0?t.left-i:Math.max(t.left-n.collisionPosition.left,t.left)},top:function(t,n){var r=e(window),i=n.collisionPosition.top+n.collisionHeight-r.height()-r.scrollTop();t.top=i>0?t.top-i:Math.max(t.top-n.collisionPosition.top,t.top)}},flip:{left:function(t,n){if(n.at[0]===i)return;var r=e(window),s=n.collisionPosition.left+n.collisionWidth-r.width()-r.scrollLeft(),o=n.my[0]==="left"?-n.elemWidth:n.my[0]==="right"?n.elemWidth:0,u=n.at[0]==="left"?n.targetWidth:-n.targetWidth,a=-2*n.offset[0];t.left+=n.collisionPosition.left<0?o+u+a:s>0?o+u+a:0},top:function(t,n){if(n.at[1]===i)return;var r=e(window),s=n.collisionPosition.top+n.collisionHeight-r.height()-r.scrollTop(),o=n.my[1]==="top"?-n.elemHeight:n.my[1]==="bottom"?n.elemHeight:0,u=n.at[1]==="top"?n.targetHeight:-n.targetHeight,a=-2*n.offset[1];t.top+=n.collisionPosition.top<0?o+u+a:s>0?o+u+a:0}}},e.offset.setOffset||(e.offset.setOffset=function(t,n){/static/.test(e.curCSS(t,"position"))&&(t.style.position="relative");var r=e(t),i=r.offset(),s=parseInt(e.curCSS(t,"top",!0),10)||0,o=parseInt(e.curCSS(t,"left",!0),10)||0,u={top:n.top-i.top+s,left:n.left-i.left+o};"using"in n?n.using.call(t,u):r.css(u)},e.fn.offset=function(t){var n=this[0];return!n||!n.ownerDocument?null:t?this.each(function(){e.offset.setOffset(this,t)}):o.call(this)})})(jQuery);