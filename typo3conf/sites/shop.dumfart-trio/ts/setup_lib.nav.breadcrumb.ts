lib.nav.breadcrumb = COA
lib.nav.breadcrumb {
	wrap = <div class="container-fluid breadcrumb-container">|</div>

	10 = COA
	10 {
		wrap = <ol class="breadcrumb hidden-xs">|</ol>

		10 = HMENU
		10 {
			special = rootline
			special.range = 0

			includeNotInMenu = 1

			# remove extension detail pages from rootline
			excludeUidList = {$plugin.tx_whoshop.settings.listPageUid}

			1 = TMENU
			1 {
				NO = 1
				NO {
					linkWrap = <li>|</li>
					stdWrap.htmlSpecialChars = 1
					ATagTitle.field = title
					stdWrap.innerWrap = <span itemprop="title">|</span>
					ATagParams = itemprop="url"
				}


				CUR = 1
				CUR < .NO
				CUR {
					linkWrap = <li class="active">|</li>
					doNotLinkIt = 1
				}
			}
		}

		20 = USER
		20 {
			userFunc      = TYPO3\CMS\Extbase\Core\Bootstrap->run
			pluginName    = Category
			extensionName = WhoShop
			vendorName    = WHO
			controller    = Category
			action        = menu
			switchableControllerActions {
				Category {
					1 = menu
					2 = switch
				}
			}
			settings{
				isNavBreadcrumb = 1
				rootParent = 1
				maxMenuDepth = 3
				menuType = 3
				catGiven = 0
			}
		}

		30 = RECORDS
		30 {
			stdWrap.if.isTrue.data = GP:tx_whoshop_product|product
			dontCheckPid = 1
			tables = tx_whoshop_domain_model_product
			source.data = GP:tx_whoshop_product|product
			source.intval = 1
			conf.tx_whoshop_domain_model_product = TEXT
			conf.tx_whoshop_domain_model_product {
				field = title
				htmlSpecialChars = 1
			}
			wrap = <li class="active">|</li>
		}

		40 = RECORDS
		40 {
			stdWrap.if.isTrue.data = GP:tx_whoshop_product|product|__identity
			dontCheckPid = 1
			tables = tx_whoshop_domain_model_product
			source.data = GP:tx_whoshop_product|product|__identity
			source.intval = 1
			conf.tx_whoshop_domain_model_product = TEXT
			conf.tx_whoshop_domain_model_product {
				field = title
				htmlSpecialChars = 1
			}
			wrap = <li class="active">|</li>
		}
	}

	20 = COA
	20 {

		#
		# @TODO add if for following HMENU to hide it when a given list of pages is called
		#
		10 = HMENU
		10 {
			stdWrap.if {
				value = {$plugin.tx_whoshop.settings.listPageUid}
				isInList.data = page:uid
				negate = 1
			}
			special = rootline
			special.range = -2|0

			includeNotInMenu = 1

			# remove extension detail pages from rootline
			excludeUidList = {$plugin.tx_whoshop.settings.listPageUid}

			1 = TMENU
			1 {
				NO = 1
				NO {
					stdWrap.htmlSpecialChars = 1
					ATagTitle.field = title
					stdWrap.innerWrap = <button class="btn btn-default btn-long btn-left"><i class="ds-icon-chevron-left"></i>|</button>
					ATagParams = class="visible-xs-block"
				}
			}
		}


		20 = USER
		20 {
			userFunc      = TYPO3\CMS\Extbase\Core\Bootstrap->run
			pluginName    = Category
			extensionName = WhoShop
			vendorName    = WHO
			controller    = Category
			action        = menu
			switchableControllerActions {
				Category {
					1 = menu
					2 = switch
				}
			}
			settings{
				isNavBreadcrumb = 1
				rootParent = 1
				maxMenuDepth = 3
				menuType = 4
				catGiven = 0
			}
		}
	}
}


