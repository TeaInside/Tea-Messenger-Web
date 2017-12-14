class profile
{
	constructor(url)
	{
		this.url = url;
	}
	saveChange()
	{
		alert('saved');
		window.location = '/profile'
	}
}