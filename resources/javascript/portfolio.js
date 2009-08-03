var p = {
	init: function () {
		//set-up headers
		$('#portfolio li.header h2').each(function () {
			var header_img = $(this).text().replace('&', '').replace('  ', ' ').replace(/[\W]/g, '_').toLowerCase()+'_header.png';
			$(this).css('background-image', 'url(resources/images/'+header_img+')').parent().addClass('image_header');
		});
		
		p.init_scroll();
		
		var scrollTop = $('#scrollbar').css('top');
		
		$('#portfolio .header').each(function () {
			$(this).css({
				position: 'relative',
				left: '-400px'
			});
		});
		$('#scrollbar').css({
			top: -300,
			opacity: 0
		});
		$('#portfolio .item').each(function () {
			//store top and left position
			var position = $(this).position();
			$(this).data('top', position.top);
			$(this).data('left', position.left);
			
			//position it
			$(this).css({
				position: 'relative',
				top: Math.random() * 601 - 300 + 'px',
				left: $(this).data('left') == 0 ? -640 : $(this).data('left') == 640 ? 640 : Math.random() * 101 - 50,
				opacity: 0
			});
		});
		$('footer').css({
			position: 'relative',
			left: '-480px',
			opacity: 0
		});
		
		$('header').css({
			'position': 'relative',
			'top': '-200px'
		}).animate({
			'top': 0
		}, 500, function () {
			var i = 0;
			$('#portfolio .item').each(function () {
				//position it
				$(this).animate({
					top: 0,
					left: 0,
					opacity: 1
				}, 250, 'swing', i == 0 ? function () {
					$('#portfolio .header').each(function () {
						$(this).animate({
							top: 0,
							left: 0
						}, 250, 'swing', function () {
							$('#scrollbar').animate({
								top: scrollTop,
								opacity: 1
							}, 300);
							$('footer').animate({
								left: 0,
								opacity: 1
							}, 300);
						});
					});
				} : null);
				
				i++;
			});
		});
		$('#portfolio .item').click(function () {
			p.show(this);
		}).css('cursor', 'pointer');
	},
	init_scroll: function () {
		//get rid of system scrollbar
		$('#content_window').css('overflow', 'hidden');
		
		$('body').bind('selectstart', function () { return false; });
		
		//add custom scrollbar
		var scrollbar = $('<div id="scrollbar"></div>');
		if ($('#portfolio').height() > $('#content_window').height()) {
			scrollbar.css('cursor', 'pointer').mousedown(function (event) {
				p._mouseY  = event.pageY;
				p._scrollY = parseInt($('#scrollbar').css('top').replace('px', ''));
				
				$('body').bind('mousemove', p.scroll_mousemove);
				$('body').bind('mouseup', function () {
					$('body').unbind('mousemove', p.scroll_mousemove);
				});
			}).mouseup(function () {
				$('body').unbind('mousemove', p.scroll_mousemove);
			});
		}
		else {
			scrollbar.addClass('disabled');
		}
		$('#site').append(scrollbar);
		
		//adjust scrollbar for when browser remembers scroll position
		var diff    = $('#portfolio').height() - $('#content_window').height();
		var percent = $('#content_window').scrollTop() / diff;
		var newY    = percent * 400 + 8;
		if (newY < 8) newY = 8;
		if (newY > 408) newY = 408;
		$('#scrollbar').css('top', newY);
		
		//add scroll wheel events
		var scrollEvent = function (event) {
			var delta = 0;
			if (!event) /* For IE. */
				event = window.event;
			if (event.wheelDelta) { /* IE/Opera. */
				delta = event.wheelDelta/120;
				/** In Opera 9, delta differs in sign as compared to IE.
				*/
				if (window.opera)
					delta = -delta;
				if ($.browser.safari) {
					delta = delta * .5;
				}
			}
			else if (event.detail) { /** Mozilla case. */
				/** In Mozilla, sign of delta is different than in IE.
				* Also, delta is multiple of 3.
				*/
				delta = -event.detail/60;
			}
			
			if (delta) {
				p.scroll(delta);
			}
			
			if (event.preventDefault)
				event.preventDefault();
			event.returnValue = false;
		};
		$('#content_window').bind('mousewheel', scrollEvent);
		$('#content_window').bind('DOMMouseScroll', scrollEvent);
		
		//add scroll masks
		$('#site').append('<div id="scroll_mask_top"></div>');
		$('#site').append('<div id="scroll_mask_bottom"></div>');
	},
	scroll: function (delta) {
		if ($('#portfolio').height() > $('#content_window').height()) {
			var diff   = $('#portfolio').height() - $('#content_window').height();
			var offset = diff * delta;
			
			$('#content_window').scrollTop($('#content_window').scrollTop() - offset);
			
			//adjust scrollbar
			var percent = $('#content_window').scrollTop() / diff;
			var newY    = percent * 400 + 8;
			if (newY < 8) newY = 8;
			if (newY > 408) newY = 408;
			
			$('#scrollbar').css('top', newY);
		}
		//$('#content_window').scrollTop();
	},
	scroll_mousemove: function (event) {
		var change = event.pageY - p._mouseY;
		var newY   = p._scrollY + change;
		
		if (newY < 8) newY = 8;
		if (newY > 408) newY = 408;
		
		$('#scrollbar').css('top', newY);
		
		var pos     = parseInt($('#scrollbar').css('top').replace('px', '')) - 8;
		var percent = pos / 400;
		
		if ($('#portfolio').height() > $('#content_window').height()) {
			var diff   = $('#portfolio').height() + 10 - $('#content_window').height();
			var offset = diff * percent;
			
			$('#content_window').scrollTop(offset);
		}
	},
	show: function (item) {
		var title       = $(item).find('img').attr('title');
		var large_image = $(item).find('.large_image').attr('data');
		var description = $(item).find('.description').attr('data');
		var style       = $(item).find('.style').attr('data');
		
		//make sure that a large image is available
		if (large_image === '') return false;
		
		//create shadow
		var shadow      = $('<div id="shadow"></div>').height($('body').height()).hide();
		shadow.appendTo('body');
		shadow.fadeIn(500);
		shadow.click(function () {
			$('#shadow').fadeOut(500, function () {
				$('#shadow').remove();
			});
			$('#modal').animate({
				top: '-402px',
				opacity: 0
			}, 500, function () {
				$('#modal').remove();
			});
			$('#modal .info').animate({
				right: '-250px'
			}, 250);
		});
		
		//create window
		var modal       = $('<div id="modal"></div>');
		modal.addClass(style !== '' && style === 'light' ? 'light' : 'dark');
		modal.css({
			'background-image': 'url(resources/portfolio/'+large_image+')',
			'top': '-402px',
			'opacity': 0
		});
		
		//add info
		modal.append('<div class="info"><h2>'+title+'</h2><p>'+description+'</p></div>');
		
		modal.appendTo('#site');
		modal.animate({
			top: '-2px',
			opacity: 1
		}, 500, function () {
			modal.find('.info').animate({
				right: 0
			}, 250);
		});
	}
};

$(window).load(function () {
	p.init();
});