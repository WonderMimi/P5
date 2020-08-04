


let contactButton = document.getElementById('contactButton');
let contactForm = document.getElementById('contactForm');

// console.log(Array.isArray($contactButton)); //false

contactButton.addEventListener("click", function(e){
	// document.body.style.backgroundColor = "red";
	e.preventDefault();
	contactForm.style.display = 'block';
	contactButton.style.display = 'none';
});











