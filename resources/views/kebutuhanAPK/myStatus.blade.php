@extends($layout)

@section('content')
    
    <h1>Kebutuhan ATK</h1>
    <hr>

    <form action="/searchmyatk" method="get">
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
                <a href="/myatk" class="btn btn-dark">Clear Filter</a>
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
                    <th class="col-sm-2" style="width: 100px"><b>Keterangan</b></th>
                    <th class="col-sm-2" style="width: 100px"><b>Status</b></th>
                </thead>

                @foreach ($orderatks as $orderatk)
                    <tr>
                        <td style="vertical-align: middle"><a href="/myatk/{{ $orderatk->id }}" class="btn btn-light">{{ $orderatk->id }}</a></td>
                        <td style="vertical-align: middle">{{ $orderatk->orderDate}}</td>
                        <td style="vertical-align: middle">{{ $orderatk->keterangan}}</td>
                        <td style="vertical-align: middle">
                            @if ($orderatk->status == "PENDING")
                                <label style="color:red"><b>{{ $orderatk->status}}</b></label>
                            @elseif ($orderatk->status == "IN PROGRESS")
                                <label style="color:blue"><b>{{ $orderatk->status}}</b></label>
                            @elseif ($orderatk->status == "IN PROGRESS")
                                <label style="color:green"><b>{{ $orderatk->status}}</b></label>
                            @else
                                <label>{{ $orderatk->status}}</label>
                            @endif
                        </td>
                    </tr>
                @endforeach   
            </table>

        </div>
    </div>

    <div class='row'>
        <label style="width: 15px"></label>
        {{ $orderatks->links('pagination::bootstrap-4') }}
    </div>
   
    
@endsection