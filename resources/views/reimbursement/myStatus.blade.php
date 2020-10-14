@extends($layout)

@section('content')
    
    <h1>Reimbursement</h1>
    <hr>

    <form action="/searchmyreimbursement" method="get">
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
                <a href="/myreimbursement"" class="btn btn-dark">Clear Filter</a>
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
                    <th class="col-sm-2" style="width: 100px"><b>Atas Nama</b></th>
                    <th class="col-sm-1" style="width: 30px"><b>Keterangan</b></th>
                    <th class="col-sm-2" style="width: 100px"><b>Status</b></th>
                </thead>

                @foreach ($orderreimbursements as $orderreimbursement)
                    <tr>
                        <td style="vertical-align: middle"><a href="/myreimbursement/{{ $orderreimbursement->id }}" class="btn btn-light">{{ $orderreimbursement->id }}</a></td>
                        <td style="vertical-align: middle">{{ $orderreimbursement->orderDate}}</td>
                        <td style="vertical-align: middle">{{ $orderreimbursement->namaRek}}</td>
                        <td style="vertical-align: middle">{{ $orderreimbursement->keterangan}}</td>
                        <td style="vertical-align: middle">
                            @if ($orderreimbursement->status == "Waiting for Approval")
                                <label style="color:#606060"><b>{{ $orderreimbursement->status}}</b></label>
                            @elseif ($orderreimbursement->status == "REJECTED")
                                <label style="color:#CC0000"><b>{{ $orderreimbursement->status}}</b></label>
                            @elseif ($orderreimbursement->status == "PENDING")
                                <label style="color:#CC6600"><b>{{ $orderreimbursement->status}}</b></label>
                            @elseif ($orderreimbursement->status == "IN PROGRESS")
                                <label style="color:blue"><b>{{ $orderreimbursement->status}}</b></label>
                            @elseif ($orderreimbursement->status == "IN PROGRESS")
                                <label style="color:green"><b>{{ $orderreimbursement->status}}</b></label>
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