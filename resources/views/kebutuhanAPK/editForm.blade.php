@extends($layout)

@php
    $date = new Datetime();

    $orderDate = strftime('%Y-%m-%dT%H:%M:%S', strtotime($orderatk->orderDate));
@endphp

@section('content')

    <h1>Order's Detail</h1>
    <hr>

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
                <table class="table table-hover table-responsive-sm">
                    <thead>
                        <tr>
                            <th><b>Name</b></th>
                            <th><b>Spesifikasi</b></th>
                            <th><b>Jumlah</b></th>
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

        @if(Session::has('successDetail'))
            <div class="alert alert-success">{{ Session::get('successDetail') }}</div>
        @endif

        <form action="{{$orderatk->id}}" method="POST">
            @method('patch')
            @csrf
            <div class="row">
                <div class="col-sm-12">
                    <label for="">Status Detail</label>
                    <textarea class="form-control" name="statusDetail" id="" cols="30" rows="5" @if ($orderatk->status == 'FINISHED') readonly @endif >{{$orderatk->statusDetail}}</textarea>
                </div>
            </div>

            <br>

            @if ($orderatk->status != 'FINISHED')
                <button type="submit" class="btn btn-info">Update</button>        
            @endif
        </form>

        <hr>

        <div class="row">
            <div class="col-sm-1">
                <a href="/todoatk" class="btn btn-dark">Back</a>        
            </div>

            @if ($orderatk->status == 'IN PROGRESS')
                <div class="col-sm-1">
                    <form action="{{$orderatk->id}}/finish" method="post" class="form-inline">
                        @method('patch')
                        @csrf
                        <button type="submit" class="btn btn-success">Finish</button>
                    </form>
                </div>
            @endif
        </div>

        <br>

        @if(Session::has('success'))
            <div class="row">
                <div class="col-sm-12">
                    <div class="alert alert-success">{{ Session::get('success') }}</div>
                </div>
            </div>
        @endif

@endsection