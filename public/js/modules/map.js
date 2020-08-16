import * as map from "leaflet";

class Map{
	static init(){
		let map = L.map('map').setView([map.dataset.lat, map.dataset.lng], 13);

		L.tileLayer('https://a.tile.openstreetmap.org/${z}/${x}/${y}.png', {
			attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>',
			maxZoom: 18,
			tileSize: 512,
			zoomOffset: -1
		}).addTo(map);

		let icon = L.icon({
			iconUrl: 'public/icons/marker-icon.png',
		})

		L.marker([map.dataset.lat,map.dataset.lng], {icon: icon}).addTo(map);

	}
}



