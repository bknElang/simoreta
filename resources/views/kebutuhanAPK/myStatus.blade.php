@extends($layout)

@section('content')
    
    <h1>Order List</h1>
    <hr>

    <br>

    <div class="row">
        <div class="col-sm-12">
            <table class="table table-hover table-responsive-sm">
                <thead>
                    <td class="col-sm-1" style="width: 30px"><b>ID</b></td>
                    <td class="col-sm-2" style="width: 100px"><b>Tanggal Order</b></td>
                    <td class="col-sm-2" style="width: 100px"><b>Keterangan</b></td>
                    <td class="col-sm-2" style="width: 100px"><b>Status</b></td>
                </thead>

                @foreach ($orderatks as $orderatk)
                    <tr>
                        <td><a href="/myatk/{{ $orderatk->id }}" class="btn btn-light">{{ $orderatk->id }}</a></td>
                        <td>{{ $orderatk->orderDate}}</td>
                        <td>{{ $orderatk->keterangan}}</td>
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