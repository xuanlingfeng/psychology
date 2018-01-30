$(function(){
	var banner = $("#myBanner"),
		num = banner.children("li").length,  // 轮播个数
		cur = $(".cur"),
		clickBanner = $(".click-banner"),
		prev = $(".prev",clickBanner),
		next = $(".next",clickBanner),
		n = 0,
		s = 5000,
		htmlI = "",
		timer, // 定时器
		targ = true;  // 定义一秒执行一次

	for(var i = 0; i<num; i++){	 // 定义小圆点
		htmlI += "<i></i>";
	}
	cur.append(htmlI);

	//  左右点击显示隐藏
	$(".banner").hover(
		function(){
			clickBanner.show();
			clearTimeout(timer); // 悬浮鼠标，禁止轮播
		},
		function(){
			clickBanner.hide();
			timer = setTimeout( bannerShow, s );  // 移除鼠标启动轮播
		}
	);
	

	// 初始化显示第一个
	banner.children().eq(0).addClass('active');
	cur.children().eq(0).addClass("active");

	// 执行轮播



	function bannerShow (pn) {
		pn == true ? n-- : n++;  // 判断方向
		
		if (n>num-1) { n = 0;}	// 如果到达最后一个
		
		if (n<0) {n = num-1;}	// 如果小于第一个直接过度到最后一个

		banner.children().eq(n).addClass("active").siblings().removeClass('active');

		cur.children().eq(n).addClass("active").siblings().removeClass("active");

		clearTimeout(timer);
		
		timer = setTimeout( bannerShow, s );
	}

	setTimeout( bannerShow, s );  // 先执行一次

	prev.click(function(){	// 点击
		if (targ) {
			targ = false;
			clearTimeout(timer);
			bannerShow(true);
			setTimeout(function(){ targ = true; }, 1000);
		}
	});

	next.click(function(){	// 点击
		if (targ) {
			targ = false;
			clearTimeout(timer);
			bannerShow(false);
			setTimeout(function(){ targ = true; }, 1000);
		}	
	});
})
