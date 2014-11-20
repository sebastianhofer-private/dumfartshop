/**
 * Page Title
 *
 * @description		generates the <title> tag
 */
lib.headerData.pageTitle.default = TEXT
lib.headerData.pageTitle.default {
	field = subtitle // title
	htmlSpecialChars = 1
	noTrimWrap = |<title>| - {$lang.label.organisation}</title>|
	append = TEXT
	append.char = 10
}