(function($) {
	"use strict";
	$(document).ready(function() {
		/*-----------------------------------------------------------------------------------*/
		/*  Home icon in main menu
		/*-----------------------------------------------------------------------------------*/ 
			if($('body').hasClass('rtl')) {
				$('.main-navigation .menu-item-home:first-child > a').append('<i class="fa fa-home spaceLeft"></i>');
			} else {
				$('.main-navigation .menu-item-home:first-child > a').prepend('<i class="fa fa-home spaceRight"></i>');
			}
		/*-----------------------------------------------------------------------------------*/
		/*  Detect touch screen device
		/*-----------------------------------------------------------------------------------*/ 
			var mobileDetect = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
		/*-----------------------------------------------------------------------------------*/
		/*  Top Search Button
		/*-----------------------------------------------------------------------------------*/ 
			if ( $( '.main-search-box' ).length ) {
				$('.main-social-box').addClass('withS');
			}
			$('.main-search-box').click(function() {
				if($('.main-social-box').hasClass('active')) {
					$('.socialLine').slideUp('fast');
					$('.main-social-box').removeClass("active");
					$('.main-social-box').html('<i class="fa fa-share-alt"></i>');
					setTimeout(function() {
						$('#search-full').slideToggle('fast');
						$('.main-search-box').toggleClass("active");
						if($('.main-search-box').hasClass('active')) {
							$('.main-search-box').html('<i class="fa fa-times"></i>');
						} else {
							$('.main-search-box').html('<i class="fa fa-search"></i>');
						}
					}, 400);
				} else {
					$('#search-full').slideToggle('fast');
					$('.main-search-box').toggleClass("active");
					if($('.main-search-box').hasClass('active')) {
						$('.main-search-box').html('<i class="fa fa-times"></i>');
					} else {
						$('.main-search-box').html('<i class="fa fa-search"></i>');
					}
				}
				if (!mobileDetect) {
					$("#search-full #search-field").focus();
				}
				return false;
			});
		/*-----------------------------------------------------------------------------------*/
		/*  Top Social Button
		/*-----------------------------------------------------------------------------------*/ 
			$('.main-social-box').click(function() {
				if($('.main-search-box').hasClass('active')) {
					$('#search-full').slideUp('fast');
					$('.main-search-box').removeClass("active");
					$('.main-search-box').html('<i class="fa fa-search"></i>');
					setTimeout(function() {
						$('.socialLine').slideToggle('fast');
						$('.main-social-box').toggleClass("active");
						if($('.main-social-box').hasClass('active')) {
							$('.main-social-box').html('<i class="fa fa-times"></i>');
						} else {
							$('.main-social-box').html('<i class="fa fa-share-alt"></i>');
						}
					}, 400);
				} else {
					$('.socialLine').slideToggle('fast');
					$('.main-social-box').toggleClass("active");
					if($('.main-social-box').hasClass('active')) {
						$('.main-social-box').html('<i class="fa fa-times"></i>');
					} else {
						$('.main-social-box').html('<i class="fa fa-share-alt"></i>');
					}
				}
				return false;
			});
		/*-----------------------------------------------------------------------------------*/
		/*  Flash News Ticker
		/*-----------------------------------------------------------------------------------*/ 
			if ( $( '#lontanoFlash' ).length ) {
				if ( $( '.main-search-box' ).length && $( '.main-social-box' ).length ) {
					$('.flashNews').addClass('withAll');
				}
				if ( ($( '.main-search-box' ).length && !$( '.main-social-box' ).length) || ($( '.main-social-box' ).length && !$( '.main-search-box' ).length) ) {
					$('.flashNews').addClass('withHalf');
				}
				$('#lontanoFlash').css('padding-left',$('.flashNews strong').outerWidth());
				$('#lontanoFlash').newsTicker({
					  row_height: 40,
					  max_rows: 1,
					  speed: 400,
					  direction: 'up',
					  duration: 4000,
					  autostart: 1,
					  pauseOnHover: 1
				});
			} else {
				if ( $( '.main-search-box' ).length && $( '.main-social-box' ).length ) {
					$('.lontanoTop').append('<div class="flashNews withAll"></div>');
				}
				if ( ($( '.main-search-box' ).length && !$( '.main-social-box' ).length) || ($( '.main-social-box' ).length && !$( '.main-search-box' ).length) ) {
					$('.lontanoTop').append('<div class="flashNews withHalf"></div>');
				}
			}
		/*-----------------------------------------------------------------------------------*/
		/*  Menu Widget
		/*-----------------------------------------------------------------------------------*/
			if ( $( 'aside ul.menu' ).length ) {
				$('aside ul.menu').find("li").each(function(){
					if($(this).children("ul").length > 0){
						$(this).append("<span class='indicatorBar'></span>");
					}
				});
				$('aside ul.menu > li.menu-item-has-children .indicatorBar, .aside ul.menu > li.page_item_has_children .indicatorBar').click(function() {
					$(this).parent().find('> ul.sub-menu, > ul.children').toggleClass('yesOpenBar');
					$(this).toggleClass('yesOpenBar');
					var $self = $(this).parent();
					if($self.find('> ul.sub-menu, > ul.children').hasClass('yesOpenBar')) {
						$self.find('> ul.sub-menu, > ul.children').slideDown(300);
					} else {
						$self.find('> ul.sub-menu, > ul.children').slideUp(200);
					}
				});
			}
		/*-----------------------------------------------------------------------------------*/
		/*  Mobile Menu
		/*-----------------------------------------------------------------------------------*/ 
			if ($( window ).width() <= 1024) {
				$('.main-navigation').find("li").each(function(){
					if($(this).children("ul").length > 0){
						$(this).append("<span class='indicator'></span>");
					}
				});
				$('.main-navigation ul > li.menu-item-has-children .indicator, .main-navigation ul > li.page_item_has_children .indicator').click(function() {
					$(this).parent().find('> ul.sub-menu, > ul.children').toggleClass('yesOpen');
					$(this).toggleClass('yesOpen');
					var $self = $(this).parent();
					if($self.find('> ul.sub-menu, > ul.children').hasClass('yesOpen')) {
						$self.find('> ul.sub-menu, > ul.children').slideDown(300);
					} else {
						$self.find('> ul.sub-menu, > ul.children').slideUp(200);
					}
				});
			}
			$(window).resize(function() {
				if ($( window ).width() > 1024) {
					$('.main-navigation ul > li.menu-item-has-children, .main-navigation ul > li.page_item_has_children').find('> ul.sub-menu, > ul.children').slideDown(300);
				}
			});
		/*-----------------------------------------------------------------------------------*/
		/*  Detect Mobile Browser
		/*-----------------------------------------------------------------------------------*/ 
		if (!mobileDetect) {
			/*-----------------------------------------------------------------------------------*/
			/*  Scroll To Top
			/*-----------------------------------------------------------------------------------*/ 
				$(window).scroll(function(){
					if ($(this).scrollTop() > 700) {
						$('#toTop').addClass('visible');
					} 
					else {
						$('#toTop').removeClass('visible');
					}
				}); 
				$('#toTop').click(function(){
					$("html, body").animate({ scrollTop: 0 }, 1000);
					return false;
				});
		}
	});
})(jQuery);