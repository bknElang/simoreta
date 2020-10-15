@extends($layout)

@section('content')
    
    <h1>Perbaikan Aplikasi</h1>
    <hr>

    <form action="/searchtodofixaplikasi" method="get">
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
                <a href="/todofixaplikasi" class="btn btn-dark">Clear Filter</a>
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
                    <td class="col-sm-1" style="width: 30px"><b>ID</b></td>
                    <td class="col-sm-1" style="width: 100px"><b>Requested By</b></td>
                    <td class="col-sm-2" style="width: 100px"><b>Order Date</b></td>
                    <td class="col-sm-2" style="width: 100px"><b>Aplikasi</b></td>
                    <td class="col-sm-1" style="width: 30px"><b>Status</b></td>
                </thead>

                @foreach ($orderfixaplikasi as $orderfixaplikasi)
                    <tr>
                        <td style="vertical-align: middle"><a href="/todofixaplikasi/{{ $orderfixaplikasi->id }}" class="btn btn-light">{{ $orderfixaplikasi->id }}</a></td>
                        <td style="vertical-align: middle">{{ $orderfixaplikasi->uName}}</td>
                        <td style="vertical-align: middle">{{ $orderfixaplikasi->orderDate}}</td>
                        <td style="vertical-align: middle">{{ $orderfixaplikasi->jenis}}</td>
                        <td style="vertical-align: middle">
                            @if ($orderfixaplikasi->status == "PENDING")
                                <label style="color:red"><b>{{ $orderfixaplikasi->status}}</b></label>
                            @elseif ($orderfixaplikasi->status == "IN PROGRESS")
                                <label style="color:blue"><b>{{ $orderfixaplikasi->status}}</b></label>
                            @elseif ($orderfixaplikasi->status == "IN PROGRESS")
                                <label style="color:green"><b>{{ $orderfixaplikasi->status}}</b></label>
                            @else
                                <label>{{ $orderfixaplikasi->status}}</label>
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