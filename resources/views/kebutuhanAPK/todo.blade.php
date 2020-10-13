@extends($layout)

@section('content')

    <h1>Kebutuhan ATK</h1>
    <hr>

    <form action="/searchtodoatk" method="get">
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
                <a href="/todoatk" class="btn btn-dark">Clear Filter</a>
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
                    <td class="col-sm-2" style="width: 100px"><b>Tanggal Order</b></td>
                    <td class="col-sm-1" style="width: 30px"><b>Status</b></td>
                </thead>

                @foreach ($orderatks as $orderatk)
                    <tr>
                        <td><a href="/todoatk/{{ $orderatk->id }}" class="btn btn-light">{{ $orderatk->id }}</a></td>
                        <td>{{ $orderatk->uName}}</td>
                        <td>{{ $orderatk->orderDate}}</td>
                        <td>
                            @if ($orderatk->status == "PENDING")
                                <label style="color:red"><b>{{ $orderatk->status}}</b></label>
                            @elseif ($orderatk->status == "IN PROGRESS")
                                <label style="color:#CCCC00"><b>{{ $orderatk->status}}</b></label>
                            @else
                                <label style="color:lime"><b>{{ $orderatk->status}}</b></label>
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