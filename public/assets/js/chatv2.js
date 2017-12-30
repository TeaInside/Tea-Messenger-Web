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
		this.asset_dir = "/assets/";
	}

	buildPhotoContext(data)
	{
		if (data===null) {
			return this.asset_dir + "img/user.png";
		} else {
			return this.asset_dir + "img/users/" + data;
		}
	}

	listen()
	{
		var that = this;
		domId('sendbox').addEventListener('submit', function() {
			var context = that.buildPostContextStream();
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
									//qe.innerHTML += '<div class="brg"><div class="wfg gfn"><span>'+that.bound[that._self]['name']+'</span><img src="'+that.buildPhotoContext(that.bound[that._self]['photo'])+'" style="width:50px;border-radius:100%;"></div><div class="wfg gra"><p align="right">'+context['raw']+'</p></div></div>';
									qe.innerHTML += '<div class="columns is-tablet is-mobile ai"><div class="column is-10"><div class="notification is-primary"><p>'+context['raw']+'</p></div></div><div class="column is-2"><div class="ai-image"><img src="'+that.buildPhotoContext(that.bound[that._self]['photo'])+'" alt="" width="60" height="60"></div></div></div>';
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
		var qe = domId('main-chat'), that = this;
		if (domId('is_empty').value === "1") {
			qe.innerHTML = "";
			domId('is_empty').value = "0";
		}
		console.log(that);
		for (var x in data) {
			//domId('main-chat').innerHTML += (this.bound[data[x]['sender']]['status'] === "self" ? '<div class="brg"><div class="wfg gfn"><span>'+this.bound[data[x]['sender']]['name']+'</span><img src="'+that.buildPhotoContext(that.bound[that._self]['photo'])+'" style="width:50px;border-radius:100%;"></div><div class="wfg gra"><p align="left">'+data[x]['text']+'</p></div></div>' : '<div class="brg"><div class="wfg nfg"><span>'+this.bound[data[x]['sender']]['name']+'</span><img src="'+this.buildPhotoContext(that.bound[that.rex]['photo'])+'" style="width:50px;border-radius:100%;"></div><div class="wfg arg"><p align="left">'+data[x]['text']+'</p></div></div>');
			domId('main-chat').innerHTML += (this.bound[data[x]['sender']]['status'] === "self" ?'<div class="columns is-tablet is-mobile ai"><div class="column is-10"><div class="notification is-primary"><p>'+data[x]['text']+'</p></div></div><div class="column is-2"><div class="ai-image"><img src="'+this.buildPhotoContext(that.bound[that.rex]['photo'])+'" alt="" width="60" height="60"></div></div></div>' : '<div class="columns is-tablet is-mobile ai"><div class="column is-2"><div class="ai-image"><img src="'+that.buildPhotoContext(that.bound[that.rex]['photo'])+'" alt="" width="60" height="60"></div></div><div class="column is-10"><div class="notification is-warning"><p>'+data[x]['text']+'</p></div></div></div>');
		}
		qe.scrollTop = qe.scrollHeight;
	}

	buildResolvedChat(data)
	{
		if (data == "") {
			domId('main-chat').innerHTML = '<div class="columns is-tablet is-mobile ai"><div class="column is-12"><div class="notification is-danger"><p>No messages here yet...</p></div></div></div>';
			domId('is_empty').value = "1";
			return false;
		}
		for (var x in data) {
			//domId('main-chat').innerHTML += (this.bound[data[x]['sender']]['status'] === "self" ? '<div class="brg"><div class="wfg gfn"><span>'+this.bound[data[x]['sender']]['name']+'</span><img src="/assets/img/users/'+this.bound[data[x]['sender']]['photo']+'" style="width:50px;border-radius:100%;"></div><div class="wfg gra"><p align="left">'+data[x]['text']+'</p></div></div>' : '<div class="brg"><div class="wfg nfg"><span>'+this.bound[data[x]['sender']]['name']+'</span><img src="/assets/img/users/'+this.bound[data[x]['sender']]['photo']+'" style="width:50px;border-radius:100%;"></div><div class="wfg arg"><p align="left">'+data[x]['text']+'</p></div></div>');
			domId('main-chat').innerHTML += (this.bound[data[x]['sender']]['status'] === "self" ? '<div class="columns is-tablet is-mobile ai"><div class="column is-10"><div class="notification is-primary"><p>'+data[x]['text']+'</p></div></div><div class="column is-2"><div class="ai-image"><img src="/assets/img/users/'+this.bound[data[x]['sender']]['photo']+'" alt="" width="60" height="60"></div></div></div>':'<div class="columns is-tablet is-mobile ai"><div class="column is-2"><div class="ai-image"><img src="/assets/img/users/'+this.bound[data[x]['sender']]['photo']+'" alt="" width="60" height="60"></div></div><div class="column is-10"><div class="notification is-warning"><p>'+data[x]['text']+'</p></div></div></div>');
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