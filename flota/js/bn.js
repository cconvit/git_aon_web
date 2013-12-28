function Loader() {
	this.tutorial = null;
}
Loader.prototype = {init: function() {
		$w = $(window);
		var height = $w.height();
		var width = $w.width();
		$("#main-loader").show();
		if (loader.tutorial)
			loader.tutorial.stop();
		$("#tutorial").hide();
		loader.tutorial = new Blitter({width: 226, height: 68, resource: "skins/blacknegative/images/tutorial.gif", frameRate: 20, frameNumber: 40, delay: 0, loop: true, autoplay: true, target: document.getElementById("tutorial")});
		$("#main-loader").removeClass("loading");
		dispatch.initStuff(function() {
			$.preload(retrieveImages($(document)), {onComplete: function(callback) {
					var perc = (100 / callback.total) * callback.done;
					EKTweener.to($("#main-loader-background")[0], .4, {width: 260 * (perc / 100)});
				}, onFinish: function() {
					$("#tutorial").fadeIn("slow");
					$(document).oneTime(10000, "freeze", function() {
						window.location = '#!/whoweare/';
					});
					$("#txt-drag").show();
					EKTweener.fromTo($("#txt-drag")[0], .4, {opacity: 0}, {opacity: 1});
				}});
		});
	}, stop: function() {
		if (loader.tutorial)
			loader.tutorial.stop();
		delete loader.tutorial;
		$("#main-loader").hide();
		$("#main-loader-background").css({width: 0});
	}};
var loader = new Loader();
;
function Ralphlauren() {}
Ralphlauren.prototype = {preview: function() {
		$("#ralph-launch").mouseenter(function() {
			$("#ralph-launch").addClass("over");
			$("#ralph-launch").stop().animate({backgroundColor: "#000", backgroundPositionX: 0}, 600, "easeOutExpo");
		});
		$("#ralph-launch").mouseleave(function() {
			$("#ralph-launch").removeClass("over");
			$("#ralph-launch").stop().animate({backgroundColor: "#FFF", backgroundPositionX: -1060}, 600, "easeOutExpo");
		});
	}, init: function() {
		var currentElement;
		$("#ralph-launch").unbind().bind("touchstart click", function(event) {
			event.stopPropagation();
			event.preventDefault();
			var isiPad = navigator.userAgent.match(/iPad/i) != null;
			var isiPhone = navigator.userAgent.match(/iPhone/i) != null;
			if (isiPad == true || isiPhone == true) {
				window.open("http://www.blacknegative.com/uploads/section/ralph/video.mp4");
			}
			else {
				initVideo();
				playVideo();
				slideTo("#ralph-container", "#ralph-placeholder", false);
			}
		});
		$("#ralph-back").unbind().click(function() {
			slideTo("#ralph-container", "#ralph-intro", false);
		});
		$("#ralph-launch").unbind("mouseenter").mouseenter(function() {
			$("#ralph-launch").addClass("over");
			$("#ralph-launch").stop().animate({backgroundColor: "#000", backgroundPositionX: 0}, 400, "easeOutExpo");
		});
		$("#ralph-launch").unbind("mouseleave").mouseleave(function() {
			$("#ralph-launch").removeClass("over");
			$("#ralph-launch").stop().animate({backgroundColor: "#FFF", backgroundPositionX: -1060}, 100, "easeOutExpo");
		});
		function initLoop() {
			dispatch.app.video.init("video-one-placeholder", "uploads/section/ralph/loop", 6.6, 272, 480);
		}
		function initVideo() {
			jwplayer("ralph-video").setup({autostart: false, controlbar: "none", stretching: "uniform", width: "100%", height: '100%', wmode: "opaque", flashplayer: "swf/player.swf", icons: false, levels: [{file: "uploads/section/ralph/video.mp4"}, {file: "uploads/section/ralph/video.webm"}, {file: "uploads/section/ralph/video.ogv"}], modes: [{type: "html5"}, {type: "flash", src: "swf/player.swf"}], events: {onComplete: function() {
						stopVideo();
						slideTo("#ralph-container", "#ralph-intro", false);
					}}});
		}
		function stopVideo() {
			dispatch.playSoundSlide();
			jwplayer("ralph-video").stop(true);
		}
		function playVideo() {
			dispatch.stopSound();
			jwplayer("ralph-video").play(true);
		}
		function disposeVideo() {
			dispatch.stopSoundNav();
			jwplayer("ralph-video").stop();
			jwplayer("ralph-video").remove();
		}
		function slideTo(container, element, resize) {
			currentElement = element;
			$w = $(window);
			var height = $w.height();
			var width = $w.width();
			var containerPosition = $(container).position();
			var elementPosition = $(element).position();
			if (resize == true) {
				$(container).css({top: -elementPosition.top});
			}
			else {
				if (Modernizr.csstransforms && Modernizr.csstransitions) {
					$(container).stop().transition({top: -elementPosition.top}, 800, "out", function() {
						if (element == "#ralph-placeholder") {
							playVideo();
							$("#nav").hide();
						}
						else {
							stopVideo();
							$("#nav").show();
						}
					});
				}
				else {
					$(container).tween({top: {start: containerPosition.top, stop: -elementPosition.top, time: 0, duration: 0.8, effect: 'easeOut', onStop: function() {
								if (element == "#ralph-placeholder") {
									playVideo();
									$("#nav").hide();
								}
								else {
									stopVideo();
									$("#nav").show();
								}
							}}});
					$.play();
				}
			}
		}
		$(window).bind("resize", function() {
			slideTo("#ralph-container", "#ralph-intro", true);
		});
		initLoop();
	}, stop: function() {
		dispatch.app.video.remove("video-one-placeholder");
		jwplayer("ralph-video").stop();
		jwplayer("ralph-video").remove();
		$("#ralph-back").unbind();
	}};
var ralphlauren = new Ralphlauren();
;
function Bose() {
}
Bose.prototype = {init: function() {
		var isPlayed = false;
		$("#bose-evolve, #bose-line, #bose-ready, #bose-sounddesign").css({"width": "0px"});
		EKTweener.fromTo($("#bose-evolve")[0], .4, {width: 0}, {width: 86, delay: 1.6});
		EKTweener.fromTo($("#bose-line")[0], .7, {width: 0}, {width: 278, delay: 1.9});
		EKTweener.fromTo($("#bose-ready")[0], .4, {width: 0}, {width: 285, delay: 1});
		EKTweener.fromTo($("#bose-sounddesign")[0], 1, {width: 0}, {width: 196, delay: 1.4});
		function initLoop() {
			dispatch.app.video.init("bose-loop-video", "uploads/section/bose/loop", 6.6, 1080, 1920);
		}
		$("#bose-back").click(function() {
			slideTo("#bose-container", "#bose-intro", false);
		});
		function stopLoop() {
			jwplayer("bose-loop-video").stop(true);
		}
		function playLoop() {
			jwplayer("bose-loop-video").play(true);
		}
		var currentElement;
		$("#bose-ready").unbind().bind("click", function() {
			var isiPad = navigator.userAgent.match(/iPad/i) != null;
			var isiPhone = navigator.userAgent.match(/iPhone/i) != null;
			if (isiPad == true || isiPhone == true) {
				window.open("http://www.blacknegative.com/uploads/section/bose/video.mp4");
			}
			else {
				slideTo("#bose-container", "#bose-placeholder", false);
				initVideo();
				playVideo();
			}
		});
		$("#bose-placeholder").bind("touchstart click", function(event) {
			event.stopPropagation();
			event.preventDefault();
			slideTo("#bose-container", "#bose-intro", false);
		});
		$("#bose-ready").mouseenter(function() {
			$("#bose-over").show();
		});
		$("#bose-ready").mouseleave(function() {
			$("#bose-over").hide();
		});
		function initVideo() {
			jwplayer("bose-video").setup({autostart: false, controlbar: "none", stretching: "uniform", width: "100%", height: '100%', flashplayer: "swf/player.swf", icons: false, wmode: "opaque", levels: [{file: "uploads/section/bose/video.mp4"}, {file: "uploads/section/bose/video.webm"}, {file: "uploads/section/bose/video.ogv"}], modes: [{type: "html5"}, {type: "flash", src: "swf/player.swf"}], events: {onComplete: function() {
						stopVideo();
						slideTo("#bose-container", "#bose-intro", false);
					}}});
		}
		function stopVideo() {
			dispatch.playSoundSlide();
			jwplayer("bose-video").stop(true);
		}
		function playVideo() {
			dispatch.stopSound();
			jwplayer("bose-video").play(true);
		}
		function slideTo(container, element, resize) {
			currentElement = element;
			$w = $(window);
			var height = $w.height();
			var width = $w.width();
			var containerPosition = $(container).position();
			var elementPosition = $(element).position();
			if (resize == true) {
				if (elementPosition) {
					$(container).css({top: -elementPosition.top});
				}
			}
			else {
				if (Modernizr.csstransforms && Modernizr.csstransitions) {
					$(container).stop().transition({top: -elementPosition.top}, 1200, "out", function() {
						handleVideo(element);
					});
				}
				else {
					$(container).tween({top: {start: containerPosition.top, stop: -elementPosition.top, time: 0, duration: 1.2, effect: 'easeOut', onStop: function() {
								handleVideo(element);
							}}});
					$.play();
				}
			}
		}
		function handleVideo(element) {
			if (element == "#bose-placeholder") {
				playVideo();
				$("#nav").hide();
			}
			else {
				stopVideo();
				$("#nav").show();
			}
		}
		$(window).bind("resize", function() {
			slideTo("#bose-container", currentElement, true);
		});
		initLoop();
	}, stop: function() {
		jwplayer("bose-video").stop();
		jwplayer("bose-video").remove();
		dispatch.app.video.remove("bose-loop-video");
		$("#bose-placeholder, #bose-back, #bose-ready").unbind();
		$("#bose-evolve, #bose-line, #bose-ready, #bose-sounddesign").css({"width": "0px"});
	}};
