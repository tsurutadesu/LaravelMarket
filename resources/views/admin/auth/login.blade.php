@extends('admin.admin_layouts')

@section('admin_content')

  <div class="d-flex align-items-center justify-content-center bg-sl-primary ht-100v">

    <div class="login-wrapper wd-300 wd-xs-350 pd-25 pd-xs-40 bg-white">
      <div class="signin-logo tx-center tx-24 tx-bold tx-inverse">Laravel <span class="tx-info tx-normal">Market</span></div>
      <div class="tx-center mg-b-60">北欧、暮らしたい</div>

      <form action="{{ route('admin.login') }}" method="POST">
        @csrf

        <div class="form-group">
          <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

          @error('email')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror
        </div>

        <div class="form-group">

          <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

          @error('password')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror


          <a href="{{ route('admin.password.request') }}" class="tx-info tx-12 d-block mg-t-10">パスワードを忘れた方へ</a>
        </div><!-- form-group -->
        <button type="submit" class="btn btn-info btn-block">Sign In</button>

        <div class="mg-t-60 tx-center">新規会員登録がまだの方は <a href="{{ route('register') }}" class="tx-info">こちらへ</a></div>

      </form>

    </div><!-- login-wrapper -->
  </div><!-- d-flex -->

@endsection