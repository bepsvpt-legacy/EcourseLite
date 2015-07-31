<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <meta charset="UTF-8">
        <title>登入</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.0/css/materialize.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    </head>
    <body style="background-color: #118EFF;">
        <div class="container">
            <div class="row" style="padding-top: 2em;">
                {!! Form::open(['route' => 'signInAuth', 'method' => 'POST', 'class' => 'col s12 m6 offset-m3 login']) !!}
                <fieldset>
                    <div class="row">
                        <div class="col s12 center">
                            <span style="font-size: 35px;color: #565656;">登入</span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12">
                            <i class="material-icons prefix">perm_identity</i>
                            <input name="username" id="username" type="text" class="validate" pattern="^\d{9}$" autocomplete="off" required>
                            <label for="username">帳號</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12">
                            <i class="material-icons prefix">vpn_key</i>
                            <input name="password" id="password" type="password" class="validate" required>
                            <label for="password">密碼</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12">
                            <input name="termsOfService" id="termsOfService" type="checkbox" value="1" class="filled-in validate" required>
                            <label for="termsOfService">我同意<a class="waves-effect waves-light modal-trigger" href="#terms-of-service">服務條款</a></label>
                        </div>
                    </div>

                    <div class="row center">
                        <div class="input-field col s12">
                            <button class="btn waves-effect waves-light" type="submit">登入</button>
                        </div>
                    </div>

                    @if ($errors->any())
                        <ul class="collection form-error-msg">
                            @foreach ($errors->all() as $error)
                                <li class="collection-item red-text">{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                </fieldset>
                {!! FOrm::close() !!}
            </div>
        </div>

        <div id="terms-of-service" class="modal">
            <div class="modal-content">
                <h4>服務條款</h4>

                <div>
                    <ol>
                        <li>本網站不會收集任何使用者的資料，在使用者登出或閒置過久後，資料將從伺服器中移除</li>
                        <li>本網站僅將使用者提供的帳號與密碼用於連線 <a href="http://ecourse.ccu.edu.tw" target="_blank">Ecourse</a> 系統，不會用於其他用途</li>
                        <li>所有於本網站操作的行為，將由使用者自行承擔其後果，本網站不負任何責任</li>
                        <li>本網站所提供服務的相關網站原始碼可由 <a href="#" target="_blank">此處</a> 查閱</li>
                        <li>在您按下登入按鈕後，即代表您已詳閱並同意此服務條款</li>
                    </ol>
                </div>
            </div>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js" defer></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.0/js/materialize.min.js" defer></script>
        <script src="{{ asset('js/all.js') }}" defer></script>
        <script>sessionStorage.clear();</script>
    </body>
</html>