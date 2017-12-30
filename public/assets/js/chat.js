class chat {
	constructor(receiver, sender)
	{
		this.receiver = receiver;
		this.sender = sender;
		this.info   = JSON.parse(decodeURIComponent(domId('boundary').value));
		this.main	= domId('chat-field');
		this.sender_photo   = this.info[this.sender]['photo'] === null ? '/assets/img/user.png' : '/assets/img/users/' + this.info[this.sender]['photo'],
		this.receiver_photo = this.info[this.receiver]['photo']  === null ? '/assets/img/user.png' : '/assets/img/users/' + this.info[this.receiver]['photo'];
	}

	resolveCurrentChat()
	{
		var ch = new XMLHttpRequest(), that = this;
			ch.onreadystatechange = function () {
				if (this.readyState === 4) {
					that.buildCurrentChat(this.responseText);
				}
			};
			ch.open("GET", "/chat/" + this.receiver +"/get");
			ch.send(null);
	}

	buildCurrentChat(data)
	{
		try {
			data = JSON.parse(data);
			var x, main = domId('chat-field');
			if (data.length > 0) {
				for (x in data) {
					if (data[x]['sender'] == this.sender) {
						this.buildChat('sender', data[x]['text'], this.sender_photo);
					} else {
						this.buildChat('receiver', data[x]['text'], this.receiver_photo);
					}
				}
			} else {

			}
		} catch (e) {
			alert("Error: " + e.message);
		}
	}

	listen() {
		var that = this;
		domId('poster').addEventListener('submit', function () {
			var context = that.buildContextStream();
			if (context !== false) {
				var ch = new XMLHttpRequest();
					ch.onreadystatechange = function () {
						if (this.readyState === 4) {
							if (this.responseText === "\"ok\"") {
								that.buildChat('sender', context['text'], that.sender_photo);
							}
						}
					};
					ch.open("POST", "/chat/" + that.receiver + "/post");
					ch.send(JSON.stringify(context));
			}
		});
	}

	buildChat(type, text, photo)
	{
		if (type === 'sender') {
			// sender
			this.main.innerHTML += 
				'<div class="sender" align="right">' +
				'<div class="c-inner sender-text">' +
				'<p>'+text+'</p>' +
				'</div><div class="c-inner sub-photo wd"><img src="'+photo+'" class="mini-photo"></div></div>';
		} else {
			// receiver
			this.main.innerHTML += 
				'<div class="receiver" align="left">' +
				'<div class="c-inner sub-photo">' +
				'<img src="'+photo+'" class="mini-photo"></div>' +
				'<div class="c-inner receiver-text"><p>'+text+'</p></div></div>';
		}
	}

	buildContextStream()
	{
		var q = domId('text-field').value.trim();
		if (q !== "") {
			q = {
				"user_id": this.receiver,
				"text": q
			};
			return q;
		} else {
			return false;
		}
	}
}