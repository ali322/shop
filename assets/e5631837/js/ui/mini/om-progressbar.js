(function(e){e.omWidget("om.omProgressbar",{options:{value:0,text:"{value}%",width:"auto",max:100},min:0,_create:function(){var t=this.element;t.addClass("om-progressbar om-widget om-widget-content om-corner-all"),this.textDiv=e("<div class='om-progressbar-text'></div>").appendTo(t),this.valueDiv=e("<div class='om-progressbar-value om-widget-header om-corner-left'></div>").appendTo(t)},_init:function(){var e=this.element.width();typeof this.options.width=="number"&&(e=this.options.width,this.element.width(e)),this.textDiv.width(Math.floor(e)),this.oldValue=this._value(),this._refreshValue()},value:function(e){if(e===undefined)return this._value();this.options.value=e,this._refreshValue()},_value:function(){var e=this.options.value;return typeof e!="number"&&(e=0),Math.min(this.options.max,Math.max(this.min,e))},_percentage:function(){return 100*this._value()/this.options.max},_refreshValue:function(){var e=this,t=e.value(),n=e.options.onChange,r=e._percentage(),i=e.options.text,s="";e.valueDiv.toggle(t>e.min).toggleClass("om-corner-right",t===e.options.max).width(r.toFixed(0)+"%"),typeof i=="function"?s=i.call(t,t):typeof i=="string"&&(s=i.replace("{value}",t)),e.textDiv.html(s),e.oldValue!==t&&(n&&e._trigger("onChange",null,t,e.oldValue),e.oldValue=t)}})})(jQuery);