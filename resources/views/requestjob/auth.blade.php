@extends($layout)

@section('content')
    
    <h1>Requested Job</h1>
    <hr>

    <form action="/searchauthjob" method="get">
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
                <a href="/authjob" class="btn btn-dark">Clear Filter</a>
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
                    <th class="col-sm-2" style="width: 100px"><b>Requested by</b></th>
                    <th class="col-sm-2" style="width: 100px"><b>Tanggal Order</b></th>
                    <th class="col-sm-2" style="width: 100px"><b>Jenis</b></th>
                </thead>

                @foreach ($requestjobs as $requestjob)
                    <tr>
                        <td style="vertical-align: middle"><a href="/authjob/{{ $requestjob->id }}" class="btn btn-light">{{ $requestjob->id }}</a></td>
                        <td style="vertical-align: middle">{{ $requestjob->uName}}</td>
                        <td style="vertical-align: middle">{{ $requestjob->orderDate}}</td>
                        <td style="vertical-align: middle">{{ $requestjob->jenis}}</td>
                    </tr>
                @endforeach   
            </table>

        </div>
    </div>

    <div class='row'>
        <label style="width: 15px"></label>
        {{ $requestjobs->links('pagination::bootstrap-4') }}
    </div>
   

@endsection