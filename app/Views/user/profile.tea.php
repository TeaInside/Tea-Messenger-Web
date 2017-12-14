<!DOCTYPE html>
<html>
<head>
	<title>{{ $name = $info['first_name'] . ($info['last_name'] ? ' ' . $info['last_name'] : '') }}</title>
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/profile.css') }}">
	<script type="text/javascript" src="{{ asset('assets/js/utils/dom.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/js/auth/profile.js') }}"></script>
</head>
<body>
<center>
	<div class="pp_cage">
		<img src="{{ asset(empty($info['photo']) ? 'assets/img/user.png' : 'assets/img/users/' . $info['photo']) }}" class="pp">
	</div>
	<div class="user_info" id="ui">
		<table id="user-info-table">
			<tbody>
				<tr><td>First name</td><td>:</td><td>{{ $info['first_name'] }}</td></tr>
				<tr><td>Last name</td><td>:</td><td>{{ $info['last_name'] }}</td></tr>
				<tr><td>Username</td><td>:</td><td>{{ $info['username'] }}</td></tr>
				<tr><td>E-Mail</td><td>:</td><td>{{ $info['email'] }}</td></tr>
				<tr><td>Registered at</td><td>:</td><td>{{ date('d F Y, h:i:s a', strtotime($info['registered_at'])) }}</td></tr>
				<tr><td>Account Status</td><td>:</td><td>{{ ucwords($info['status']).' '.($info['verified'] === 'false' ? '(Not Verified)' : '<p>(Verified)<p>')}}</td></tr>
			</tbody>
			<tfoot>
				<tr><td align="center" colspan="3"><a href="#change_profile" class="achange" id="achange"><span class="change">Change profile info</span></a></td></tr>
			</tfoot>
		</table>
		<form action="javascript:void(0);" id="edit-info">
			<table id="edit-info-table" style="display:none;">
				<tbody>
					<tr><td>First name</td><td>:</td><td><input type="text" name="fn" id="fn" value="{{ $info['first_name'] }}" required></td></tr>
					<tr><td>Last name</td><td>:</td><td><input type="text" name="ln" id="ln" value="{{ $info['last_name'] }}" required></td></tr>
					<tr><td>Username</td><td>:</td><td><input type="text" name="uname" id="uname" value="{{ $info['username'] }}" required></td></tr>
					<tr><td>E-Mail</td><td>:</td><td><input type="text" name="email" id="email" value="{{ $info['email'] }}" required></td></tr>
				</tbody>
				<tfoot>
					<tr><td align="center" colspan="3"><button type="submit" id="sv" class="wqb">Save change</button></td></tr>
					<tr><td align="center" colspan="3"><button type="button" id="cn" class="wqb">Cancel</button></td></tr>
				</tfoot>
			</table>
		</form>
	</div>
	<script type="text/javascript">
		var pr = new profile("/profile");
		domId('achange').addEventListener('click', function () {
			domId('user-info-table').style.display = 'none';
			domId('edit-info-table').style.display = '';
		});
		domId('edit-info').addEventListener('submit', function () {
			pr.saveChange();
		});
	</script>
</center>
</body>
</html>