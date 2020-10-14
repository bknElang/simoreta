@extends($layout)

@section('content')
    
    <h1>Jurnal AAK</h1>
    <hr>

    <form action="/searchtodoaak" method="get">
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
                <a href="/todoaak" class="btn btn-dark">Clear Filter</a>
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
                    <th class="col-sm-1" style="width: 30px"><b>ID</b></th>
                    <th class="col-sm-2" style="width: 200px"><b>Tanggal Order</b></th>
                    <th class="col-sm-2" style="width: 200px"><b>Requested by</b></th>
                    <th class="col-sm-2" style="width: 300px"><b>File Name</b></th>
                    <th class="col-sm-2" style="width: 100px"><b>Status</b></th>
                </thead>

                @foreach ($aaks as $aak)
                    <tr>
                        <td><a href="/todoaak/{{ $aak->id }}" class="btn btn-light">{{ $aak->id }}</a></td>
                        <td>{{ $aak->orderDate}}</td>
                        <td>{{ $aak->uName}}</td>
                        <td>{{ $aak->filename}}</td>
                        <td>
                            @if ($aak->status == "PENDING")
                                <label style="color:red"><b>{{ $aak->status}}</b></label>
                            @elseif ($aak->status == "IN PROGRESS")
                                <label style="color:blue"><b>{{ $aak->status}}</b></label>
                            @elseif ($aak->status == "IN PROGRESS")
                                <label style="color:green"><b>{{ $aak->status}}</b></label>
                            @else 
                                <label>{{ $aak->status}}</label>
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