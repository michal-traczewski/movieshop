<div class="jumbotron">
    <div class="container">
        <form name="editUser" action="profile" method="POST">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="firstName">First Name:</label>
                <input type="text" name="firstName" id="firstName" class="form-control" placeholder="First Name" value="{{ $user->first_name }}"><br/>
                @if ($errors->first('firstName'))
                    <div class="alert alert-danger" role="alert">
                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                        <span class="sr-only">Error:</span>
                        {{ $errors->first('firstName') }}
                    </div>
                @endif
                <label for="lastName">Last Name:</label>
                <input type="text" name="lastName" id="lastName" class="form-control" placeholder="Last Name" value="{{ $user->name }}"><br/>
                @if ($errors->first('lastName'))
                    <div class="alert alert-danger" role="alert">
                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                        <span class="sr-only">Error:</span>
                        {{ $errors->first('lastName') }}
                    </div>
                @endif
                <label for="address">Address:</label>
                <input type="text" name="address" id="address" class="form-control" placeholder="Address" value="{{ $user->address }}"><br/>
                @if ($errors->first('address'))
                    <div class="alert alert-danger" role="alert">
                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                        <span class="sr-only">Error:</span>
                        {{ $errors->first('address') }}
                    </div>
                @endif
                <label for="city">City:</label>
                <input type="text" name="city" id="city" class="form-control" placeholder="City" value="{{ $user->city }}"><br/>
                @if ($errors->first('city'))
                    <div class="alert alert-danger" role="alert">
                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                        <span class="sr-only">Error:</span>
                        {{ $errors->first('city') }}
                    </div>
                @endif
                <label for="postalCode">Postal Code:</label>
                <input type="text" name="postalCode" id="postalCode" class="form-control" placeholder="Postal Code" value="{{ $user->postal_code }}"><br/>
                @if ($errors->first('postalCode'))
                    <div class="alert alert-danger" role="alert">
                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                        <span class="sr-only">Error:</span>
                        {{ $errors->first('postalCode') }}
                    </div>
                @endif
                <label for="phoneNumber">Phone Number:</label>
                <input type="text" name="phoneNumber" id="phoneNumber" class="form-control"  placeholder="Phone Number" value="{{ $user->phone }}"><br/>
                @if ($errors->first('phoneNumber'))
                    <div class="alert alert-danger" role="alert">
                        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                        <span class="sr-only">Error:</span>
                        {{ $errors->first('phoneNumber') }}
                    </div>
                @endif
            </div>
            <button class="btn btn-primary" tye="submit">
                <span class="glyphicon glyphicon-ok" ></span>Submit
            </button>
        </form>
    </div>
</div>