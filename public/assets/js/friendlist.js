class friendlist
{
	constructor(api, pv, page)
	{
		this.main = domId('main-list');
		this.api  = api;
		this.private_chat_route = pv+"/";
		this.page = page;
	}

	listen()
	{
		var ch = new XMLHttpRequest(), that = this;
			ch.onreadystatechange = function () {
				if (this.readyState === 4) {
					that.buildView(this.responseText);
				}
			};
			ch.withCredentials = true;
			ch.open("GET", this.api.replace("{page}", this.page));
			ch.send(null);
	}

	buildView(data)
	{
		try	{
			data = JSON.parse(data);
			for (var x in data) {
				var name = data[x]['first_name'] + (data[x]['last_name']!==""?" " + data[x]['last_name'] : ""),
					photo = 'assets/img' + (data[x]['photo'] == null ? "/user.png" : "/users/" + data[x]['photo']);	
				this.main.innerHTML += 
					'<tr><td>' +
					'<a href="'+this.private_chat_route+data[x]['username']+'" class="link">' +
					'<div class="info-cage">' +
					'<img class="photo ib" src="/'+photo+'">' +
					'<div class="name-cage ib">' +
					'<p class="name">'+name+'</p>' +
					'</div>' +
					'</div>' +
					'</a>' +
					'</td>' +
					'</tr>';
			}
		} catch (e) {
			alert(e.message);
		}
	}
}