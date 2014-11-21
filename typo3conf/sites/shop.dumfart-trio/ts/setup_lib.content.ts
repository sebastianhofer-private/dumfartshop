/**
 * Content Middle
 *
 * @description		assign content middle
 */
lib.content = COA
lib.content {
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
			isContentCatNav = 1
			#rootParent.insertData = 1
			maxMenuDepth = 1
			menuType = 1
		}
	}

	20 < styles.content.get

	wrap = <div class="container-fluid">|</div>
}