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
                    <td class="col-sm-2" style="width: 100px"><b>Tanggal Pemakaian</b></td>
                    <td class="col-sm-2" style="width: 100px"><b>Tanggal Selesai Pemakaian</b></td>
                    <td class="col-sm-1" style="width: 30px"><b>Status</b></td>
                    <td class="col-sm-2" style="width: 100px"><b>Keperluan</b></td>
                </thead>

                @foreach ($orderkendaraans as $orderkendaraan)
                    <tr>
                        <td><a href="/myordercar/{{ $orderkendaraan->id }}" class="btn btn-light">{{ $orderkendaraan->id }}</a></td>
                        <td>{{ $orderkendaraan->orderDate}}</td>
                        <td>{{ $orderkendaraan->useDatetime}}</td>
                        <td>{{ $orderkendaraan->finishDatetime}}</td>
                        <td><label style="color:red"><b>{{ $orderkendaraan->status}}</b></label></td>
                        <td>{{ $orderkendaraan->necessity}}</td>
                    </tr>
                @endforeach   
            </table>

        </div>
    </div>

    <div class='row'>
        <label style="width: 15px"></label>
        {{ $orderkendaraans->links('pagination::bootstrap-4') }}
    </div>
   
    
@endsection