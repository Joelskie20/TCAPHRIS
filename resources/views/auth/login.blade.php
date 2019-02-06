@extends('layouts.app')

@section('title', 'Login')
@section('syles')
<style>
html,body{height:auto;}
.login-logo,.register-logo{margin-bottom:15px;}
</style>
@endsection
@section('content')
<body class="hold-transition login-page">
<div class="login-box">

  <div class="login-box-body">

    <div class="login-logo">
      <a href="/"><b>HRIS</b></a>
    </div>

    <p class="login-box-msg">Sign in to start your session</p>

    <form action="{{ route('login') }}" method="post">
      @csrf

      <div class="form-group has-feedback">
        <input type="text" id="username" name="username" class="form-control" value="{{ old('username') }}" placeholder="Employee ID..." required autofocus>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>

      <div class="form-group has-feedback">
        <input id="password" type="password" name="password" class="form-control" placeholder="Password" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>

      <div class="row">
        <div class="col-xs-12 pull-right">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
      </div>

    </form>

    @if ($errors->has('username'))
    <div class="alert alert-danger alert-dismissible mt10">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4><i class="icon fa fa-ban"></i>Error!</h4>
      {{ $errors->first('username') }}
    </div>
    @endif

    <a href="{{ route('password.request') }}" class="text-center mt10" style="display:block;">I forgot my password</a>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->
@stop