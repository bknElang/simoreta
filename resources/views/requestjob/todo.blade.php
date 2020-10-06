@extends($layout)

@section('content')
    
    <h1>Order List</h1>
    <hr>

    <div class="row">
        <div class="col-sm-12">
            <table class="table table-hover table-responsive-sm">
                <thead>
                    <th class="col-sm-1" style="width: 30px"><b>ID</b></th>
                    <th class="col-sm-2" style="width: 100px"><b>Requested by</b></th>
                    <th class="col-sm-2" style="width: 100px"><b>Tanggal Order</b></th>
                    <th class="col-sm-2" style="width: 100px"><b>Jenis</b></th>
                    <th class="col-sm-1" style="width: 30px"><b>Status</b></th>
                </thead>

                @foreach ($requestjobs as $requestjob)
                    <tr>
                        <td><a href="/todojob/{{ $requestjob->id }}" class="btn btn-light">{{ $requestjob->id }}</a></td>
                        <td>{{ $requestjob->uName}}</td>
                        <td>{{ $requestjob->orderDate}}</td>
                        <td>{{ $requestjob->jenis}}</td>
                        <td>
                            @if ($requestjob->status == 'PENDING')
                                <label style="color:red"><b>{{ $requestjob->status}}</b></label>
                            @elseif ($requestjob->status == 'IN PROGRESS')requestjob
                                <label style="color:yellow"><b>{{ $requestjob->status}}</b></label>
                            @elseif ($requestjob->status == 'FINISHED')
                                <label style="color:lime"><b>{{ $requestjob->status}}</b></label>
                            @endif
                        </td>
                    </tr>
                @endforeach   
            </table>

        </div>
    </div>

    <div class='row'>
        <label style="width: 15px"></label>
        {{ $requestjobs->links('pagination::bootstrap-4') }}
    </div>
   

@endsection