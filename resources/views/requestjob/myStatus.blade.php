@extends($layout)

@section('content')
    
    <h1>Requested Job</h1>
    <hr>

    <form action="/searchmyjob" method="get">
        <div class="row">
            <div class="col-sm-4 form-inline">
                <label for="">From:</label>
                <input type="datetime-local" class="form-control" name="from">
            </div>
            <div class="col-sm-4 form-inline">
                <label for="">To:</label>
                <input type="datetime-local" class="form-control" name="to">
            </div>

            <div class="col-sm-4">
                <button type="submit" class="btn btn-success">Search by Order Date</button>
                <a href="/myjob"" class="btn btn-dark">Clear Filter</a>
            </div>
        </div>
    </form>

    <hr>

    <p>Click ID for details</p>

    <div class="row">
        <div class="col-sm-12">
            <table class="table table-hover table-responsive-sm">
                <thead>
                    <th class="col-sm-1" style="width: 30px"><b>ID</b></th>
                    <th class="col-sm-2" style="width: 100px"><b>Tanggal Order</b></th>
                    <th class="col-sm-2" style="width: 100px"><b>Jenis</b></th>
                    <th class="col-sm-2" style="width: 100px"><b>Assigned to</b></th>
                    <th class="col-sm-1" style="width: 30px"><b>Status</b></th>
                </thead>

                @foreach ($requestjobs as $requestjob)
                    <tr>
                        <td><a href="/myjob/{{ $requestjob->id }}" class="btn btn-light">{{ $requestjob->id }}</a></td>
                        <td>{{ $requestjob->orderDate}}</td>
                        <td>{{ $requestjob->jenis}}</td>
                        <td>{{ $requestjob->rName}}</td>
                        <td>
                            @if ($requestjob->status == "Waiting for Approval")
                                <label style="color:#606060"><b>{{ $requestjob->status}}</b></label>
                            @elseif ($requestjob->status == "REJECTED")
                                <label style="color:#CC0000"><b>{{ $requestjob->status}}</b></label>
                            @elseif ($requestjob->status == "PENDING")
                                <label style="color:#CC6600"><b>{{ $requestjob->status}}</b></label>
                            @elseif ($requestjob->status == "IN PROGRESS")
                                <label style="color:blue"><b>{{ $requestjob->status}}</b></label>
                            @elseif ($requestjob->status == "FINISHED")
                                <label style="color:green"><b>{{ $requestjob->status}}</b></label>
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