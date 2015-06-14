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
	concatenateCss = 0
	compressJs = 0
	compressCss = 0
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

		basket = 8
	}
}

/**
 * tx_who_cat_menu
 */

plugin.tx_whoshop.settings {
	storagePid = 7
	rootParent = 1
	#maxMenuDepth = 0
	menuType = 0 #default menu type
	listPageUid = 5
	defaultCategory = 2
}

plugin.tx_femanager {
	view {
		# cat=plugin.tx_femanager/file; type=string; label= Path to template root (FE)
		templateRootPath = typo3conf/sites/shop.dumfart-trio/html/ext/femanager/Templates/

		# cat=plugin.tx_femanager/file; type=string; label= Path to template partials (FE)
		partialRootPath = typo3conf/sites/shop.dumfart-trio/html/ext/femanager/Partials/

		# cat=plugin.tx_femanager/file; type=string; label= Path to template layouts (FE)
		layoutRootPath = typo3conf/sites/shop.dumfart-trio/html/ext/femanager/Layouts/
	}
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