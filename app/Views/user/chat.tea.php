<?php $page = isset($_GET['page']) ? $_GET['page'] : 1; ?>
<!DOCTYPE html>
<html>
<head>
	<title>Tea Messenger</title>
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/friendlist.css') }}">
	<script type="text/javascript" src="{{ asset('assets/js/utils/dom.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/js/friendlist.js') }}"></script>
</head>
<body>
	<center>
		<table>
			<thead>
				<tr><th><p class="hd">People May You Know</p></th></tr>
			</thead>
			<tbody id="main-list">
			</tbody>
		</table>
	</center>
	<script type="text/javascript">
		var ch = new friendlist("{{ route('friendlist', '{page}') }}", "{{ route('chat') }}", {{ $page }});
			ch.listen();
	</script>
</body>
</html>