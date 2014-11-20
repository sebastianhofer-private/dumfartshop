/**
 * TSConfig
 *
 * @description		Backend Configuration
 */

options.clearCache.pages = 1
options.clearCache.all = 1

RTE.default {
	contentCSS = typo3conf/sites/shop.dumfart-trio/css/rte.css
	showButtons := addToList(left, center, right, line)
 	hideButtons = blockstyle, showhelp, about, blockstylelabel, spellcheck, chMode
}

mod.SHARED {
	defaultLanguageLabel = de_DE
	defaultLanguageFlag = de.gif
}

# permissions
TCEMAIN.permissions.groupid = 1
TCEMAIN.permissions.userid = 1
TCEMAIN.permissions.group = show,edit,delete,new,editcontent


<INCLUDE_TYPOSCRIPT: source="FILE: typo3conf/sites/shop.dumfart-trio/ts/tsconfig_page.TCEFORM.ts">