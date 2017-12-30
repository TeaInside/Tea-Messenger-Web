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
		<div class="user-view">
			<div class="name-cage sub-cage">
				<p id="name">{{ $name }}</p>
				<p id="last-seen">Online</p>
			</div>
			<div class="photo-cage sub-cage">
			<img src="{{ empty($info['photo']) ? asset('assets/img/user.png') : asset('assets/img/users/'.$info['photo']) }}" class="photo">
			</div>
		</div>
		<!-- Chat akan muncul di id chat-field. Cek public/assets/js/chat.js untuk info lebih lanjut -->
		<div id="chat-field">
			<p>No messages here yet...</p>
		</div>
		<div class="form-field">
			<form method="post" action="javascript:void(0);" id="poster">
				<input type="hidden" id="is-empty" value="0">
				<input type="hidden" name="boundary" value="{{ rawurlencode($boundary) }}" id="boundary">
				<div class="input sub-cage" align="left">
					<div class="image-upload sub-cage">
						<label for="file-input">
							<img class="attachment-icon" src="{{ asset('assets/img/icon/attachment.png') }}">
						</label>
						<input id="file-input" type="file"/>
					</div>
					<div class="sub-cage">
						<input type="text" name="text-field" autocomplete="off" id="text-field">
					</div>
				</div>
				<div class="submit sub-cage">
					<button id="submit" type="submit">Send</button>
				</div>
			</form>
		</div>
	</div>
	<script type="text/javascript">
		var ch = new chat({{ $info['user_id'] }}, {{ $selfinfo['user_id'] }});
			ch.resolveCurrentChat();
			ch.listen();
	</script>
</center>
</body>
</html>
