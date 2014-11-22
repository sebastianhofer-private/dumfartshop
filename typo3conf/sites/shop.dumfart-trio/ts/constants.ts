/**
 * General Settings
 *
 * @description		misc settings
 */
setting {
	host = shop.dumfart-trio.at
	protocol = http://
	admPanel = 0
	no_cache = 0
	concatenateJs = 0
	concatenateCss = 1
	compressJs = 1
	compressCss = 1
	index_enable = 1
	sendCacheHeaders = 1
	sendCacheHeaders_onlyWhenLoginDeniedInBranch = 1
	#tx_realurl_enable = 1
}

/**
 * Path
 *
 * @description
 */
path {
	res = typo3conf/sites/shop.dumfart-trio/
}

/**
 * Uids
 *
 * @description		various uid constants for use in setup ts files
 */
uid {
	pages {
		root = 1
	}
}

/**
 * tx_who_cat_menu
 */

plugin.tx_whoshop.settings {
	storagePid = 1
	rootParent = 1
	#maxMenuDepth = 0
	menuType = 0 #default menu type
	listPageUid = 5
	defaultCategory = 2
}


/**
 * Language Settings
 *
 * @description		settings and labels for languages
 */
<INCLUDE_TYPOSCRIPT: source="FILE: typo3conf/sites/shop.dumfart-trio/ts/constants_lang.ts">

/**
 * Local Settings
 *
 * @description		specific settings for local environment
 */
<INCLUDE_TYPOSCRIPT: source="FILE: typo3conf/sites/shop.dumfart-trio/ts/constants.development.ts">