class Basket {

	constructor() {
    	this.items = this.loadBasket();
   		console.log(this.items);
   		this.displayItemsBasket();
  	}

  	displayItemsBasket() {
  		if(this.items.length > 0) {
   			$('#itemBasket').text(this.items.length);
   		} else {
   			$('#itemBasket').text('');
   		}
  	}

	addToBasket(beerId, name, quantity, price) {
		
		beerId    = parseInt(beerId);
    	quantity  = parseInt(quantity);


		let item = {
			beerId: beerId,
			name: name,
			quantity: quantity,
			price: price
		}

		for(let index = 0; index < this.items.length; index++)
		{
		    if(this.items[index].beerId == beerId)
		    {
		      	this.items[index].quantity += quantity

		            this.saveBasket();

		            return true;
		    }
		}

		this.items.push(item);
		this.saveBasket();

	}

	loadBasket() {

		let items = loadDataFromDomStorage('basketBeer4you');
		
		if (items == null) {
			items = [];
		}

		return items;
	}

	saveBasket() {

		saveDataToDomStorage('basketBeer4you', this.items);	
		this.displayItemsBasket();	
	}

	displayCompleteBasket() {

		$('#displayBasket table tbody').empty();
		for (let i = 0; i < this.items.length; i++) {
			var tr = $('<tr>');
			tr.append('<td>'+this.items[i].quantity+'</td><td>'+this.items[i].name+'</td><td>'+this.items[i].price+'</td><td>'+(parseFloat(this.items[i].quantity)*parseFloat(this.items[i].price)) +'</td><td><button>Supprimer</button></td>')
			$('#displayBasket table tbody').append(tr);
		}

	}


}