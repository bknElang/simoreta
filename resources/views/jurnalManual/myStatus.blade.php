@extends($layout)

@section('content')
    
    <h1>Jurnal Manual</h1>
    <hr>

    <form action="/searchmyjurnalmanual" method="get">
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
                <a href="/myjurnalmanual"" class="btn btn-dark">Clear Filter</a>
            </div>
        </div>
    </form>

    <hr>

    <p>Click ID for details</p>

    <div class="row">
        <div class="col-sm-12">
            <table class="table table-hover table-responsive-sm">
                <thead>
                    <td class="col-sm-1" style="width: 30px"><b>ID</b></td>
                    <td class="col-sm-2" style="width: 100px"><b>Tanggal Order</b></td>
                    <td class="col-sm-2" style="width: 100px"><b>File Name</b></td>
                    <td class="col-sm-2" style="width: 100px"><b>Status</b></td>
                </thead>

                @foreach ($manuals as $manual)
                    <tr>
                        <td><a href="/myjurnalmanual/{{ $manual->id }}" class="btn btn-light">{{ $manual->id }}</a></td>
                        <td>{{ $manual->orderDate}}</td>
                        <td>{{ $manual->filename}}</td>
                        <td>
                            @if ($manual->status == "PENDING")
                                <label style="color:red"><b>{{ $manual->status}}</b></label>
                            @elseif ($manual->status == "IN PROGRESS")
                                <label style="color:#CCCC00"><b>{{ $manual->status}}</b></label>
                            @else
                                <label style="color:lime"><b>{{ $manual->status}}</b></label>
                            @endif
                        </td>
                    </tr>
                @endforeach   
            </table>

        </div>
    </div>

    <div class='row'>
        <label style="width: 15px"></label>
        {{ $manuals->links('pagination::bootstrap-4') }}
    </div>
   
    
@endsection