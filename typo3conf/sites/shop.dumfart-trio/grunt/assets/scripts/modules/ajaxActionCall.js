function ajaxActionCall(actionToCall, targetUrl, successFunction, eventObject, product, orderSize) {
	$('#loaderImage-wrapper').css('display', 'block');
	var params = {
		tx_whoshop_product: {
			forwardAction: actionToCall,
			product: product,
			ordersize: orderSize
		}
	};

	$.ajax({
		url: targetUrl,
		data: params,
		success: function(json){
			switch (successFunction){
				case 'addedToBasket': addedToBasket(json, eventObject);
					break;
				case 'removedFromBasket': removedFromBasket(json, eventObject);
					break;
				case 'updatedInBasket': updatedInBasket(json, eventObject, orderSize);
					break;
				case 'removedFromBasketList': removedFromBasketList(eventObject);
					break;
				default: doDefault();
			}
			$('#loaderImage-wrapper').css('display', 'none');
		},
		error: function(error) {
			console.log(error);
		}
	});
}


function addedToBasket(jsonObj, eventObj) {

	eventObj.removeClass('btn-primary');
	eventObj.removeClass('add-to-basket');
	eventObj.addClass('btn-danger');
	eventObj.addClass('remove-from-basket');
	eventObj.text('aus Warenkorb entfernen');
	eventObj.data('basket-event', 'remove');
	$('.order-size').css('visibility', 'hidden');
	//$('#basket-badge').text(jsonObj.value('basketcount'));
	//alert(jsonObj.val('basketcount'));
 }

function removedFromBasket(jsonObj, eventObj) {
	eventObj.removeClass('btn-danger');
	eventObj.removeClass('remove-from-basket');
	eventObj.addClass('btn-primary');
	eventObj.addClass('add-to-basket');
	eventObj.html('<span class="glyphicon glyphicon-shopping-cart"></span> Warenkorb <span class="glyphicon glyphicon-chevron-right"></span>');
	eventObj.data('basket-event', 'add');
	$('.order-size').css('visibility', 'visible');
	//$('#basket-badge').text(jsonObj.value('basketcount'));

}

function updatedInBasket(jsonObj, eventObj, size){
	var newVal = eventObj.next('p').data('single-value') * size,
		newSum = 0;
	eventObj.next('p').text(newVal.toFixed(2) + ' €');
	calcSum();
	calcTotal();

}

function removedFromBasketList(eventObj) {
	var toDelete = eventObj.data('parent-element');
	$('.' + toDelete).remove();
	calcSum();
	calcTotal();
}

function calcSum(){
	var newSum = 0,
		calculated = 0;
	$('.order-size-basketlist').each(function(){
		calculated = $(this).data('single-price') * $(this).val();
		newSum = newSum + calculated;
	});
	$('.basket-sum').text(newSum.toFixed(2) + ' €');
}

function calcTotal(){
	var newSum = 0,
		calculated = 0;
	$('.order-size-basketlist').each(function(){
		calculated = $(this).data('single-price') * $(this).val();
		newSum = newSum + calculated;
	});
	newSum = newSum + 5;
	$('.basket-total').text(newSum.toFixed(2) + ' €');
}

function doDefault(){
	//@todo: implement this function
	//if this function is called something bad is running ;-)
}
