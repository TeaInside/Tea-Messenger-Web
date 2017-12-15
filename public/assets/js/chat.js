class chat
{
	constructor(rex,_self)
	{
		this._self = _self;
		this.rex   = rex;
		this.realtimeChatUpdate = this.buildRealtimeContextStream();
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
							domId('main-chat').innerHTML += '<div class="brg"><div class="wfg gfn"><span>'+that.bound[that._self]['name']+'</span><img src="/assets/img/users/'+that.bound[that._self]['photo']+'" style="width:50px;border-radius:100%;"></div><div class="wfg gra"><p align="left">'+context['raw']+'</p></div></div>'
						}
					};
					ch.withCredentials = true;
					ch.open("POST", "/chat/" + this.rex + "/post");
					ch.send(context['stream']);
			}
		});
	}

	buildPostContextStream()
	{
		var rq = {
			"text": domId('txt').value
		};
		if (rq['text']=="") {return false;}
		return {
			'stream': JSON.stringify(rq),
			'raw': rq['text']
		};
	}

	buildRealtimeContextStream()
	{
	}

	buildResolvedChat(data)
	{
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