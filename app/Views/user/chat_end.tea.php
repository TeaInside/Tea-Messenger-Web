<!DOCTYPE html>
<html>
<head>
	<title>{{ $name = $info['first_name'] . ($info['last_name'] ? ' ' . $info['last_name'] : '') }}</title>
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/chat.css') }}">
	<script type="text/javascript" src="{{ asset('assets/js/utils/dom.js') }}"></script>
	<!-- <script type="text/javascript" src="{{ asset('assets/js/chat.js'.'?t='.time()) }}"></script> -->
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
		<div id="chat-field">
			<div class="sender" align="right">
				<div class="c-inner _sender_text">
					<p>What's your name?</p>
				</div>
				<div class="c-inner _photo wd">
					<img src="{{ empty($selfinfo['photo']) ? asset('assets/img/user.png') : asset('assets/img/users/'.$selfinfo['photo']) }}" class="mini-photo">
				</div>
			</div>

			<div class="receiver" align="left">
				<div class="c-inner _photo">
					<img src="{{ empty($info['photo']) ? asset('assets/img/user.png') : asset('assets/img/users/'.$info['photo']) }}" class="mini-photo">
				</div>
				<div class="c-inner _receiver_text">
					<p> I just have developed a new lib for managing IO in Java. Its purpose is making things easier.</p>
				</div>
			</div>
		</div>
		<div class="form-field">
			<form method="post" action="javascript:void(0);" id="poster">
				<input type="hidden" name="boundary" value="{{ rawurlencode($boundary) }}">
				<div class="input sub-cage" align="left">
					<div class="image-upload sub-cage">
						<label for="file-input">
							<img class="attachment-icon" src="{{ asset('assets/img/icon/attachment.png') }}">
						</label>
						<input id="file-input" type="file"/>
					</div>
					<div class="sub-cage">
						<input type="text" name="txt" autocomplete="off" id="txt">
					</div>
				</div>
				<div class="submit sub-cage">
					<button id="submit" type="submit">Send</button>
				</div>
			</form>
		</div>
	</div>
	<script type="text/javascript">
		/*var ch = new chat({{ $info['user_id'] }}, {{ $selfinfo['user_id'] }});
			ch.resolveCurrentChat();
			ch.listen();
			setInterval(function () {
				ch.getRealtimeUpdate();
			}, 2000);*/
	</script>
</center>
</body>
</html>
