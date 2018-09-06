//Add commas between variables

var activeGlance = null;
var activeShuttlePage = null;
var ctaLogo;
var content;
var content_original_margin;
var event_banner;
var event_banner_height;
var event_nav;
var event_nav_height;
var global_nav;
var global_nav_height;
var isEventNavOpen = false;
var isEventNavSticky = false;
var isMobile;
var nav_items;
var openSubPage = null;
var isAnimating = false;
var isHome;

var mobileBreak = 768;

$(document).ready(function(){
	this_window = $(window);
	ctaLogo = $('.cta_logo');
	content = $('#content');
	content_original_margin = $('#content').css('margin-top');
	event_banner = $('.event_banner');
	event_nav = $('.event_nav_wrap');
	global_nav = $('.main_nav');
	nav_items = $('.global_nav a');
	isHome = $('body').hasClass('home');
	isMobile = $('#content').hasClass('mobile');
  isEventsPage = $('.js-events-page').length > 0;

	this_window.resize(function(){

		if(!isMobile) {
			setCollapsePoints();
			setUpArrows();

		}
	});

	//ARROWS

	if (!isMobile){
		setUpArrows();
		setHovers();
	}

	setCollapsePoints();

	if (event_banner.length > 0){
		prepEventNav();
		this_window.scroll(function(e){
			var scrollTop = this_window.scrollTop();
		    elementOffset =  event_nav.length ? event_nav.offset().top : 0;
		    distance = (elementOffset - scrollTop);

		   	if(isEventNavSticky) {
		   		elementOffset = event_banner.offset().top + event_banner.outerHeight(true);
		   		distance = elementOffset - scrollTop - event_nav_height;

		   		distance > 0 && unstickEventNav();

		   	} else if (distance < global_nav_height) {
		    	// ctaLogo.addClass('collapse');
		    	difference = -(global_nav_height - distance) + 'px';

		    	global_nav.css('top', difference);

		    	distance <= 0 ? stickEventNav() : unstickEventNav();

		    } else {
		    	// ctaLogo.removeClass('collapse');
		    	global_nav.css('top', '0px');
		   	}
		});
	} else {
    this_window.scroll(function(e){
			var scrollTop = this_window.scrollTop();
		    elementOffset =  event_nav.length ? event_nav.offset().top : 0;
		    distance = (elementOffset - scrollTop);

		   	if (scrollTop > 0) {
		    	ctaLogo.addClass('collapse');

		    } else {
		    	ctaLogo.removeClass('collapse');
		   	}
		});
  }

	if (isHome){
		var navSticky = false;
		var target = global_nav.offset().top;

		this_window.scroll(function(e){
			var scrollTop = this_window.scrollTop();

			if (scrollTop > target && !navSticky ){
				navSticky = true;
				global_nav.addClass('sticky');
			}

			if (scrollTop < target && navSticky){
				navSticky = false;
				global_nav.removeClass('sticky');
			}
		});
  }

  if (isEventsPage){

    eventPageSections = $('.js-events-page-section');
    eventNavLinks = $('.js-events-page-nav-link');

    function checkPageSection(windowPos){
      $.each(eventPageSections, function(index, section){
        var sectionOffset = $(section).offset().top;
        var sectionHeight = $(section).outerHeight();

        if ( windowPos > sectionOffset - (window.innerHeight / 2) ){
          $activeLink = $(eventNavLinks[index]);
          $('.js-events-page-nav-item.is-active').removeClass('is-active');
          $activeLink.parents('.js-events-page-nav-item').addClass('is-active');
        }
      })
    }

    this_window.scroll(function(e){
			var pos = this_window.scrollTop();
      checkPageSection(pos);
		});
  }


	$('.mobile-menu-toggle').on('click', function(e){
		console.log(e);
		toggleNavMenu();
	});

  $('.js-events-page-nav-link').on('click', function(e){
    e.preventDefault();
    $('.js-events-page-nav-item.is-active').removeClass('is-active');
    $(this).parents('.js-events-page-nav-item').addClass('is-active');

    var linkEventId = $(this).data('event');
    var targetEvent = $('.js-events-page-section[data-event="' + linkEventId + '"]');
    var offset = targetEvent.offset().top - global_nav.outerHeight();

    $('html').velocity("scroll", {duration: 600, offset: offset, mobileHA: false, easing: [.4, 0, .6, 1]});
  })
});

