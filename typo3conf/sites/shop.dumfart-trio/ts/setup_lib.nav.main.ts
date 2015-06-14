/**
 * Main navigation
 *
 * @description		main navigation
 */
lib.nav.main = COA
lib.nav.main {
	10 = TEXT
	10 {
		typolink.parameter = {$uid.pages.root}
		value = Startseite
		wrap = <li>|</li>
	}

	15 = USER_INT
	15 {
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
			maxMenuDepth = 2
			menuType = 0
		}
	}

	20 = HMENU
	20 {
		entryLevel = 0

		excludeUidList = {$uid.pages.basket}

		1 = TMENU
		1 {
			expAll = 1

			noBlur = 1
			NO = 1
			NO.wrapItemAndSub = <li>|</li>

			ACT < .NO
			ACT = 1
			ACT.ATagParams = class="active"

			CUR < .NO
			CUR = 1
			CUR.ATagParams = class="active"

			IFSUB < .NO
			IFSUB = 1
			IFSUB.wrapItemAndSub = <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">{field:nav_title // field:title}<span class="ds-icon-chevron-down"></span></a><ul class="dropdown-menu"  role="menu">|</ul></li>
			IFSUB.wrapItemAndSub.insertData = 1
			IFSUB.linkWrap = <li>|</li>
			IFSUB.stdWrap.cObject = COA
			IFSUB.stdWrap.cObject {
				10 = TEXT
				10.data = field:nav_title // field:title

				15 = TEXT
				15.value = &nbsp;-&nbsp;

				20 = TEXT
				20.value = Übersicht
			}

			ACTIFSUB < .IFSUB
			ACTIFSUB = 1
			ACTIFSUB.wrapItemAndSub = <li class="dropdown"><a href="#" class="active dropdown-toggle" data-toggle="dropdown">{field:nav_title // field:title}<span class="ds-icon-chevron-down"></span></a><ul class="dropdown-menu"  role="menu">|</ul></li>


			CURIFSUB < .ACTIFSUB
			CURIFSUB = 1
			CURIFSUB.ATagParams = class="active"
		}

		2 = TMENU
		2 {
			expAll = 1

			NO = 1
			NO.wrapItemAndSub = <li>|</li>

			CUR < .NO
			CUR = 1
			CUR.ATagParams = class="active"
		}
	}

	wrap = <ul class="nav navbar-nav">|</ul>
}