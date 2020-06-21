@extends('layouts.layout')

@section('styles')
<style tyle="text/css">
p{
    font-size:20px;
}
.user_info{
    width:80%;
    height:90%;
    margin:10px;
    border:1px solid #000000;
    line-height:40px;
}

.error{
  font-size:12px;
  width:60%;
  background:#f8cccc;
  line-height:30px;
}

.password_change{
    margin:10px
}

.form-group{
  line-height:30px
}

</style>
@endsection

@section('title','会員情報')

@section('subtitle','登録情報')

@section('content')
<h2><ユーザ情報の変更></h2>
<form action="/shopping/users/userinfo_change" method="POST">
              @csrf
              <div class="form-group">
                <label for="email">メールアドレス</label>
                <input type="text" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}" />
                @if($errors->has('email'))
                  <div class="error">
			            @foreach($errors->get('email') as $message)
			            	・{{$message }}<br>
		            	@endforeach
                  </div>
	            	@endif
              </div>
              <div class="form-group">
                <label for="name">ユーザー名</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ Auth::user()->name }}" />
                @if($errors->has('name'))
                  <div class="error">
			            @foreach($errors->get('name') as $message)
			            	・{{$message }}<br>
		            	@endforeach
                  </div>
	            	@endif
              </div>
              <div class="form-group">
                <span class="form-control" name="birthday">生年月日: {{ Auth::user()->birthday }}</span>
              </div>
              <div class="text-right">
                <button type="submit" class="btn btn-primary">変更</button>
              </div>
</form>
<div class="password_change">
        <h2><パスワードの変更></h2>
        <form action="/shopping/users/pass_change" method="POST">
            @csrf
            @if(isset($msg))
              <p class="error">{{$msg}}</p>
            @endif
            @if (count($errors) > 0)
                <div class="error">
                      <ul>
                          @foreach ($errors->all() as $error) 
                                <li>{{ $error }}</li>
                          @endforeach
                      </ul>
                  </div>
            @endif
            <div class="form-group">
                <label for="current_password">現在のパスワード</label>
                <input type="password" class="form-control" id="current_password" name="current_password">
            </div>
            <div class="form-group">
                <label for="new_password">新しいパスワード</label>
                <input type="password" class="form-control" id="new_password" name="new_password">
            </div>
            <div class="form-group">
                <label for="new_password-confirm">新しいパスワード（確認）</label>
                <input type="password" class="form-control" id="new_password-confirm" name="new_password_confirmation">
            </div>
            <div class="text-right">
                    <button type="submit" class="btn btn-primary">パスワード変更</button>
            </div>
        </form>
</div>  

@endsection