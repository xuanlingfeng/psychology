//生成座位并赋予状态
function createdSeat(num, seatArr, price, img) {
    var $cart = $('#selected-seats'), //座位区
        $counter = $('#counter'), //票数
        $total = $('#total'); //总计金额
    var sc = $('#seat-map').seatCharts({
        map: [  //座位图
            'aaaaaaaaa________',//1排
            'aaaaaaaaaa_______',//2排
            'aaaaaaaaaaa______',//3排
            'aaaaaaaaaaaa_____',//4排
            'aaaaaaaaaaaaa____',//5排
            'aaaaaaaaaa_______',//6排
            'aaaaaaaaaa_______',//7排
            'aaaaaaaaaaa______',//8排
            'aaaaaaaaaaaa_____',//9排
            'aaaaaaa__________',//10排
            'aaaaaaaaaaaa_____',//11排
            'aaaaaaaaaaaaaa___',//12排
            'aaaaaaaaaaaaaa___',//13排
            'aaaaaaaaaaaaaa___',//14排
            'aaaaaaaaaaaaaa___',//15排
            'aaaaaaaaaa_______',//16排
            'aaaaaaaaaa_______',//17排
            'aaaaaaaaaa_______',//18排
            'aaaaaaaaaaaa_____',//19排
            'aaaaaaaaaaaa_____',//20排
            'aaaaaaaaaaaaaa___',//21排
            'aaaaaaaaaaaaaa___',//22排
            'aaaaaaaaaaaaaaaaa',//23排
        ],
        legend: { //定义图例
            node: $('#legend'),
            items: [
                ['a', 'available', '可选座'],
                ['a', 'unavailable', '已售出'],
            ]
        },
        click: function () { //点击事件
            var size = $('.selected').size();
            if (size >= num && this.status() == 'available') {
                alert("一次最多选" + num + "个座位!");
                return 'available';
            } else {
                if (this.status() == 'available') { //可选座
                    $('#' + (this.settings.row + 1) + '_' + this.settings.label).html("<img src=" + img + ">");
                    $('.tips .txt').css('display', 'none')
                    $('.tips .p, #selected-seats').css('display', 'block')
                    $('#selected-seats').css('display', 'block')
                    $('<li>' + (this.settings.row + 1) + '排' + this.settings.label + '座</li>')
                        .attr('id', 'cart-item-' + this.settings.id)
                        .data('seatId', this.settings.id)
                        .appendTo($cart);
                    $counter.text(sc.find('selected').length + 1);
                    $total.text(amountFormat(amountTotal(sc) + price));
                    return 'selected';
                } else if (this.status() == 'selected') { //已选中
                    $('#' + (this.settings.row + 1) + '_' + this.settings.label).html(null);
                    if (size == 1) {
                        $('.tips .txt').css('display', 'block')
                        $('.tips .p, #selected-seats').css('display', 'none')
                    }
                    //更新数量
                    $counter.text(sc.find('selected').length - 1);
                    //更新总计
                    $total.text(amountFormat(amountTotal(sc) - price));
                    //删除已预订座位
                    $('#cart-item-' + this.settings.id).remove();
                    //可选座
                    return 'available';
                } else if (this.status() == 'unavailable') { //已售出
                    return 'unavailable';
                } else {
                    return this.style();
                }
            }
        }
    });

    //处理已售出的座位
    seatArr = seatArr.split(',');
    sc.get(seatArr).status('unavailable');

    //计算座位位置
    (function seatPosition() {
        $(document).ready(function () {
            var w = $('.seatCharts-row').width() * 0.4; //座位左侧、右侧区域宽度
            var wd = $('.seatCharts-seat').width();
            $('.seatCharts-seat').height(wd);
            $('.seatCharts-row').height(wd);
            $('.seatCharts-header, .seatCharts-space').remove();
            $('#seat-map .seatCharts-row').each(function () {
                var _this = $(this);
                var x = $(_this).index();//排数
                var size = $(_this).find('.seatCharts-seat').size();//座位总数
                $(_this).find('.seatCharts-seat').each(function () {
                    var y = $(this).index() + 1;//座位号
                    var z = 0;
                    if (size == 17 || size == 7 || x <= 5 || x == 11) {
                        z = 7;
                    } else if (size == 11) {
                        z = 6;
                    } else {
                        z = size / 2;
                    }
                    //座位间距
                    spa = (w - (z * (wd + 2))) / (z - 1);
                    if (x > 5) {//第5排以下
                        if (y <= z) {
                            $(this).css("left", (y - 1) * (spa + wd + 2));
                            $(this).attr("seat-align", "left");
                        } else {
                            if (x == 8 || x == 11) { //第8排
                                z = 5;
                                spa = (w - (5 * (wd + 2))) / 4;
                            }
                            $(this).css("right", (size - y) * (spa + wd + 2));
                            if (x == 23) {
                                $(this).attr("seat-align", "left");
                            } else {
                                $(this).attr("seat-align", "right");
                            }
                        }
                    } else {
                        if (y > size - 7) {//前5排 座位后7个
                            $(this).css("right", (size - y) * (spa + wd + 2));
                            $(this).attr("seat-align", "right");
                        } else if (y != 1) {
                            $(this).css("left", (y - 1) * (spa + wd + 2) + (6 - x) * wd * 0.75);
                            $(this).attr("seat-align", "left");
                        } else {
                            $(this).css("left", (6 - x) * wd * 0.75);
                            $(this).attr("seat-align", "left");
                        }
                    }
                });
            });
            //左侧排数条
            var row = $('#seat-map .seatCharts-row').size();
            var html = '';
            for (var i = 1; i <= row; i++) {
                html += "<em>" + i + "</em>";
            }
            $(".rowBar").append(html);
            $(".rowBar em").height(wd);
            $(".rowBar em").css("line-height", wd + "px");
            $(window.document).scroll(function () {
                var left = $(document).scrollLeft();
                $(".rowBar").animate({left: left}, 100);
            });
        });
    })();

    //计算总金额
    function amountTotal(sc) {
        var total = 0;
        sc.find('selected').each(function () {
            total += price;
        });
        return total;
    }

    //金额格式化
    function amountFormat(x) {
        var f_x = parseFloat(x);
        if (isNaN(f_x)) {
            alert('function:changeTwoDecimal->parameter error');
            return false;
        }
        f_x = Math.round(x * 100) / 100;
        var s_x = f_x.toString();
        var pos_decimal = s_x.indexOf('.');
        if (pos_decimal < 0) {
            pos_decimal = s_x.length;
            s_x += '.';
        }
        while (s_x.length <= pos_decimal + 2) {
            s_x += '0';
        }
        return s_x;
    }
}

