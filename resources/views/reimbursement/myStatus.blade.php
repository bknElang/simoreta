@extends($layout)

@section('content')
    
    <h1>Reimbursement</h1>
    <hr>

    <br>

    <div class="row">
        <div class="col-sm-12">
            <table class="table table-hover table-responsive-sm">
                <thead>
                    <td class="col-sm-1" style="width: 30px"><b>ID</b></td>
                    <td class="col-sm-2" style="width: 100px"><b>Tanggal Order</b></td>
                    <td class="col-sm-2" style="width: 100px"><b>Atas Nama</b></td>
                    <td class="col-sm-1" style="width: 30px"><b>Keterangan</b></td>
                    <td class="col-sm-2" style="width: 100px"><b>Status</b></td>
                </thead>

                @foreach ($orderreimbursements as $orderreimbursement)
                    <tr>
                        <td><a href="/myreimbursement/{{ $orderreimbursement->id }}" class="btn btn-light">{{ $orderreimbursement->id }}</a></td>
                        <td>{{ $orderreimbursement->orderDate}}</td>
                        <td>{{ $orderreimbursement->namaRek}}</td>
                        <td>{{ $orderreimbursement->keterangan}}</td>
                        <td>
                            @if ($orderreimbursement->status == 'PENDING')
                                <label style="color:red"><b>{{ $orderreimbursement->status}}</b></label>
                            @elseif ($orderreimbursement->status == 'IN PROGRESS')
                                <label style="color:yellow"><b>{{ $orderreimbursement->status}}</b></label>
                            @elseif ($orderreimbursement->status == 'FINISHED')
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