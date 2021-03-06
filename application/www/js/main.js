'use strict';

/////////////////////////////////////////////////////////////////////////////////////////
// FONCTIONS                                                                           //
/////////////////////////////////////////////////////////////////////////////////////////
let basket = new Basket();
let state = false;
$('#userButton').on('mouseover', function() {
	$('.under-nav-list').removeClass('hide');
});

$('.under-nav-list').on('mouseout', function() {
	$('.under-nav-list').addClass('hide');
});

$('#burger-button').on('click', showNav);
$('header').on('click', hideNav);
//$('main').on('click', hideNav);

function showNav(event) {
	event.preventDefault();
	
	if (state == false) {
		$('.nav-column').fadeIn('slow');
		state = true;
	} else {
		$('.nav-column').fadeOut('slow');
		state = false;
	}
}

function hideNav(event) {
	event.preventDefault();
	if(state == true) {
		$('.nav-column').fadeOut('slow');
		state = false;
	}
}

if(window.location.href.indexOf('/products') != -1) {

	$('.addToBasket').on('click', function(event) {
		event.preventDefault();
		let id = $(this).data('id');
		let name = $(this).data('name');
		let quantity = $('#beer-'+id).val();
		let price = $(this).data('price');

		if(isNaN(quantity) || quantity == '') {
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

if(window.location.href.indexOf('/payment') != -1) {

		basket.loadBasketInInput('#orders');
}

if(window.location.href.indexOf('/success') != -1) {
		console.log('success');
		basket.clearBasket();
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