var bose = new Bose();
;
function Bullittagency() {
	var arr = null;
}
Bullittagency.prototype = {resize: function() {
		$w = $(window);
		var height = $w.height();
		var width = $w.width();
		var nbrHeight = Math.ceil(height / 93);
		var nbrWidth = Math.ceil(width / 92);
		var marginTop = parseInt((height - (nbrHeight * 93)));
		var marginLeft = parseInt((width - (nbrWidth * 92)));
		$("#bullitt-intro").css({width: (nbrWidth * 92), height: (nbrHeight * 93), "top": marginTop, "left": marginLeft});
	}, preview: function() {
		bullittagency.arr = [];
		var pieces = [{x: -4, y: -3, img: "wetry.jpg"}, {x: -3, y: -2, img: "m.jpg"}, {x: -2, y: -2, img: "a.jpg"}, {x: -1, y: -2, img: "k.jpg"}, {x: 0, y: -2, img: "e.jpg"}, {x: -3, y: -1, img: "t.jpg"}, {x: -2, y: -1, img: "h.jpg"}, {x: -1, y: -1, img: "ee.jpg"}, {x: 0, y: -1, img: "line.jpg"}, {x: 1, y: -1, img: "w.jpg"}, {x: 2, y: -1, img: "eee.jpg"}, {x: 3, y: -1, img: "b.jpg"}, {x: -3, y: 0, img: "aa.jpg"}, {x: -2, y: 0, img: "lineline.jpg"}, {x: -1, y: 0, img: "bb.jpg"}, {x: 0, y: 0, img: "eeee.jpg"}, {x: 1, y: 0, img: "tt.jpg"}, {x: 2, y: 0, img: "ttt.jpg"}, {x: 3, y: 0, img: "eeeee.jpg"}, {x: 4, y: 0, img: "r.jpg"}, {x: -3, y: 1, img: "p.jpg"}, {x: -2, y: 1, img: "l.jpg"}, {x: -1, y: 1, img: "a.jpg"}, {x: 0, y: 1, img: "c.jpg"}, {x: 1, y: 1, img: "e.jpg"}];
		generateMosaic();
		function generateMosaic() {
			$w = $(window);
			var height = $w.height();
			var width = $w.width();
			var nbrHeight = Math.ceil(height / 93);
			var nbrWidth = Math.ceil(width / 92);
			var marginTop = parseInt((height - (nbrHeight * 93)));
			var marginLeft = parseInt((width - (nbrWidth * 92)));
			$("#bullitt-intro").empty().css({width: (nbrWidth * 92), height: (nbrHeight * 93), "top": marginTop, "left": marginLeft});
			for (var line = 0; line <= nbrHeight; line++) {
				for (var column = 0; column <= nbrWidth; column++) {
					$("#bullitt-intro").append("<div></div>");
				}
			}
			dispatchPieces(nbrHeight, nbrWidth);
		}
		function dispatchPieces(nbrHeight, nbrWidth) {
			$("#bullitt-intro > div").each(function() {
				$(this).bind("mouseenter", function() {
					var piece = $(this);
					EKTweener.killTweensOf(piece[0]);
					$(this).css({opacity: 0});
				});
				$(this).bind("mouseleave", function() {
					var piece = $(this);
					EKTweener.to(piece[0], .2, {opacity: 1, delay: 0.6});
				});
			});
			for (var item = 0; item < pieces.length; item++) {
				var currentIndex = ((Math.round(nbrHeight / 2) + pieces[item].y) * nbrWidth) + Math.round(nbrWidth / 2) + pieces[item].x;
				$("#bullitt-intro > div").eq(currentIndex).css({"background-image": "url('skins/blacknegative/images/bullitt/" + pieces[item].img + "')"});
			}
			var nbrItem = $("#bullitt-intro > div").size();
			while (bullittagency.arr.length < nbrItem) {
				var randomnumber = Math.ceil(Math.random() * nbrItem);
				var found = false;
				for (var i = 0; i < bullittagency.arr.length; i++) {
					if (bullittagency.arr[i] == randomnumber) {
						found = true;
						break;
					}
				}
				if (!found)
					bullittagency.arr[bullittagency.arr.length] = randomnumber;
			}
		}
	}, init: function() {
		bullittagency.preview();
		$("#bullitt-text, #bullitt-launch").hide();
		$("#bullitt-intro").unbind().bind("touchstart click", function(event) {
			event.stopPropagation();
			event.preventDefault();
			$("#bullitt-intro > div").unbind();
			var size = $("#bullitt-intro > div").size();
			var i = 0;
			var e = 0;
			for (i = 0; i < size; i++) {
				setTimeout(function() {
					e = e + 1;
					$("#bullitt-intro > div").eq(bullittagency.arr[e] - 1).css({"background-image": "none", "background-color": "transparent"});
				}, 10 * i);
			}
			setTimeout(function() {
				$("#bullitt-intro").hide();
				$("#bullitt-text, #bullitt-launch").fadeIn();
			}, 1800);
			i = 0;
		});
		function initLoop() {
			dispatch.app.video.init("bullitt-loop-video", "uploads/section/bullitt/loop", 6.6, 576, 1028);
		}
		function fadeOutMosaic() {
		}
		$(window).bind("resize", function() {
			bullittagency.preview();
		});
		initLoop();
	}, stop: function() {
		dispatch.app.video.remove("bullitt-loop-video");
		$(document).stopTime();
		$("#bullitt-intro, #bullitt-intro > div").unbind();
		$("#bullitt-intro > div").css({opacity: 1});
		$("#bullitt-intro").show();
		$("#bullitt-text, #bullitt-launch").hide();
		bullittagency.preview();
	}};
var bullittagency = new Bullittagency();
;
function Adisseo() {
	this.tutorial = null;
}
Adisseo.prototype = {init: function() {
		$w = $(window);
		var height = $w.height();
		var width = $w.width();
		slideTo("#adisseo-container", "#adisseo-intro", true);
		var currentElement;
		$("#adisseo-launch").unbind().click(function(event) {
			var isiPad = navigator.userAgent.match(/iPad/i) != null;
			var isiPhone = navigator.userAgent.match(/iPhone/i) != null;
			event.stopPropagation();
			event.preventDefault();
			if (isiPad == true || isiPhone == true) {
				window.open("http://www.blacknegative.com/uploads/section/adisseo/video.mp4");
			}
			else {
				slideTo("#adisseo-container", "#adisseo-placeholder", false);
				initVideo();
				playVideo();
			}
		});
		$("#adisseo-back").bind("click touchstart", function(event) {
			event.stopPropagation();
			event.preventDefault();
			slideTo("#adisseo-container", "#adisseo-intro", false);
		});
		$("#adisseo-hover").mouseenter(function() {
			$("#adisseo-slide").addClass("selected");
		});
		$("#adisseo-hover").mouseleave(function() {
			$("#adisseo-slide").removeClass("selected");
		});
		$("#adisseo-launch-img").mouseenter(function() {
			$("#adisseo-launch").addClass("selected");
		});
		$("#adisseo-launch-img").mouseleave(function() {
			$("#adisseo-launch").removeClass("selected");
		});
		if (adisseo.tutorial)
			adisseo.tutorial.stop();
		adisseo.tutorial = new Blitter({width: 100, height: 55, resource: "skins/blacknegative/images/adisseo/sprite.png", frameRate: 20, frameNumber: 53, delay: 0, loop: true, autoplay: true, target: document.getElementById("adisseo-sprite")});
		$("#adisseo-hover").bind("click touchstart", function(event) {
			event.stopPropagation();
			event.preventDefault();
			$("#adisseo-bg").tween({bottom: {start: 0, stop: -10, units: "%", time: 0, duration: 1.4, effect: 'quartInOut'}});
			$("#adisseo-content").tween({bottom: {start: 35, stop: -110, units: "%", time: 0, duration: 1.4, effect: 'quartInOut'}});
			$("#adisseo-launch").tween({bottom: {start: 170, stop: 172, units: "%", time: 0, duration: 1.8, effect: 'quartInOut'}});
			$.play();
		});
		function initVideo() {
			jwplayer("adisseo-video").setup({autostart: false, controlbar: "none", stretching: "uniform", width: "100%", height: '100%', flashplayer: "swf/player.swf", icons: false, wmode: "opaque", levels: [{file: "uploads/section/adisseo/video.mp4"}, {file: "uploads/section/adisseo/video.webm"}, {file: "uploads/section/adisseo/video.ogv"}], modes: [{type: "html5"}, {type: "flash", src: "swf/player.swf"}], events: {onComplete: function() {
						stopVideo();
						slideTo("#adisseo-container", "#adisseo-intro", false);
					}}});
		}
		function stopVideo() {
			dispatch.playSoundSlide();
			jwplayer("adisseo-video").stop(true);
		}
		function playVideo() {
			dispatch.stopSound();
			jwplayer("adisseo-video").play(true);
		}
		function disposeVideo() {
			jwplayer("adisseo-video").stop();
			jwplayer("adisseo-video").remove();
		}
		function slideTo(container, element, resize) {
			currentElement = element;
			$w = $(window);
			var height = $w.height();
			var width = $w.width();
			var containerPosition = $(container).position();
			var elementPosition = $(element).position();
			if (resize == true) {
				$(container).css({top: -elementPosition.top});
			}
			else {
				if (Modernizr.csstransforms && Modernizr.csstransitions) {
					$(container).stop().transition({top: -elementPosition.top}, 1000, "out", function() {
						handleVideo(element);
					});
				}
				else {
					$(container).tween({top: {start: containerPosition.top, stop: -elementPosition.top, time: 0, duration: 1, effect: 'easeOut', onStop: function() {
								handleVideo(element);
							}}});
					$.play();
				}
			}
		}
		function handleVideo(element) {
			if (element == "#adisseo-placeholder") {
				playVideo();
				$("#nav").hide();
			}
			else {
				stopVideo();
				$("#nav").show();
			}
		}
		$(window).bind("resize", function() {
			slideTo("#adisseo-container", currentElement, true);
		});
	}, stop: function() {
		$("#adisseo-bg").css({bottom: "0%"});
		$("#adisseo-content").css({bottom: "35%"});
		$("#adisseo-launch").css({bottom: "170%"});
		if (adisseo.tutorial)
			adisseo.tutorial.stop();
		delete adisseo.tutorial;
		jwplayer("adisseo-video").stop();
		jwplayer("adisseo-video").remove();
		$("#adisseo-launch, #adisseo-back, #adisseo-sprite, #adisseo-launch-img, #adisseo-sprite").unbind();
	}};
