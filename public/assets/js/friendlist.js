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
			ch = new XMLHttpRequest(), that = this;
			ch.onreadystatechange = function () {
				if (this.readyState === 4) {
					that.buildPaginator(this.responseText);
				}
			};
			ch.withCredentials = true;
			ch.open("GET", this.api.replace("{page}", "count"));
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
					'<img class="photo ib" src="/'+photo+'?t='+(new Date()).getSeconds()+'">' +
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

	buildPaginator(data)
	{
		try	{
			data = Math.floor(JSON.parse(data) / 6);
			this.main.innerHTML += "<tr><td><div id=\"paginator-wd\"></div></td></tr>";
			var q = "";
			var func = [], newob = [];
			for (var i = [1]; i[0] <= data; i[0]++) {
				domId('paginator-wd').innerHTML += "<a href=\"javascript:void(0);\" onclick=\"funcx("+i+")\">" + i + "</a>";
			}
		} catch (e) {
			alert(e.message);
		}
	}

	changePage(number)
	{
		var ch = new XMLHttpRequest(), that = this;
			ch.onreadystatechange = function () {
				if (this.readyState === 4) {
					that.main.innerHTML = "";
					that.buildView(this.responseText);
				}
			};
			ch.withCredentials = true;
			ch.open("GET", this.api.replace("{page}", number));
			ch.send(null);
			ch = new XMLHttpRequest(), that = this;
			ch.onreadystatechange = function () {
				if (this.readyState === 4) {
					that.buildPaginator(this.responseText);
				}
			};
			ch.withCredentials = true;
			ch.open("GET", this.api.replace("{page}", "count"));
			ch.send(null);
	}
}

function funcx(q)
{
	ch.changePage(q);
}