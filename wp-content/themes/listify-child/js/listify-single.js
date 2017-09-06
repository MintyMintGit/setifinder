(function($) {

	$(document).ready(function () {
	
		$('.single-job_listing-cover-gallery-slick').on('lazyLoaded', alignSlider);
		$(window).resize(alignSlider);

	});

	function alignSlider() {

		var minH = 0, // set unreal height
			$imgs = $(this).find('img');

		$imgs.each(function (i, el) {
			var h = $(el).height();
			// h == 0 when image is not loaded
			if(minH == 0
				|| h !== 0 && h < minH) {
				minH = h;
			}
		});

		if(minH !== 0) {
			$imgs.each(function (i, el) {
				var h = $(el).height();
				// h == 0 when image is not loaded
				if(h !== 0 && h > minH) {
					var offset = (h - minH) / 2;
					$(el).css('top', -offset);
				}
			});

			// update container height
			$('.listing-cover').outerHeight(minH);
		}
			
	}

})(jQuery);