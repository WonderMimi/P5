// import Places from 'places.js'
// TODO: fix import issue

// let inputAddress = document.querySelector('#property_address');
// let place = Places({
// 	container: inputAddress
// })
//
// place.addEventListener('change', e => {
// 	document.querySelector('#property_city').value = e.suggestion.city;
// 	document.querySelector('#property_postal_code').value = e.suggestion.postcode;
// 	document.querySelector('#property_lat').value = e.suggestion.latlng.lat;
// 	document.querySelector('#property_lng').value = e.suggestion.latlng.lng;
// })
//=====================================================================
// Form button and animation to contact the estate agent

let contactButton = document.getElementById('contactButton');
let contactForm = document.getElementById('contactForm');

// console.log(Array.isArray($contactButton)); //false

contactButton.addEventListener("click", function(e){
	// document.body.style.backgroundColor = "red";
	e.preventDefault();
	contactForm.style.display = 'block';
	contactButton.style.display = 'none';
});
//=====================================================================














