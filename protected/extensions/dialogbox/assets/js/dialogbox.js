/**
 * Created with JetBrains PhpStorm.
 * User: alichen
 * Date: 12-8-20
 * Time: 下午2:06
 * To change this template use File | Settings | File Templates.
 */
(function($){
    $.fn.dialogBox = function(options){
        var defaults = {
            opacity: 0.5,//背景透明度
            callBack: null,
            noTitle: false,
            show:false,
            timeout:0,
            target:null,
            requestType:null,//iframe,ajax,img
            title: "dialogBox Title",
            drag:true,
            iframeWH: {//iframe 设置高宽
                width: 400,
                height: 300
            },
            html: ''//wBox内容
        },_this=this;
        this.YQ = $.extend(defaults, options);
        var  B = null, C = null, $win = $(window),$t=$(this);//B背景，C内容jquery div;
        this.showBox=function (){
            if($('#dialogBox').length > 0){
                $('#dialogBox').empty().remove();
            }else{
                $('<div class="dialog_box" id="dialogBox"><div class="dialog_box_title_wrap"></a><div class="dialog_box_title dialog_box_dragger">'+(_this.YQ.noTitle ? '' : _this.YQ.title)+'</div>'+
                    '<div class="dialogBox_close">关闭</div></div><div class="dialog_box_content" id="dialogBoxContent"></div>').appendTo(document.body);
            }
            if($('#dialogBox_overlay').length>0){
                $('#dialogBox_overlay').empty().remove();
            }else{
                $("<div id='dialogBox_overlay' class='dialogBox_hide'></div>").hide().addClass('dialogBox_overlayBG').css({'opacity': _this.YQ.opacity,'height':$win.height()}).dblclick(function(){
                    _this.close();
                }).appendTo(document.body).fadeIn(300);
            }

           handleClick();
        };
        /*
         * 处理点击
         * @param {string} what
         */
        function handleClick(){
            var con = $("#dialogBoxContent");
            if (_this.YQ.requestType && $.inArray(_this.YQ.requestType, ['iframe', 'ajax','img'])!=-1) {
                con.html("<div class='dialogBox_load'><div id='dialogBox_loading'></div></div>");
                if (_this.YQ.requestType === "img") {
                    var img = $("<img />");
                    img.attr("src",_this.YQ.target);
                    img.load(function(){
                        img.appendTo(con.empty());
                        setPosition();
                    });
                }
                else
                if (_this.YQ.requestType === "ajax") {
                    $.get(_this.YQ.target, function(data){
                        con.html(data);
                        $('#dialogBox').find('.dialogBox_close').click(_this.close);
                        setPosition();
                    })

                }
                else {
                    ifr = $("<iframe name='dialogBoxIframe' style='width:" + _this.YQ.iframeWH.width + "px;height:" + _this.YQ.iframeWH.height + "px;' scrolling='auto' frameborder='0' src='" + _this.YQ.target + "'></iframe>");
                    ifr.appendTo(con.empty());
                    ifr.load(function(){
                        try {
                            $it = $(this).contents();
                            $it.find('.dialogBox_close').click(_this.close);
                            fH = $it.height();//iframe height
                            fW = $it.width();
                            w = $win;
                            newW = Math.min(w.width() - 40, fW);
                            newH = w.height() - 25 - (_this.YQ.noTitle ? 0 : 30);
                            newH = Math.min(newH, fH);
                            if (!newH)
                                return;
                            var lt = calPosition(newW);
                            $('#dialogBox').css({
                                left: lt[0],
                                top: lt[1]
                            });

                            $(this).css({
                                height: newH,
                                width: newW
                            });
                        }
                        catch (e) {
                        }
                    });
                }

            }
            else
            if (_this.YQ.target) {
                $(_this.YQ.target).clone(true).show().appendTo(con.empty());

            }
            else
            if (_this.YQ.html) {
                con.html(_this.YQ.html);
            }
            else {
                $t.clone(true).show().appendTo(con.empty());
            }
            afterHandleClick();
        }
        /*
         * 处理点击之后的处理
         */
        function afterHandleClick(){
            setPosition();
            $('#dialogBox').show().find('.dialogBox_close').click(_this.close).hover(function(){
                $(this).addClass("on");
            }, function(){
                $(this).removeClass("on");
            });
            $(document).unbind('keydown.dialogBox').bind('keydown.dialogBox', function(e){
                if (e.keyCode === 27)
                    _this.close();
                return true
            });
            typeof _this.YQ.callBack === 'function' ? _this.YQ.callBack() : null;
            !_this.YQ.noTitle&&_this.YQ.drag?drag():null;
            if(_this.YQ.timeout){
                setTimeout(_this.close,_this.YQ.timeout);
            }
        }
        /*
         * 设置dialogBox的位置
         */
        function setPosition(){
            if ($('#dialogBox').length == 0) {
                return false;
            }

            var width = $('#dialogBox').width(),  lt = calPosition(width);
            $('#dialogBox').css({
                left: lt[0],
                top: lt[1]
            });
            var $h = $("body").height(), $wh = $win.height(),$hh=$("html").height();
            $h = Math.max($h, $wh);
            $('#dialogBox_overlay').height($h).width($win.width());
        }
        /*
         * 计算dialogBox的位置
         * @param {number} w 宽度
         */
        function calPosition(w){
            l = ($win.width() - w) / 2;
            t = $win.scrollTop() + $win.height() /9;
            return [l, t];
        }
        /*
         * 拖拽函数drag
         */
        function drag(){
            var dx, dy, moveout;
            var T = $('#dialogBox').find('.dialog_box_dragger').css('cursor', 'move');
            T.bind("selectstart", function(){
                return false;
            });

            T.mousedown(function(e){
                dx = e.clientX - parseInt($('#dialogBox').css("left"));
                dy = e.clientY - parseInt($('#dialogBox').css("top"));
                $('#dialogBox').mousemove(move).mouseout(out).css('opacity', 0.8);
                T.mouseup(up);
            });
            /*
             * 移动改变生活
             * @param {Object} e 事件
             */
            function move(e){
                moveout = false;
                if (e.clientX - dx < 0) {
                    l = 0;
                }
                else
                if (e.clientX - dx > $win.width() - $('#dialogBox').width()) {
                    l = $win.width() - $('#dialogBox').width();
                }
                else {
                    l = e.clientX - dx
                }
                $('#dialogBox').css({
                    left: l,
                    top: e.clientY - dy
                });

            }
            /*
             * 你已经out啦！
             * @param {Object} e 事件
             */
            function out(e){
                moveout = true;
                setTimeout(function(){
                    moveout && up(e);
                }, 10);
            }
            /*
             * 放弃
             * @param {Object} e事件
             */
            function up(e){
                $('#dialogBox').unbind("mousemove", move).unbind("mouseout", out).css('opacity', 1);
                T.unbind("mouseup", up);
            }
        }

        /*
         * 关闭弹出框就是移除还原
         */
        this.close=function (){
            if ($('#dialogBox').length>0) {
                $('#dialogBox_overlay').remove();
                $('#dialogBox').stop().fadeOut(300, function(){
                    $('#dialogBox').remove();
                })
            }
        }
        /*
         * 触发click事件
         */
        $win.resize(function(){
            setPosition();
        });

        _this.YQ.show?_this.showBox():$t.click(function(){
            _this.showBox();
            return false;
        });

        return this;
    };
})(jQuery);
