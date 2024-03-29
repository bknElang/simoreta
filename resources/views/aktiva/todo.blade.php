@extends($layout)

@section('content')
    
    <h1>Kebutuhan Aktiva</h1>
    <hr>

    <form action="/searchtodoaktiva" method="get">
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
                <a href="/todoaktiva" class="btn btn-dark">Clear Filter</a>
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
                    <td class="col-sm-2" style="width: 100px"><b>Jenis Barang</b></td>
                    <td class="col-sm-1" style="width: 30px"><b>Status</b></td>
                </thead>

                @foreach ($aktivas as $aktiva)
                    <tr>
                        <td><a href="/todoaktiva/{{ $aktiva->id }}" class="btn btn-light">{{ $aktiva->id }}</a></td>
                        <td>{{ $aktiva->uName}}</td>
                        <td>{{ $aktiva->orderDate}}</td>
                        <td>{{ $aktiva->jenisBarang}}</td>
                        <td>
                            @if ($aktiva->status == "Waiting for Approval")
                                <label style="color:#606060"><b>{{ $aktiva->status}}</b></label>
                            @elseif ($aktiva->status == "REJECTED")
                                <label style="color:#CC0000"><b>{{ $aktiva->status}}</b></label>
                            @elseif ($aktiva->status == "PENDING")
                                <label style="color:#CC6600"><b>{{ $aktiva->status}}</b></label>
                            @elseif ($aktiva->status == "IN PROGRESS")
                                <label style="color:blue"><b>{{ $aktiva->status}}</b></label>
                            @elseif ($aktiva->status == "FINISHED")
                                <label style="color:green"><b>{{ $aktiva->status}}</b></label>
                            @endif
                        </td>
                    </tr>
                @endforeach   
            </table>

        </div>
    </div>

    <div class='row'>
        <label style="width: 15px"></label>
        {{ $aktivas->links('pagination::bootstrap-4') }}
    </div>
   
    
@endsection