var adisseo = new Adisseo();
;
function Whoweare() {
}
Whoweare.prototype = {init: function() {
		$(document).stopTime("freeze");
		var sectionContainer = $("#whoweare-section-container");
		var currentContainer = null;
		var isPlayed = false;
		function initLoop() {
			dispatch.app.video.init("whoweare-loop-video", "uploads/section/whoweare/loop", 7.9, 576, 1024);
		}
		$("div.whoweare-section").bind("click touchstart", function(event) {
			event.stopPropagation();
			event.preventDefault();
			if (dispatch.app.isiPad && currentContainer && currentContainer.attr("id") != $(this).attr("id"))
				desactivate(currentContainer);
			var _this = currentContainer = $(this);
			var _thisHover = $(this).find(".section-hover");
			var _thisTitle = $(this).find(".whoweare-title");
			var _thisSpan = $(this).find("span");
			var _thisPopup = $(this).find(".whoweare-popup");
			if (!_this.hasClass("selected")) {
				_thisSpan.hide();
				EKTweener.to(sectionContainer[0], .5, {marginTop: -160, ease: "easeOutExpo"});
				EKTweener.to(_thisHover[0], .5, {opacity: 1, ease: "easeOutExpo"});
				_thisPopup.show();
				EKTweener.to(_thisTitle[0], .5, {height: 176, marginTop: 10, marginBottom: 10, ease: "easeOutExpo"});
				_this.addClass("selected");
			}
			else {
				_this.removeClass("selected");
				_thisSpan.show();
				_thisPopup.hide();
				EKTweener.to(sectionContainer[0], .4, {marginTop: -67});
				EKTweener.to(_thisHover[0], .4, {opacity: 0});
				EKTweener.to(_thisTitle[0], .4, {height: 24, marginTop: 0, marginBottom: 0});
			}
		});
		if (dispatch.app.isiPad == false) {
			$("div.whoweare-section", $("#whoweare-section-container")).bind("mouseenter", function() {
				var _this = $(this);
				var _thisHover = $(this).find(".section-hover");
				var _thisTitle = $(this).find(".whoweare-title");
				EKTweener.to(sectionContainer[0], .4, {marginTop: -126});
				EKTweener.to(_thisHover[0], .4, {opacity: 0.2});
				EKTweener.to(_thisTitle[0], .4, {height: 87, marginTop: 27, marginBottom: 27});
			});
			$("div.whoweare-section", $("#whoweare-section-container")).mouseleave(function() {
				desactivate($(this));
			});
		}
		function desactivate(self) {
			var _this = self;
			var _thisHover = self.find(".section-hover");
			var _thisTitle = self.find(".whoweare-title");
			var _thisSpan = self.find("span");
			var _thisPopup = self.find(".whoweare-popup");
			_this.removeClass("selected");
			_thisSpan.show();
			_thisPopup.hide();
			EKTweener.to(sectionContainer[0], .3, {marginTop: -67});
			EKTweener.to(_thisHover[0], .3, {opacity: 0});
			EKTweener.to(_thisTitle[0], .3, {height: 24, marginTop: 0, marginBottom: 0});
			currentContainer = null;
		}
		initLoop();
	}, stop: function() {
		dispatch.app.video.remove("whoweare-loop-video");
		$("div.whoweare-section").unbind();
	}};
var whoweare = new Whoweare();
;
function Kindy() {
}
Kindy.prototype = {init: function() {
		var currentElement;
		var currentVideo = 1;
		var spriteTitle;
		function initLoop() {
			dispatch.app.video.init("kindy-loop-video", "uploads/section/kindy/loop", 6.6, 720, 1280);
		}
		if (!dispatch.app.isiPad) {
			initLoop();
		}
		slideTo("#kindy-container", "#kindy-intro", true);
		$("#kindy-launch").unbind().bind("click touchstart", function(event) {
			event.stopPropagation();
			event.preventDefault();
			var isiPad = navigator.userAgent.match(/iPad/i) != null;
			var isiPhone = navigator.userAgent.match(/iPhone/i) != null;
			if (isiPad == true || isiPhone == true) {
				window.open("http://www.blacknegative.com/uploads/section/kindy/" + currentVideo + "/video.mp4");
			}
			else {
				$w = $(window);
				var height = $w.height();
				initVideo();
				EKTweener.fromTo($("#kindy-launch")[0], 1.2, {marginTop: -1400}, {marginTop: -1400 - height, ease: "easeInOutBack", onComplete: function() {
						EKTweener.to($("#kindy-launch")[0], 0, {marginTop: -1400, delay: 1});
					}});
				$(document).oneTime(400, "wait", function() {
					slideTo("#kindy-container", "#kindy-placeholder-video", false);
				});
			}
		});
		$("#kindy-back").unbind().click(function() {
			jwplayer("kindy-video-full").pause(true);
			slideTo("#kindy-container", "#kindy-intro", false);
		});
		$("#kindy-section ul li").unbind().bind("click touchstart", function(event) {
			event.stopPropagation();
			event.preventDefault();
			$("#kindy-section ul li.current").removeClass("current");
			$(this).addClass("current");
			currentVideo = $(this).index() + 1;
			var nextSection = $("#kindy-section" + ($(this).index() + 1));
		});
		$("#kindy-section ul li").unbind().bind("click touchstart", function(event) {
			event.stopPropagation();
			event.preventDefault();
			$("#spriteIn, #kindy-ellipse, #spriteCircle").show();
			$("#kindy-section ul li.current").removeClass("current");
			$(this).addClass("current");
			currentVideo = $(this).index() + 1;
			var nextSection = $("#kindy-section" + ($(this).index() + 1));
			spriteCircle.gotoAndPlay(0, function() {
			}, function() {
			});
			$(document).oneTime(1000, "wait", function() {
				spriteCircle2.gotoAndPlay(3, function(frameNumber) {
				}, function() {
					$("#spriteCircle").hide();
				});
			});
			spriteIn.gotoAndPlay(0, function(frameNumber) {
				if (frameNumber == 13) {
					$("#kindy-section1, #kindy-section2, #kindy-section3").hide();
					nextSection.show();
				}
			}, function() {
				$("#kindy-ellipse, #spriteIn").hide();
			});
		});
		function initVideo() {
			jwplayer("kindy-video-full").setup({autostart: false, controlbar: "none", stretching: "uniform", width: "100%", height: '100%', wmode: "opaque", flashplayer: "swf/player.swf", icons: false, levels: [{file: "uploads/section/kindy/" + currentVideo + "/video.mp4"}, {file: "uploads/section/kindy/" + currentVideo + "/video.webm"}, {file: "uploads/section/kindy/" + currentVideo + "/video.ogv"}], modes: [{type: "html5"}, {type: "flash", src: "swf/player.swf"}], events: {onComplete: function() {
						stopVideo();
						slideTo("#kindy-container", "#kindy-intro", false);
					}}});
		}
		function stopVideo() {
			dispatch.playSoundSlide();
			jwplayer("kindy-video-full").stop(true);
		}
		function playVideo() {
			dispatch.stopSound();
			jwplayer("kindy-video-full").play(true);
		}
		function slideTo(container, element, resize) {
			currentElement = element;
			var containerPosition = $(container).position();
			var elementPosition = $(element).position();
			if (resize == true) {
				$(container).css({top: -elementPosition.top});
			}
			else {
				if (Modernizr.csstransforms && Modernizr.csstransitions) {
					$(container).stop().transition({top: -elementPosition.top}, 800, "out", function() {
						handleVideo(element);
					});
				}
				else {
					$(container).tween({top: {start: containerPosition.top, stop: -elementPosition.top, time: 0, duration: 1, effect: 'easeOut', onStop: function() {
								handleVideo(element);
							}}});
					$.play();
				}
			}
		}
		function handleVideo(element) {
			if (element == "#kindy-placeholder-video") {
				playVideo();
				$("#nav").hide();
			}
			else {
				stopVideo();
				$("#nav").show();
			}
		}
		var spriteIn = new Blitter({width: 380, height: 380, resource: "skins/blacknegative/images/kindy/spriteIn.png", frameRate: 15, frameNumber: 22, delay: 0, autoplay: true, loop: false, firstFrame: 0, target: document.getElementById("spriteIn")});
		var spriteCircle = new Blitter({width: 632, height: 632, resource: "skins/blacknegative/images/kindy/spriteCircle.png", frameRate: 20, frameNumber: 3, delay: 0, autoplay: false, firstFrame: 0, target: document.getElementById("spriteCircle")});
		var spriteCircle2 = new Blitter({width: 632, height: 632, resource: "skins/blacknegative/images/kindy/spriteCircle.png", frameRate: 20, frameNumber: 5, delay: 0, autoplay: false, firstFrame: 3, target: document.getElementById("spriteCircle")});
		if (this.spriteTitle)
			this.spriteTitle.stop();
		this.spriteTitle = new Blitter({width: 135, height: 98, resource: "skins/blacknegative/images/kindy/spriteTitle.png", frameRate: 20, frameNumber: 42, delay: 0, autoplay: true, loop: true, firstFrame: 0, target: document.getElementById("spriteTitle")});
		$(window).bind("resize", function() {
			slideTo("#kindy-container", currentElement, true);
		});
	}, stop: function() {
		if (this.spriteTitle)
			this.spriteTitle.stop();
		delete this.spriteTitle;
		jwplayer("kindy-video-full").stop();
		jwplayer("kindy-video-full").remove();
		dispatch.app.video.remove("kindy-loop-video");
		$("#kindy-launch, #kindy-back, #kindy-section ul li, #kindy-section ul li").unbind();
	}};
