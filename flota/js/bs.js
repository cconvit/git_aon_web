var UTILS = {}
UTILS.checkAndroid = function()
{
	var ua = navigator.userAgent.toLowerCase();
	var isAndroid = ua.indexOf("android") > -1;
	return isAndroid;
}
UTILS.checkiPhone = function()
{
	return
	((navigator.platform.indexOf("iPhone") != -1) || (navigator.platform.indexOf("iPod") != -1));
}
var PRELOAD = {}
PRELOAD.init = function()
{
	$(window).load(PRELOAD.remove);
}
PRELOAD.remove = function()
{
	console.log("LOADED");
	var w = $(window).width();
	$("#page").show();
	$("#cl").fadeOut(400);
	HOME.init();
	APP.goTop();
	$("#preload-right").delay(400).animate({"left": -w}, 700, "easeInOutExpo", function()
	{
		$(this).remove();
	});
	$("#preload").animate({"left": w}, 700, "easeInOutExpo", function()
	{
		$(this).remove();
	});
}
var LOADER = {white: {lines: 16, length: 3, width: 2, radius: 6, rotate: 0, color: '#fff', speed: 2, trail: 40, shadow: false, hwaccel: false, className: 'spinner', zIndex: 2e9, top: '0', left: '0'}, black: {lines: 16, length: 3, width: 2, radius: 6, rotate: 0, color: '#000000', speed: 2, trail: 40, shadow: false, hwaccel: false, className: 'spinner', zIndex: 2e9, top: '0', left: '0'}}
LOADER.buildOLD = function($ref, $clr)
{
	if ($clr)
	{
		var spinner = new Spinner(LOADER.black).spin()
	}
	else
	{
		var spinner = new Spinner(LOADER.white).spin()
	}
	$($ref).append(spinner.el).css("overflow-x", "visible");
}
LOADER.build = function($clr)
{
	var cl = new CanvasLoader("cl");
	cl.setShape('square');
	cl.setColor($clr);
	cl.setDiameter(32);
	cl.setDensity(94);
	cl.setRange(0.9);
	cl.setSpeed(3);
	cl.setFPS(60);
	cl.show();
}
var APP = {location: '', }
APP.init = function()
{
	APP.initNavi();
	PRELOAD.init();
	APP.naviMobi();
}
APP.checkBar = function()
{
	if (navigator.userAgent.indexOf('iPhone') != -1 || navigator.userAgent.indexOf('Android') != -1)
	{
		addEventListener("load", function() {
			setTimeout(hideURLbar, 0);
		}, false);
	}
}
APP.hideURLbar = function()
{
	window.scrollTo(0, 1);
}
APP.goTop = function()
{
	$("html,body").animate({scrollTop: 0}, 800, "easeInOutExpo");
}
APP.hideAll = function(vl)
{
	$("body").animate({opacity: 0}, 600, "easeInOutExpo", function()
	{
		window.location = vl;
	});
}
APP.initNavi = function()
{
	$("#navi a").click(function(e)
	{
		e.preventDefault();
		var ref = $(this).attr("href");
		var id = $(this).parent().attr("id");
		if (id == "navi-contatti")
		{
			APP.showContatti();
		}
		else
		{
			APP.hideAll(ref);
		}
	});
}
APP.initLogo = function()
{
	$("#logo").click(function(e)
	{
		e.preventDefault();
		APP.hideAll("http://www.bluestepstudio.it/");
	});
}
APP.hideLoader = function()
{
	$("#cl").fadeOut(400);
}
APP.naviMobi = function()
{
	$("#btn-mobi").click(function(e)
	{
		e.preventDefault();
		$("#navi-mobi").toggle();
		$("#testimonial").hide();
	});
}
APP.showContatti = function()
{
	$("#contact-pannel").stop(true, true).animate({"top": 0}, 600, "easeOutExpo");
	$("#page, #slider").stop(true, true).animate({"margin-top": "300px"}, 800, "easeOutExpo");
	$("#close-contact-pannel").click(function()
	{
		$("#contact-pannel").animate({"top": "-300px"}, 800, "easeOutExpo");
		$("#page").animate({"margin-top": "90px"}, 800, "easeOutExpo");
		$("#slider").animate({"margin-top": "0px"}, 800, "easeOutExpo");
	});
}
APP.hideAll = function(vl, hidewall)
{
	if (hidewall)
	{
		APP.fadeoutWall(vl);
	}
	else
	{
		$("body").animate({opacity: 0}, 600, "easeInOutExpo", function()
		{
			window.location = vl;
		});
	}
}
APP.fadeoutWall = function(vl)
{
	APP.location = vl;
	$("#work a").unbind();
	var $item = $("#work .item-work");
	$item.find(".over").animate({"opacity": "0"}, 400, "easeOutExpo");
	$item.prepend("<div class='mask'/>")
	$item.find(".mask").each(function(i)
	{
		var t = $(this);
		var r = Math.random() * 300 + 300;
		t.delay(r).animate({"width": "100%"}, 400, "easeInOutExpo");
	});
	$("body").delay(600).animate({opacity: 0}, 600, "easeInOutExpo", function()
	{
		window.location = vl;
	});
}
var HOME = {ref: '', testArr: ["It is an absolute pleasure to work with Bluestepstudio. They are friendly, accommodating, and patient and their attention to detail and design initiatives are excellent. <span>Fadil Berisha, NYC</span>", "La Bluestepstudio e' riuscita a creare un sito di altissimo livello che rispecchia efficacemente la nostra qualita' e filosofia aziendale.<span>Paolo Contini, Contini s.p.a</span>", "BluestepStudio is pretty awesome to work with. They are incredibly organized, easy to communicate with, responsive with next iterations,and beautiful and cutting edge work.<span>Antonello Scano, AD Teleco s.p.a</span>"], }
HOME.getText = function(arr)
{
	var l = arr.length;
	return arr[Math.floor(Math.random() * l)];
}
HOME.init = function()
{
	console.log("INIT HOME");
	HOME.initWall();
	setTimeout(HOME.initWall, 400);
	var t = HOME.getText(HOME.testArr);
	$(".testimonial-descpn p").html(t);
	APP.initLogo();
	if (window.innerWidth < 370 && window.devicePixelRatio >= 2)
	{
		$("#testimonial").hide();
	}
	else if (window.innerWidth < 370 && window.devicePixelRatio >= 1.5)
	{
		$("#testimonial").hide();
	}
	else if (window.innerWidth < 650 && window.devicePixelRatio >= 2)
	{
		$("#testimonial").hide();
	}
	else
	{
		setTimeout(HOME.initTestimonails, 1600);
	}
}
HOME.isIDevice = function() {
	return((navigator.platform.indexOf("iPhone") != -1) || (navigator.platform.indexOf("iPad") != -1) || (navigator.platform.indexOf("iPod") != -1));
}
HOME.isIPhone = function() {
	return(navigator.platform.indexOf("iPhone") != -1);
}
HOME.hideTestimonials = function()
{
	$("#testimonial").animate({"top": "-320px"}, 600, "easeOutExpo", function()
	{
		$(this).remove();
	})
}
HOME.initTestimonails = function()
{
	setTimeout(HOME.hideTestimonials, 6000);
	$("#testimonial").css("display", "table").css("top", "-280px").css("cursor", "pointer").animate({"top": "340px"}, 600, "easeOutExpo").click(function()
	{
		$(this).fadeOut(300);
	});
}
HOME.initWall = function()
{
	var itm = $("#work a");
	itm.each(function(i)
	{
		var t = $(this);
		var r = Math.random() * 300 + 300;
		if (!HOME.isIDevice())
		{
			t.find(".over").css("opacity", 1).delay(r).animate({"opacity": 0.45}, 800, "easeOutExpo");
		}
		else
		{
			t.find(".over").css("opacity", 0.5);
		}
	});
	if (!HOME.isIDevice())
	{
		HOME.initActions();
	}
	else
	{
		HOME.initTouch();
	}
}
HOME.initActions = function()
{
	var itm = $("#work a");
	itm.click(function(e)
	{
		e.preventDefault();
		var ref = $(this).attr("href");
		APP.hideAll(ref, true);
	});
	itm.hover(function()
	{
		var t = $(this);
		t.find(".over").animate({"opacity": 1}, 200, "easeOutExpo");
		t.find(".table-cell").animate({"opacity": 1}, 200, "easeOutExpo");
	}, function()
	{
		var t = $(this);
		t.find(".over").stop().animate({"opacity": 0.5}, 200, "easeOutExpo");
		t.find(".table-cell").stop().animate({"opacity": 0}, 200, "easeOutExpo");
	});
}
HOME.isTouched = function()
{
	APP.hideAll(HOME.ref);
}
HOME.initTouch = function()
{
	var itm = $("#work a");
	itm.on({'doubletap': function(e)
		{
			e.preventDefault();
			var t = $(this);
			t.find(".over").stop().animate({"opacity": 0.5}, 300, "easeOutExpo");
			t.find(".table-cell").stop().animate({"opacity": 0}, 200, "easeOutExpo");
			var ref = $(this).attr("href");
			HOME.ref = ref;
			setTimeout(HOME.isTouched, 350);
		}});
	itm.hover(function()
	{
		var t = $(this);
		t.find(".over").animate({"opacity": 1}, 200, "easeOutExpo");
		t.find(".table-cell").animate({"opacity": 1}, 300, "easeOutExpo");
	}, function()
	{
		var t = $(this);
		t.find(".over").animate({"opacity": 0.5}, 300, "easeOutExpo");
		t.find(".table-cell").animate({"opacity": 0}, 200, "easeOutExpo");
	});
}
var WORK = {}
WORK.initSlider = function()
{
	$('#slider').royalSlider({imageAlignCenter: false, imageScaleMode: 'fill', numImagesToPreload: 4, slidesSpacing: 0, sliderDrag: true, transitionSpeed: 600, controlNavigation: "none", easeInOut: "easeInOutExpo"});
}
WORK.doRsz = function()
{
	if (window.innerWidth < 650 && window.devicePixelRatio >= 2)
	{
		$("#slider").css("width", "100%");
		$(".slide-item").css("width", "100%");
		$(".slide-item").find('img').css("width", "100%");
	}
}
WORK.init = function()
{
	$(window).resize(function(e) {
		WORK.doRsz();
	});
	if (window.innerWidth < 370 && window.devicePixelRatio >= 2)
	{
		$("#btn-more").hide();
	}
	else if (window.innerWidth < 370 && window.devicePixelRatio >= 1.5)
	{
		$("#btn-more").hide();
	}
	else if (window.innerWidth < 650 && window.devicePixelRatio >= 2)
	{
		$("#btn-more").hide();
	}
	else
	{
		WORK.initSlider();
	}
	setTimeout(WORK.hideNavi, 1500);
	WORK.initMouse();
	$("#show-more").click(function(e)
	{
		e.preventDefault();
		$(".btn-more").toggleClass("minus");
		WORK.showInfo();
	});
}
WORK.showInfo = function(vl)
{
	var w = $(window).width();
	$("#work-infos").css("display", "table");
	if ($("#work-infos").hasClass("infoIN"))
	{
		$("#work-infos").stop(true).animate({"left": "-300px"}, 600, "easeInOutExpo");
		$("#work-infos").removeClass("infoIN");
	}
	else
	{
		$("#work-infos").addClass("infoIN");
		$("#work-infos").css("left", w).animate({"left": "30%"}, 600, "easeOutExpo");
	}
}
WORK.hideNavi = function()
{
	$("#header").animate({"top": "-100px"}, 800, "easeInOutExpo");
	$(".btn-more").animate({"left": "60px"}, 800, "easeInOutExpo");
}
WORK.showNavi = function()
{
	$("#header").stop(true).animate({"top": "0px"}, 600, "easeOutExpo");
}
WORK.initMouse = function()
{
	$("#header-hold").hover(WORK.showNavi, WORK.hideNavi);
}
var SERVIZI = {}
SERVIZI.init = function()
{
	$(".content").fadeIn(600);
	if (window.innerWidth < 370 && window.devicePixelRatio >= 2)
	{
		$("#canvas").remove();
	}
	else if (window.innerWidth < 370 && window.devicePixelRatio >= 1.5)
	{
		$("#canvas").remove();
	}
	else
	{
		SERVIZI.show();
	}
}
SERVIZI.show = function()
{
	if (navigator.userAgent.match(/iPad/i) != null)
	{
		SERVIZI.showMobile();
	}
	else
	{
		SERVIZI.showDesktop();
	}
}
SERVIZI.showMobile = function()
{
	$("#canvas").fallingmedia({dropOnClick: false, source_type: 'json', source: 'http://www.bluestepstudio.it/php/source.json'});
	$("#canvas").fallingmedia('drop', 8);
}
SERVIZI.showDesktop = function()
{
	$("#canvas").fallingmedia({dropOnClick: true, source_type: 'json', source: 'http://www.bluestepstudio.it/php/source.json'});
	$("#canvas").fallingmedia('drop', 8);
}
SERVIZI.initCats = function()
{
	var posx = [50, 0, 200, 60];
	var posy = [300, 100, 200, 900];
	$(".item-servizio").each(function(i)
	{
		var t = $(this);
		t.css("position", "absolute");
		var px = posx[i];
		var py = posy[i];
		var r = Math.random() * 200 + 200;
		t.delay(300).animate({"opacity": 1, "top": px + "px", "left": py + "px"}, 300, "easeOutExpo");
	});
}
var WORKLIST = {}
WORKLIST.init = function()
{
	$(window).resize(WORKLIST.rsz);
	WORKLIST.rsz();
	var itm = $("#work-list a");
	itm.click(function(e)
	{
		e.preventDefault();
		var ref = $(this).attr("href");
		APP.hideAll(ref);
	});
}
WORKLIST.rsz = function()
{
	if ($(window).width() > 800)
	{
		WORKLIST.setActions();
	}
	else
	{
		WORKLIST.removeActions();
	}
}
WORKLIST.setActions = function()
{
	if ($(window).width() > 1024)
	{
		$(".image-list").hover(function()
		{
			$(this).stop(true, true).animate({"height": "158px", "opacity": 1}, 600, "easeOutExpo");
			$(this).find(".list-title").stop(true, true).animate({"margin-top": "80px"}, 600, "easeOutExpo");
			$(this).find("img").stop(true, true).animate({"opacity": "0.9"}, 600, "easeOutExpo");
		}, function()
		{
			$(this).animate({"height": "100px"}, 400, "easeOutExpo");
			$(this).find(".list-title").animate({"margin-top": "46px"}, 400, "easeOutExpo");
			$(this).find("img").animate({"opacity": "0.5"}, 600, "easeOutExpo");
		});
	}
}
WORKLIST.removeActions = function()
{
	$(".image-list").unbind();
}

