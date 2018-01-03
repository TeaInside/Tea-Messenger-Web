<!DOCTYPE html>
<html>
<head>
	<title>Change photo</title>
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/change_photo.css') }}">
</head>
<body>
	<center>
		<div class="pp_cage">
			<img src="{{ asset(empty($info['photo']) ? 'assets/img/user.png' : 'assets/img/users/' . $info['photo']) }}" class="pp">
		</div>
		<form method="post" action="{{ route('change_photo') }}" enctype="multipart/form-data">
			<div>
				<input type="hidden" name="csrf" value="{{ $that->csrf_token() }}">
				<input type="hidden" name="cost" value="{{ rstr(32) }}">
				<p><input type="file" name="photo"></p>
				<p><button type="submit" name="save">Upload</button></p>
			</div>
		</form>
	</center>
</body>
</html>