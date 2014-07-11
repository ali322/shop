(function(e){e.omWidget("om.omGrid",{options:{height:462,width:"100%",colModel:!1,autoFit:!1,showIndex:!0,dataSource:!1,extraData:{},method:"GET",preProcess:!1,limit:15,rowClasses:["oddRow","evenRow"],singleSelect:!0,title:"",onRowSelect:function(e,t,n){},onRowDeselect:function(e,t,n){},onRowClick:function(e,t,n){},onRowDblClick:function(e,t,n){},onPageChange:function(e,t,n){},onSuccess:function(e,t,n,r){},onError:function(e,t,n,r){},onRefresh:function(e,t,n){},_onRefreshCallbacks:[],_onResizableCallbacks:[],_onResizeCallbacks:[]},_create:function(){var t=this.options,n=this.element.show().attr({cellPadding:0,cellSpacing:0,border:0}).empty().append("<tbody></tbody>");n.wrap('<div class="om-grid om-widget om-widget-content"><div class="bDiv" style="width:auto"></div></div>').closest(".om-grid");if(!e.isArray(this._getColModel()))return;this.hDiv=e('<div class="hDiv om-state-default"></div>').append('<div class="hDivBox"><table cellPadding="0" cellSpacing="0"></table></div>'),n.parent().before(this.hDiv),this.pDiv=e('<div class="pDiv om-state-default"></div>'),n.parent().after(this.pDiv);var r=n.closest(".om-grid");this.loadMask=e('<div class="gBlock"><div align="center" class="gBlock-valignMiddle" ><div class="loadingImg" style="display:block"/></div></div>').mousedown(function(e){return!1}).hide(),r.append(this.loadMask),this.titleDiv=e("<div class='titleDiv'></div>"),r.prepend(this.titleDiv),this.tbody=this.element.children().eq(0),this._guid=0,t._onRefreshCallbacks.push(function(){this._refreshHeaderCheckBox()}),this._bindScrollEnvent()},_init:function(){var t=this.element,n=this,r=this.options,i=t.closest(".om-grid");this._measure(i,r);if(!e.isArray(this._getColModel()))return;this._extraData={},this.tbody.empty(),e("table",this.hDiv).empty(),this.pDiv.empty(),this.titleDiv.empty(),this._buildTableHead(),this._buildPagingToolBar(),this._buildLoadMask(),this._bindSelectAndClickEnvent(),this._makeColsResizable(),this._buildTitle(),this._resetHeight(),this.pageData={nowPage:1,totalPages:1},this._populate(),e(window).bind("resize",function(){n.resize({width:"fit",height:"auto"})})},resize:function(t){var n=this,r=this.options,i=this.element.closest(".om-grid"),s,o;t=t||{},r.width=t.width||arguments[0]||r.width,r.height=t.height||arguments[1]||r.height,this._measure(i,r),this._buildLoadMask(),this._resetWidth(),this._resetHeight(),e.each(r._onResizeCallbacks,function(e,t){t.call(n)})},_measure:function(e,t){e.outerWidth(t.width==="fit"?e.parent().width():t.width),e.outerHeight(t.height==="fit"?e.parent().height():t.height)},_resetHeight:function(){var e=this.element,t=e.closest(".om-grid");t.children(".bDiv").height("auto")},_resetWidth:function(){var t=this.options,n=this._getColModel(),r=-1,i=this.element.closest(".om-grid"),s=e("thead",this.hDiv),o=0;e.each(n,function(e,t){var n=t.width||60;t.width=="autoExpand"&&(n=0,r=e),s.find("th[axis='col"+e+"'] >div").width(n),o+=n}),this._fixHeaderWidth(r,o);var u={};e(this._getHeaderCols()).each(function(){u[e(this).attr("abbr")]=e("div",e(this)).width()}),this.tbody.find("td[abbr]").each(function(t,n){var r=e(n).prop("abbr");u[r]!=null&&e(n).find(">div:first").width(u[r])})},_getColModel:function(){return this.options.colModel},_buildTitle:function(){var e=this.titleDiv;this.options.title?e.html("<div class='titleContent'>"+this.options.title+"</div>").show():e.empty().hide()},_fixHeaderWidth:function(t,n){var r=this.element.closest(".om-grid"),i=e("thead",this.hDiv),s=this._getColModel(),o=this.options;if(t!=-1){var u=r.width()-32,a=i.find('th[axis="col'+t+'"] div');a.parent().hide();var f=u-i.width();a.parent().show(),f<=0?a.css("width",60):a.css("width",f)}else if(o.autoFit){var u=r.width()-22,f=u-i.width(),l=1+f/n,c=i.find('th[axis^="col"] >div');e.each(s,function(e){var t=c.eq(e);t.width(parseInt(t.width()*l))})}},_buildTableHead:function(){var t=this.options,n=this.element,r=n.closest(".om-grid"),i=this._getColModel(),s=0,o=0,u=0,a=-1;thead=e("<thead></thead>"),tr=e("<tr></tr>").appendTo(thead);if(t.showIndex){var f=e("<th></th>").attr({axis:"indexCol",align:"center"}).addClass("indexCol").append(e('<div class="indexheader" style="text-align:center;width:25px;"></div>'));tr.append(f),o=25}if(!t.singleSelect){var f=e("<th></th>").attr({axis:"checkboxCol",align:"center"}).addClass("checkboxCol").append(e('<div class="checkboxheader" style="text-align:center;width:17px;"><span class="checkbox"/></div>'));tr.append(f),u=17}for(var l=0,c=i.length;l<c;l++){var h=i[l],p=h.width||60,d=h.align||"center";p=="autoExpand"&&(p=0,a=l);var v=e("<div></div>").html(h.header).css({"text-align":d,width:p});h.wrap&&v.addClass("wrap");var m=e("<th></th>").attr("axis","col"+l).addClass("col"+l).append(v);h.name&&m.attr("abbr",h.name),h.align&&m.attr("align",h.align),s+=p,tr.append(m)}n.prepend(thead),e("table",this.hDiv).append(thead),this._fixHeaderWidth(a,s),this.thead=thead,thead=null},_buildPagingToolBar:function(){var t=this.options;if(t.limit<=0){this.pDiv.css("border-width",0).hide(),this.pager=this.pDiv;return}var n=this,r=this.element,i=this.pDiv;i.show().html('<div class="pDiv2"><div class="pGroup"><div class="pFirst pButton om-icon"><span class="om-icon-seek-start"></span></div><div class="pPrev pButton om-icon"><span class="om-icon-seek-prev"></span></div></div><div class="btnseparator"></div><div class="pGroup"><span class="pControl"></span></div><div class="btnseparator"></div><div class="pGroup"><div class="pNext pButton om-icon"><span class="om-icon-seek-next"></span></div><div class="pLast pButton om-icon"><span class="om-icon-seek-end"></span></div></div><div class="btnseparator"></div><div class="pGroup"><div class="pReload pButton om-icon"><span class="om-icon-refresh"></span></div></div><div class="btnseparator"></div><div class="pGroup"><span class="pPageStat"></span></div></div>');var s=e.om.lang._get(t,"omGrid","pageText").replace(/{totalPage}/,"<span>1</span>").replace(/{index}/,'<input type="text" size="4" value="1" />');e(".pControl",i).html(s),r.parent().after(i),e(".pReload",i).click(function(){n._populate()}),e(".pFirst",i).click(function(){n._changePage("first")}),e(".pPrev",i).click(function(){n._changePage("prev")}),e(".pNext",i).click(function(){n._changePage("next")}),e(".pLast",i).click(function(){n._changePage("last")}),e(".pControl input",i).keydown(function(t){t.keyCode==e.om.keyCode.ENTER&&n._changePage("input")}),e(".pButton",i).hover(function(){e(this).addClass("om-state-hover")},function(){e(this).removeClass("om-state-hover")}),this.pager=i},_buildLoadMask:function(){var e=this.element.closest(".om-grid");this.loadMask.css({width:"100%",height:"100%"})},_changePage:function(t){if(this.loading)return!0;var n=this.element,r=this.options,i=n.closest(".om-grid"),s=this.pageData,o=s.nowPage,u=s.totalPages,a=o;this._oldPage=o;switch(t){case"first":a=1;break;case"prev":o>1&&(a=o-1);break;case"next":o<u&&(a=o+1);break;case"last":a=u;break;case"input":var f=parseInt(e(".pControl input",n.closest(".om-grid")).val());isNaN(f)&&(f=o),f<1?f=1:f>u&&(f=u),e(".pControl input",this.pDiv).val(f),a=f;break;default:if(/\d/.test(t)){var f=parseInt(t);isNaN(f)&&(f=1),f<1?f=1:f>u&&(f=u),e(".pControl input",n.closest(".om-grid")).val(f),a=f}}if(a==o)return!1;if(this._trigger("onPageChange",null,t,a)===!1)return;s.nowPage=a,this._populate()},_populate:function(){var t=this,n=this.element,r=n.closest(".om-grid"),i=this.options,s=e(".pPageStat",r);if(!i.dataSource)return e(".pPageStat",r).html(i.emptygMsg),!1;if(this.loading)return!0;var o=this.pageData,u=o.nowPage||1,a=e(".gBlock",r);this.loading=!0,s.html(e.om.lang._get(i,"omGrid","loadingMsg")),a.show();var f=i.limit<=0?1e8:i.limit,l=e.extend(!0,{},this._extraData,i.extraData,{start:f*(u-1),limit:f,_time_stamp_:(new Date).getTime()});e.ajax({type:i.method,url:i.dataSource,data:l,dataType:"json",success:function(e,n,r){var s=i.onSuccess;typeof s=="function"&&t._trigger("onSuccess",null,e,n,r),t._addData(e);for(var o=0,f=i._onRefreshCallbacks.length;o<f;o++)i._onRefreshCallbacks[o].call(t);t._trigger("onRefresh",null,u,e.rows),a.hide(),t.loading=!1},error:function(n,r,o){s.html(e.om.lang._get(i,"omGrid","errorMsg")).css("color","red");try{var u=i.onError;typeof u=="function"&&u(n,r,o)}catch(f){}finally{return a.hide(),t.loading=!1,t.pageData.data={rows:[],total:0},!1}}})},_addData:function(t){var n=this.options,r=this.element,i=r.closest(".om-grid"),s=e(".pPageStat",i),o=n.preProcess,u=this.pageData;o&&(t=o(t)),u.data=t,u.totalPages=Math.ceil(t.total/n.limit),this._buildPager(),this._renderDatas()},_buildPager:function(){var t=this.options;if(t.limit<=0)return;var n=this.element,r=this.pager,i=e(".pControl",r),s=this.pageData,o=s.nowPage,u=s.totalPages,a=s.data,f=t.limit*(o-1)+1,l=f-1+a.rows.length,c="";a.total===0?c=e.om.lang._get(t,"omGrid","emptyMsg"):c=e.om.lang._get(t,"omGrid","pageStat").replace(/{from}/,f).replace(/{to}/,l).replace(/{total}/,a.total),e("input",i).val(o),e("span",i).html(u),e(".pPageStat",r).html(c)},_renderDatas:function(){var t=this,n=this.element,r=this.options,i=n.closest(".om-grid"),s=this._getHeaderCols(),o=this.pageData.data.rows||[],u=this._getColModel(),a=r.rowClasses,f=e("tbody",n).empty(),l=typeof a=="function",c=this.pageData,h=(c.nowPage-1)*r.limit,p="<td align='$' abbr='$' class='$'><div align='$' class='innerCol $' style='width:$px'>$</div></td>",d=[],v=[],m,g;this.pageData.data.rows||(this.pageData.data.rows=[]),t.hDiv.scrollLeft(0),e(s).each(function(t){d[t]=e("div",e(this)).width()}),e.each(o,function(n,r){var i=l?a(n,r):a[n%a.length],o=t._buildRowCellValues(u,r,n);v.push("<tr _grid_row_id="+t._guid++ +" class='om-grid-row "+i+"'>"),e(s).each(function(t){var r=e(this).attr("axis"),i=!1,s;if(r=="indexCol")s=n+h+1;else if(r=="checkboxCol")s='<span class="checkbox"/>';else if(r.substring(0,3)=="col"){var a=r.substring(3);s=o[a],u[a].wrap&&(i=!0)}else s="";m=[this.align,this.abbr,r,this.align,i?"wrap":"",d[t],s],g=0,v.push(p.replace(/\$/g,function(){return m[g++]}))}),v.push("</tr>")}),f.html(v.join(" "))},_getHeaderCols:function(){return this.hDiv.find("th[axis]")},_buildRowCellValues:function(e,t,n){var r=e.length,i=[];for(var s=0;s<r;s++){var o=e[s],u,a=o.renderer;if(o.name.indexOf(".")>0){var f=o.name.split("."),l=1,c=f.length,u=t[f[0]];while(l<c&&u&&(u=u[f[l++]])!=undefined);}u==undefined&&(u=t[o.name]==undefined?"":t[o.name]),typeof a=="function"&&(u=a(u,t,n)),i[s]=u,u=null}return i},_bindScrollEnvent:function(){var t=this;this.tbody.closest(".bDiv").scroll(function(){t.hDiv.scrollLeft(e(this).scrollLeft())})},_bindSelectAndClickEnvent:function(){var t=this;this.tbody.unbind(),this.options.singleSelect?(this.tbody.delegate("tr.om-grid-row","click",function(n){var r=e(this),i=t._getRowIndex(r);if(!r.hasClass("om-state-highlight")){var s=t._getRowIndex(t.tbody.find("tr.om-state-highlight:not(:hidden)"));s!=-1&&t._rowDeSelect(s),t._rowSelect(i)}t._trigger("onRowClick",n,i,t._getRowData(i))}),this.tbody.delegate("tr.om-grid-row","dblclick",function(e){var n=t._getRowIndex(this);t._trigger("onRowDblClick",e,n,t._getRowData(n))})):(e("th.checkboxCol span.checkbox",this.thead).click(function(){var n=e(this),r=t._getTrs().size();if(n.hasClass("selected")){n.removeClass("selected");for(var i=0;i<r;i++)t._rowDeSelect(i)}else{n.addClass("selected");for(var i=0;i<r;i++)t._rowSelect(i)}}),this.tbody.delegate("tr.om-grid-row","click",function(n){var r=e(this),i=t._getRowIndex(r);r.hasClass("om-state-highlight")?t._rowDeSelect(i):t._rowSelect(i),t._refreshHeaderCheckBox(),t._trigger("onRowClick",n,i,t._getRowData(i))}),this.tbody.delegate("tr.om-grid-row","dblclick",function(n){var r=e(this),i=t._getRowIndex(r);r.hasClass("om-state-highlight")||(t._rowSelect(i),t._refreshHeaderCheckBox()),t._trigger("onRowDblClick",n,i,t._getRowData(i))}))},_getRowData:function(e){return this.pageData.data.rows[e]},_rowSelect:function(t){var n=this.element,r=this.options,i=e("tbody",n),s=this._getTrs().eq(t),o=e("td.checkboxCol span.checkbox",s);s.addClass("om-state-highlight"),o.addClass("selected"),this._trigger("onRowSelect",null,t,this._getRowData(t))},_rowDeSelect:function(t){var n=this.element,r=this.options,i=e("tbody",n),s=this._getTrs().eq(t),o=e("td.checkboxCol span.checkbox",s);s.removeClass("om-state-highlight"),o.removeClass("selected"),this._trigger("onRowDeselect",null,t,this._getRowData(t))},_refreshHeaderCheckBox:function(){var t=this.getSelections(),n=this._getTrs(),r=e("th.checkboxCol span.checkbox",this.thead),i=n.length;r.toggleClass("selected",i>0&&i==t.length)},_makeColsResizable:function(){var t=this,n=t.tbody.closest(".bDiv"),r=t.element.closest(".om-grid"),i=this.titleDiv,s;e('th[axis^="col"] div',t.thead).omResizable({handles:"e",containment:"document",minWidth:60,resize:function(s,o){var u=e(this),a=u.parent().attr("abbr"),f=e('td[abbr="'+a+'"] > div',t.tbody),l=t.thead.closest(".hDiv");u.width(s.size.width).height(""),f.width(s.size.width).height(""),n.height(r.height()-(i.is(":hidden")?0:i.outerHeight(!0))-l.outerHeight(!0)-(t.pDiv.is(":hidden")?0:t.pDiv.outerHeight(!0))),l.scrollLeft(n.scrollLeft())},start:function(t,n){s=e(this).parent().width()},stop:function(r,i){var o=t.options._onResizableCallbacks,u=e(this).parent(),a=t.thead.closest(".hDiv");s=u.width()-s;for(var f=0,l=o.length;f<l;f++)o[f].call(t,u,s);a.scrollLeft(n.scrollLeft())}})},_getRowIndex:function(e){return this._getTrs().index(e)},_getTrs:function(){return this.tbody.find("tr.om-grid-row:not([_delete]=true)")},setData:function(e,t){this.options.dataSource=e,this.options.extraData=t||{},this.pageData={nowPage:1,totalPages:1},this._populate()},getData:function(){return this.pageData.data},refresh:function(){if(this.loading)return!0;this.loading=!0;var t=this.options;e(".pPageStat",this.pager).html(e.om.lang._get(t,"omGrid","loadingMsg")),this.loadMask.show(),this._buildPager(),this._renderDatas(),this._trigger("onRefresh",null,this.pageData.nowPage||1,this.pageData.data.rows);for(var n=0,r=t._onRefreshCallbacks.length;n<r;n++)t._onRefreshCallbacks[n].call(this);this.loadMask.hide(),this.loading=!1},reload:function(e){if(this.loading)return!0;typeof e!="undefined"&&(e=parseInt(e)||1,e<0&&(e=1),e>this.pageData.totalPages&&(e=this.pageData.totalPages),this.pageData.nowPage=e),this._populate()},setSelections:function(t){var n=this;e.isArray(t)||(t=[t]);var r=this.getSelections();e(r).each(function(){n._rowDeSelect(this)}),e(t).each(function(){n._rowSelect(this)}),n._refreshHeaderCheckBox()},getSelections:function(e){var t=this,n=t._getTrs(),r=n.filter(".om-state-highlight"),i=[];if(e){var s=t.getData().rows;r.each(function(e,t){i[i.length]=s[n.index(t)]})}else r.each(function(e,t){i[i.length]=n.index(t)});return i},destroy:function(){var e=this.element;e.closest(".om-grid").after(e).remove()}}),e.om.lang.omGrid={loadingMsg:"正在加载数据，请稍候...",emptyMsg:"没有数据",errorMsg:"取数出错",pageText:"第{index}页，共{totalPage}页",pageStat:"共{total}条数据，显示{from}-{to}条"}})(jQuery);