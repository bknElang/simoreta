@extends('layouts.admin.app')

@section('content')
    
    <h1>User List</h1>
    <hr>
    <form action="{{route('search')}}" method="GET">
        <div class="form-inline">
            <input name="search" type="text" placeholder="Search User's Name" class="form-control" style="width:500px">
            <label for="" style="width:30px"></label>
            <button type="submit" class="btn btn-success">Search</button>
        </div>
    </form>
    <br>
    <div class="row">
        <div class="col-sm-10">
            <table class="table table-hover">
                <thead>
                    <td class="col-sm-1" style="width: 30px"><b>ID</b></td>
                    <td class="col-sm-2" style="width: 100px"><b>Nama</b></td>
                    <td class="col-sm-3" style="width: 100px"><b>Username</b></td>
                    <td class="col-sm-2" style="width: 100px"><b>Role</b></td>
                    <td class="col-sm-2" style="width: 50px"><b>Edit</b></td>
                </thead>

                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name}}</td>
                        <td>{{ $user->username}}</td>
                        <td>{{ $user->role->name}}</td>
                        <td>
                            <a href="/users/{{$user->id}}" class="btn btn-info">Details</a>
                        </td>
                    </tr>
                @endforeach   
            </table>

        </div>

        <div class="col-sm-2"></div>
    </div>

    <div class='row'>
        <label style="width: 15px"></label>
        {{ $users->links('pagination::bootstrap-4') }}
    </div>
   
    
@endsection