jQuery ($) ->
	$body = $('body')
	$header = $('header')
	$headerWrap = $('.header-wrap')
	$logo = $('header .col-logo')
	$logoSvg = $('header svg')
	$intro = $('#intro')
	$main = $('main')
	init = () ->
		adjustHeader()	

	adjustHeader = () ->
		scrollY = $(window).scrollTop()
		introBottom = $intro.innerHeight()
		introHalf = introBottom/2
		percentToHalf = scrollY/introHalf
		headerHeight = $header.innerHeight()
		smallLogoWidth = 50

		if percentToHalf >= 1
			$header.addClass('aligned')
			logoWidth = smallLogoWidth
			if percentToHalf <= 2
				widthDivide = percentToHalf/2
				subFactor = widthDivide*100 - smallLogoWidth
				logoWidth = 100 - subFactor
		else
			$header.removeClass('aligned')
			logoWidth = 100

		if logoWidth == smallLogoWidth
			$headerWrap.css
				height: headerHeight
			$header.addClass('fixed')
		else
			$headerWrap.css
				height: 'auto'
			$header.removeClass('fixed')

		
		$logo.css
			width: logoWidth+'%'

		if $header.is('.aligned')
			percentToHalf = 1
		for key, part of logoObj()
			initX = part.x
			initY = part.y
			newY = percentToHalf * -part.y + part.y
			newX = percentToHalf * -part.x + part.x
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