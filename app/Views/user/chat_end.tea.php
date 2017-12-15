<!DOCTYPE html>
<html>
<head>
	<title>{{ $name = $info['first_name'] . ($info['last_name'] ? ' ' . $info['last_name'] : '') }}</title>
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/chat.css') }}">
	<script type="text/javascript" src="{{ asset('assets/js/utils/dom.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/js/chat.js'.'?t='.time()) }}"></script>
	<script type="text/javascript" src="{{ asset('assets/js/auth/cookies.js') }}"></script>
</head>
<body>
<center>
	<div class="main-cage">
		<div class="banner">
			<div class="pp" align="left">
				<img src="{{ (! empty($info['photo']) ? asset('assets/img/users/'.$info['photo']) : asset('assets/img/user.png')) }}" width="50" height="50" style="border-radius:100%;margin-left:2%;"><br>
				<span>{{ $name }} (Online)</span>
			</div>
		</div>
		<div class="main-chat" id="main-chat">
		</div>
		<div class="input">
			<form method="post" id="sendbox" action="javascript:void(0);">
				<input type="hidden" name="is_empty" id="is_empty" value="0">
				<input type="hidden" name="bound" value="{{ rawurlencode($boundary) }}" id="bound">
				<input type="text" name="txt" id="txt" size="80"><button type="submit" class="sb">Send</button>
			</form>
		</div>
	</div>
	<script type="text/javascript">
		var ch = new chat("{{ $info['username'] }}", {{ $selfinfo['user_id'] }});
			ch.resolveCurrentChat();
			ch.listen();
			setInterval(function () {
				ch.getRealtimeUpdate();
			}, 2000);
	</script>
</center>
</body>
</html> 