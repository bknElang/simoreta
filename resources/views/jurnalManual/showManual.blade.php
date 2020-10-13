@extends($layout)

@php
    $date = new Datetime();

    $orderDate = strftime('%Y-%m-%dT%H:%M:%S', strtotime($jurnalManual->orderDate));
@endphp

@section('content')
    <h1>Input Jurnal Manual</h1>
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
            <label for="orderdateID">Tanggal Order</label>
            <input id="orderdateID" type="datetime-local" class="form-control" style="width:320px" name="orderdate" value="{{$orderDate}}" readonly>
        </div>
    </div>

    <br>

    <div class="row">
        <div class="col-sm-4">
            <a href="{{asset('jurnal_Manual/'.$jurnalManual->filename)}}" class="btn btn-primary">Download File</a>
        </div>
    </div>

    <hr>

    @if ($jurnalManual->status != 'PENDING')
        <div class="row">
            <div class="col-sm-12">
                <label for="">Status Detail</label>
                <textarea class="form-control" name="statusDetail" id="" cols="30" rows="5" readonly>{{$jurnalManual->statusDetail}}</textarea>
            </div>
        </div>

        <hr>
    @endif

    <a href="/myjurnalmanual" class="btn btn-dark">Back</a>

@endsection