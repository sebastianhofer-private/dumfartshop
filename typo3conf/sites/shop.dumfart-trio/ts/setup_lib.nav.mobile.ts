lib.nav.mobile = COA
lib.nav.mobile {

	#header
	10 = COA
	10 {
		wrap = <div class="navbar-nav-header">|</div>

		10 = TEXT
		10.value = Menü
		10.wrap = <span class="nav-headline">|</span>

		20 = TEXT
		20.value = schließen
		20.wrap = <button type="button" class="navbar-toggle nav-close" data-toggle="offcanvas" data-target=".navmenu" data-canvas="body">| <i class="ds-icon-close"></i></button>
	}

	#Menu
	20 = COA
	20 {
		wrap = <ul class="nav navbar-nav">|</ul>

		#Start page
		10 = TEXT
		10 {
			value = Startseite
			typolink.parameter = {$uid.pages.root}
			wrap = <li>|</li>
		}

		# Cat Menu
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
				maxMenuDepth = 3
				menuType = 5
			}
		}

		20 = HMENU
		20 {
			entryLevel = 0
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
				IFSUB.wrapItemAndSub = <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">{field:nav_title // field:title}</a><ul class="dropdown-menu"  role="menu">|</ul></li>
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
				ACTIFSUB.wrapItemAndSub = <li class="dropdown"><a href="#" class="active dropdown-toggle" data-toggle="dropdown">{field:nav_title // field:title}</a><ul class="dropdown-menu"  role="menu">|</ul></li>


				CURIFSUB < .ACTIFSUB
				CURIFSUB = 1
				CURIFSUB.ATagParams = class="active"
			}

			2 < .1

			3 = TMENU
			3 {
				expAll = 1

				NO = 1
				NO.wrapItemAndSub = <li>|</li>

				CUR < .NO
				CUR = 1
				CUR.ATagParams = class="active"
			}
		}
	}
}