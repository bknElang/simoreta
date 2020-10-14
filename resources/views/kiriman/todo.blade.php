@extends($layout)

@section('content')
    
    <h1>Kiriman Dokumen</h1>
    <hr>

    <form action="/searchtodokiriman" method="get">
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
                <a href="/todokiriman"" class="btn btn-dark">Clear Filter</a>
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
                    <th class="col-sm-2" style="width: 100px"><b>Requested Byr</b></th>
                    <th class="col-sm-2" style="width: 100px"><b>Tanggal Order</b></th>
                    <th class="col-sm-2" style="width: 100px"><b>Nama Tujuan</b></th>
                    <th class="col-sm-2" style="width: 100px"><b>PIC Penerima</b></th>
                    <th class="col-sm-2" style="width: 100px"><b>Status</b></th>
                </thead>

                @foreach ($kirimans as $kiriman)
                    <tr>
                        <td style="vertical-align: middle"><a href="/todokiriman/{{ $kiriman->id }}" class="btn btn-light">{{ $kiriman->id }}</a></td>
                        <td style="vertical-align: middle">{{ $kiriman->uName}}</td>
                        <td style="vertical-align: middle">{{ $kiriman->orderDate}}</td>
                        <td style="vertical-align: middle">{{ $kiriman->namaDebitur}}</td>
                        <td style="vertical-align: middle">{{ $kiriman->namaPIC}}</td>
                        <td style="vertical-align: middle">
                            @if ($kiriman->status == "PENDING")
                                <label style="color:red"><b>{{ $kiriman->status}}</b></label>
                            @elseif ($kiriman->status == "IN PROGRESS")
                                <label style="color:blue"><b>{{ $kiriman->status}}</b></label>
                            @elseif ($kiriman->status == "IN PROGRESS")
                                <label style="color:green"><b>{{ $kiriman->status}}</b></label>
                            @else
                                <label>{{ $kiriman->status}}</label>
                            @endif
                        </td>
                    </tr>
                @endforeach   
            </table>

        </div>
    </div>

    <div class='row'>
        <label style="width: 15px"></label>
        {{ $kirimans->links('pagination::bootstrap-4') }}
    </div>
   
    
@endsection