var kindy = new Kindy();
;
function Sanofi() {
	var itemList = [];
	this.animId = null;
}
(function() {
	var lastTime = 0;
	var vendors = ['ms', 'moz', 'webkit', 'o'];
	for (var x = 0; x < vendors.length && !window.requestAnimationFrame; ++x) {
		window.requestAnimationFrame = window[vendors[x] + 'RequestAnimationFrame'];
		window.cancelAnimationFrame = window[vendors[x] + 'CancelAnimationFrame'] || window[vendors[x] + 'CancelRequestAnimationFrame'];
	}
	if (!window.requestAnimationFrame)
		window.requestAnimationFrame = function(callback, element) {
			var currTime = new Date().getTime();
			var timeToCall = Math.max(0, 16 - (currTime - lastTime));
			var id = window.setTimeout(function() {
				callback(currTime + timeToCall);
			}, timeToCall);
			lastTime = currTime + timeToCall;
			return id;
		};
	if (!window.cancelAnimationFrame)
		window.cancelAnimationFrame = function(id) {
			clearTimeout(id);
		};
}());
Sanofi.prototype = {preview: function() {
		sanofi.itemList = [];
		$(".parallax-obj", $("#main-sanofi")).each(function() {
			$(this).hide();
			sanofi.itemList.push({element: $(this), depth: $(this).data("depth"), top: $(this).data("top"), left: $(this).data("left")});
		});
	}, init: function() {
		sanofi.preview();
		var mouseX = 0, mouseY = 0, percentX = 0, percentY = 0;
		var currentElement;
		var backgroundFlou = $("#sanofi-flou");
		var sanofiLaunch = $("#sanofi-launch");
		var background = getBackgroundDimension();
		var sanofiBackground = $("#sanofi-background");
		var backgroundDepth = sanofiBackground.data("depth");
		$w = $(window);
		var height = $w.height();
		var width = $w.width();
		slideTo("#sanofi-container", "#sanofi-intro", true);
		$("#sanofi-launch").unbind().bind("click touchstart", function(event) {
			event.stopPropagation();
			event.preventDefault();
			var isiPad = navigator.userAgent.match(/iPad/i) != null;
			var isiPhone = navigator.userAgent.match(/iPhone/i) != null;
			if (isiPad == true || isiPhone == true) {
				window.open("http://www.blacknegative.com/uploads/section/sanofi/video.mp4");
			}
			else {
				initVideo();
				playVideo();
				slideTo("#sanofi-container", "#sanofi-placeholder", false);
			}
		});
		$("#sanofi-placeholder").unbind().bind("click", function(event) {
			event.stopPropagation();
			event.preventDefault();
			slideTo("#sanofi-container", "#sanofi-intro", false);
		});
		$("#sanofi-back").unbind().click(function() {
			slideTo("#sanofi-container", "#sanofi-intro", false);
		});
		$("#main-sanofi").mousemove(function(e) {
			mouseX = e.pageX;
			mouseY = e.pageY;
			percentX = (mouseX / width) * 100 - 50;
			percentY = (mouseY / height) * 100 - 50;
		});
		runMovement();
		function handleVideo(element) {
			if (element == "#sanofi-placeholder") {
				playVideo();
				$("#nav").hide();
			}
			else {
				stopVideo();
				$("#nav").show();
			}
		}
		var initialize = false;
		function render() {
			if (percentX != 0) {
				sanofiBackground.css({left: (percentX * backgroundDepth), top: (percentY * backgroundDepth)});
				backgroundFlou.css({left: (percentX * backgroundDepth), top: (percentY * backgroundDepth)});
				var newOpacity = ((Math.abs(percentX * 2) / 100) + (Math.abs(percentY * 2) / 100)) / 2;
				backgroundFlou.css("opacity", 1 - Math.pow(1 - newOpacity / 1, 13));
				sanofiLaunch.css("opacity", Math.pow(1 - newOpacity / 1, 13));
				for (var i = 0; i < sanofi.itemList.length; i++)
				{
					sanofi.itemList[i].element.css({marginLeft: sanofi.itemList[i].left + (percentX * sanofi.itemList[i].depth * width * 0.01), marginTop: sanofi.itemList[i].top + (percentY * sanofi.itemList[i].depth * height * 0.01)});
				}
				if (initialize == false) {
					for (var i = 0; i < sanofi.itemList.length; i++)
					{
						sanofi.itemList[i].element.fadeIn("fast");
					}
					initialize = true;
				}
			}
		}
		function runMovement() {
			var isiPad = navigator.userAgent.match(/iPad/i) != null;
			var isiPhone = navigator.userAgent.match(/iPhone/i) != null;
			if (!isiPad && !isiPhone) {
				(function animloop() {
					sanofi.animId = requestAnimFrame(animloop);
					render();
				})();
			}
			else {
				var newOpacity = 1;
				backgroundFlou.css("opacity", Math.pow(1 - newOpacity / 1, 13));
				sanofiLaunch.css("opacity", 0.8);
				for (var i = 0; i < sanofi.itemList.length; i++)
				{
					sanofi.itemList[i].element.fadeIn("fast");
				}
			}
		}
		function stopMovement() {
			window.cancelAnimationFrame(sanofi.animId);
		}
		function getBackgroundDimension() {
			$w = $(window);
			height = $w.height();
			width = $w.width();
			if (height < 720 && width < 1280) {
				backgroundHeight = 720;
				backgroundWidth = 1280;
			}
			else if (height < 810 && width < 1440) {
				backgroundHeight = 810;
				backgroundWidth = 1440;
			}
			else if (height < 900 && width < 1600) {
				backgroundHeight = 900;
				backgroundWidth = 1600;
			}
			else if (height < 1012 && width < 1800) {
				backgroundHeight = 1012;
				backgroundWidth = 1800;
			}
			else if (height < 1152 && width < 2048) {
				backgroundHeight = 1152;
				backgroundWidth = 2048;
			}
			else if (height < 1440 && width < 2560) {
				backgroundHeight = 1440;
				backgroundWidth = 2560;
			}
			else if (height < 1600 && width < 2844) {
				backgroundHeight = 1600;
				backgroundWidth = 2844;
			}
			return [backgroundHeight, backgroundWidth];
		}
		function initVideo() {
			jwplayer("sanofi-video").setup({autostart: false, controlbar: "none", stretching: "uniform", width: "100%", height: '100%', wmode: "opaque", flashplayer: "swf/player.swf", icons: false, levels: [{file: "uploads/section/sanofi/video.mp4"}, {file: "uploads/section/sanofi/video.webm"}, {file: "uploads/section/sanofi/video.ogv"}], modes: [{type: "html5"}, {type: "flash", src: "swf/player.swf"}], events: {onComplete: function() {
						stopVideo();
						slideTo("#sanofi-container", "#sanofi-intro", false);
					}}});
		}
		function stopVideo() {
			dispatch.playSoundSlide();
			jwplayer("sanofi-video").stop(true);
		}
		function playVideo() {
			dispatch.stopSound();
			jwplayer("sanofi-video").play(true);
		}
		function disposeVideo() {
			jwplayer("sanofi-video").stop();
			jwplayer("sanofi-video").remove();
		}
		function slideTo(container, element, resize) {
			currentElement = element;
			$w = $(window);
			var height = $w.height();
			var width = $w.width();
			var containerPosition = $(container).position();
			var elementPosition = $(element).position();
			if (resize == true) {
				$(container).css({top: -elementPosition.top});
			}
			else {
				if (Modernizr.csstransforms && Modernizr.csstransitions) {
					$(container).stop().transition({top: -elementPosition.top}, 1000, "out", function() {
						handleVideo(element);
					});
				}
				else {
					$(container).tween({top: {start: containerPosition.top, stop: -elementPosition.top, time: 0, duration: 1, effect: 'easeOut', onStop: function() {
								handleVideo(element);
							}}});
					$.play();
				}
			}
		}
		$(window).bind("resize", function() {
			slideTo("#sanofi-container", currentElement, true);
		});
	}, stop: function() {
		for (var i = 0; i < sanofi.itemList.length; i++)
		{
			sanofi.itemList[i].element.hide();
		}
		window.cancelAnimationFrame(sanofi.animId);
	}};