function toggleNavMenu(){
	var mainNav = $('.main_nav');
	var nav = $('.global_nav_wrap');

	mainNav.toggleClass('active');

	var dY = mainNav.hasClass('active') ? 0 : -window.innerHeight * 2;

	nav.velocity({
		translateY: dY
	}, 300, [.4, .7, .8, 1])
}


function setCollapsePoints(){
	global_nav_height = global_nav.outerHeight(true);
	event_banner_height = event_banner.outerHeight(true);
	event_nav_height = event_nav.outerHeight(true);
}

function stickEventNav(){
	console.log('stickEVentNav');
	event_nav.addClass('fixed');
	margin = (event_nav_height) + parseInt(content_original_margin);
	content.css('margin-top', margin);
	isEventNavSticky = true;
}

function unstickEventNav(){
	event_nav.removeClass('fixed');
	content.css('margin-top', content_original_margin);
	isEventNavSticky = false;
}

function closeEventNav(){
  $('.js-event-nav-link.active').removeClass('active');
	$('.menu_bottom').removeClass('open');
	$('.event_nav_wrap').removeClass('open');
	isEventNavOpen = false;
}

function openEventNav(){
	$('.menu_bottom').addClass('open');
	$('.event_nav_wrap').addClass('open');
	isEventNavOpen = true;
}

function prepEventNav(){

	$('ul.shuttle_pages > li > a').click(function(e){
		e.preventDefault();

		var clickedShuttlePage = $(this).parent().index();

		if(! isEventNavOpen){
			openEventNav();
			activeShuttlePage = clickedShuttlePage;
			$("ul.sub_pages").hide();
			$(this).parent().find('ul.sub_pages').show();
		} else {
			if(clickedShuttlePage == activeShuttlePage)
			{
				// closeEventNav();
				$(this).removeClass('active');
			} else {
				$("ul.sub_pages").hide();
				$(this).parent().find('ul.sub_pages').show();
				activeShuttlePage = clickedShuttlePage;
			}
		}
	});

	var all_glances = $('.glances > .glance');
	var parent_glances = $('.glances > .parent_glance');

	$('.js-close-event-menu').on('click', function(e){
		closeEventNav();
	})

	$(".shuttle_pages > li").click(function(e){

		if ($(this).hasClass('active')){
			$(this).removeClass('active');
      closeEventNav();
			$('.sub_pages').hide();
			return;
		}

		items = $('.shuttle_pages > li');
		items.removeClass('active');
		$(this).addClass('active');

		if(isEventNavOpen)
		{
			e.preventDefault();
			var anchors = $('.shuttle_pages > li > a');
			anchors.removeClass('active');
			var clickedIndex = $(this).index();
			$('.sub_pages').hide();
			$('.sub_pages').eq(clickedIndex).show();
			$(this).children('a').addClass('active');
		}
	});

	$(".shuttle_pages > li").hover(
		function(){
			var nextActiveGlance = parent_glances.eq($(this).index());
			if(activeGlance){
				activeGlance.removeClass('active');
			}

			activeGlance = nextActiveGlance;
			activeGlance.addClass('active');
		},
		function(){

		}
	);

	$('.sub_pages li a').hover(
		function(){
			//Set hover state on
			$('.sub_pages li a').removeClass('active');
			$(this).addClass('active');

			var nextActiveGlance = all_glances.eq($(this).parent('li').attr('data-counter'));
			if(activeGlance){
				activeGlance.removeClass('active');
			}

			activeGlance = nextActiveGlance;
			activeGlance.addClass('active');
		},
		function(){

		}
	);
}

function lockScroll(){
	$('html').css('overflow', 'hidden');
}

function unlockScroll(){
	$('html').css('overflow', 'visible');
}




