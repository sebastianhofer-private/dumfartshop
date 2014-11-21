lib.nav.breadcrumb = COA
lib.nav.breadcrumb {
	wrap = <div class="container-fluid">|</div>

	10 = COA
	10 {
		wrap = <ol class="breadcrumb hidden-xs">|</ol>

		10 = HMENU
		10 {
			special = rootline
			special.range = 0

			includeNotInMenu = 1

			# remove extension detail pages from rootline
			# data record title is used instead. See also lib.nav.breadcrumb.20/30 below
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
	}

	20 = TEXT
	20 {
		value = Library
		wrap = <a href="#" class="visible-xs-block"><button class="btn btn-default btn-long btn-left"><i class="ds-icon-chevron-left"></i>|</button></a>
	}
}


