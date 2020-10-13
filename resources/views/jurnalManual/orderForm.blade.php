@extends($layout)

@php
    $date = new Datetime();
@endphp

@section('content')
    <h1>Input Jurnal Manual</h1>
    <hr>

    @if(Session::has('successOrder'))
        <div class="alert alert-success">{{ Session::get('successOrder') }}</div>
    @endif

    <form action="{{route('jurnalmanual')}}" enctype="multipart/form-data" method="POST">
        @csrf

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
                <input id="orderdateID" type="datetime-local" class="form-control" style="width:320px" name="orderdate" value="{{$date->format('Y-m-d\TH:i:s')}}" readonly>
            </div>
        </div>

        <br>

        <div class="row">
            <div class="col-sm-4">
                <label for="fileID">File <label style="color: red">*</label></label>
                <input type="file" id="fileID" class="form-control @error('fileUpload') is-invalid @enderror" name="fileUpload" style="width:320px">
                @error('fileUpload') <label style="width: 5px"></label> <label style="color:red"> {{$message }}</label> @enderror
            </div>
        </div>

        <br>

        <input type="submit" class="btn btn-success" value="Order">

    </form>
@endsection