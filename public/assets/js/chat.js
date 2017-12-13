class chat
{
	constructor(url)
	{
		this.url = url;
	}

	noMsg()
	{
		// domId('main-chat').innerHTML = "<div style=\"margin-top:23%;\"><p style=\"font-size:15px;\">No messages here yet...</p></div>";
	}

	buildMessage(data)
	{
		var x;
		for(x in data) {
			alert(data[x][0]);
		}
	}

	get()
	{
		var ch = new XMLHttpRequest(), that = this;
			ch.onreadystatechange = function () {
				if (this.readyState === 4) {
					try {
						var a = JSON.parse(this.responseText);
						if (a == "") {that.noMsg()} else {that.buildMessage(a)}
					} catch (e) {
						alert(this.responseText);
					}
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