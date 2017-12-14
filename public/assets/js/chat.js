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
		domId('main-chat').innerHTML = "";
		for(x in data) {
			 domId('main-chat').innerHTML += (this.bound[data[x]['sender']]['status'] === "self" ? '<div class="brg"><div class="wfg gfn"><span>'+this.bound[data[x]['sender']]['name']+'</span><img src="/assets/img/users/'+this.bound[data[x]['sender']]['photo']+'" style="width:50px;border-radius:100%;"></div><div class="wfg gra"><p align="left">'+data[x]['text']+'</p></div></div>' : '<div class="brg"><div class="wfg nfg"><span>'+this.bound[data[x]['sender']]['name']+'</span><img src="/assets/img/users/'+this.bound[data[x]['sender']]['photo']+'" style="width:50px;border-radius:100%;"></div><div class="wfg arg"><p align="left">'+data[x]['text']+'</p></div></div>');
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
							that.get();
							var elem = domId('main-chat');
							elem.scrollTop = elem.scrollHeight;
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