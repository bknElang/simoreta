@extends('layouts.admin.app')

@section('content')

    <h1>User's Detail</h1>
    <hr>

    <form action="{{$user->id}}" method="POST">
        <div class="row">
            <div class="col-sm-6">
                @method('patch')
                @csrf
                
                <label for="NIPID">NIP</label>
                <div class='form-inline'>
                    <input type="text" id="NIPID" class="form-control @error('nip') is-invalid @enderror" name="nip" placeholder="NIP" style="width:320px" value="{{$user->NIP}}">
                    @error('nip') <label style="width: 5px"></label> <label style="color:red"> {{$message }}</label> @enderror
                </div>

                <br>

                <label for="emailID">Email</label>
                <div class='form-inline'>
                    <input type="text" id="emailID" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Email" style="width:320px" value="{{$user->email}}">
                    @error('email') <label style="width: 5px"></label> <label style="color:red"> {{$message }}</label> @enderror
                </div>
                
                <br>

                <label for="nohpID">No. HP</label>
                <div class='form-inline'>
                    <input type="text" id="nohpID" class="form-control @error('nohp') is-invalid @enderror" name="nohp" placeholder="No. HP" style="width:320px" value="{{$user->nohp}}">
                    @error('nohp') <label style="width: 5px"></label> <label style="color:red"> {{$message }}</label> @enderror
                </div>
                
                <br>
        
                <label for="nameID">Name</label>
                <div class='form-inline'>
                    <input type="text" id="login" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Name" style="width:320px" value="{{$user->name}}">
                    @error('name') <label style="width: 5px"></label> <label style="color:red"> {{$message }}</label> @enderror
                </div>
        
                <br>
            
                <label for="passwordID">Password</label>
                <div class='form-inline'>
                    <input type="password" id="passwordID" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password" style="width:320px">
                    @error('password') <label style="width: 5px"></label> <label style="color:red"> {{$message }}</label> @enderror
                </div>
                
                <br>
        
                <label for="passwordID">Confirm Password</label>
                <input type="password" id="login" class="form-control @error('password') is-invalid @enderror" name="password_confirmation" placeholder="Confirm Password" style="width:320px">
                
                <br>

                <label for="cabangID">Cabang</label>
                <select id="cabangID" class="form-control roles-select" name="cabang" style="width:320px">
                    @foreach ($cabangs as $cabang)
                        <option value="{{$cabang->id}}" @if ($cabang->id == $user->cabang_id) {{'selected'}} @endif>{{$cabang->name}}</option>  
                    @endforeach
                </select>

                <br>
        
                <label for="roleID">Role</label>
                <select id="roleID" class="form-control roles-select" name="role" style="width:320px">
                    @foreach ($roles as $role)
                        <option value="{{$role->id}}" @if ($role->id == $user->role_id) {{'selected'}} @endif>{{$role->name}}</option>  
                    @endforeach
                </select>
        
                <br>

                <div class="form-inline">
                    <input type="submit" class="btn btn-success" value="Update">
            </form>
           
                    <label for="" style="width: 5px"></label>
                    
                    <form action="{{$user->id}}" method="POST">
                        @method('delete')
                        @csrf
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            <br>
            
            
            </div>

            <form action="{{$user->id}}" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="col-sm-4">
                    <a href="#" class="btn btn-dark" style="border-radius:50%"><img src="{{asset('images/'.$user->avatar)}}" alt="" style="border-radius:50%; width:400px;"></a>
                    <br><br>
                    <div class="form-inline">
                        <input type="file" class="btn btn-dark" name="image" style="margin-left: 30px">
                        <button type="submit" class="btn btn-dark" style="margin-left: 30px">Change Avatar</button>
                    </div>
                    
                    <br>
                    
                    @if(Session::has('updateAvaSuccess'))
                        <div class="alert alert-success" style="width:320px">{{ Session::get('updateAvaSuccess') }}</div>
                    @endif
                </div>
            </form>
        </div>

        @if(Session::has('updateSuccess'))
                <div class="alert alert-success" style="width:320px">{{ Session::get('updateSuccess') }}</div>
        @endif

@endsection