//提交验证
function check(form) {
    var sArr = [];//所有选中座位
    var cArr = [];//同一区域 同一排座位
    var newsArr = [];////座位分组
    var tempArr = [];
    var row = 0;//排数
    var row1 = 0;
    var align = '';//座位区域
    var align1 = '';

	var phone = $('input[name="phone"]').val();
	var guestname = $('input[name="guestname"]').val();

    $('.seatCharts-row').each(function () {
        var _this = $(this);
        $(_this).find('.selected').each(function () {
            var r = $(this).attr('id'); //获取id值
            sArr.push(r);
        })
    });

    var exits = true;

	if (guestname == '') {
		alert('学员姓名不能为空！');
		return false;
	}

	if (phone == '') {
		alert('联系电话不能为空！');
		return false;
	}

	if(!(/^1[34578]\d{9}$/.test(phone))){
        alert("请填写有效的联系电话，我们将在选座结束后，将座位信息发送至您手机。");
        return false;
    }

    if (sArr.length < 1) {
        alert("请选择座位！");
        return false;
    } else if (sArr.length > 1) {
        for (var i = 0; i < sArr.length; i++) {//将座位分组
            row = $('.seatCharts-row').find(("#" + sArr[i])).parent().index();
            row1 = $('.seatCharts-row').find("#" + sArr[i + 1]).parent().index();
            align = $("#" + sArr[i]).attr('seat-align');
            align1 = $("#" + sArr[i + 1]).attr('seat-align');
            if (row == row1 && align == align1) {//是否同一排 同一区域
                tempArr.push(sArr[i]);
            } else {
                tempArr.push(sArr[i]);
                newsArr.push(tempArr.slice(0));
                tempArr.length = 0;
            }
        }

        cArr = $.grep(newsArr, function (arr) {//获取同一排同一区域座位
            return arr.length >= 2;
        });

        //判断是否连坐
        if (cArr.length >= 1) {
            $.each(cArr, function (n, arr) {
                var size = arr.length;//同一排 同一区域座位数
                var ft = $("#" + arr[0]).prevAll('.available').size();//第一个座位前空位
                var lt = $("#" + arr[size - 1]).prevAll('.available').size();//最后一个座位前空位

                if (ft - lt != 0) {
                    alert("请选择连续的座位！");
                    exits = false;
                }
            });
        }
    }

    form.seats.value = sArr;
    //setAjax(userClass, sArr);

    return exits;
}

function setAjax(userClass, setArr) {
    window.location = 'pay/index.php?seat=' + setArr + '&title=' + userClass.title + '&price=' + userClass.price + '&openid=' + userClass.openid + '&info_id=' + userClass.id;

    /*$.ajax({
     type: "POST",
     url: "seatAjax.php",
     data: "seat="+setArr.join(','),
     success: function(data){
     alert(data);return;
     if ( data == 'OK' ) {
     alert('提交成功');
     window.location = 'index.php';
     } else {
     alert('提交失败,请重新尝试');
     location.reload();
     }
     }
     });*/
}
