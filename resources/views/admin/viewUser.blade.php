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

    <hr>

    <p>Click ID for details</p>

    <hr>

    <div class="row">
        <div class="col-sm-12">
            <table class="table table-hover">
                <thead>
                    <th class="col-sm-1" style="width: 30px"><b>ID</b></th>
                    <th class="col-sm-2" style="width: 30px"><b>Cabang</b></th>
                    <th class="col-sm-2" style="width: 100px"><b>Nama</b></th>
                    <th class="col-sm-2" style="width: 100px"><b>NIP</b></th>
                    <th class="col-sm-3" style="width: 100px"><b>Email</b></th>
                    <th class="col-sm-2" style="width: 100px"><b>No. HP</b></th>
                    <th class="col-sm-2" style="width: 100px"><b>Unit Kerja</b></th>
                </thead>

                @foreach ($users as $user)
                    <tr>
                        <td><a href="/users/{{ $user->id }}" class="btn btn-light">{{ $user->id }}</a></td>
                        <td>{{ $user->cName }}</td>
                        <td>{{ $user->name}}</td>
                        <td>{{ $user->NIP}}</td>
                        <td>{{ $user->email}}</td>
                        <td>{{ $user->nohp}}</td>
                        <td>{{ $user->rName}}</td>
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