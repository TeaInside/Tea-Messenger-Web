<?php $page = isset($_GET['page']) ? ((int) $_GET['page']) - 1 : 0; ?>
<!DOCTYPE html>
<html>
<head>
	<title>Tea Messenger</title>
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/chat_list.css') }}">
</head>
<body>
	<center>
		<table>
			<thead>
				<tr><th><p class="hd">People May You Know</p></th></tr>
			</thead>
			<tbody>
			@foreach(\App\Chat::getBuddyList($page) as $list) 
<?php $name = $list['first_name'].($list['last_name']!==""?" ".$list['last_name'] : ""); $photo = 'assets/img' . (empty($list['photo']) ? "/user.png" : "/users/".$list['photo']); ?>			
				<tr>
					<td>
						<a href="{{ route('private_chat', $list['username']) }}" class="link">
						<div class="info-cage">
							<img class="photo ib" src="{{ asset($photo) }}">
							<div class="name-cage ib">
								<p class="name">{{ $name }}</p>
							</div>
						</div>
						</a>
					</td>
				</tr>
			@endforeach
			</tbody>
		</table>
	</center>
</body>
</html>