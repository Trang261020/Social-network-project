@extends('layouts.admin')
<link href="{{ asset('build/assets/app-form.css') }}" rel="stylesheet">

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Login Admin</div>
                    <div class="card-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('admin-login') }}">
                             @csrf
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label class="control-label">Email Address</label>
                                <div class="">
                                    <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label class="control-label">Password</label>
                                <div class="">
                                    <input type="password" class="form-control" name="password">
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-btn fa-sign-in"></i>Login
                                    </button>
                                    <a class="btn btn-link" href="{{ url('/password/reset') }}">Forgot Your Password?</a>
                                </div>
                            </div>
                        </form>
                        @if(Session::has('error'))
                            <div class="alert alert-success">
                                {{ Session::get('error') }}
                                @php
                                    Session::forget('error');
                                @endphp
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

