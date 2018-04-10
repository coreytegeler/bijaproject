jQuery ($) ->
	$body = $('body')
	$header = $('header')
	$headerWrap = $('.header-wrap')
	$logo = $('header .col-logo')
	$logoSvg = $('header svg')
	$intro = $('#intro')
	$introCont = $intro.find('.container')
	$main = $('main')
	$mainRow = $main.find('.main-row')
	$faders = $main.find('.inner-content')
	
	init = () ->
		adjustHeader()	

	adjustHeader = () ->
		scrollY = $(window).scrollTop()
		windowWidth = $(window).innerWidth()
		windowHeight = $(window).innerHeight()
		winSize = getSize()
		headerTop = $headerWrap.position().top
		introBottom = $introCont.offset().top + $introCont.innerHeight()
		mainTop = $main.offset().top
		toAlign = scrollY/introBottom
		toResize = scrollY/mainTop
		resizeFactor = toAlign - 1
		headerHeight = $header.innerHeight()
		leftWidth = $main.find('.left.col').innerWidth()
		rightWidth = $main.find('.right.col').innerWidth()
		leftWidthPerc = leftWidth/windowWidth
		if toAlign >= 1
			$header.addClass('aligned')
			resizeFactor = (scrollY - introBottom)/(headerTop - introBottom)
			if resizeFactor < 1
				leftGap = rightWidth*resizeFactor
				logoWidth = ((windowWidth - leftGap)/windowWidth)*100
				$headerWrap.css
					height: 'auto'
				$header.removeClass('fixed')
				$mainRow.attr('style', '')
				$main.removeClass('fixed')
				$faders.css
					opacity: resizeFactor
			else
				toResize = 1
				logoWidth = (leftWidth/windowWidth)*100
				$headerWrap.css
					height: headerHeight
				$header.addClass('fixed')
				$main.attr('style','')
				if !isSize(['xs', 'sm'])
					$main.addClass('fixed')
					$mainRow.css
						height: windowHeight - headerHeight
						top: headerHeight
				else
					$main.removeClass('fixed')
					$mainRow.attr('style','')
					$main.css
						height: windowHeight - headerHeight
				$faders.css
					opacity: 1
		else
			$header.removeClass('aligned')
			logoWidth = 100
			$faders.css
				opacity: 0
		
		if !isSize(['xs', 'sm']) && toResize < 1
			$logo.css
				width: Math.floor(logoWidth)+'%'
		else 
			$logo.attr('style','')

		if $header.is('.aligned')
			toAlign = 1
		for key, part of logoObj()
			initX = part.x
			initY = part.y
			newY = toAlign * -part.y + part.y
			newX = toAlign * -part.x + part.x
			if isSize(['xs','sm'])
				newY = 0
				newX = 0
			$(part.elem).attr('transform','translate('+newX+','+newY+')')
			
	logoObj = () ->
		height = $(window).innerHeight()
		width = $(window).innerWidth()
		obj = 
			t:
				elem: $logoSvg.children().filter('g:eq(2)')
				x: -50
				y: -100
			b:
				elem: $logoSvg.children().filter('g:eq(1)')
				x: 100
				y: -100
			p:
				elem: $logoSvg.children().filter('g:eq(0)')
				x: -100
				y: 100
		return obj

	getTranslate = (svg) ->
		attrs = $(svg).attr('transform')
		b = {}
		attrs = attrs.match(/(\w+\((\-?\d+\.?\d*e?\-?\d*,?)+\))+/g)
		for attr in attrs
			c = attr.match(/[\w\.\-]+/g)
			b[c.shift()] = c
		return b['translate']

	getSize = () ->
		bodyBefore = window.getComputedStyle($body[0], '')
		size = bodyBefore.getPropertyValue('content')
		size = size.replace(/"/g,'')

	isSize = (sizes) ->
		if !Array.isArray(sizes)
			sizes = [sizes]
		winSize = getSize()
		for size in sizes
			if size == winSize
				return true
		return false

	$(window).scroll (e) ->
		adjustHeader()

	$(window).resize (e) ->
		adjustHeader()

	$ -> 
		init()
		getSize()