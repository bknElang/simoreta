@extends('layouts.admin.app')

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
                        <form action="/viewforgot/{{$reset->resetID}}" method="post">
                            @method('delete')
                            @csrf
                            <input type="hidden" value="{{$reset->resetID}}" name="resetID">
                            <input type="hidden" value="{{$reset->id}}" name="userID">
                            <td style="vertical-align: middle">{{$reset->resetID}}</td>
                            <td style="vertical-align: middle"><a href="/users/{{ $user->id }}">{{$reset->id}}</a></td>
                            <td style="vertical-align: middle">{{$reset->name}}</td>
                            <td style="vertical-align: middle">{{$reset->NIP}}</td>
                            <td style="vertical-align: middle"><button type="submit" class="btn btn-success">Reset Password</button></td>
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