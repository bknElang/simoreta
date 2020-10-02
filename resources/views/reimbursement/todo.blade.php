@extends($layout)

@section('content')
    
    <h1>Order List</h1>
    <hr>

    <div class="row">
        <div class="col-sm-4">
            <input type="datetime-local" class="form-control">
        </div>

        <div class="col-sm-4">
            <input type="datetime-local" class="form-control">
        </div>

        <div class="col-sm-2">
            <button type="submit" class="btn btn-success">Search By Order Date</button>
        </div>
    </div>

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
                    <td class="col-sm-2" style="width: 100px"><b>Nama Rekening</b></td>
                    <td class="col-sm-1" style="width: 30px"><b>Status</b></td>
                </thead>

                @foreach ($orderreimbursements as $orderreimbursement)
                    <tr>
                        <td><a href="/todoreimbursement/{{ $orderreimbursement->id }}" class="btn btn-light">{{ $orderreimbursement->id }}</a></td>
                        <td>{{ $orderreimbursement->uName}}</td>
                        <td>{{ $orderreimbursement->orderDate}}</td>
                        <td>{{ $orderreimbursement->namaRek}}</td>
                        <td>
                            @if ($orderreimbursement->status == "PENDING")
                                <label style="color:red"><b>{{ $orderreimbursement->status}}</b></label>
                            @elseif ($orderreimbursement->status == "IN PROGRESS")
                                <label style="color:#CCCC00"><b>{{ $orderreimbursement->status}}</b></label>
                            @else
                                <label style="color:lime"><b>{{ $orderreimbursement->status}}</b></label>
                            @endif
                        </td>
                    </tr>
                @endforeach   
            </table>

        </div>
    </div>

    <div class='row'>
        <label style="width: 15px"></label>
        {{ $orderreimbursements->links('pagination::bootstrap-4') }}
    </div>
   
    
@endsection