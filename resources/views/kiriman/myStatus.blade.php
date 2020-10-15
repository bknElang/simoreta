@extends($layout)

@section('content')
    
    <h1>Kiriman Dokumen</h1>
    <hr>

    <form action="/searchmykiriman" method="get">
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
                <a href="/mykiriman"" class="btn btn-dark">Clear Filter</a>
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
                    <th class="col-sm-2" style="width: 100px"><b>Nama Tujuan</b></th>
                    <th class="col-sm-2" style="width: 100px"><b>PIC Penerima</b></th>
                    <th class="col-sm-2" style="width: 100px"><b>Status</b></th>
                </thead>

                @foreach ($kirimans as $kiriman)
                    <tr>
                        <td><a href="/mykiriman/{{ $kiriman->id }}" class="btn btn-light">{{ $kiriman->id }}</a></td>
                        <td>{{ $kiriman->orderDate}}</td>
                        <td>{{ $kiriman->namaDebitur}}</td>
                        <td>{{ $kiriman->namaPIC}}</td>
                        <td>
                            @if ($kiriman->status == "Waiting for Approval")
                                <label style="color:#606060"><b>{{ $kiriman->status}}</b></label>
                            @elseif ($kiriman->status == "REJECTED")
                                <label style="color:#CC0000"><b>{{ $kiriman->status}}</b></label>
                            @elseif ($kiriman->status == "PENDING")
                                <label style="color:#CC6600"><b>{{ $kiriman->status}}</b></label>
                            @elseif ($kiriman->status == "IN PROGRESS")
                                <label style="color:blue"><b>{{ $kiriman->status}}</b></label>
                            @elseif ($kiriman->status == "IN PROGRESS")
                                <label style="color:green"><b>{{ $kiriman->status}}</b></label>
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