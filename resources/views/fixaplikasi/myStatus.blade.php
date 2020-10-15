@extends($layout)

@section('content')
    
    <h1>Perbaikan Aplikasi</h1>
    <hr>

    <form action="/searchmyfixaplikasi" method="get">
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
                <a href="/myfixaplikasi" class="btn btn-dark">Clear Filter</a>
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
                    <th class="col-sm-2" style="width: 100px"><b>Aplikasi</b></th>
                    <th class="col-sm-1" style="width: 30px"><b>Keterangan</b></th>
                    <th class="col-sm-2" style="width: 100px"><b>Status</b></th>
                </thead>

                @foreach ($orderfixaplikasi as $orderfixaplikasi)
                    <tr>
                        <td style="vertical-align: middle"><a href="/myfixaplikasi/{{ $orderfixaplikasi->id }}" class="btn btn-light">{{ $orderfixaplikasi->id }}</a></td>
                        <td style="vertical-align: middle">{{ $orderfixaplikasi->orderDate}}</td>
                        <td style="vertical-align: middle">{{ $orderfixaplikasi->jenis}}</td>
                        <td style="vertical-align: middle">{{ $orderfixaplikasi->keterangan}}</td>
                        <td style="vertical-align: middle">
                            @if ($orderfixaplikasi->status == "Waiting for Approval")
                                <label style="color:#606060"><b>{{ $orderfixaplikasi->status}}</b></label>
                            @elseif ($orderfixaplikasi->status == "REJECTED")
                                <label style="color:#CC0000"><b>{{ $orderfixaplikasi->status}}</b></label>
                            @elseif ($orderfixaplikasi->status == "PENDING")
                                <label style="color:#CC6600"><b>{{ $orderfixaplikasi->status}}</b></label>
                            @elseif ($orderfixaplikasi->status == "IN PROGRESS")
                                <label style="color:blue"><b>{{ $orderfixaplikasi->status}}</b></label>
                            @elseif ($orderfixaplikasi->status == "IN PROGRESS")
                                <label style="color:green"><b>{{ $orderfixaplikasi->status}}</b></label>
                            @endif
                        </td>
                    </tr>
                @endforeach   
            </table>

        </div>
    </div>

    <div class='row'>
        <label style="width: 15px"></label>
        {{ $orderfixaplikasi->links('pagination::bootstrap-4') }}
    </div>
   
    
@endsection