<!DOCTYPE html>
<html>
<head>
	<title>{{ $name = $info['first_name'] . ($info['last_name'] ? ' ' . $info['last_name'] : '') }}</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/tea-messager.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/fontawesome.css') }}">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="{{ asset('assets/js/utils/dom.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/js/chat.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/js/auth/cookies.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/js/index.js') }}"></script>
</head>
<body>
  <div class="container">
    <div class="row app-one">

      <!-- Conversation Start -->
      <div class="col-sm-12 conversation">
		<!-- Content Chatingan -->

		<!-- Heading -->
        <div class="row heading">
          <div class="col-sm-2 col-md-1 col-xs-3 heading-avatar">
            <div class="heading-avatar-icon">
				<img src="{{ empty($info['photo']) ? asset('assets/img/user.png') : asset('assets/img/users/'.$info['photo']) }}">
            </div>
          </div>
          <div class="col-sm-8 col-xs-7 heading-name">
            <a class="heading-name-meta">{{ $name }}
            </a>
            <span class="heading-online">Online</span>
          </div>
          <div class="col-sm-1 col-xs-1  heading-dot pull-right">
            <i class="fa fa-ellipsis-v fa-2x  pull-right" aria-hidden="true"></i>
          </div>
        </div>
        <!-- Heading End -->

        <!-- Message Box -->
        <div class="row message" id="conversation">

          <div class="row message-body">
            <div class="col-sm-12">

                <!-- Messenger Text -->
                <div id="chat-field" class="message-text">
                	<p>No Message in here...</p>
                </div>
                <span id="chat-time-reciver" class="message-time pull-right">
                	<p></p>
                </span>

            </div>
          </div>
        
      	</div>
        <!-- Message Box End -->

        <!-- Reply Box -->
		<form method="post" action="javascript:void(0);" id="poster">
		<input type="hidden" id="is-empty" value="0">
		<input type="hidden" name="boundary" value="{{ rawurlencode($boundary) }}" id="boundary">
        <div class="row reply">
		  <div class="col-sm-1 col-xs-1 reply-emojis">
			<label for="file-input">
				<img class="attachment-icon" src="{{ asset('assets/img/icon/attachment.png') }}">
			</label>
			<input id="file-input" type="file"/>
          </div>
          <div class="col-sm-9 col-xs-9 reply-main">
			<input type="text" class="form-control" name="text-field" autocomplete="off" id="text-field">
          </div>
          <div class="col-sm-1 col-xs-1 reply-recording">
            <i class="fa fa-microphone fa-2x" aria-hidden="true"></i>
          </div>
          <div class="col-sm-1 col-xs-1 reply-send">
			<button id="submit" type="submit" class="btn-send">
				<i class="fa fa-send fa-2x" aria-hidden="true"></i>
			</button>
          </div>
        </div>
		</form>
        <!-- Reply Box End -->
      </div>
      <!-- Conversation End -->
    </div>
    <!-- App One End -->
  </div>
<!--
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
					<button id="submit" type="submit" class="btn btn-default"><i class="fa fa-send font-icon"></i></button>
				</div>
			</form>
		</div>
-->
	<script type="text/javascript">
		var ch = new chat({{ $info['user_id'] }}, {{ $selfinfo['user_id'] }});
			ch.resolveCurrentChat();
			ch.listen();
	</script>
</body>
</html>
