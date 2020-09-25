@extends('layouts.admin.app')

@section('content')

    <h1>Register</h1>
    <hr>
    
    <form action="{{route('register')}}" method="POST">
        {{csrf_field()}}

        <label for="usernameID">Username</label>
        <div class='form-inline'>
            <input type="text" id="usernameID" class="form-control @error('username') is-invalid @enderror" name="username" placeholder="Username" style="width:320px" value="{{old('username')}}">
            @error('username') <label style="width: 5px"></label> <label style="color:red"> {{$message }}</label> @enderror
        </div>
        
        <br>

        <label for="nameID">Name</label>
        <div class='form-inline'>
            <input type="text" id="login" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Name" style="width:320px"  value="{{old('name')}}">
            @error('name') <label style="width: 5px"></label> <label style="color:red"> {{$message }}</label> @enderror
        </div>

        <br>
    
        <label for="passwordID">Password</label>
        <div class='form-inline'>
            <input type="password" id="passwordID" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password" style="width:320px">
            @error('password') <label style="width: 5px"></label> <label style="color:red"> {{$message }}</label> @enderror
        </div>
        

        <br>

        <label for="passwordID">Password</label>
        <input type="password" id="login" class="form-control @error('password') is-invalid @enderror" name="password_confirmation" placeholder="Confirm Password" style="width:320px">
        <br>

        <label for="roleID">Role</label>
        <select id="roleID" class="form-control roles-select" name="role" style="width:320px">
            @foreach ($roles as $role)
                @if ($role->id != '1')
                    <option value="{{$role->id}}" @if (old('role') == $role->id) {{'selected'}} @endif>{{$role->name}}</option>  
                @endif
            @endforeach
        </select>

        <br>

        <input type="submit" class="btn btn-success" value="Register">
    </form>
    

    
@endsection