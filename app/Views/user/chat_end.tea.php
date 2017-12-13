<!DOCTYPE html>
<html>
<head>
	<title>{{ $name = $info['first_name'] . ($info['last_name'] ? ' ' . $info['last_name'] : '') }}</title>
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/chat.css') }}">
	<script type="text/javascript" src="{{ asset('assets/js/utils/dom.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/js/chat.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/js/auth/cookies.js') }}"></script>
</head>
<body>
<center>
	<div class="main-cage">
		<div class="banner">
			<div class="pp"><img src="{{ (! empty($info['photo']) ? assets('assets/img/users/'.$info['photo']) : '') }}" width="50" height="50" style="border-radius:100%;"></div>
			<div class="name"><p>{{ $name }}</p></div>
		</div>
		<div class="main-chat" id="main-chat">
			<div>
				
			</div>
		</div>
		<div class="input">
			<form method="post" action="javascript:void(0);">
				<input type="text" name="txt" size="80"><button type="submit" class="sb">Send</button>
			</form>
		</div>
	</div>
	<script type="text/javascript">
		var ch = new chat("/chat/{{$info['username']}}");
			ch.get();
			ch.listen();
	</script>
</center>
</body>
</html>