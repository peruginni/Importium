/**
 * On file load
 */

// empty


/**
 * On document ready
 */
$(function(){


        /**
         * links
         */
//	$("a:not([href^='"+baseUrl+"'])").attr('target','_blank').addClass("external");
//	var ignoredUri = [
//		"a[href^='#']",
//		"a[href^='?']",
//		"a[href^='mailto:']",
//		"a[href^='javascript:']",
//		"a[href^='skype:']",
//		"a[href^='"+baseUrl.replace(/www\./,'')+"']"
//	];
//	for(var i = 0; i < ignoredUri.length; i++) {
//		$(ignoredUri[i]).attr('target','').removeClass("external");
//	}

        /**
         * colorbox
         */
//        $(function(){
//            $("a[rel=lightbox], .typotheme a[href$='.jpg'], .typotheme a[href$='.png']").colorbox();
//        });

	/**
	 * Confirmation before requesting delete of item
	 */
	$('.confirmRemove').click(function(ev){
		if(!confirm('Do you really want to delete this item?')) {
			ev.preventDefault();
		}
	});

});
