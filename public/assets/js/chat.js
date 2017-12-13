class chat
{
	constructor(url)
	{
		this.url = url;
	}

	get()
	{
		var ch = new XMLHttpRequest();
			ch.onreadystatechange = function () {
				if (this.readyState === 4) {
					alert(this.responseText);
				}
			};
			ch.withCredentials = true;
			ch.open("GET", this.url + "/get");
			ch.send(null);
	}

	listen()
	{

	}
}