/*--------------------------------------------------------------
 Copyright (C) pixelemu.com
 License: http://www.pixelemu.com/license.html PixelEmu Proprietary Use License
 Website: http://www.pixelemu.com
 Support: info@pixelemu.com
---------------------------------------------------------------*/

(function($) {

	"use strict";

	$(document).ready(function() {

		$( ".pe-theme-elements-info" ).each(function() {
		  let widgetID = $( this ).attr('id');
		  widgetID = widgetID.replace(widgetID.match(/(\d+)/g)[0], '').trim(); // removes numbers
		  widgetID = widgetID.replace(/-/g, ' '); // replace all -
	      widgetID = widgetID.replace(/_/g, ' '); // replace all _
	      widgetID = widgetID.replace(/\w\S*/g, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();}); // capitalize first letters in each word
		  $( this ).children().children().children(".pe-theme-elements-info-type").append( widgetID );
		});

	});
	
})(jQuery);
