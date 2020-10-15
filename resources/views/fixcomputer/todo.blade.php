@extends($layout)

@section('content')
    
    <h1>Perbaikan Komputer</h1>
    <hr>

    <form action="/searchtodofixcomputer" method="get">
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
                <a href="/todofixcomputer" class="btn btn-dark">Clear Filter</a>
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
                    <td class="col-sm-2" style="width: 100px"><b>Komponen Komputer</b></td>
                    <td class="col-sm-1" style="width: 30px"><b>Status</b></td>
                </thead>

                @foreach ($orderfixcomputer as $orderfixcomputer)
                    <tr>
                        <td style="vertical-align: middle"><a href="/todofixcomputer/{{ $orderfixcomputer->id }}" class="btn btn-light">{{ $orderreimbursement->id }}</a></td>
                        <td style="vertical-align: middle">{{ $orderfixcomputer->uName}}</td>
                        <td style="vertical-align: middle">{{ $orderfixcomputer->orderDate}}</td>
                        <td style="vertical-align: middle">{{ $orderfixcomputer->jenis}}</td>
                        <td style="vertical-align: middle">
                            @if ($orderfixcomputer->status == "PENDING")
                                <label style="color:red"><b>{{ $orderfixcomputer->status}}</b></label>
                            @elseif ($orderfixcomputer->status == "IN PROGRESS")
                                <label style="color:blue"><b>{{ $orderfixcomputer->status}}</b></label>
                            @elseif ($orderfixcomputer->status == "IN PROGRESS")
                                <label style="color:green"><b>{{ $orderfixcomputer->status}}</b></label>
                            @else
                                <label>{{ $orderfixcomputer->status}}</label>
                            @endif
                        </td>
                    </tr>
                @endforeach   
            </table>

        </div>
    </div>

    <div class='row'>
        <label style="width: 15px"></label>
        {{ $orderfixcomputer->links('pagination::bootstrap-4') }}
    </div>
   
    
@endsection