@extends('layouts.login')

@section('content')
<div id="app" v-cloak="">
        <div class="login-container">
            <div class="logo-place"> 
                   <div class="logo">
            </div>
            <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}
                
                <div class="form-group {{ $errors->has('username') ? ' has-error' : '' }}">
                    <label for="username" class="control-label">Username</label>
                    <input id="username" type="username" class="form-control form-input" name="username" value="{{ old('username') ? old('username') : 'admin' }}" required autofocus>
                    @if ($errors->has('username'))
                        <span class="help-block">
                            <strong>{{ $errors->first('username') }}</strong>
                        </span>
                    @endif
                </div>
                
 
                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password" class="control-label">Password</label>
                    <input id="password" type="password" class="form-control form-input" name="password" required>
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
 
                <div style="height:10px; "></div>
                <div class="form-group" style="text-align:right">
                    <label class="control-label" style="display: inline; margin-right: 15px;">Remember me</label>
                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                </div>
                
                <div style="height:10px; "></div>
                <div class="form-group" style="text-align:right">
                    <div class="">
                        <button type="submit" class="action-btn">
                            Login
                        </button>
                    </div>
                </div>
                
                
            </form>

        </div>
    </div>
@endsection
