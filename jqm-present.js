/* 	jQuery Mobile Presentation
	By : Mike More | http://www.moretechtips.net
	licensed under a Creative Commons Attribution-ShareAlike 3.0 Unported License. */

(function($) {
	
// change slide with transition set in data-transition
var changeSlide = function(toSlide){
	if(toSlide.length) $.mobile.changePage( toSlide, { transition: toSlide.jqmData('transition') } );
};

// get home slide
var getHomeSlide = function(){
	return $(':jqmData(role=page):first');
};
// go home
var goHome = function(){
	changeSlide( getHomeSlide() );
	return false;
};

// get next slide
var getNextSlide = function(slide){
	return slide.next(':jqmData(role=page)');
};
// go next slide
var goForward = function(){
	changeSlide( getNextSlide($.mobile.activePage) );
	return false;
};

// get previous slide
var getPrevSlide = function(slide){
	return slide.prev(':jqmData(role=page)');
};
// go previous slide
var goBack = function(){
	changeSlide( getPrevSlide($.mobile.activePage) );
	return false;
};


// responsive lazy-loading images
var loadImages = function(slide) {
	var width = $(window).width();
	// use large image for screens bigger than 480px, otherwise use small size
	var attrName = width > 480? 'large' : 'small';

	$('img:jqmData('+attrName+')', slide).each(function(){
		var img = $(this);
		var source = img.jqmData(attrName);
		// set img src with large/small image then remove data
		if(source) img.attr('src', source).jqmRemoveData(attrName);
	});
};

// Handle arrows and swipe events
$(document).keydown(function(e) {
    if(e.keyCode ==39) goForward(); //right
    else if(e.keyCode ==37) goBack(); //left
})
.bind("swiperight", goForward )
.bind("swipeleft", goBack );

// Handle slide on before-create event
$(':jqmData(role=page)').live( 'pagebeforecreate',function(event){
	var slide = $(this);

	// find footer or add it
	var footer = $(":jqmData(role=footer)", slide );
	if( !footer.length ) {
		footer = $('<div data-role="footer" data-position="fixed" data-fullscreen="true"/>').appendTo(slide);
	};

	// add nav. bar
	footer.html('<div data-role="navbar">'+
					'<ul>'+
						'<li><a data-icon="back"></a></li>'+
						'<li><a data-icon="home"></a></li>'+
						'<li><a data-icon="forward"></a></li>' +
					'</ul>'+
				'</div>');

	// Handle nav. bar clicks
	var backButton = $(':jqmData(icon=back)', footer).click( goBack );
	var homeButton = $(':jqmData(icon=home)', footer).click( goHome );
	var forwardButton = $(':jqmData(icon=forward)', footer).click( goForward );

	// get home, next and previous slides
	var prevSlide = getPrevSlide( slide ), homeSlide = getHomeSlide(), nextSlide = getNextSlide( slide ) ;

	// prev slide exists?
	if( prevSlide.length ) {
		// set href to slide ID
		backButton.attr('href', '#'+ prevSlide.attr('id') );
		homeButton.attr('href', '#'+ homeSlide.attr('id') )
	}else{
		// disable buttons otherwise
		backButton.addClass('ui-disabled');
		homeButton.addClass('ui-disabled')
	};

	// next slide exists?
	if( nextSlide.length ) {
		// set href to slide ID
		forwardButton.attr('href', '#'+ nextSlide.attr('id') )
	}else{
		// disable button otherwise
		forwardButton.addClass('ui-disabled')
	};

	// lazy-load images in this slide
	loadImages(slide);

	// lazy-load images in next slide after 3 sec
	if( nextSlide.length ) {
		setTimeout( function(){ loadImages( nextSlide ) } , 3000)
	}
});
	
})(jQuery);	