//****
// Main Nav Arrow Animations
//****

//Colors
var mcm_red = '#E31B23';
var mcm_gold = '#FED130';
var gray = '#303030';
var mcm_blue = '#122343';
var numAnimated = 0;
var arrowWidth;
var canAnimate = true;

function setUpArrows(){
	searchIcon = $('.search_icon');
	arrow = $('.arrow');
	arrowWidth = Math.max(arrow.width(), 7);
	//Get position of the last nav item
	var searchOffset = searchIcon.offset().left - searchIcon.parent().offset().left + searchIcon.width();
	var numberOfPossibleArrows = Math.ceil(searchOffset / arrowWidth - arrow.length);
	console.log(numberOfPossibleArrows);

	numberOfPossibleArrows > 0 ? addArrows(numberOfPossibleArrows) : removeArrows(numberOfPossibleArrows)
}

function addArrows(numberOfPossibleArrows){
	for(var i = 1; i < numberOfPossibleArrows; i++)
	{
		$('.arrows').append('<svg version="1.1" class="arrow" x="0px" y="0px" viewBox="-299.2 385 9.5 23.2" style="enable-background:new -299.2 385 9.5 23.2; fill: #303030;" xml:space="preserve"><title>Fill 2 Copy 4</title><desc>Created with Sketch.</desc><g id="Page-1" sketch:type="MSPage"><g id="Race-Landing-Page" transform="translate(-314.000000, -29.000000)" sketch:type="MSArtboardGroup"><g id="Group" transform="translate(238.000000, 29.000000)" sketch:type="MSLayerGroup"><path id="Fill-2-Copy-4" sketch:type="MSShapeGroup" class="st0" d="M-223.2,408.2l4.7-11.6l-4.7-11.6h4.7l4.7,11.6l-4.7,11.6 H-223.2"/></g></g></g></svg>');
	}
}

function removeArrows(numberOfPossibleArrows){
	for(var i = 1; i < Math.abs(numberOfPossibleArrows); i++){
		$('.arrow').first().remove();
	}

}

function setHovers()
{
	var nav_items = $('.nav_link');

	$(nav_items).on('mouseenter', function(){
			if(canAnimate) {
				hoverOn(nav_items, $(this));
			}
	});

	$(".global_nav").mouseleave(function(){
		numAnimated = 0;
		clearArrows($(this));
	});
}

function hoverOn(nav_items, item){
	var index = item.index();
	var calculated_width = 0;
	var this_width = 0;

	var navItemOffset = item.offset().left - item.parent().offset().left + item.width();

	var numArrowsToAnimate = Math.ceil(navItemOffset / arrowWidth  - numAnimated);

	numArrowsToAnimate > 0 ? 	animateArrowsOn(numArrowsToAnimate) : 	animateArrowsOff(numArrowsToAnimate);

}

function animateArrowsOn(numToAnimate)
{
	var arrows = $(".arrow").slice(0, numToAnimate);

	TweenMax.staggerTo('.arrow', .15, {
		'fill': gray,
		y: 0,
	}, .01 )

	TweenMax.staggerTo(arrows, .15, {
		'fill': mcm_red,
		y: -3,
		delay: .01
	}, .01 )

	TweenMax.staggerTo(arrows, .15, {
		'fill': mcm_gold,
		delay: .1
	}, .01 )
}

function animateArrowsOff(numToAnimate)
{
	var arrows = $(".arrow").slice(0, numToAnimate);

	TweenMax.staggerTo(arrows, .15, {
		'fill': red,
	}, .01 )

	TweenMax.staggerTo(arrows, .15, {
		'fill': gray,
		y: 0,
		delay: .05
	}, .01 )
}

function hoverOff(nav_items, item)
{
	animateArrowsOff(item);
}


function clearArrows(item)
{
	var arrows = $(".arrow");

	TweenMax.staggerTo(arrows, .15, {
		fill: mcm_red,
		y: -3,
	}, .01 )

	TweenMax.staggerTo(arrows, .15, {
		fill: gray,
		y: 0,
		delay: .05
	}, .01 )
}
