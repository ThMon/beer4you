'use strict';

/////////////////////////////////////////////////////////////////////////////////////////
// FONCTIONS                                                                           //
/////////////////////////////////////////////////////////////////////////////////////////
let basket = new Basket();

$('#userButton').on('mouseover', function() {
	$('.under-nav-list').removeClass('hide');
});

$('.under-nav-list').on('mouseout', function() {
	$('.under-nav-list').addClass('hide');
});

if(window.location.href.indexOf('/products') != -1) {

	$('.addToBasket').on('click', function(event) {
		event.preventDefault();
		let id = $(this).data('id');
		let name = $(this).data('name');
		let quantity = $('#beer-'+id).val();
		let price = $(this).data('price');

		if(isNaN(quantity) || $('#beer-'+id).val == '') {
			$('#errorPopUp').removeClass('hide');
			$('#beer-'+id).val('');
		} else {
			console.log(id);
			console.log(name);
			console.log(quantity);
			basket.addToBasket(id, name, quantity, price);
			$('#productPopUp').removeClass('hide');
			$('#beerNumber').text(quantity);
			$('#beer-'+id).val('');

		}

		
	});

	$('.closePopUp').on('click', function(event) {
		$('#productPopUp').addClass('hide');
		$('#errorPopUp').addClass('hide');
	});

	

}

if(window.location.href.indexOf('/basket') != -1) {
	console.log('panier');
	basket.displayCompleteBasket();

	$(document).on('click', '.trash-beer', function(event) {
		event.preventDefault();
		let id = $(this).data('index');
		basket.removeToBasket(id);
	});
}
/*

if(window.location.href.indexOf('/product/update') != -1) {
	console.log('laaaaaa');

	$('#beer_pict').on('change', function(event) {
		console.log($('#beer_pict').val());
		$('.b-form img').attr('src', $('#beer_pict').val());
	})

}

*/
/////////////////////////////////////////////////////////////////////////////////////////
// CODE PRINCIPAL                                                                      //
/////////////////////////////////////////////////////////////////////////////////////////

