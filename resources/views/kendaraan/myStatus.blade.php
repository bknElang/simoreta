@extends($layout)

@section('content')
    
    <h1>Order List</h1>
    <hr>

    <form action="/searchmyordercar" method="get">
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
                <a href="/myordercar" class="btn btn-dark">Clear Filter</a>
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
                    <th class="col-sm-2" style="width: 100px"><b>Tanggal Pemakaian</b></th>
                    <th class="col-sm-2" style="width: 100px"><b>Tanggal Selesai Pemakaian</b></th>
                    <th class="col-sm-1" style="width: 30px"><b>Status</b></th>
                    <th class="col-sm-2" style="width: 100px"><b>Keperluan</b></th>
                </thead>

                @foreach ($orderkendaraans as $orderkendaraan)
                    <tr>
                        <td style="vertical-align: middle"><a href="/myordercar/{{ $orderkendaraan->id }}" class="btn btn-light">{{ $orderkendaraan->id }}</a></td>
                        <td style="vertical-align: middle">{{ $orderkendaraan->orderDate}}</td>
                        <td style="vertical-align: middle">{{ $orderkendaraan->useDatetime}}</td>
                        <td style="vertical-align: middle">{{ $orderkendaraan->finishDatetime}}</td>
                        <td style="vertical-align: middle">
                            @if ($orderkendaraan->status == "Waiting for Approval")
                                <label style="color:#606060"><b>{{ $orderkendaraan->status}}</b></label>
                            @elseif ($orderkendaraan->status == "REJECTED")
                                <label style="color:#CC0000"><b>{{ $orderkendaraan->status}}</b></label>
                            @elseif ($orderkendaraan->status == "PENDING")
                                <label style="color:#CC6600"><b>{{ $orderkendaraan->status}}</b></label>
                            @elseif ($orderkendaraan->status == "IN PROGRESS")
                                <label style="color:blue"><b>{{ $orderkendaraan->status}}</b></label>
                            @elseif ($orderkendaraan->status == "IN PROGRESS")
                                <label style="color:green"><b>{{ $orderkendaraan->status}}</b></label>
                            @endif
                        </td>
                        <td style="vertical-align: middle">{{ $orderkendaraan->necessity}}</td>
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