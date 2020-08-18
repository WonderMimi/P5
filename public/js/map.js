class Map{
	static init(){
		let map = document.getElementById('map');

		map = L.map('map').setView([map.dataset.lat, map.dataset.lng], 15);

		L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
			attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a>',
			maxZoom: 18,
			id: 'mapbox/streets-v11',
			tileSize: 512,
			zoomOffset: -1,
			accessToken: 'pk.eyJ1IjoibGl0dGxlbXkiLCJhIjoiY2p4aGRob2FyMWI3ZDN5bXc0NGNhZG1iZSJ9.AEJVuPskylswENDp4xeqog'
		}).addTo(map);

		let icon = L.icon({
			iconUrl: 'public/icons/marker-icon.png',
		})

		L.marker([map.dataset.lat,map.dataset.lng], {icon: icon}).addTo(map);

	}
}

let map = new Map();

