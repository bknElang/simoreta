@extends($layout)

@section('content')
    
    <h1>Jurnal AAK</h1>
    <hr>

    <form action="/searchmyjurnalaak" method="get">
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
                <a href="/myjurnalaak"" class="btn btn-dark">Clear Filter</a>
            </div>
        </div>
    </form>

    <hr>

    <p>Click ID for details</p>

    <div class="row">
        <div class="col-sm-12">
            <table class="table table-hover table-responsive-sm">
                <thead>
                    <td class="col-sm-1" style="width: 30px"><b>ID</b></td>
                    <td class="col-sm-2" style="width: 100px"><b>Tanggal Order</b></td>
                    <td class="col-sm-2" style="width: 100px"><b>File Name</b></td>
                    <td class="col-sm-2" style="width: 100px"><b>Status</b></td>
                </thead>

                @foreach ($aaks as $aak)
                    <tr>
                        <td style="vertical-align: middle"><a href="/myjurnalaak/{{ $aak->id }}" class="btn btn-light">{{ $aak->id }}</a></td>
                        <td style="vertical-align: middle">{{ $aak->orderDate}}</td>
                        <td style="vertical-align: middle">{{ $aak->filename}}</td>
                        <td style="vertical-align: middle">
                            @if ($aak->status == "Waiting for Approval")
                                <label style="color:#606060"><b>{{ $aak->status}}</b></label>
                            @elseif ($aak->status == "REJECTED")
                                <label style="color:#CC0000"><b>{{ $aak->status}}</b></label>
                            @elseif ($aak->status == "PENDING")
                                <label style="color:#CC6600"><b>{{ $aak->status}}</b></label>
                            @elseif ($aak->status == "IN PROGRESS")
                                <label style="color:blue"><b>{{ $aak->status}}</b></label>
                            @elseif ($aak->status == "IN PROGRESS")
                                <label style="color:green"><b>{{ $aak->status}}</b></label>
                            @endif
                        </td>
                    </tr>
                @endforeach   
            </table>

        </div>
    </div>

    <div class='row'>
        <label style="width: 15px"></label>
        {{ $aaks->links('pagination::bootstrap-4') }}
    </div>
   
    
@endsection