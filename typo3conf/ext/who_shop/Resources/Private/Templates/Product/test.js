
$(document).ready(function () {
	// (1) define some post-parameters with action, controller and stuff for the action
	var params = {
		tx_myextension_pi1: {
			action : "ajax",
			controller : "Product"
		}
	};
	// (2) do the ajax-call
	$.post(url, params, function (json) {
		// (3) evaluate the response from server
		if (json && json.success) {
			$("#myContainer").html(json.content);
			return;
		}
		try {
			console.log(json);
		} catch (e) {

		}
	},
		"json");
});
