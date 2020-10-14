@extends($layout)

@section('content')
    
    <h1>Jurnal AAK</h1>
    <hr>

    <form action="/searchauthjurnalaak" method="get">
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
                <a href="/authjurnalaak" class="btn btn-dark">Clear Filter</a>
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
                </thead>

                @foreach ($aaks as $aak)
                    <tr>
                        <td style="vertical-align: middle"><a href="/authjurnalaak/{{ $aak->id }}" class="btn btn-light">{{ $aak->id }}</a></td>
                        <td style="vertical-align: middle">{{ $aak->orderDate}}</td>
                        <td style="vertical-align: middle">{{ $aak->uName}}</td>
                        <td style="vertical-align: middle">{{ $aak->filename}}</td>
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