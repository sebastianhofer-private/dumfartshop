lib.nav.secondary = COA
lib.nav.secondary {
	10 = USER
	10 {
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
			isNavSecondary = 1
			#rootParent.insertData = 1
			maxMenuDepth = 1
			menuType = 2
			catGiven = 0
		}
	}

	20 = HMENU
	20 {
		entryLevel = 2
		1 = TMENU
		1 {
			noBlur = 1
			NO = 1
			NO.ATagParams = class="list-group-item"

			ACT < .NO
			ACT = 1
			ACT.ATagParams = class="list-group-item active"

			CUR < .NO
			CUR = 1
			CUR.ATagParams = class="list-group-item active"
		}
	}

	wrap = <div class="panel panel-primary hidden-xs"><div class="list-group">|</div></div>
}