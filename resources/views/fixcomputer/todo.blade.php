@extends($layout)

@section('content')
    
    <h1>Reimbursement</h1>
    <hr>

    <form action="/searchtodoreimbursement" method="get">
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
                <a href="/todoreimbursement" class="btn btn-dark">Clear Filter</a>
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
                    <td class="col-sm-2" style="width: 100px"><b>Nama Rekening</b></td>
                    <td class="col-sm-1" style="width: 30px"><b>Status</b></td>
                </thead>

                @foreach ($orderreimbursements as $orderreimbursement)
                    <tr>
                        <td style="vertical-align: middle"><a href="/todoreimbursement/{{ $orderreimbursement->id }}" class="btn btn-light">{{ $orderreimbursement->id }}</a></td>
                        <td style="vertical-align: middle">{{ $orderreimbursement->uName}}</td>
                        <td style="vertical-align: middle">{{ $orderreimbursement->orderDate}}</td>
                        <td style="vertical-align: middle">{{ $orderreimbursement->namaRek}}</td>
                        <td style="vertical-align: middle">
                            @if ($orderreimbursement->status == "PENDING")
                                <label style="color:red"><b>{{ $orderreimbursement->status}}</b></label>
                            @elseif ($orderreimbursement->status == "IN PROGRESS")
                                <label style="color:blue"><b>{{ $orderreimbursement->status}}</b></label>
                            @elseif ($orderreimbursement->status == "IN PROGRESS")
                                <label style="color:green"><b>{{ $orderreimbursement->status}}</b></label>
                            @else
                                <label>{{ $orderreimbursement->status}}</label>
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