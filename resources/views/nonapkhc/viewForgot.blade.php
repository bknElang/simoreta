@extends('layouts.nonapkhc.app')

@section('content')
    
    <h1>User List</h1>

    <hr>

    <p>Click User ID for details</p>

    <hr>

    @if(Session::has('success'))
            <div class="alert alert-success">{{ Session::get('success') }}</div>
    @endif

    <div class="row">
        <div class="col-sm-12">
            <table class="table table-hover">
                <thead>
                    <th class="col-sm-1" style="width: 30px"><b>ID</b></th>
                    <th class="col-sm-1" style="width: 30px"><b>User ID</b></th>
                    <th class="col-sm-3" style="width: 200px"><b>Nama</b></th>
                    <th class="col-sm-3" style="width: 200px"><b>NIP</b></th>
                    <th class="col-sm-2" style="width: 100px"><b>Action</b></th>
                </thead>

                @foreach ($resets as $reset)
                    <tr>
                        <form action="/viewforgothc/{{$reset->resetID}}" method="post">
                            @method('patch')
                            @csrf
                            <input type="hidden" value="{{$reset->resetID}}" name="resetID">
                            <input type="hidden" value="{{$reset->id}}" name="userID">
                            <td>{{$reset->resetID}}</td>
                            <td><a href="/users/{{ $reset->id }}">{{$reset->id}}</a></td>
                            <td>{{$reset->name}}</td>
                            <td>{{$reset->NIP}}</td>
                            <td><button type="submit" class="btn btn-success">Approve</button></td>
                        </form>
                    </tr>
                @endforeach   
            </table>

        </div>

        <div class="col-sm-2"></div>
    </div>

    <div class='row'>
        <label style="width: 15px"></label>
        {{ $resets->links('pagination::bootstrap-4') }}
    </div>
   
    
@endsection