@if(Auth::user()->role_id == 2)
    @extends('layouts.logistik.app')
@elseif(Auth::user()->role_id == 3)
    @extends('layouts.pembukuan.app') 
@endif

@section('content')
    <h2>User's Detail</h2>
    <hr>

    <form action="{{$user->id}}" method="POST">
        <div class="row">
            <div class="col-sm-6">
                @method('patch')
                @csrf
        
                <label for="usernameID">Username</label>
                <div class='form-inline'>
                    <input type="text" id="usernameID" class="form-control @error('username') is-invalid @enderror" name="username" placeholder="Username" style="width:320px" value="{{$user->username}}" readonly>
                    @error('username') <label style="width: 5px"></label> <label style="color:red"> {{$message }}</label> @enderror
                </div>
                
                <br>
        
                <label for="nameID">Name</label>
                <div class='form-inline'>
                    <input type="text" id="login" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Name" style="width:320px" value="{{$user->name}}" readonly>
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
        
                <label for="roleID">Role</label>
                <input type="text" id="login" class="form-control" name="role" placeholder="Role" style="width:320px" value="{{ $user->role->name}}" readonly>
        
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
                </div>
            </form>
        </div>

@endsection