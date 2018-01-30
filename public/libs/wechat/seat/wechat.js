//提交验证
function check(){
    var sArr 	= [];//所有选中座位
    var cArr 	= [];//同一区域 同一排座位
    var newsArr = [];////座位分组
    var tempArr = [];
    var row 	= 0;//排数
    var row1    = 0;
    var align 	='';//座位区域
    var align1 	='';
    $('.seatCharts-row').each(function(){
        var _this=$(this);
        $(_this).find('.selected').each(function(){
            var r = $(this).attr('id'); //获取id值
            sArr.push(r);
        })
    });

    if ( sArr.length < 1 ){
        alert("请选择座位！");
        return false;
    }

    if ( sArr.length == 1 ) {
        setAjax(userClass, sArr);
    } else {
        for(var i=0;i<sArr.length;i++){//将座位分组
            row   = $('.seatCharts-row').find(("#"+sArr[i])).parent().index();
            row1  = $('.seatCharts-row').find("#"+sArr[i+1]).parent().index();
            align =$("#"+sArr[i]).attr('seat-align');
            align1=$("#"+sArr[i+1]).attr('seat-align');
            if(row == row1 && align == align1){//是否同一排 同一区域
                tempArr.push(sArr[i]);
            } else{
                tempArr.push(sArr[i]);
                newsArr.push(tempArr.slice(0));
                tempArr.length = 0;
            }
        }

        //console.log(newsArr);
        cArr = $.grep(newsArr,function(arr){//获取同一排同一区域座位
            return arr.length >= 2;
        });

        //alert(cArr.length);return;

        //判断是否连坐
        if ( cArr.length >= 1 ){
            $.each(cArr, function (n,arr) {
                var size = arr.length;//同一排 同一区域座位数
                var ft  = $("#"+arr[0]).prevAll('.available').size();//第一个座位前空位
                var lt  = $("#"+arr[size-1]).prevAll('.available').size();//最后一个座位前空位

                if(ft-lt!=0){
                    alert("请选择连续的座位！");
                    return false;
                } else {
                    setAjax(userClass, sArr);
                }
            });
        } else {
            setAjax(userClass, sArr);
        }
    }
}

function setAjax (userClass, setArr) {
    window.location = 'pay/index.php?seat='+ setArr +'&title='+ userClass.title +'&price='+ userClass.price +'&openid='+ userClass.openid +'&info_id='+ userClass.id;

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