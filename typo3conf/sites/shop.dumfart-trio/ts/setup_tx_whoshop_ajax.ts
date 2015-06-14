tx_whoshop_ajax = PAGE
tx_whoshop_ajax {
	typeNum = 1105
	config {
		disableAllHeaderCode = 1
		xhtml_cleaning = 0
		admPanel = 0
		additionalHeaders = Content-type:application/json
		no_cache = 1
	}

	10 = USER
	10 {
		userFunc = TYPO3\CMS\Extbase\Core\Bootstrap->run
		pluginName    = Product
		extensionName = WhoShop
		vendorName    = WHO
		controller = Product
		action = ajax
		switchableControllerActions {
			Product {
				1 = ajax
			}
		}
		view < plugin.tx_myextension.view
		persistence < plugin.tx_myextension.persistence
		settings < plugin.tx_myextension.settings
	}
}