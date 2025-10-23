const data = null;

const xhr = new XMLHttpRequest();
xhr.withCredentials = true;

xhr.addEventListener('readystatechange', function () {
	if (this.readyState === this.DONE) {
		console.log(this.responseText);
	}
});

xhr.open('GET', 'https://booking-com15.p.rapidapi.com/api/v1/attraction/searchAttractions?id=eyJ1ZmkiOi0yMDkyMTc0fQ%3D%3D&sortBy=trending&page=1&currency_code=INR&languagecode=en-us');
xhr.setRequestHeader('x-rapidapi-key', 'd216cd50fcmshab7d60facfefe23p1462d3jsn1f28ca135bd8');
xhr.setRequestHeader('x-rapidapi-host', 'booking-com15.p.rapidapi.com');

xhr.send(data);
