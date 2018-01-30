window.onload=function(){
    var aInput=document.getElementsByTagName('input');
    var oUser=aInput[0];
    var oTel=aInput[1];
    var oWork=aInput[2];
    var aI=document.getElementsByTagName('i')[0];
    
    
    
    //用户名检测
    
    oUser.onfocus=function(){
        aI.innerHTML='';
        oUser.removeAttribute("placeholder");

    }
    oUser.onkeyup=function(){
    }
    
    oUser.onblur=function(){
        if(this.value==""){
            aI.innerHTML='姓名不可为空';
        }
    }
    //手机号码
    oTel.onfocus=function(){
        // if(oUser.value==""){
        //     aI.innerHTML='姓名不可为空';
        // }
        oTel.removeAttribute("placeholder");
    }
    oTel.onblur=function(){
       var tel = /1[3|4|5|7|8][0-9]\d{8}$/;
       if(this.value==""){
            aI.innerHTML='手机号不可为空';
        }
        if(!tel.test(this.value)){
            aI.innerHTML='手机号不正确';
        }else if(tel.test(this.value)){
           aI.innerHTML='';
       }
    }
    //招聘岗位
    oWork.onfocus=function(){
        // if(oUser.value==""){
        //     aI.innerHTML='姓名不可为空';
        // }
        oWork.removeAttribute("placeholder");
    }
    oWork.onblur=function(){
        // var tel = /1[3|4|5|7|8][0-9]\d{8}$/;
        if(this.value==""){
            aI.innerHTML='招聘岗位不可为空';
        }
        // if(!tel.test(this.value)){
        //     aI.innerHTML='手机号不正确';
        // }else if(tel.test(this.value)){
        //     aI.innerHTML='';
        // }
    }
    
}