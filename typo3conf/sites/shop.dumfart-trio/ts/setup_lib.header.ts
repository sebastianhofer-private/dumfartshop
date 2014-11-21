lib.header = COA
lib.header {

	10 = IMAGE
	10 {
		file = {$path.res}assets/img/img_header_2.jpg
		params = class="img-responsive img-rounded"
		wrap = <div class="page-header dumfart-heder hidden-xs">|</div>
	}

	20 = TEXT
	20 {
		value = Eigenverlag Dumfart
		wrap = <div class="mobile-header visible-zero-block"><p class="h1">|</p></div>
	}

	wrap = |<div class="visible-xs-block header-margin"></div>
}