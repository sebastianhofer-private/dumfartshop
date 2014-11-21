/**
 * page
 * 
 * @description		default page object
 */
page = PAGE
page {
	typeNum = 0

	headerData {
		# favicon
		#10 = TEXT
		#10 {
		#	value = <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico" />
		#	append = TEXT
		#	append.char = 10
		#}

		# title
		20 =< lib.headerData.pageTitle.default
	}

	10 =< lib.template.main

	meta {
		keywords.data.field = keywords
		description.data.field = description
		robots = index, follow
	}

	includeCSS {
		10 = {$path.res}assets/css/jasny-bootstrap.min.css
		20 = {$path.res}assets/css/application.css
	}

	includeJSlibs {
		jQuery = {$path.res}assets/js/jquery.min.js
		#modernizr = {$path.res}assets/js/modernizr.min.js
		bootstrap = {$path.res}assets/js/bootstrap.js
		jasny = {$path.res}assets/js/jasny-bootstrap.min.js
	}

	includeJS {
		10 = {$path.res}assets/js/application.js
	}
}