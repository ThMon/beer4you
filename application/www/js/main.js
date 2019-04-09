'use strict';

/////////////////////////////////////////////////////////////////////////////////////////
// FONCTIONS                                                                           //
/////////////////////////////////////////////////////////////////////////////////////////
let basket = new Basket();

if(window.location.href.indexOf('/product') != -1) {

	$('.addToBasket').on('click', function(event) {
		event.preventDefault();
		let id = $(this).data('id');
		let name = $(this).data('name');
		let quantity = $('#beer-'+id).val();
		let price = $(this).data('price');

		console.log(id);
		console.log(name);
		console.log(quantity);
		basket.addToBasket(id, name, quantity, price);
	});

}

if(window.location.href.indexOf('/basket') != -1) {
	console.log('panier');
	basket.displayCompleteBasket();

}

/////////////////////////////////////////////////////////////////////////////////////////
// CODE PRINCIPAL                                                                      //
/////////////////////////////////////////////////////////////////////////////////////////

