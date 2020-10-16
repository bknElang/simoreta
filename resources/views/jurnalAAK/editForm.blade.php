@extends($layout)

@php
    $date = new Datetime();

    $orderDate = strftime('%Y-%m-%dT%H:%M:%S', strtotime($jurnalAAK->orderDate));
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
            <a href="{{asset('jurnal_AAK/'.$jurnalAAK->filename)}}" class="btn btn-primary">Download File</a>
        </div>
    </div>

    <hr>

    @if(Session::has('successDetail'))
            <div class="alert alert-success">{{ Session::get('successDetail') }}</div>
    @endif

    <form action="{{$jurnalAAK->id}}" method="POST">
        @method('patch')
        @csrf
        <div class="row">
            <div class="col-sm-12">
                <label for="">Status Detail</label>
                <textarea class="form-control" name="statusDetail" id="" cols="30" rows="5" @if ($jurnalAAK->status == 'FINISHED') readonly @endif >{{$jurnalAAK->statusDetail}}</textarea>
            </div>
        </div>

        <br>

        @if ($jurnalAAK->status != 'FINISHED')
            <button type="submit" class="btn btn-info">Update</button>        
        @endif
    </form>

    <hr>

    <div class="row">
        <div class="col-sm-1">
            <a href="/todoaak" class="btn btn-dark">Back</a>
        </div>

        @if ($jurnalAAK->status == 'IN PROGRESS')
            <div class="col-sm-1">
                <form action="{{$jurnalAAK->id}}/finish" method="post" class="form-inline">
                    @method('patch')
                    @csrf
                    <button type="submit" class="btn btn-success">Finish</button>
                </form>
            </div>
        @endif
    </div>

    <br>

    @if(Session::has('success'))
        <div class="alert alert-success">{{ Session::get('success') }}</div>
    @endif

@endsection