var sanofi = new Sanofi();
;
function Twist() {
	this.spriteOne = null;
	this.spriteTwo = null;
	this.spriteThree = null;
	this.spriteFour = null;
}
Twist.prototype = {preview: function() {
		$("#twist-action").mouseenter(function() {
			$("#twist-circle, #twist-go").show();
			EKTweener.to($("#twist-circle")[0], 0.8, {marginTop: -196, marginLeft: -155, height: 372, width: 372, opacity: 1, ease: "easeInOutElastic"});
			EKTweener.to($("#twist-go")[0], 0.8, {marginTop: 70, marginLeft: 150, height: 82, width: 82, opacity: 1, ease: "easeInOutElastic"});
		});
		$("#twist-action").mouseleave(function() {
			EKTweener.to($("#twist-circle")[0], .9, {marginTop: 0, marginLeft: 101, height: 0, width: 0, opacity: 0, ease: "easeInOutElastic", onComplete: function() {
					$("#twist-circle").hide();
				}});
			EKTweener.to($("#twist-go")[0], .9, {marginTop: 132, marginLeft: 232, height: 0, width: 0, opacity: 0, ease: "easeInOutElastic", onComplete: function() {
					$("#twist-go").hide();
				}});
		});
	}, init: function() {
		if (twist.spriteOne)
			twist.spriteOne.stop();
		twist.spriteOne = new Blitter({width: 70, height: 93, resource: "skins/blacknegative/images/twist/sprite1.png", frameRate: 15, frameNumber: 40, delay: 0, autoplay: true, firstFrame: 0, loop: true, target: document.getElementById("twist-sprite1")});
		if (twist.spriteTwo)
			twist.spriteTwo.stop();
		twist.spriteTwo = new Blitter({width: 44, height: 53, resource: "skins/blacknegative/images/twist/sprite2.png", frameRate: 15, frameNumber: 40, delay: 0, autoplay: true, firstFrame: 0, loop: true, target: document.getElementById("twist-sprite2")});
		if (twist.spriteThree)
			twist.spriteThree.stop();
		twist.spriteThree = new Blitter({width: 159, height: 157, resource: "skins/blacknegative/images/twist/sprite3.png", frameRate: 15, frameNumber: 40, delay: 0, autoplay: true, firstFrame: 0, loop: true, target: document.getElementById("twist-sprite3")});
		if (twist.spriteFour)
			twist.spriteFour.stop();
		twist.spriteFour = new Blitter({width: 257, height: 187, resource: "skins/blacknegative/images/twist/sprite4.png", frameRate: 15, frameNumber: 40, delay: 0, autoplay: true, firstFrame: 0, loop: true, target: document.getElementById("twist-sprite4")});
		var isiPad = navigator.userAgent.match(/iPad/i) != null;
		if (isiPad) {
			$("#twist-circle, #twist-go").show();
			EKTweener.to($("#twist-circle")[0], 0.8, {marginTop: -196, marginLeft: -155, height: 372, width: 372, opacity: 1, ease: "easeInOutElastic"});
			EKTweener.to($("#twist-go")[0], 0.8, {marginTop: 70, marginLeft: 150, height: 82, width: 82, opacity: 1, ease: "easeInOutElastic"});
		}
		$("#twist-action").unbind("mouseenter").mouseenter(function() {
			$("#twist-circle, #twist-go").show();
			EKTweener.to($("#twist-circle")[0], 0.8, {marginTop: -196, marginLeft: -155, height: 372, width: 372, opacity: 1, ease: "easeInOutElastic"});
			EKTweener.to($("#twist-go")[0], 0.8, {marginTop: 70, marginLeft: 150, height: 82, width: 82, opacity: 1, ease: "easeInOutElastic"});
		});
		$("#twist-action").unbind("mouseleave").mouseleave(function() {
			EKTweener.to($("#twist-circle")[0], .9, {marginTop: 0, marginLeft: 101, height: 0, width: 0, opacity: 0, ease: "easeInOutElastic", onComplete: function() {
					$("#twist-circle").hide();
				}});
			EKTweener.to($("#twist-go")[0], .9, {marginTop: 132, marginLeft: 232, height: 0, width: 0, opacity: 0, ease: "easeInOutElastic", onComplete: function() {
					$("#twist-go").hide();
				}});
		});
		$("#twist-action").unbind("click").click(function(event) {
			event.stopPropagation();
			event.preventDefault();
			var ecran1 = $("#twist-ecran1");
			EKTweener.fromTo(ecran1[0], .5, {opacity: 1}, {opacity: 0, onComplete: function() {
					ecran1.hide();
				}});
		});
		$w = $(window);
		var height = $w.height();
		var width = $w.width();
		var currentElement;
		slideTo("#twist-container", "#twist-intro", true);
		$("#twist-launch").unbind().bind("click touchstart", function() {
			event.stopPropagation();
			event.preventDefault();
			var isiPad = navigator.userAgent.match(/iPad/i) != null;
			var isiPhone = navigator.userAgent.match(/iPhone/i) != null;
			if (isiPad == true || isiPhone == true) {
				window.open("http://www.blacknegative.com/uploads/section/twist/video.mp4");
			}
			else {
				initVideo();
				playVideo();
				slideTo("#twist-container", "#twist-placeholder", false);
			}
		});
		$("#twist-back").unbind().click(function() {
			slideTo("#twist-container", "#twist-intro", false);
		});
		function initVideo() {
			jwplayer("twist-video").setup({autostart: false, controlbar: "none", stretching: "uniform", repeat: 'always', width: "100%", height: '100%', flashplayer: "swf/player.swf", wmode: "opaque", icons: false, levels: [{file: "uploads/section/twist/video.mp4"}, {file: "uploads/section/twist/video.webm"}, {file: "uploads/section/twist/video.ogv"}], modes: [{type: "html5"}, {type: "flash", src: "swf/player.swf"}], events: {onComplete: function() {
						stopVideo();
						slideTo("#twist-container", "#twist-intro", false);
					}}});
		}
		function stopVideo() {
			jwplayer("twist-video").stop(true);
		}
		function playVideo() {
			jwplayer("twist-video").play(true);
		}
		function slideTo(container, element, resize) {
			currentElement = element;
			$w = $(window);
			var height = $w.height();
			var width = $w.width();
			var containerPosition = $(container).position();
			var elementPosition = $(element).position();
			if (resize == true) {
				$(container).css({top: -elementPosition.top});
			}
			else {
				if (Modernizr.csstransforms && Modernizr.csstransitions) {
					$(container).stop().transition({top: -elementPosition.top}, 1000, "out", function() {
						handleVideo(element);
					});
				}
				else {
					$(container).tween({top: {start: containerPosition.top, stop: -elementPosition.top, time: 0, duration: 1, effect: 'easeOut', onStop: function() {
								handleVideo(element);
							}}});
					$.play();
				}
			}
		}
		function handleVideo(element) {
			if (element == "#twist-placeholder") {
				playVideo();
				$("#nav").hide();
			}
			else {
				stopVideo();
				$("#nav").show();
			}
		}
		$(window).bind("resize", function() {
			slideTo("#twist-container", currentElement, true);
		});
	}, stop: function() {
		jwplayer("twist-video").stop();
		jwplayer("twist-video").remove();
		$("#twist-ecran1").show();
		$("#twist-ecran1").css({opacity: 1});
		$("#twist-action, #twist-back, #twist-launch").unbind();
		twist.spriteOne.stop();
		twist.spriteTwo.stop();
		twist.spriteThree.stop();
		twist.spriteFour.stop();
	}};
var twist = new Twist();
;
function Contact() {
}
Contact.prototype = {init: function() {
		function initLoop() {
			dispatch.app.video.init("contact-loop-video", "uploads/section/contact/loop", 8, 556, 990);
		}
		$("#contact-email").bind("mouseenter touchstart", function() {
			$("#contact-hello-bg").show();
		});
		$("#contact-email").bind("mouseleave", function() {
			$("#contact-hello-bg").hide();
		});
		initLoop();
		EKTweener.to($("#see-all")[0], 0.5, {bottom: 60, ease: "easeOutExpo", delay: 1});
	}, stop: function() {
		dispatch.app.video.remove("contact-loop-video");
	}};
var contact = new Contact();
;
function News() {
	var contentPane = null;
	this.currentIndex = 0;
}
News.prototype = {preview: function() {
		$(document).oneTime(1000, function() {
			$("#news-container").show();
			$("#news-container").jScrollPane({verticalDragMinHeight: 189, verticalDragMaxHeight: 189, horizontalDragMinWidth: 19, horizontalDragMaxWidth: 19});
		});
	}, init: function() {
		$("#news-container").jScrollPane({verticalDragMinHeight: 189, verticalDragMaxHeight: 189, horizontalDragMinWidth: 19, horizontalDragMaxWidth: 19});
		var currentElement;
		var currentIndex = 0;
		var isPlayed = false;
		function initLoop() {
			dispatch.app.video.init("news-loop-video", "uploads/section/news/loop", 5.7, 576, 1024);
		}
		function slideTo(container, element, resize) {
			currentElement = element;
			$w = $(window);
			var height = $w.height();
			var width = $w.width();
			var containerPosition = $(container).position();
			var elementPosition = $(element).position();
			if (resize == true) {
				$(container).css({top: -elementPosition.top});
			}
			else {
				if (element == "#news-placeholder-video") {
					$("#nav").hide();
				}
				else {
					stopVideo();
					$("#nav").show();
				}
				if (Modernizr.csstransforms && Modernizr.csstransitions) {
					$(container).stop().transition({top: -elementPosition.top}, 1000, "out");
				}
				else {
					$(container).tween({top: {start: containerPosition.top, stop: -elementPosition.top, time: 0, duration: 1, effect: 'easeOut'}});
					$.play();
				}
			}
		}
		initLoop();
		slideTo("#news-cont", "#news-intro", true);
		$(".news-item").bind("click touchstart", function() {
			$(this).find("img").eq(news.currentIndex).hide();
			if (news.currentIndex == 2) {
				news.currentIndex = 0;
			}
			else {
				news.currentIndex = news.currentIndex + 1;
			}
			$(this).find("img").eq(news.currentIndex).show();
		});
		$(".news-item", $("#news-placeholder")).mouseenter(function() {
			news.currentIndex = 0;
			$(this).find(".news-visuel").find("img").hide().eq(0).show();
			if ($.browser.msie) {
				$(this).find(".news-visuel").show();
			}
			else {
				$(this).find(".news-visuel").fadeIn();
			}
		});
		$(".news-item", $("#news-placeholder")).mouseleave(function() {
			if ($.browser.msie) {
				$(this).find(".news-visuel").hide();
			}
			else {
				$(this).find(".news-visuel").fadeOut();
			}
		});
		$("#news-back").click(function() {
			slideTo("#news-cont", "#news-intro", false);
		});
		$(window).bind("resize", function() {
			$("#news-container").jScrollPane({verticalDragMinHeight: 189, verticalDragMaxHeight: 189, horizontalDragMinWidth: 19, horizontalDragMaxWidth: 19});
			slideTo("#news-cont", currentElement, true);
		});
	}, stop: function() {
		dispatch.app.video.remove("news-loop-video");
	}};
