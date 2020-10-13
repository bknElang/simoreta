@extends($layout)

@section('content')
    
    <h1>Kebutuhan Aktiva</h1>
    <hr>

    <form action="/searchmyaktiva" method="get">
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
                <a href="/myaktiva" class="btn btn-dark">Clear Filter</a>
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
                    <th class="col-sm-2" style="width: 100px"><b>Jenis Barang</b></th>
                    <th class="col-sm-2" style="width: 100px"><b>Spesifikasi</b></th>
                    <th class="col-sm-2" style="width: 100px"><b>Status</b></th>
                </thead>

                @foreach ($aktivas as $aktiva)
                    <tr>
                        <td><a href="/myaktiva/{{ $aktiva->id }}" class="btn btn-light">{{ $aktiva->id }}</a></td>
                        <td>{{ $aktiva->orderDate}}</td>
                        <td>{{ $aktiva->jenisBarang}}</td>
                        <td>{{ $aktiva->spesifikasi}}</td>
                        <td>
                            @if ($aktiva->status == "PENDING")
                                <label style="color:red"><b>{{ $aktiva->status}}</b></label>
                            @elseif ($aktiva->status == "IN PROGRESS")
                                <label style="color:blue"><b>{{ $aktiva->status}}</b></label>
                            @elseif ($aktiva->status == "IN PROGRESS")
                                <label style="color:green"><b>{{ $aktiva->status}}</b></label>
                            @else 
                                <label>{{ $aktiva->status}}</label>
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