class chat
{
	constructor(rex,_self)
	{
		this._self = _self;
		this.rex   = rex;
		try	{
			this.bound = JSON.parse(decodeURIComponent(domId('bound').value));
		} catch (e) {
			alert(e.message);
		}
	}

	listen()
	{
		var that = this;
		domId('sendbox').addEventListener('submit', function() {
			var context = that.buildPostContextStream();
			console.log(context);
			if (context !== false) {
				var ch = new XMLHttpRequest();
					ch.onreadystatechange = function () {
						if (this.readyState === 4) {
							try {
								if (this.responseText === "\"ok\"") {
									var qe = domId('main-chat');
									if (domId('is_empty').value === "1") {
										qe.innerHTML = "";
										domId('is_empty').value = "0";
									}
									qe.innerHTML += '<div class="brg"><div class="wfg gfn"><span>'+that.bound[that._self]['name']+'</span><img src="/assets/img/users/'+that.bound[that._self]['photo']+'" style="width:50px;border-radius:100%;"></div><div class="wfg gra"><p align="left">'+context['raw']+'</p></div></div>';
									qe.scrollTop = qe.scrollHeight;
									domId('txt').value = '';
								} else {
									alert("Error while sending a message\n\n" + this.responseText);
								}
								domId('txt').disabled = '';
							} catch (e) {
								alert(e.message);
							}
						} else {
							domId('txt').disabled = 1;
						}
					};
					ch.withCredentials = true;
					ch.open("POST", "/chat/" + that.rex + "/post");
					ch.send(context['stream']);
			}
		});
	}

	getRealtimeUpdate()
	{
		var chx = new XMLHttpRequest(), that = this;
			chx.onreadystatechange = function () {
				if (this.readyState === 4) {
					try {
						var dt = JSON.parse(this.responseText);
						if (dt == "") {return false}
						that.buildRealtimeContextRead(dt);
					} catch (e) {
						alert(e.message);
					}
				}
			};
			chx.withCredentials = true;
			chx.open("GET", "/chat/" + this.rex + "/get?realtime_update=1");
			chx.send(null);
	}

	buildPostContextStream()
	{
		var rq = {
			"text": domId('txt').value
		};
		if (rq['text']=="") {
			return false;
		}
		return {
			'stream': JSON.stringify(rq),
			'raw': rq['text']
		};
	}

	buildRealtimeContextRead(data)
	{
		if (data == "") {return false;}
		for (var x in data) {
			domId('main-chat').innerHTML += (this.bound[data[x]['sender']]['status'] === "self" ? '<div class="brg"><div class="wfg gfn"><span>'+this.bound[data[x]['sender']]['name']+'</span><img src="/assets/img/users/'+this.bound[data[x]['sender']]['photo']+'" style="width:50px;border-radius:100%;"></div><div class="wfg gra"><p align="left">'+data[x]['text']+'</p></div></div>' : '<div class="brg"><div class="wfg nfg"><span>'+this.bound[data[x]['sender']]['name']+'</span><img src="/assets/img/users/'+this.bound[data[x]['sender']]['photo']+'" style="width:50px;border-radius:100%;"></div><div class="wfg arg"><p align="left">'+data[x]['text']+'</p></div></div>');
		}
	}

	buildResolvedChat(data)
	{
		if (data == "") {
			domId('main-chat').innerHTML = "<div style=\"margin-top:23%;\"><p style=\"font-size:15px;\">No messages here yet...</p></div>";
			domId('is_empty').value = "1";
			return false;
		}
		for (var x in data) {
			domId('main-chat').innerHTML += (this.bound[data[x]['sender']]['status'] === "self" ? '<div class="brg"><div class="wfg gfn"><span>'+this.bound[data[x]['sender']]['name']+'</span><img src="/assets/img/users/'+this.bound[data[x]['sender']]['photo']+'" style="width:50px;border-radius:100%;"></div><div class="wfg gra"><p align="left">'+data[x]['text']+'</p></div></div>' : '<div class="brg"><div class="wfg nfg"><span>'+this.bound[data[x]['sender']]['name']+'</span><img src="/assets/img/users/'+this.bound[data[x]['sender']]['photo']+'" style="width:50px;border-radius:100%;"></div><div class="wfg arg"><p align="left">'+data[x]['text']+'</p></div></div>');
		}
	}

	resolveCurrentChat()
	{
		var chx = new XMLHttpRequest(), that = this;
			chx.onreadystatechange = function () {
				if (this.readyState === 4) {
					try	{
						that.buildResolvedChat(JSON.parse(this.responseText));
						var qe = domId('main-chat');
						qe.scrollTop = qe.scrollHeight;
					} catch (e) {
						alert("Error: " + e.message);
					}
				}
			};
			chx.withCredentials = true;
			chx.open("GET", "/chat/" + this.rex + "/get");
			chx.send(null);
	}
}