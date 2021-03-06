@extends('layouts.app')

@section('content')

<link rel="stylesheet" type="text/css" href="{{ asset('/frontend/styles/contact_styles.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('/frontend/styles/contact_responsive.css') }}">

<div class="contact_form">
  <div class="container">
    <div class="row">
      <div class="col-lg-7 login_form mx-auto">
        <div class="contact_form_container">
          <div class="contact_form_title">ユーザー設定</div>
          <form action="{{ route('update.profile.info') }}" id="contact_form" method="POST">
            @csrf
            <div class="form-group">
              <label for="name">お名前</label>
              <input type="text" class="form-control" placeholder="例）山田太郎" name="name" required="" value="{{ old('name', $user->name) }}">
              @error('name')
                <span class="register_feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>

            <div class="form-group">
              <label for="kana">フリガナ</label>
              <input type="text" class="form-control" placeholder="例）ヤマダタロウ" name="kana" required="" value="{{ old('kana', $user->kana) }}" onBlur="$(this).val(hiraToKana($(this).val()));">
              @error('kana')
                <span class="register_feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>

            <div class="form-group">
              <label for="phone">電話番号</label>
              <input type="tel" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone', $user->phone) }}"  placeholder="例）09012345678" required="" onBlur="$(this).val(check_only_num($(this).val()));" maxlength="11">
              @error('phone')
                <span class="register_feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>

            <div class="form-group">
              <label for="email">メールアドレス</label>
              <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $user->email) }}" aria-describedby="emailHelp" placeholder="例）test@test.com" required="">
              @error('email')
                <span class="register_feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>

            <div class="form-group">
              <label for="zip_code">郵便番号<span class="tx-danger">*</span></label>
              <input type="text" class="form-address" placeholder="例）1001000"  name="zip_code" required="" maxlength="7" value="{{ old('zip_code', $user->zip_code) }}">
              @error('zip_code')
                <span class="register_feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>

            <div class="form-group">
              <label for="prefectures">都道府県<span class="tx-danger">*</span></label>
              <select name="prefectures" id="" class="form-address" >
                @foreach ($prefs as $index => $name)
                  <option value="{{ $index }}" {{ $index == old('prefectures', $user->prefectures) ? 'selected' : '' }}>{{ $name }}</option>
                @endforeach
              </select>
              @error('prefectures')
                <span class="register_feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>

            <div class="form-group">
              <label for="address1">住所１<span class="tx-danger">*</span></label>
              <input type="text" class="form-control" placeholder="市区町村番地"  name="address1" required="" value="{{ old('address1', $user->address1) }}">
              @error('address1')
                <span class="register_feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>

            <div class="form-group">
              <label for="address2">住所２</label>
              <input type="text" class="form-control" placeholder="建物名" name="address2" value="{{ old('address2', $user->address2) }}">
            </div>

            <div class="contact_form_button text-center">
              <button type="submit" class="btn submit-btn font-weight-bold col-lg-5">更新する</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  function hiraToKana(str) {
      return str.replace(/[\u3041-\u3096]/g, function(match) {
          var chr = match.charCodeAt(0) + 0x60;
          return String.fromCharCode(chr);
      });
  }

  function check_only_num(num){
      let value = num;
      value = value
          .replace(/[０-９]/g, function(s) {
              return String.fromCharCode(s.charCodeAt(0) - 65248);
          })
          .replace(/[^0-9]/g, '');
      return value;
  }
</script>

@endsection
