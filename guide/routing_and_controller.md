# Routing.
Routes defined in the `public/assets/js/routes.js` file.
### For Example:
- Load register controller when the hash location is `#test`. Let us say the url is <a href="http://localhost:8000/#test">http://localhost:8000/#test</a>.
- The register controller located at `public/assets/js/app/test.js`
```javascript
	case "/test":
		view("test");
	break;
```

# How to make a controller.
Every controller must be saved in `public/assets/js/app` with ".js" extenstion and derived by component class.
### For example:
```javascript
class test extends Component {
	constructor(props) {
		super(props);
	}
	render() {
		return "<center><h1>Test Page</h1></center>";
	}
}
```
![Controller Example](https://raw.githubusercontent.com/TeaInside/Tea-Messenger-Web/master/guide/img/controller_example.png)

