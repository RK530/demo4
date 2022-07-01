<!DOCTYPE html>
<html >
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{config('app.name') }}</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="backend/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="backend/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="backend/dist/css/adminlte.min.css">

</head>
<body class="hold-transition login-page">
<div class="login-box">

  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <div class="login-logo">
        <b>{{config('app.name') }}</b>
      </div>

      <img src="public/images/userIcon.png" alt="User Avatar" class="center" style="margin-left:50px" >
      <form method="post" action="{{ route('login') }}" id="validateForm">
        @csrf
        <div class="input-group mb-3">
          <input type="name" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="User Name" value="{{ old('name') }}" required autocomplete="username" autofocus>
          
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
          @error('name')
          <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
          </span>
          @enderror
          
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" required autocomplete="current-password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
           
          @error('password')
              <span class="invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
              </span>
            @enderror
        </div>
       
        <div>
          <button type="submit" class="btn btn-primary btn-block"> {{ __('Sign In') }}</button>
        </div>
        <br>
        <div class="row">
        <div class="col-6">
        <div class="icheck-primary">
            <input type="checkbox" id="remember" {{ old('remember') ? 'checked' : '' }} name="remember" class="form-check-input">
            <label for="remember" class="form-check-label" style="font-weight: 700">
              {{ __('Remember Me') }}
             </label>
       </div>
       </div>
    <!-- /.col -->
        <div class="col-6">
          <!--            <button type="submit" class="btn btn-primary btn-block">Sign In</button>-->
          @if (Route::has('password.request'))
          <a class="btn btn-link" style="font-weight: 700" href="{{ route('password.request') }}">
              {{ __('Forgot Password?') }}
          </a>
          
      @endif
          </div>
          <!-- /.col -->
          </div>
      </form>