@extends($layout)

@section('content')

    <h2>Change Password</h2>
    <hr>

    @if(Session::has('error'))
        <div class="alert alert-danger">{{ Session::get('error') }}</div>
    @endif

    @if(Session::has('success'))
        <div class="alert alert-success">{{ Session::get('success') }}</div>
    @endif

    <form action="/changepassword/{{$user->id}}" enctype="multipart/form-data" method="POST">
        @method('patch')
        @csrf
        <div class="col-sm-4">
            <div class="row">
                <label for="oldID">Old Password</label>
                <input type="password" id="oldID" name="oldPassword" class="form-control">
            </div>

            <br>

            <div class="row">
                <label for="newID">New Password</label>
                <input type="password" id="newID" name="newPassword" class="form-control @error('newPassword') is-invalid @enderror">
                @error('newPassword')</label> <label style="color:red"> {{$message}}</label> @enderror
            </div>

            <br>

            <div class="row">
                <label for="confID">Confirm Password</label>
                <input type="password" id="confID" name="newPassword_confirmation" class="form-control @error('newPassword') is-invalid @enderror">
            </div>

            <br>

            <div class="row">
                <button type="submit" class="btn btn-success">Change Password</button>
                <a href="/" class="btn btn-dark" style="margin-left: 5px">Back to Home</a>
            </div>
        </div>
    </form>

    <br>

    @if ($interval->format('%a') < 8)
        <div class="alert alert-danger">You have <b>{{$interval->format("%a day(s)")}}</b> to change password before account non-activation</div>
    @else
        <div class="alert alert-warning">You have <b>{{$interval->format("%a day(s)")}}</b> to change password before account non-activation</div>
    @endif

@endsection