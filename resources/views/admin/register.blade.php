@extends('layouts.admin.app')

@section('content')

    <h1>Register</h1>
    <hr>
    
    <form action="{{route('register')}}" method="POST">
        {{csrf_field()}}

        <label for="nameID">Name</label>
        <div class='form-inline'>
            <input type="text" id="login" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Name" style="width:320px"  value="{{old('name')}}">
            @error('name') <label style="width: 5px"></label> <label style="color:red"> {{$message }}</label> @enderror
        </div>

        <br>
        
        <label for="NIPID">NIP</label>
        <div class='form-inline'>
            <input type="text" id="NIPID" class="form-control @error('nip') is-invalid @enderror" name="nip" placeholder="NIP" style="width:320px" value="{{old('nip')}}">
            @error('nip') <label style="width: 5px"></label> <label style="color:red"> {{$message }}</label> @enderror
        </div>

        <br>

        <label for="emailID">Email</label>
        <div class='form-inline'>
            <input type="text" id="emailID" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Email" style="width:320px" value="{{old('email')}}">
            @error('email') <label style="width: 5px"></label> <label style="color:red"> {{$message }}</label> @enderror
        </div>
        
        <br>

        <label for="nohpID">No. HP</label>
        <div class='form-inline'>
            <input type="text" id="nohpID" class="form-control @error('nohp') is-invalid @enderror" name="nohp" placeholder="No. HP" style="width:320px" value="{{old('nohp')}}">
            @error('nohp') <label style="width: 5px"></label> <label style="color:red"> {{$message }}</label> @enderror
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

        <label for="CabangID">Cabang</label>
        <select id="cabangID" class="form-control roles-select" name="cabang" style="width:320px">
            @foreach ($cabangs as $cabang)
                <option value="{{$cabang->id}}" @if (old('cabang') == $cabang->id) {{'selected'}} @endif>{{$cabang->name}}</option>  
            @endforeach
        </select>

        <br>

        <label for="roleID">Unit Kerja</label>
        <select id="roleID" class="form-control roles-select" name="role" style="width:320px">
            @foreach ($roles as $role)
                @if ($role->id != '1')
                    <option value="{{$role->id}}" @if (old('role') == $role->id) {{'selected'}} @endif>{{$role->name}}</option>  
                @endif
            @endforeach
        </select>

        <br>

        @if(Session::has('registerSuccess'))
            <div class="alert alert-success" style="width:320px">{{ Session::get('registerSuccess') }}</div>
        @endif

        <input type="submit" class="btn btn-success" value="Register">      
    </form>
    
@endsection