<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>{{ $name = $info['first_name'] . ($info['last_name'] ? ' ' . $info['last_name'] : '') }}</title>
    <link rel="stylesheet" href="{{ asset('assets/bulma/css/bulma.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/font-awesome/css/font-awesome.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/custom.css') }}">
    <script type="text/javascript" src="{{ asset('assets/js/utils/dom.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/chat.js'.'?t='.time()) }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/auth/cookies.js') }}"></script>
</head>
<body>
    <div id="main">
      <section class="section">
        <div class="container is-widescreen">
            <div class="box primary-box">
              <h2 class="subtitle is-h2 has-text-centered">{{ $name }} (Online)</h2>
              <hr>
              <div class="form-chat" id="form-chat">
                <div class="columns is-tablet is-mobile ai">
                  <div class="column is-2">
                    <div class="ai-image">
                      <img src="{{ asset('assets/img/kyla.png') }}" alt="" width="60" height="60">
                    </div>
                  </div>
                  <div class="column is-10">
                    <div class="notification is-warning">
                      <p>
                          Selamat datang di halaman chat ini.
                      </p>
                    </div>
                  </div>
                </div>

                <div class="columns is-tablet is-mobile ai">
                  <div class="column is-2">
                    <div class="ai-image">
                      <img src="{{ asset('assets/img/kyla.png') }}" alt="" width="60" height="60">
                    </div>
                  </div>
                  <div class="column is-10">
                    <div class="notification is-primary">
                      <p>
                        Testing
                      </p>
                    </div>
                  </div>
                  <div class="column is-2">
                    <div class="user-image">
                      <img src="{{ (! empty($info['photo']) ? asset('assets/img/users/'.$info['photo']) : asset('assets/img/user.png')) }}" alt="" width="60" height="60">
                    </div>
                  </div>
                </div>

                <div class="columns is-tablet is-mobile ai">
                  <div class="column is-2">
                    <div class="ai-image">
                      <img src="{{ asset('assets/img/kyla.png') }}" alt="" width="60" height="60">
                    </div>
                  </div>
                  <div class="column is-10">
                    <div class="notification is-warning">
                      <p>
                        Kyla is writing...
                      </p>
                    </div>
                  </div>
                </div>
              </div>

              <hr>
              <div class="form-input">
                <div class="columns">
                  <div class="column is-10">
                    <div class="field">
                      <div class="control">
                        <input type="text" name="" class="input is-12" value="" placeholder="Masukkan Pesan...">
                      </div>
                    </div>
                  </div>
                  <div class="column is-2">
                    <div class="field">
                      <div class="control">
                        <button type="button" class="button is-primary" name="button"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                        <button type="button" class="button is-danger" name="button"><i class="fa fa-microphone" aria-hidden="true"></i></button>
                      </div>
                    </div>
                  </div>
                </div>
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
