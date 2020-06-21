@extends('layouts.layout')

@section('styles')
<style type="text/css">
.register_guide{
  color:#1155a3;
  text-decoration:underline;
}

.form-group{
  line-height:30px;
}

.error{
  font-size:12px;
  width:60%;
  background:#f8cccc;
}

.input_ok{
  width:60%;
  background:#acf7bf;
}

.panel-body,.text-center{
  margin-bottom:12px;
}

</style>
@endsection

@section('title','会員について')

@section('subtitle','ログイン')

@section('content')

  
          <div class="panel-heading"><ログイン></div>
          <div class="panel-body">
            <form action="{{ route('login') }}" method="POST">
              @csrf
                @if(!($errors->has('email'))&&old('email'))
                  <div class="input_ok">
                @endif
              <div class="form-group">
                <label for="email">メールアドレス</label>
                <input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}" />
                @if(!($errors->has('email'))&&old('email'))
                  </div>
                @endif

                @if($errors->has('email'))
                  <div class="error">
			            @foreach($errors->get('email') as $message)
			            	・{{$message }}<br>
		            	@endforeach
                  </div>
	            	@endif
              </div>
              <div class="form-group">
                <label for="password">パスワード</label>
                <input type="password" class="form-control" id="password" name="password" />
                @if($errors->has('password'))
                  <div class="error">
			            @foreach($errors->get('password') as $message)
			            	・{{$message }}<br>
		            	@endforeach
                  </div>
	            	@endif
              </div>
              <div class="text-right">
                <button type="submit" class="btn btn-primary">ログイン</button>
              </div>
            </form>
          </div>
        <div class="text-center">
          <a href="/">パスワードの変更はこちらから</a>
        </div>
        <a class="register" href="/shopping/nusers/register">登録ページは<span class="register_guide" >こちら</span></a>
     
@endsection