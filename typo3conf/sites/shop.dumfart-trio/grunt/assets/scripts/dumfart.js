$(document).ready(function() {
	equalHeights('.equal-heights', '.caption', 0);
	$(window).resize(function() {
		equalHeights('.equal-heights', '.caption', 0);
	});

	$('.basket-event').click(function() {

		var product = $(this).data('product'),
			targetUrl = $(this).data('targeturl'),
			basketEvent = $(this).data('basket-event');

		if(basketEvent == 'remove'){
			ajaxActionCall('removeFromBasket',targetUrl,'removedFromBasket',$(this), product,0);
		}else if(basketEvent == 'add') {
			ajaxActionCall('addToBasket', targetUrl, 'addedToBasket', $(this), product,$(this).data('order-size'));
		}else if(basketEvent == 'removeBasket') {
			ajaxActionCall('removeFromBasket',targetUrl,'removedFromBasketList',$(this), product,0);
		}
	});

	$('#order-size-single').change(function(){
		$('.basket-event').data('order-size', $(this).value());
	});

	$('.order-size-basketlist').change(function(){
		var product = $(this).data('product'),
			targetUrl = $(this).data('targeturl');
		ajaxActionCall('updateOrderSize', targetUrl, 'updatedInBasket', $(this), product,$(this).val());
	});
	//$('#binding-order')


});