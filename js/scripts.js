(function( root, $, undefined ) {
	"use strict";

	$(function () {
		$('.mobile-nav__button').click(function(){
			$(this).toggleClass('open');
			$(this).parent().toggleClass('open');
		});
	});

} ( this, jQuery ));