var news = new News();
;
function Citroen() {
	this.tutorial = null;
}
Citroen.prototype = {init: function() {
		var isiPad = navigator.userAgent.match(/iPad/i) != null;
		runMovement();
		var mouseX = 0;
		var mouseY = 0;
		var itemList = [];
		var dragged = false;
		$w = $(window);
		var height = $w.height();
		var width = $w.width();
		var background = getBackgroundDimension();
		var citroenBackground = $("#citroen-background");
		var backgroundDepth = citroenBackground.data("depth");
		$(".parallax-obj", $("#main-citroen")).each(function() {
			itemList.push({element: $(this), depth: $(this).data("depth"), top: $(this).data("top"), left: $(this).data("left")});
		});
		if (citroen.tutorial)
			citroen.tutorial.stop();
		citroen.tutorial = new Blitter({width: 150, height: 35, resource: "skins/blacknegative/images/citroen/sprite.gif", frameRate: 20, frameNumber: 31, delay: 0, loop: true, autoplay: true, target: document.getElementById("citroen-drag")});
		var currentElement;
		slideTo("#citroen-container", "#citroen-intro", true);
		$("#citroen-launch").unbind().bind("click touchstart", function(event) {
			event.stopPropagation();
			event.preventDefault();
			var isiPad = navigator.userAgent.match(/iPad/i) != null;
			var isiPhone = navigator.userAgent.match(/iPhone/i) != null;
			if (isiPad == true || isiPhone == true) {
				window.open("http://www.blacknegative.com/uploads/section/citroen/video.mp4");
			}
			else {
				initVideo();
				slideTo("#citroen-container", "#citroen-placeholder", false);
			}
		});
		$("#citroen-placeholder").unbind().bind("click", function() {
			slideTo("#citroen-container", "#citroen-intro", false);
		});
		function initVideo() {
			jwplayer("citroen-video").setup({autostart: false, controlbar: "none", disabled: false, stretching: "uniform", width: "100%", height: '100%', flashplayer: "swf/player.swf", icons: false, wmode: "opaque", levels: [{file: "uploads/section/citroen/video.mp4"}, {file: "uploads/section/citroen/video.webm"}, {file: "uploads/section/citroen/video.ogv"}], modes: [{type: "html5"}, {type: "flash", src: "swf/player.swf"}], events: {onComplete: function() {
						stopVideo();
						slideTo("#citroen-container", "#citroen-intro", false);
					}}});
		}
		function stopVideo() {
			dispatch.playSoundSlide();
			jwplayer("citroen-video").stop(true);
		}
		function playVideo() {
			dispatch.stopSound();
			jwplayer("citroen-video").play(true);
		}
		function disposeVideo() {
			jwplayer("citroen-video").stop();
			jwplayer("citroen-video").remove();
		}
		function slideTo(container, element, resize) {
			currentElement = element;
			$w = $(window);
			var height = $w.height();
			var width = $w.width();
			var containerPosition = $(container).position();
			var elementPosition = $(element).position();
			if (resize == true) {
				$(container).css({top: -elementPosition.top});
			}
			else {
				if (Modernizr.csstransforms && Modernizr.csstransitions) {
					$(container).stop().transition({top: -elementPosition.top}, 1000, "out", function() {
						handleVideo(element);
					});
				}
				else {
					$(container).tween({top: {start: containerPosition.top, stop: -elementPosition.top, time: 0, duration: 1, effect: 'easeOut', onStop: function() {
								handleVideo(element);
							}}});
					$.play();
				}
			}
		}
		function handleVideo(element) {
			if (element == "#citroen-placeholder") {
				playVideo();
				$("#nav").hide();
			}
			else {
				stopVideo();
				$("#nav").show();
			}
		}
		$(window).bind("resize", function() {
			slideTo("#citroen-container", currentElement, true);
			background = getBackgroundDimension();
		});
		$("#main-citroen").mousemove(function(e) {
			mouseX = e.pageX;
			mouseY = e.pageY;
		});
		$("#main-citroen").mouseenter(function() {
			runMovement();
		});
		$("#main-citroen").mouseleave(function() {
			stopMovement();
		});
		$("#citroen-back").click(function() {
			slideTo("#citroen-container", "#citroen-intro", false);
		});
		function runMovement() {
			$(document).stopTime("movement");
			$(document).everyTime(30, "movement", function() {
				var distanceWidth = width - background[1];
				var distanceHeight = height - background[0];
				citroenBackground.css({left: -width / 2 - distanceWidth / 2 * (mouseX * backgroundDepth * 0.001), top: -height / 2 - distanceHeight / 2 * (mouseY * backgroundDepth * 0.003)});
				for (var i = 0; i < itemList.length; i++)
				{
					itemList[i].element.css({marginLeft: itemList[i].left + (mouseX * itemList[i].depth * 0.3) - 100, marginTop: itemList[i].top + (mouseY * itemList[i].depth * 0.3) - 100});
				}
			});
		}
		function stopMovement() {
			$(document).stopTime("movement");
		}
		$('#citroen-drag-over').css({left: 0});
		$('#citroen-drag-over').draggable({axis: 'x', cursor: 'move', containment: '#citroen-dragbar', drag: function(event, ui) {
				$("#citroen-drag").css({left: ui.position.left});
				var percent = ((ui.position.left / 270) * 53 >> 1) * 2 + 1;
				$("#main-sequence > div.current").removeClass("current");
				$("#main-sequence > div").eq(percent).addClass("current");
				if (ui.position.left >= 270 && dragged == false) {
					dragThis();
				}
			}});
		function dragThis() {
			dragged = true;
			runMovement();
			$('#citroen-drag').draggable("disable");
			$('#citroen-logo').show();
			$("#citroen-drag-bg").tween({top: {start: 0, stop: 100, time: 1, units: '%', duration: 1.3, effect: 'easeOut', onStart: function() {
						$('#citroen-dragbar, #main-sequence').hide();
					}, onStop: function() {
						afterEffect();
					}}});
			$.play();
		}
		function getBackgroundDimension() {
			$w = $(window);
			height = $w.height();
			width = $w.width();
			if (height < 720 && width < 1280) {
				backgroundHeight = 720;
				backgroundWidth = 1280;
			}
			else if (height < 810 && width < 1440) {
				backgroundHeight = 810;
				backgroundWidth = 1440;
			}
			else if (height < 900 && width < 1600) {
				backgroundHeight = 900;
				backgroundWidth = 1600;
			}
			else if (height < 1012 && width < 1800) {
				backgroundHeight = 1012;
				backgroundWidth = 1800;
			}
			else if (height < 1152 && width < 2048) {
				backgroundHeight = 1152;
				backgroundWidth = 2048;
			}
			else if (height < 1440 && width < 2560) {
				backgroundHeight = 1440;
				backgroundWidth = 2560;
			}
			else if (height < 1600 && width < 2844) {
				backgroundHeight = 1600;
				backgroundWidth = 2844;
			}
			return [backgroundHeight, backgroundWidth];
		}
		function afterEffect() {
			$(document).stopTime("afterEffect");
			$(document).oneTime(800, "afterEffect", function() {
				$('#citroen-logo').fadeOut("fast");
			});
		}
	}, stop: function() {
		citroen.tutorial.stop();
		citroen.tutorial = null;
		$('#citroen-drag').draggable("destroy").css({left: 0});
		$("#main-sequence > div.current").removeClass("current");
		$("#main-sequence > div").eq(1).addClass("current");
		$('#citroen-logo').hide();
		$('#citroen-dragbar, #main-sequence').show();
		$("#citroen-drag-bg").css({top: 0});
	}};
var citroen = new Citroen();
;
function Client() {
}
Client.prototype = {init: function() {
		var arr = [];
		$(".item-client").each(function() {
			arr.push(this);
		});
		$("#client-launch").bind("click touchstart", function(event) {
			event.stopPropagation();
			event.preventDefault();
			$("#client-work, #client-launch").hide();
			$("#client-back").show();
			animateOut();
		});
		animateIn();
		function animateIn() {
			var clientGood = $("#client-good");
			clientGood.show();
			EKTweener.fromTo(clientGood[0], .4, {opacity: 0, marginTop: 0}, {opacity: 1, marginTop: -66, onComplete: function() {
				}});
		}
		function animateOut() {
			var clientGood = $("#client-good");
			EKTweener.fromTo(clientGood[0], .4, {opacity: 1, marginTop: -66}, {opacity: 0, marginTop: 0, onComplete: function() {
					clientGood.hide();
				}});
			for (var i = 0; i < arr.length; i++) {
				if (arr[i]) {
					$(arr[i]).css({opacity: 0}).show();
					EKTweener.to(arr[i], .4, {opacity: 1, ease: "easeInOutElastic", delay: i * .04, onComplete: function() {
						}});
				}
			}
		}
		$("#client-back").click(function() {
			$("#client-work, #client-launch").show();
			animateIn();
			$("#client-back, .item-client").hide();
		});
		function initLoop() {
			dispatch.app.video.init("client-loop-video", "uploads/section/client/loop", 8, 576, 1024);
		}
		initLoop();
	}, stop: function() {
		dispatch.app.video.remove("client-loop-video");
		$("#client-work, #client-launch").show();
		$("#client-back, .item-client").hide();
		$("#client-loop").css({opacity: 0});
		$(".item-client", $("#client")).css({opacity: 0});
	}};
var client = new Client();
;
function Ownthesky() {
}
Ownthesky.prototype = {init: function() {
		var currentElement;
		var isPlayed = false;
		initLoop();
		slideTo("#ownthesky-container", "#ownthesky-intro", true);
		$("#ownthesky-launch").unbind().bind("click touchstart", function(event) {
			event.stopPropagation();
			event.preventDefault();
			var isiPad = navigator.userAgent.match(/iPad/i) != null;
			var isiPhone = navigator.userAgent.match(/iPhone/i) != null;
			if (isiPad == true || isiPhone == true) {
				window.open("http://www.blacknegative.com/uploads/section/ownthesky/video.mp4");
			}
			else {
				initVideo();
				playVideo();
				slideTo("#ownthesky-container", "#ownthesky-placeholder", false);
			}
		});
		$("#ownthesky-placeholder").unbind().bind("click", function() {
			slideTo("#ownthesky-container", "#ownthesky-intro", false);
		});
		$("#ownthesky-back").unbind().click(function() {
			slideTo("#ownthesky-container", "#ownthesky-intro", false);
		});
		function initLoop() {
			dispatch.app.video.init("ownthesky-loop-video", "uploads/section/ownthesky/loop", 7.6, 486, 1000);
		}
		function initVideo() {
			jwplayer("ownthesky-video").setup({autostart: false, controlbar: "none", stretching: "uniform", repeat: 'always', width: "100%", height: '100%', wmode: "opaque", flashplayer: "swf/player.swf", icons: false, levels: [{file: "uploads/section/ownthesky/video.mp4"}, {file: "uploads/section/ownthesky/video.webm"}, {file: "uploads/section/ownthesky/video.ogv"}], modes: [{type: "html5"}, {type: "flash", src: "swf/player.swf"}], events: {onComplete: function() {
						stopVideo();
						slideTo("#ownthesky-container", "#ownthesky-intro", false);
					}}});
		}
		function stopVideo() {
			dispatch.playSoundSlide();
			jwplayer("ownthesky-video").stop(true);
		}
		function playVideo() {
			dispatch.stopSound();
			jwplayer("ownthesky-video").play(true);
		}
		function slideTo(container, element, resize) {
			currentElement = element;
			$w = $(window);
			var height = $w.height();
			var width = $w.width();
			var containerPosition = $(container).position();
			var elementPosition = $(element).position();
			if (resize == true) {
				$(container).css({top: -elementPosition.top});
			}
			else {
				if (element == "#ownthesky-placeholder") {
					playVideo();
					$("#nav").hide();
				}
				else {
					stopVideo();
					$("#nav").show();
				}
				if (Modernizr.csstransforms && Modernizr.csstransitions) {
					$(container).stop().transition({top: -elementPosition.top}, 1000, "out");
				}
				else {
					$(container).tween({top: {start: containerPosition.top, stop: -elementPosition.top, time: 0, duration: 1, effect: 'easeOut'}});
					$.play();
				}
			}
		}
		$(window).bind("resize", function() {
			slideTo("#ownthesky-container", currentElement, true);
		});
	}, stop: function() {
		dispatch.app.video.remove("ownthesky-loop-video");
		jwplayer("ownthesky-video").stop();
		jwplayer("ownthesky-video").remove();
	}};
