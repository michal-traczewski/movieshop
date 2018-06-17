@extends('layouts.main')
@section('content')
<div class="jumbotron">
    <div class="container">
        <form name="login" action="{{ route('login') }}" method="POST">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="text" name="email" id="email" class="form-control" placeholder="Email" value="{{ old('email') }}"><br/>
                @if ($errors->first('email'))
                    <div class="alert alert-danger" role="alert">
                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                        <span class="sr-only">Error:</span>
                        {{ $errors->first('email') }}
                    </div>
                @endif
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Password" ><br/>
                @if ($errors->first('password'))
                    <div class="alert alert-danger" role="alert">
                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                        <span class="sr-only">Error:</span>
                        {{ $errors->first('password') }}
                    </div>
                @endif
                <label for="remember">Remember Me:</label>
                <input type="checkbox" name="remember" id="remember" class="form-control" {{ old('remember') ? 'checked' : '' }}><br/>
                
            <button class="btn btn-primary" tye="submit">
                <span class="glyphicon glyphicon-ok" ></span>OK
            </button>
        </form>
    </div>
</div>
@endsection