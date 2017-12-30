<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>{{ $name = $info['first_name'] . ($info['last_name'] ? ' ' . $info['last_name'] : '') }}</title>
    <link rel="stylesheet" href="{{ asset('assets/bulma/css/bulma.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/font-awesome/css/font-awesome.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/custom.css') }}">
    <script type="text/javascript" src="{{ asset('assets/js/utils/dom.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/chatv2.js'.'?t='.time()) }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/auth/cookies.js') }}"></script>
</head>
<body>
    <div id="main">
      <section class="section">
        <div class="container is-widescreen">
            <div class="box primary-box">
              <h2 class="subtitle is-h2 has-text-centered">{{ $name }} (Online)</h2>
              <hr>
              <div class="main-chat" id="main-chat"></div>
              <hr>
              <form method="post" id="sendbox" action="javascript:void(0)">
              <div class="form-input">
                <div class="columns">
                  <div class="column is-10">
                    <div class="field">
                      <div class="control">
                        <input type="hidden" name="is_empty" id="is_empty" value="0">
                        <input type="hidden" name="bound" value="{{ rawurlencode($boundary) }}" id="bound">
                        <input type="text" name="txt" id="txt" class="input is-12" value="" placeholder="Masukkan Pesan...">
                      </div>
                    </div>
                  </div>
                  <div class="column is-2">
                    <div class="field">
                      <div class="control">
                        <button type="submit" class="sb button is-primary" name="button"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                      </div>
                    </div>
                  </div>
                </div>
                </form>
              </div>
            </div>
        </div>
      </section>
      <footer class="footer">
        <div class="container">
          <div class="content has-text-centered">
            <p>
              Copyright &copy; Kyla. All Rights Reserved
            </p>
          </div>
        </div>
      </footer>
    </div>
    <script type="text/javascript">
        var ch = new chat({{ $info['user_id'] }}, {{ $selfinfo['user_id'] }});
            ch.resolveCurrentChat();
            ch.listen();
            setInterval(function () {
                ch.getRealtimeUpdate();
            }, 2000);
    </script>
</body>
</html>