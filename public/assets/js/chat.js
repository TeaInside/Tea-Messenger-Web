class chat
{
	constructor(user, self_id)
	{
		this.user = user;
		this.self_id = self_id;
	}

	noMsg()
	{
		domId('main-chat').innerHTML = "<div style=\"margin-top:23%;\"><p style=\"font-size:15px;\">No messages here yet...</p></div>";
	}

	buildMessage(data)
	{
		this.bound = JSON.parse(decodeURIComponent(domId('bound').value));
		var x;
		for(x in data) {
			// domId('main-chat').innerHTML+="<div><span>"+this.bound[data[x]['sender']]+"</span>";
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
						alert(e.message);
					}
				}
			};
			ch.withCredentials = true;
			ch.open("GET", "/chat/" + this.user + "/get");
			ch.send(null);
	}

	listen()
	{
		var that = this;
		domId('sendbox').addEventListener('submit', function () {
			var context = that.buildPostContext();
			if (context !== false) {
				var ch = new XMLHttpRequest();
					ch.onreadystatechange = function () {
						if (this.readyState === 4) {
							alert(this.responseText);
						}
					};
					ch.withCredentials = true;
					ch.open("POST", "/chat/" + that.user + "/post");
					ch.send(context);
			}
		});
	}

	buildPostContext()
	{
		var rq = {
			"text": domId('txt').value
		};
		if (rq['text']=="") {return false;}
		return JSON.stringify(rq);
	}
}