var ownthesky = new Ownthesky();
;
function Luminarc() {
}
Luminarc.prototype = {init: function() {
		var currentElement;
		var isPlayed = false;
		initLoop();
		slideTo("#luminarc-container", "#luminarc-intro", true);
		$("#luminarc-launch").unbind().bind("click touchstart", function(event) {
			event.stopPropagation();
			event.preventDefault();
			var isiPad = navigator.userAgent.match(/iPad/i) != null;
			var isiPhone = navigator.userAgent.match(/iPhone/i) != null;
			if (isiPad == true || isiPhone == true) {
				window.open("http://www.blacknegative.com/uploads/section/luminarc/video.mp4");
			}
			else {
				initVideo();
				playVideo();
				slideTo("#luminarc-container", "#luminarc-placeholder", false);
			}
		});
		$("#luminarc-placeholder").unbind().bind("click touchstart", function() {
			event.stopPropagation();
			event.preventDefault();
			slideTo("#luminarc-container", "#luminarc-intro", false);
		});
		$("#luminarc-back").unbind().click(function() {
			slideTo("#luminarc-container", "#luminarc-intro", false);
		});
		function initLoop() {
			dispatch.app.video.init("luminarc-loop-video", "uploads/section/luminarc/loop", 7.6, 556, 992);
		}
		function initVideo() {
			jwplayer("luminarc-video").setup({autostart: false, controlbar: "none", stretching: "uniform", width: "100%", wmode: "opaque", height: '100%', flashplayer: "swf/player.swf", icons: false, levels: [{file: "uploads/section/luminarc/video.mp4"}, {file: "uploads/section/luminarc/video.webm"}, {file: "uploads/section/luminarc/video.ogv"}], modes: [{type: "html5"}, {type: "flash", src: "swf/player.swf"}], events: {onComplete: function() {
						jwplayer("luminarc-video").stop();
						slideTo("#luminarc-container", "#luminarc-intro", false);
					}}});
		}
		function stopVideo() {
			dispatch.playSoundSlide();
			jwplayer("luminarc-video").stop(true);
		}
		function playVideo() {
			dispatch.stopSound();
			jwplayer("luminarc-video").play(true);
		}
		function slideTo(container, element, resize) {
			currentElement = element;
			$w = $(window);
			var height = $w.height();
			var width = $w.width();
			var containerPosition = $(container).position();
			var elementPosition = $(element).position();
			if (resize == true) {
				$(container).css({top: -elementPosition.top});
			}
			else {
				if (element == "#luminarc-placeholder") {
					playVideo();
					$("#nav").hide();
				}
				else {
					stopVideo();
					$("#nav").show();
				}
				if (Modernizr.csstransforms && Modernizr.csstransitions) {
					$(container).stop().transition({top: -elementPosition.top}, 1000, "out");
				}
				else {
					$(container).tween({top: {start: containerPosition.top, stop: -elementPosition.top, time: 0, duration: 1, effect: 'easeOut'}});
					$.play();
				}
			}
		}
		$(window).bind("resize", function() {
			slideTo("#luminarc-container", currentElement, true);
		});
	}, stop: function() {
		dispatch.app.video.remove("luminarc-loop-video");
		jwplayer("luminarc-video").stop();
		jwplayer("luminarc-video").remove();
	}};
