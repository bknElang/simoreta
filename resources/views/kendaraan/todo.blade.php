@extends($layout)

@section('content')
    
    <h1>Order List</h1>
    <hr>

    <form action="/searchtodocar" method="get">
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
                <a href="/todocar" class="btn btn-dark">Clear Filter</a>
            </div>
        </div>
    </form>

    <hr>

    <div class="row">
        <div class="col-sm-12">
            <p>Click ID for details</p>
        </div>
    </div>
    
    <div class="row">
        <div class="col-sm-12">
            <table class="table table-hover table-responsive-sm">
                <thead>
                    <th class="col-sm-1" style="width: 30px"><b>ID</b></th>
                    <th class="col-sm-1" style="width: 100px"><b>Requested By</b></th>
                    <th class="col-sm-2" style="width: 100px"><b>Order Date</b></th>
                    <th class="col-sm-2" style="width: 100px"><b>Tanggal Pemakaian</b></th>
                    <th class="col-sm-2" style="width: 100px"><b>Tanggal Selesai Pemakaian</b></th>
                    <th class="col-sm-1" style="width: 30px"><b>Status</b></th>
                </thead>

                @foreach ($orderkendaraans as $orderkendaraan)
                    <tr>
                        <td><a href="/todocar/{{ $orderkendaraan->id }}" class="btn btn-light">{{ $orderkendaraan->id }}</a></td>
                        <td>{{ $orderkendaraan->uName}}</td>
                        <td>{{ $orderkendaraan->orderDate}}</td>
                        <td>{{ $orderkendaraan->useDatetime}}</td>
                        <td>{{ $orderkendaraan->finishDatetime}}</td>
                        <td>
                            @if ($orderkendaraan->status == "PENDING")
                                <label style="color:red"><b>{{ $orderkendaraan->status}}</b></label>
                            @elseif ($orderkendaraan->status == "IN PROGRESS")
                                <label style="color:#CCCC00"><b>{{ $orderkendaraan->status}}</b></label>
                            @else
                                <label style="color:lime"><b>{{ $orderkendaraan->status}}</b></label>
                            @endif
                        </td>
                    </tr>
                @endforeach   
            </table>

        </div>
    </div>

    <div class='row'>
        <label style="width: 15px"></label>
        {{ $orderkendaraans->links('pagination::bootstrap-4') }}
    </div>
   
    
@endsection