/**
 * config
 *
 * @description		config parameters for a transitional site with strict language mode
 */
config {
	###### HEADER ######
	doctype = html5
	htmlTag_stdWrap.override (
<!--[if lt IE 7]> <html lang="{$lang.config.language}" class="no-js ie6"> <![endif]-->
<!--[if IE 7]> <html lang="{$lang.config.language}" class="no-js ie7"> <![endif]-->
<!--[if IE 8]> <html lang="{$lang.config.language}" class="no-js ie8"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="{$lang.config.language}" class="no-js"> <!--<![endif]-->
	)
	noPageTitle = 2
	disablePrefixComment = 1
	metaCharset = utf-8
	renderCharset = utf-8
	disablePrefixComment = 1
	headerComment (
Sebastian Hofer
sebastian.hofer@s-hofer.de
	)

	###### LANGUAGE ######
	linkVars = L
	sys_language_uid = {$lang.config.sys_language_uid}
	sys_language_mode = {$lang.config.sys_language_mode}
	language = {$lang.config.language}
	locale_all = {$lang.config.locale_all}
	htmlTag_langKey = {$lang.config.htmlTag_langKey}
	sys_language_overlay = {$lang.config.sys_language_overlay}
	htmlTag_langKey = {$lang.config.language}
	htmlTag_dir = {$lang.config.htmlTag_dir}

	###### TYPOLINK ######
	absRefPrefix = {$setting.protocol}{$setting.host}/
	baseURL = {$setting.protocol}{$setting.host}/
	prefixLocalAnchors = all
	typolinkCheckRootline = 0
	content_from_pid_allowOutsideDomain = 1
	extTarget = _blank

	###### ADMIN ######
	admPanel = {$setting.admPanel}
	no_cache = {$setting.no_cache}
	index_enable = {$setting.index_enable}
	concatenateJs = {$setting.concatenateJs}
	concatenateCss = {$setting.concatenateCss}
	compressJs = {$setting.compressJs}
	compressCss = {$setting.compressCss}
	sendCacheHeaders = {$setting.sendCacheHeaders}
	sendCacheHeaders_onlyWhenLoginDeniedInBranch = {$setting.sendCacheHeaders_onlyWhenLoginDeniedInBranch}

	###### REALURL ######
	tx_realurl_enable = {$setting.tx_realurl_enable}
}
