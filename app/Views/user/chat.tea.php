<!DOCTYPE html>
<html>
<head>
	<title>Tea Messenger</title>
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/chat_list.css') }}">
</head>
<body>
	<center>
		<table>
			<tbody>
			@foreach(\App\Chat::getBuddyList() as $list) 
<?php $name = $list['first_name'].($list['last_name']!==""?" ".$list['last_name'] : ""); $photo = 'assets/img' . (empty($list['photo']) ? "/user.png" : "/users/".$list['photo']); ?>			
				<tr>
					<td>
						<div>
							<div class="photo-cage ib">
								<img class="photo" src="{{ asset($photo) }}">
							</div>
							<div class="name-cage ib">
								<p class="name">{{ $name }}</p>
							</div>
						</div>
					</td>
				</tr>
			@endforeach
			</tbody>
		</table>
	</center>
</body>
</html>