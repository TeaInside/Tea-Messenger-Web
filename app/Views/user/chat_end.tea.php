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
			<div class="pp" align="left">
				<img src="{{ (! empty($info['photo']) ? asset('assets/img/users/'.$info['photo']) : '') }}" width="50" height="50" style="border-radius:100%;margin-left:2%;"><br>
				<span>{{ $name }} (Online)</span>
			</div>
		</div>
		<div class="main-chat" id="main-chat">
			<div class="brg">
				<div class="wfg nfg">
					<span>Septian Hari</span>
					<img src="{{ (! empty($info['photo']) ? asset('assets/img/users/'.$info['photo']) : '') }}" style="width:50px;border-radius:100%;">
				</div>
				<div class="wfg arg"><p align="left">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quod vestri non item. Itaque sensibus rationem adiunxit et ratione effecta sensus non reliquit. Expressa vero in iis aetatibus, quae iam confirmatae sunt. Duo Reges: constructio interrete. Quantum Aristoxeni ingenium consumptum videmus in musicis? Quae similitudo</p></div>
			</div>
			<div class="brg">
				<div class="wfg gfn">
					<span>Ammar Faizi</span>
					<img src="{{ asset('assets/img/users/'.$selfinfo['photo']) }}" style="width:50px;border-radius:100%;">
				</div>
				<div class="wfg gra"><p align="left">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quod vestri non item. Itaque sensibus rationem adiunxit et ratione effecta sensus non reliquit. Expressa vero in iis aetatibus, quae iam confirmatae sunt. Duo Reges: constructio interrete. Quantum Aristoxeni ingenium consumptum videmus in musicis? Quae similitudo</p></div>
			</div>
			
		</div>
		<div class="input">
			<form method="post" id="sendbox" action="javascript:void(0);">
				<input type="hidden" name="bound" value="{{ rawurlencode($boundary) }}" id="bound">
				<input type="text" name="txt" id="txt" size="80"><button type="submit" class="sb">Send</button>
			</form>
		</div>
	</div>
	<script type="text/javascript">
		var ch = new chat("{{ $info['username'] }}", {{ $selfinfo['user_id'] }});
			ch.get();
			ch.listen();
	</script>
</center>
</body>
</html> 