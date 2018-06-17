@extends('layouts.main')
@section('content')               
<div class="jumbotron">
    <div class="container">
        <form name="register" action="{{ route('register') }}" method="POST">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="name">Last Name:</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Last Name" value="{{ old('name') }}" required autofocus><br/>
                @if ($errors->first('name'))
                    <div class="alert alert-danger" role="alert">
                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                        <span class="sr-only">Error:</span>
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <label for="email">Email:</label>
                <input type="text" name="email" id="email" class="form-control" placeholder="Email" value="{{ old('email') }}" required><br/>
                @if ($errors->first('email'))
                    <div class="alert alert-danger" role="alert">
                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                        <span class="sr-only">Error:</span>
                        {{ $errors->first('email') }}
                    </div>
                @endif
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" class="form-control" required><br/>
                @if ($errors->first('password'))
                    <div class="alert alert-danger" role="alert">
                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                        <span class="sr-only">Error:</span>
                        {{ $errors->first('password') }}
                    </div>
                @endif
                <label for="password_confirmation">Confirm Password:</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required><br/>
                @if ($errors->first('password'))
                    <div class="alert alert-danger" role="alert">
                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                        <span class="sr-only">Error:</span>
                        {{ $errors->first('password') }}
                    </div>
                @endif
            </div>
            <button class="btn btn-primary" tye="submit">
                <span class="glyphicon glyphicon-ok" ></span>Submit
            </button>
        </form>
    </div>
</div>
@endsection
