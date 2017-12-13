class register
{
	constructor(to)
	{
		this.to = to;
	}
	listen()
	{
		var that = this;
		domId('form-register').addEventListener("submit", function () {
			that.action(123);
		});
	}
	action(dt){
		var ch = new XMLHttpRequest();
			ch.onreadystatechange = function () {
				if (this.readyState === 4) {
					alert(this.responseText);
				}
			};
			ch.open("POST", this.to);
			ch.send(dt);
			alert(123);
	}
}