var luminarc = new Luminarc();
;
function Class() {
	var someManagedAjax = null;
	var app = $.sammy();
	var currentPosition = 0;
	var trash = [];
	app.activeSound = true;
	app.soundHome = null;
	app.soundSlide = null;
	app.soundType = 0;
	app.currentPage = null;
	app.lastPage = null;
	app.vignetteList = [];
	app.pageManager = [];
	app.lastVignette = 0;
	app.skipTransition = false;
	app.isDragged = false;
	app.video = new Video();
	app.pageManager["loader"] = loader;
	app.pageManager["ralphlauren"] = ralphlauren;
	app.pageManager["bose"] = bose;
	app.pageManager["news"] = news;
	app.pageManager["bullittagency"] = bullittagency;
	app.pageManager["adisseo"] = adisseo;
	app.pageManager["whoweare"] = whoweare;
	app.pageManager["kindy"] = kindy;
	app.pageManager["sanofi"] = sanofi;
	app.pageManager["twist"] = twist;
	app.pageManager["citroen"] = citroen;
	app.pageManager["client"] = client;
	app.pageManager["contact"] = contact;
	app.pageManager["ownthesky"] = ownthesky;
	app.pageManager["luminarc"] = luminarc;
	app.currentLeft = 0;
	if ($.browser.msie || $.browser.mozilla) {
		app.activeSound = false;
	}
	var isiPad = navigator.userAgent.match(/iPad/i) != null;
	var isiPhone = navigator.userAgent.match(/iPhone/i) != null;
	var isAndroid = navigator.userAgent.match(/Android/i) != null;
	if (isAndroid) {
		$("#container").addClass("android");
	}
	app.isiPad = isiPad;
	if (isiPhone == true)
		app.isiPad = true;
}
Class.prototype = {init: function() {
		var self = this;
		$w = $(window);
		self.HEIGHT = $w.height();
		self.WIDTH = $w.width();
		self.menuOpen = false;
		self.nav = $("#nav");
		self.logo = $("#logo");
		self.social = $("#social");
		self.credit = $("#credit");
		self.navContainer = $("#nav-container");
		self.maskMenu = $("#mask-menu");
		self.maskHover = $("#mask-hover");
		self.maskNav = $("#mask-nav");
		self.main = $("#main");
		self.modules = $("#module-navigator > #handler > div");
		self.home = $("#home");
		self.handler = $("#handler");
		self.currentElement = null;
		self.loader = false;
		self.app = $.sammy(function() {
			this.get('#!/:controlleur/', function() {
				if (this.params['controlleur'] != "loader" && $("#ralphlauren").size() == 0) {
					window.location = "#!/loader/";
				}
				else {
					dispatch.run(this.params['controlleur'], this.params['controlleur']);
				}
			});
			return false;
		});
		$("#social-twitter").click(function() {
			window.open("http://twitter.com/share?text=blacknegative&url=http%3A%2F%2Fwww.blacknegative.com", "Share", config = "height=350, width=400, toolbar=no, menubar=no, scrollbars=no, resizable=no, location=no, directories=no, status=no");
			return false;
		});
		$("#social-facebook").click(function() {
			window.open("http://www.facebook.com/sharer.php?u=http://www.blacknegative.com", "Share", config = "height=350, width=400, toolbar=no, menubar=no, scrollbars=no, resizable=no, location=no, directories=no, status=no");
			return false;
		});
		dispatch.adjustSize();
		$.preload(["skins/blacknegative/images/loader-bg.png"], {onFinish: function() {
				dispatch.app.run("#!/loader/");
			}});
	}, initStuff: function(callback) {
		var self = this;
		$.manageAjax.add('ajaxProfile', {abortOld: false, preventDoubbleRequests: true, cacheResponse: true, success: function(data) {
				$("#handler").append(data);
				self.modules = $("#module-navigator > #handler > div");
				dispatch.initHome();
				dispatch.initDrag();
				dispatch.adjustSize();
				dispatch.initSound();
				self.loader = true;
				if (callback)
					callback();
			}, url: "experience"});
	}, initSound: function() {
		if (dispatch.app.isiPad) {
			return false;
		}
		var _this = this;
		_this.app.soundSlide = new buzz.sound("uploads/sound/home", {formats: ["ogg", "mp3"], autoload: true, loop: true, autoplay: false});
		_this.app.soundNav = new buzz.sound("uploads/sound/slide", {formats: ["ogg", "mp3"], autoload: true, loop: true, autoplay: false});
		$("#sound-control").click(function() {
			if ($(this).hasClass("unable")) {
				_this.app.soundSlide.unmute();
				_this.app.soundNav.unmute();
				$(this).removeClass("unable");
				$(this).find("img").attr("src", "skins/blacknegative/images/home/sound.png");
			}
			else {
				_this.app.soundSlide.mute();
				_this.app.soundNav.mute();
				$(this).addClass("unable");
				$(this).find("img").attr("src", "skins/blacknegative/images/home/home-close.png");
			}
		});
	}, playSoundNav: function() {
		if (dispatch.app.isiPad || dispatch.app.activeSound != true) {
			return false;
		}
		if (dispatch.app.soundType != 2) {
			dispatch.app.soundNav.fadeIn(1000);
			dispatch.app.soundSlide.fadeOut(1000);
			dispatch.app.soundType = 2;
		}
	}, playSoundSlide: function() {
		if (dispatch.app.isiPad || dispatch.app.activeSound != true) {
			return false;
		}
		if (dispatch.app.soundType != 1) {
			dispatch.app.soundType = 1;
			dispatch.app.soundSlide.fadeIn(1000);
			dispatch.app.soundNav.fadeOut(1000);
		}
	}, pauseSoundSlide: function() {
		if (dispatch.app.isiPad || dispatch.app.activeSound != true) {
			return false;
		}
		dispatch.app.soundType = 0;
		dispatch.app.soundSlide.fadeOut(1000);
	}, stopSound: function() {
		if (dispatch.app.isiPad || dispatch.app.activeSound != true) {
			return false;
		}
		dispatch.app.soundType = 0;
		dispatch.app.soundSlide.fadeOut(1000);
		dispatch.app.soundNav.fadeOut(1000);
	}, initDrag: function() {
		var self = this;
		if (!dispatch.currentPosition)
			dispatch.currentPosition = 0;
		var nbItem = $("#handler > div").size();
		var items = [];
		$("#handler > div").each(function() {
			items.push({element: $(this), id: $(this).attr("id")});
		});
		$('#handler').draggable({axis: 'x', cursor: 'move', start: function(event) {
				event.stopPropagation();
				dispatch.app.isDragged = true;
			}, stop: function(event, ui) {
				event.stopPropagation();
				dispatch.app.isDragged = false;
				var offsetXPos = parseInt(ui.offset.left) * -1;
				var updatedPosition;
				if (offsetXPos > (((self.currentIndex) * self.WIDTH) + (self.WIDTH * 0.2)) && self.currentIndex + 1 < nbItem) {
					updatedPosition = self.currentIndex + 1;
					window.location.href = "#!/" + items[updatedPosition].id + "/";
				}
				else if (offsetXPos < (((self.currentIndex) * self.WIDTH) - (self.WIDTH * 0.2)) && self.currentIndex > 1) {
					updatedPosition = self.currentIndex - 1;
					window.location.href = "#!/" + items[updatedPosition].id + "/";
				}
				else {
					dispatch.slideTo(items[self.currentIndex].id, false);
				}
			}});
	}, run: function(page, container, callback) {
		_gaq.push(['_trackPageview', page]);
		var self = this;
		self.currentElement = $("#" + page);
		$(window).unbind("resize");
		dispatch.displayMenu(container);
		if (page != "home") {
			var prev = self.currentElement.prev().find("> div");
			var next = self.currentElement.next().find("> div");
			var nextAll = self.currentElement.next().nextAll().find("> div");
			var prevAll = self.currentElement.prev().prevAll().find("> div");
			var current = self.currentElement.find("> div");
			prev.show();
			next.show();
			nextAll.hide();
			prevAll.hide();
			current.show();
			self.navContainer.addClass("off");
			self.navContainer.css({height: 32});
			self.maskMenu.css({bottom: 14});
			self.logo.css({bottom: -20, opacity: 0});
			self.social.css({bottom: -20, opacity: 0});
		}
		else {
			self.logo.css({bottom: 17, opacity: 1});
			self.social.css({bottom: 23, opacity: 1});
			self.navContainer.css({height: 63});
			self.maskNav.css({bottom: -34});
			self.maskHover.css({bottom: -43});
			self.maskMenu.css({bottom: -24, opacity: 1});
			self.navContainer.removeClass("off");
		}
		$(window).bind("resize", function() {
			$w = $(window);
			self.HEIGHT = $w.height();
			self.WIDTH = $w.width();
			dispatch.app.pageManager["bullittagency"].preview();
			$("#home-back-container").css({"padding-top": $(".navigator-item").size() * 135 + self.HEIGHT + 150, "padding-bottom": $(".navigator-item").size() * 135 + self.HEIGHT, backgroundPositionX: self.WIDTH, backgroundPositionY: self.HEIGHT + 48});
			dispatch.slideTo(container, true, true);
			dispatch.slidePage(dispatch.app.lastVignette, 0);
			dispatch.adjustSize();
		});
		dispatch.slideTo(container, false, dispatch.app.skipTransition);
		dispatch.app.skipTransition = false;
	}, adjustSize: function() {
		var self = this;
		self.main.removeClass("one two three four five six seven");
		if (self.HEIGHT < 720 && self.WIDTH < 1280) {
			self.main.addClass("one");
		}
		else if (self.HEIGHT < 810 && self.WIDTH < 1440) {
			self.main.addClass("two");
		}
		else if (self.HEIGHT < 900 && self.WIDTH < 1600) {
			self.main.addClass("three");
		}
		else if (self.HEIGHT < 1012 && self.WIDTH < 1800) {
			self.main.addClass("four");
		}
		else if (self.HEIGHT < 1152 && self.WIDTH < 2048) {
			self.main.addClass("five");
		}
		else if (self.HEIGHT < 1440 && self.WIDTH < 2560) {
			self.main.addClass("six");
		}
		else if (self.HEIGHT < 1600 && self.WIDTH < 2844) {
			self.main.addClass("seven");
		}
	}, initHome: function() {
		var self = this;
		dispatch.app.pageManager["bullittagency"].preview();
		dispatch.app.pageManager["ralphlauren"].preview();
		dispatch.app.pageManager["twist"].preview();
		dispatch.app.pageManager["sanofi"].preview();
		dispatch.app.pageManager["news"].preview();
		$(".home-back-item-transition", $("#home-back-container")).each(function() {
			var _this = $(this)[0];
			var spriteIn = new Blitter({width: 241, height: 241, resource: "skins/blacknegative/images/home/sprite.png", frameRate: 60, frameNumber: 26, delay: 0, loop: false, autoplay: false, target: _this});
			dispatch.app.vignetteList.push(spriteIn);
		});
		var currentSlide = 0;
		var nbItem = $(".navigator-item").size();
		dispatch.slidePage(0, 0);
		$("#home-back-container").css({"padding-top": nbItem * 135 + self.HEIGHT + 150, "padding-bottom": nbItem * 135 + self.HEIGHT, backgroundPositionX: self.WIDTH, backgroundPositionY: self.HEIGHT + 48});
		if (!dispatch.app.isiPad) {
			$("#nav-container").bind("mouseenter", function() {
				if (dispatch.app.currentPage != "home") {
					self.maskHover.show();
					EKTweener.to(self.maskHover[0], .4, {bottom: 0});
				}
			});
			$("#nav-container").mouseleave(function() {
				EKTweener.to(self.maskHover[0], .4, {bottom: -34, onComplete: function() {
						self.maskHover.hide();
					}});
			});
			$("#navigator-drag, #main-home").click(function() {
				self.maskHover.show();
				EKTweener.to(self.maskHover[0], .4, {bottom: 0});
				EKTweener.to($("#nav-container")[0], .4, {height: 32, onComplete: function() {
					}});
				dispatch.app.skipTransition = true;
				window.location.href = "#!/" + $("#handler > div").eq(currentSlide).attr("id") + "/";
			});
		}
		$("#mask-hover, #mask-menu").bind("click", function() {
			window.location = '#!/home/';
		});
		$("#nav-container").bind("touchstart", function() {
			window.location = '#!/home/';
		});
		$(".navigator-item").bind("mouseenter touchstart", function() {
			var duration = (self.menuOpen == false ? 0 : 1200);
			var index = $(this).index(".navigator-item");
			currentSlide = index + 1;
			EKTweener.to($("#navigator-drag")[0], .6, {left: 30 * (index)});
			dispatch.slidePage(index, duration);
		});
		$("a.ajax").each(function() {
			$(this).attr("href", "#!/" + $(this).attr('href')).removeClass("ajax");
		});
	}, displayMenu: function(container) {
		var self = this;
		if (container == "home") {
			self.nav.show();
			self.logo.show();
			self.social.show();
			self.credit.show();
		}
		else if (container == "loader") {
			self.credit.hide();
			self.nav.hide();
		}
		else {
			self.credit.hide();
			self.nav.show();
		}
	}, slidePage: function(currentPosition, timing) {
		var self = this;
		$(".home-front-item.selected").removeClass("selected");
		$(".home-front-item").eq(currentPosition).addClass("selected");
		var itemSelected = $(".home-back-item.selected");
		if (dispatch.app.vignetteList[dispatch.app.lastVignette])
			dispatch.app.vignetteList[dispatch.app.lastVignette].gotoAndStop(0);
		if (dispatch.app.vignetteList[currentPosition])
			dispatch.app.vignetteList[currentPosition].play();
		dispatch.app.lastVignette = currentPosition;
		itemSelected.removeClass("selected");
		$(".home-back-item").eq(currentPosition).addClass("selected");
		if (timing == 0) {
			$("#home-back-container").css({top: -($(".navigator-item").size() * 135 + self.HEIGHT / 2 + 250 + (135 * ($(".navigator-item").size() - currentPosition)) - 200), left: -(135 * currentPosition - (self.WIDTH / 2)) - self.WIDTH});
			$("#home-front-container").css({left: -(470 * currentPosition) + (self.WIDTH / 2) - 235});
		}
		else {
			var backBackground = $(".home-back-item").eq(currentPosition).find(".home-back-item-background");
			var backContainer = $("#home-back-container");
			var frontContainer = $("#home-front-container");
			var backTop = ($(".navigator-item").size() * 135 + self.HEIGHT / 2 + 250 + (135 * ($(".navigator-item").size() - currentPosition)) - 200);
			EKTweener.to(backBackground[0], .4, {opacity: 1});
			EKTweener.to(backContainer[0], 1, {top: -backTop, left: -(135 * currentPosition - (self.WIDTH / 2)) - self.WIDTH});
			EKTweener.to(frontContainer[0], 1, {left: -(470 * currentPosition) + (self.WIDTH / 2) - 235});
		}
	}, displayVertical: function(verticalPosition) {
		var self = this;
		EKTweener.to(self.main[0], 0.5, {top: verticalPosition, ease: "easeOutExpo", onComplete: function() {
				if (verticalPosition < 0) {
					self.modules.hide();
					self.menuOpen = true;
				}
				else {
					self.home.hide();
					self.menuOpen = false;
				}
			}});
	}, slideTo: function(container, resize, skip) {
		var self = this;
		self.currentIndex = self.currentElement.index();
		self.currentPosition = self.currentIndex * self.WIDTH;
		var verticalPosition = (container == "home" ? self.HEIGHT : 0);
		var itemSelected = $(".navigator-item.selected");
		var currentItem = $(".navigator-item").eq(self.currentIndex - 1);
		if (resize == true) {
			self.main.css("top", -verticalPosition);
			self.handler.css("left", -self.currentPosition);
		}
		else {
			self.modules.show();
			self.home.show();
			dispatch.app.lastPage = dispatch.app.currentPage;
			dispatch.app.currentPage = container;
			if (container == "loader") {
				dispatch.app.pageManager["loader"].init();
				self.handler.css({left: 0});
			}
			else if (container != "home") {
				self.menuOpen = false;
				itemSelected.removeClass("selected");
				currentItem.addClass("selected");
				self.maskNav.css({bottom: 0});
				dispatch.playSoundNav();
				if (skip == true) {
					self.handler.css({left: -self.currentPosition});
					if (dispatch.app.currentPage != dispatch.app.lastPage) {
						if (dispatch.app.lastPage != null && dispatch.app.currentPage != dispatch.app.lastPage && dispatch.app.lastPage != "home")
							dispatch.app.pageManager[dispatch.app.lastPage].stop();
						dispatch.app.pageManager[dispatch.app.currentPage].init();
					}
				}
				else {
					EKTweener.to(self.handler[0], .6, {left: -self.currentPosition, onComplete: function() {
							if (dispatch.app.currentPage != dispatch.app.lastPage) {
								if (dispatch.app.lastPage != null && dispatch.app.currentPage != dispatch.app.lastPage && dispatch.app.lastPage != "home")
									dispatch.app.pageManager[dispatch.app.lastPage].stop();
								dispatch.app.pageManager[dispatch.app.currentPage].init();
							}
						}});
				}
			}
			else {
				dispatch.playSoundSlide();
				self.menuOpen = true;
			}
			self.displayVertical(-verticalPosition);
		}
	}};
var dispatch = new Class();