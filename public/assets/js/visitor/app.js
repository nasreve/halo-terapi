$(function () {
	/* ======================================
    * Button ripple
    ====================================== */
	"use strict";
	[].map.call(document.querySelectorAll('[anim="ripple"]'), (el) => {
		el.addEventListener("click", (e) => {
			e = e.touches ? e.touches[0] : e;
			const r = el.getBoundingClientRect(),
				d = Math.sqrt(Math.pow(r.width, 2) + Math.pow(r.height, 2)) * 2;
			el.style.cssText = `--s: 0; --o: 1;`;
			el.offsetTop;
			el.style.cssText = `--t: 1; --o: 0; --d: ${d}; --x:${e.clientX - r.left}; --y:${
				e.clientY - r.top
			};`;
		});
	});

	/* ======================================
    * Mobile drawer navigation
    ====================================== */
	$("#dismiss, .tbr_drawer_overlay, .tbr_change_photo").on("click", function () {
		$(".tbr_nav_drawer, .tbr_member_aside").removeClass("active");
		$(".tbr_drawer_overlay").removeClass("active");
	});
	$(".openDrawer").on("click", function () {
		$(".tbr_nav_drawer").addClass("active");
		$(".tbr_drawer_overlay").addClass("active");
		$(".collapse.in").toggleClass("in");
		$("a[aria-expanded=true]").attr("aria-expanded", "false");
	});
	$(".tbr_open_member_aside").on("click", function () {
		$(".tbr_member_aside").addClass("active");
		$(".tbr_drawer_overlay").addClass("active");
		$(".collapse.in").toggleClass("in");
		$("a[aria-expanded=true]").attr("aria-expanded", "false");
	});

	/* ======================================
    * On scroll fixed header
    ====================================== */
	$(window).scroll(function () {
		var scroll = $(window).scrollTop();
		if (scroll) {
			$("html").addClass("tbr_header_fixed");
		} else {
			$("html").removeClass("tbr_header_fixed");
		}
	});

	/* ======================================
    * Custom file input
    ====================================== */
	$(".custom-file-input").on("change", function () {
		let fileName = $(this).val().split("\\").pop();
		$(this).next(".custom-file-label").addClass("selected").html(fileName);
	});

	/* ======================================
    * Datepicker
    ====================================== */
	$(".datepicker").datepicker({
		format: "dd-mm-yyyy",
		autoclose: true,
		todayHighlight: true,
		language: "id",
	});

	/* ======================================
    * Avoid dropdown close on clicking outside
    ====================================== */
	$(".tbr_nav_auth").on("hide.bs.dropdown", function (e) {
		if (e.clickEvent) {
			e.preventDefault();
		}
	});

	/* ======================================
    * Main slider
    ====================================== */
	var backMainSliderButton ='<span class="slick-prev"><i class="icons icon-arrow-left"></i></span>';
	var nextMainSliderButton ='<span class="slick-next"><i class="icons icon-arrow-right"></i></span>';
	$(".tbr_main_slider").slick({
		prevArrow: backMainSliderButton,
		nextArrow: nextMainSliderButton,
		dots: true,
		arrows: true,
		infinite: true,
		slidesToShow: 1,
		slidesToScroll: 1,
		autoplay: true,
		autoplaySpeed: 4000,
		speed: 1500,
		pauseOnHover: false,
	});

	/* ======================================
    * Review carousel
    ====================================== */
    var backReviewCarouselButton ='<span class="slick-prev"><i class="icons icon-arrow-left"></i></span>';
	var nextReviewCarouselButton ='<span class="slick-next"><i class="icons icon-arrow-right"></i></span>';
	$(".tbr_reviews").slick({
		prevArrow: backMainSliderButton,
		nextArrow: nextMainSliderButton,
		arrows: false,
		dots: true,
		infinite: true,
		slidesToShow: 2,
		slidesToScroll: 2,
		autoplay: true,
		autoplaySpeed: 20000,
		speed: 1500,
		pauseOnHover: false,
		responsive: [
			{
				breakpoint: 992,
				settings: {
					slidesToShow: 2,
					slidesToScroll: 2,
					vertical: false,
					verticalSwiping: false,
					arrows: false,
					dots: true,
				},
			},
			{
				breakpoint: 768,
				settings: {
					slidesToShow: 1,
					slidesToScroll: 1,
					vertical: false,
					verticalSwiping: false,
					arrows: true,
					dots: false,
				},
			},
			{
				breakpoint: 486,
				settings: {
					slidesToShow: 1,
					slidesToScroll: 1,
					vertical: false,
					verticalSwiping: false,
					arrows: true,
					dots: false,
				},
			},
		],
	});

	/* ======================================
    * Back to top
    ====================================== */
	var btn = $("#tbr_back_to_top");
	$(window).scroll(function () {
		if ($(window).scrollTop() > 300) {
			btn.addClass("show");
		} else {
			btn.removeClass("show");
		}
	});
	btn.on("click", function (e) {
		e.preventDefault();
		$("html, body").animate({ scrollTop: 0 }, "300");
	});

	/* ======================================
    * Login switch
    ====================================== */
	$(".tbr_form_switch").click(function () {
		var test = $(this).val();
		$(".tbr_form_auth").hide().removeClass("tbr_form_active");
		$("#Area" + test)
			.show()
			.addClass("tbr_form_active");
	});

	/* ======================================
    * Scroll to services section
    ====================================== */
	$(".tbr_btn_slider").click(function () {
		$("html, body").animate(
			{
				scrollTop: $("#SectionService").offset().top - 50,
			},
			1000
		);
	});

	/* ======================================
    * Custom pnotify and sample toast
    ====================================== */
	if (typeof PNotify != "undefined") {
		PNotify.prototype.options.styling = "fontawesome";
		$.extend(true, PNotify.prototype.options, {
			shadow: false,
		});
		$.extend(PNotify.styling.fontawesome, {
			container: "notification",
			notice: "notification-warning",
			info: "notification-info",
			success: "notification-success",
			error: "notification-danger",
			notice_icon: "fas fa-exclamation",
			info_icon: "fas fa-info",
			success_icon: "fas fa-check",
			error_icon: "fas fa-times",
		});
	}
	var stack_topleft = { dir1: "down", dir2: "left", push: "bottom", spacing1: 50, spacing2: 100 };
	var iconSuccess = "tbr_icon_success";
	var iconError = "tbr_icon_error";
	// Sample
	$("#custom-icon-primary").click(function () {
		var notice = new PNotify({
			title: "Berhasil",
			text: "Anda telah berhasil melakukan pendaftaran di haloterapi.",
			addclass: "notification-primary",
			icon: iconSuccess,
			type: "success",
			stack: stack_topleft,
			width: "348px",
			buttons: {
				sticker: false,
			},
		});
	});
	$("#custom-icon-error").click(function () {
		var notice = new PNotify({
			title: "Opss!",
			text: "Akun telah diblokir dari aplikasi ini dikarenakan melanggar ketentuan yang berlaku atau hal lainnya.",
			addclass: "notification-error",
			icon: iconError,
			type: "error",
			stack: stack_topleft,
			width: "348px",
			buttons: {
				sticker: false,
			},
		});
	});

	if (typeof(blocked) !== 'undefined' && blocked == "true") {
		new PNotify({
			title: "Opss!",
			text: "Akun telah diblokir dari aplikasi ini dikarenakan melanggar ketentuan yang berlaku atau hal lainnya.",
			addclass: "notification-error",
			icon: iconError,
			type: "error",
			stack: stack_topleft,
			width: "348px",
			buttons: {
				sticker: false,
			},
		});
	}

	if (typeof(sessionExpired) !== 'undefined' && sessionExpired == "true") {
		new PNotify({
			title: "Opss!",
			text: "Sesi Anda telah kedaluwarsa dikarenakan tidak ada aktivitas permintaan terhadap sistem.",
			addclass: "notification-error",
			icon: iconError,
			type: "error",
			stack: stack_topleft,
			width: "348px",
			buttons: {
				sticker: false,
			},
		});
	}

	$(function () {
		$(".tbr_page_loader").fadeOut( "slow" );
	})
});