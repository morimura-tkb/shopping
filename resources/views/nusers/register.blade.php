@extends('layouts.layout')

@section('styles')
<style type="text/css">
.login_guide{
  color:#1155a3;
  text-decoration:underline;
}
.form-group{
  line-height:30px
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

.reinput{
  color:red;
}

.panel-body{
  margin-bottom:12px;
}


</style>
@endsection

@section('title','会員について')

@section('subtitle','会員登録')

@section('content')
    
        <nav class="panel panel-default">
          <div class="panel-heading"><会員登録></div>
          <div class="panel-body">
           
            <form action="{{ route('register') }}" method="POST">
              @csrf
              <div class="form-group">
                @if(!($errors->has('email'))&&old('email'))
                  <div class="input_ok">
                @endif
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
                @if(!($errors->has('name'))&&old('name'))
                  <div class="input_ok">
                @endif
                <label for="name">ユーザー名</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" />
                @if(!($errors->has('name'))&&old('name'))
                  </div>
                @endif
                @if($errors->has('name'))
                  <div class="error">
			            @foreach($errors->get('name') as $message)
			            	・{{ $message }}<br>
		            	@endforeach
                  </div>
	            	@endif
              </div>
              <div class="form-group">
                @if(!($errors->has('birthday'))&&old('day'))
                  <div class="input_ok">
                @endif
                <label for="year">生年月日</label>
                  <select id="year" name="year">
                    <option value="">---</option>
                      <?php $years = array_reverse(range(today()->year - 100, today()->year)); ?>
                      @foreach($years as $year)
                        <option
                          value="{{ $year }}"
                          {{ old('year') == $year ? 'selected' : '' }}>
                          {{ $year }}</option>
                      @endforeach
                  </select>
                <label for="year">年</label>
                  <select id="month" name="month">
                    <option value="">---</option>
                      @foreach(range(1, 12) as $month)
                      <option
                          value="{{ $month }}"
                          {{ old('month') == $month ? 'selected' : '' }}>
                          {{ $month }}</option>
                      @endforeach
                  </select>
                <label for="month">月</label>
                  <select
                      id="day"
                      name="day"
                      data-old-value="{{ old('day') }}">
                      <option value="">---</option>
                  </select>
                <label for="day">日</label>
                @if(!($errors->has('birthday'))&&old('birthday'))
                  </div>
                @endif
              <script src="/js/birthday.js"></script>
                @if($errors->has('birthday'))
                  <div class="error">
			            @foreach($errors->get('birthday') as $message)
			            	・{{ $message }}<br>
		            	@endforeach
                  </div>
	            	@endif
              </div>
                @if(!($errors->has('password'))&&count($errors)>0)
                <div>
                 <p class="reinput"> 他に入力不備があったためおパスワードを入力し直してください。</p>
                @endif
              <div class="form-group">
                <label for="password">パスワード</label>
                <input type="password" class="form-control" id="password" name="password">
              </div>
              <div class="form-group">
                <label for="password-confirm">パスワード（確認）</label>
                <input type="password" class="form-control" id="password-confirm" name="password_confirmation">
              </div>
                @if(!($errors->has('password'))&&count($errors)>0)
                  </div>
                @endif
                @if($errors->has('password'))
                  <div class="error">
			            @foreach($errors->get('password') as $message)
			            	・{{ $message }}<br>
		            	@endforeach
                  </div>
	            	@endif
              <div class="text-right">
                <button type="submit" class="btn btn-primary">登録</button>
              </div>
            </form>
          </div>
        </nav>
      
      <a class="login" href="/shopping/nusers/login">ログインページは<span class="login_guide" >こちら</span></a>

  @endsection

