jQuery ($) ->
	$body = $('body')
	$header = $('header')
	$headerWrap = $('.header-wrap')
	$logo = $('header .col-logo')
	$logoSvg = $('header svg')
	$intro = $('#intro')
	$main = $('main')
	$faders = $main.find('.inner_content')
	init = () ->
		adjustHeader()	

	adjustHeader = () ->
		scrollY = $(window).scrollTop()
		windowWidth = $(window).innerWidth()
		introBottom = $intro.innerHeight()
		introHalf = introBottom/2
		toAlign = scrollY/introHalf
		toResize = toAlign - 1
		headerHeight = $header.innerHeight()
		leftWidth = $main.find('.left.col').innerWidth()
		rightWidth = $main.find('.right.col').innerWidth()
		leftWidthPerc = leftWidth/windowWidth
		# console.log 'toAlign: '+toAlign
		if toAlign >= 1
			$header.addClass('aligned')
			if toResize <= 1
				leftGap = rightWidth*toResize
				logoWidth = ((windowWidth - leftGap)/windowWidth)*100
				$headerWrap.css
					height: 'auto'
				$header.removeClass('fixed')
				$faders.css
					opacity: toResize
			else
				logoWidth = (leftWidth/windowWidth)*100
				$headerWrap.css
					height: headerHeight
				$header.addClass('fixed')
				$faders.css
					opacity: 1

		else
			$header.removeClass('aligned')
			logoWidth = 100
			$faders.css
					opacity: 0

		# if logoWidth == leftWidth
		# 	$headerWrap.css
		# 		height: headerHeight
		# 	$header.addClass('fixed')
		# else
		# 	$headerWrap.css
		# 		height: 'auto'
		# 	$header.removeClass('fixed')
		
		$logo.css
			width: logoWidth+'%'

		if $header.is('.aligned')
			toAlign = 1
		for key, part of logoObj()
			initX = part.x
			initY = part.y
			newY = toAlign * -part.y + part.y
			newX = toAlign * -part.x + part.x
			$(part.elem).attr('transform','translate('+newX+','+newY+')')
			
	logoObj = () ->
		height = $(window).innerHeight()
		width = $(window).innerWidth()
		obj = 
			t:
				elem: $logoSvg.children().filter('g:eq(2)')
				x: -20
				y: -100
			b:
				elem: $logoSvg.children().filter('g:eq(1)')
				x: 100
				y: -80
			p:
				elem: $logoSvg.children().filter('g:eq(0)')
				x: -80
				y: 80
		return obj

	getTranslate = (svg) ->
		attrs = $(svg).attr('transform')
		b = {}
		attrs = attrs.match(/(\w+\((\-?\d+\.?\d*e?\-?\d*,?)+\))+/g)
		for attr in attrs
			c = attr.match(/[\w\.\-]+/g)
			b[c.shift()] = c
		return b['translate']


	$(window).scroll (e) ->
		adjustHeader()

	$(window).resize (e) ->
		adjustHeader()

	$ -> 
		init()