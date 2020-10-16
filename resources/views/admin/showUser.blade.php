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
                    <input type="text" id="NIPID" class="form-control" name="nip" placeholder="NIP" style="width:320px" value="{{$user->NIP}}" readonly>
                </div>

                <br>

                <label for="emailID">Email</label>
                <div class='form-inline'>
                    <input type="text" id="emailID" class="form-control" name="email" placeholder="Email" style="width:320px" value="{{$user->email}}" readonly>
                </div>
                
                <br>

                <label for="nohpID">No. HP</label>
                <div class='form-inline'>
                    <input type="text" id="nohpID" class="form-control" name="nohp" placeholder="No. HP" style="width:320px" value="{{$user->nohp}}" readonly>
                </div>
                
                <br>
        
                <label for="nameID">Name</label>
                <div class='form-inline'>
                    <input type="text" id="login" class="form-control" name="name" placeholder="Name" style="width:320px" value="{{$user->name}}" readonly>
                </div>
        
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

            <label for="" style="width: 5px"></label>

            <form action="{{$user->id}}" method="POST">
                @method('patch')
                @csrf
                <button type="submit" class="btn btn-primary">Activate User</button>
            </form>
        </div>
    <br>
                    
            </div>

            <div class="col-sm-4">
                <img src="{{asset('images/'.$user->avatar)}}" class="rounded mx-auto d-block" style="max-width:400px">
                <br>         
            </div>
        </div>

        @if(Session::has('updateSuccess'))
                <div class="alert alert-success" style="width:320px">{{ Session::get('updateSuccess') }}</div>
        @endif

@endsection