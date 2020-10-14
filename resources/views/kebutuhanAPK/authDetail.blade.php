@extends($layout)

@php
    $date = new Datetime();

    $orderDate = strftime('%Y-%m-%dT%H:%M:%S', strtotime($orderatk->orderDate));
@endphp

@section('content')

    <h1>Order's Detail</h1>
    <hr>

    @if(Session::has('success'))
            <div class="alert alert-success">{{ Session::get('success') }}</div>
    @endif

    <div class="row">
        <div class="col-sm-4">
            <label for="requesterID">Requester</label>
            <input type="text" id="requesterID" class="form-control" name="requester" placeholder="requester" style="width:320px" value="{{$currUser->name}}" readonly>
        </div>

        <div class="col-sm-4">
            <label for="nipID">NIP Requester</label>
            <input type="text" id="nipID" class="form-control" name="nip" placeholder="NIP" style="width:320px" value="{{$currUser->NIP}}" readonly>
        </div>

        <div class="col-sm-4">
            <label for="nohpID">No. Telp Requester</label>
            <input type="text" id="nohpID" class="form-control" name="nohp" placeholder="No. Telp" style="width:320px" value="{{$currUser->nohp}}" readonly>
        </div>

    </div>

    <br>

    <div class="row">
        <div class="col-sm-4">
            <label for="orderdateID">Tanggal Order <label style="color: red">*</label></label>
            <input id="orderdateID" type="datetime-local" class="form-control" style="width:320px" name="orderdate" value="{{$orderDate}}" readonly>
        </div>
    </div>

    <br>

    <div class="row">
        <div class="col-sm-4">
            <label for="ketID">Keterangan</label>
            <textarea id="ketID" class="form-control" name="keterangan" cols="40" rows="4" readonly>{{$orderatk->keterangan}}</textarea>
        </div>
    </div>

    <br>

    <div class="row">
        <div class="col-sm-12">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <td><b>Name</b></td>
                        <td><b>Spesifikasi</b></td>
                        <td><b>Jumlah</b></td>
                    </tr>
                </thead>
                @foreach ($detailatks as $detailatk)
                    <tr>
		                <td>{{$detailatk->name}}</td>
		                <td>{{$detailatk->spesifikasi }}</td>
		                <td>{{$detailatk->jumlah }}</td>
	                </tr>
                @endforeach
	        </table>
        </div>
    </div>

    <hr>

    @if ($orderatk->status == "Waiting for Approval")
        <div class="row">
            <form action="/authatk/{{$orderatk->id}}/approve" method="post">
                @method('patch')
                @csrf
                <div class="col-sm-1">
                    <button type="submit" class="btn btn-success">Authorize</button>
                </div>
            </form>

            <form action="/authatk/{{$orderatk->id}}/reject" method="post">
                @method('patch')
                @csrf
                <div class="col-sm-1">
                    <button type="submit" class="btn btn-danger">Reject</button>
                </div>
            </form>
        </div>

    <hr>

    @endif

    <a href="/authatk" class="btn btn-dark">Back</a>
@endsection