@extends($layout)

@php
    $date = new Datetime();

    $orderDate = strftime('%Y-%m-%dT%H:%M:%S', strtotime($orderKiriman->orderDate));
@endphp

@section('content')
    <h1>Kiriman Dokumen</h1>
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
            <label for="orderdateID">Tanggal Order </label>
            <input id="orderdateID" type="datetime-local" class="form-control" style="width:320px" name="orderdate" value="{{$orderDate}}" readonly>
        </div>
    </div>

    <br>

    <div class="row">
        <div class="col-sm-4">
            <label for="jenisID">Jenis Pengiriman</label>
            <select name="jenisKiriman" id="jenisID" class="form-control" style="width:320px" disabled>
                <option value="TOP URGENT" @if ($orderKiriman->jenisKiriman == "TOP URGENT") selected @endif>TOP URGENT</option>
                <option value="URGENT" @if ($orderKiriman->jenisKiriman == "URGENT") selected @endif>URGENT</option>
                <option value="NORMAL" @if ($orderKiriman->jenisKiriman == "NORMAL") selected @endif>NORMAL</option>
            </select>
        </div>

        <div class="col-sm-4">
            <br>
            <br>
            <label for="asuransiID">Asuransi </label>
            <input type="radio" name="asuransi" id="yesCheck" value="Ya" @if ($orderKiriman->asuransi == "Ya") checked @endif disabled><label for="asuransiID">Ya</label>
            <input type="radio" name="asuransi" id="noCheck" value="Tidak" @if ($orderKiriman->asuransi == "Tidak") checked @endif disabled><label for="asuransiID">Tidak</label>
        </div>

        <div class="col-sm-4">
            <label for="pihakID">Nilai Pertanggungan </label>
            <input type='text' id='pihakID' name='pertanggungan' class="form-control" value="{{$orderKiriman->pertanggungan}}" readonly>
        </div>
    </div>

    <br>

    <div class="row">
        <div class="col-sm-4"> 
            <label for="pihakID">Nama Debitur/Nasabah/Pihak yang Dituju </label>
            <input id="pihakID" type="text" class="form-control" style="width:320px" name="namaTujuan" value="{{$orderKiriman->namaDebitur}}" readonly>
        </div>

        <div class="col-sm-4">
            <label for="penerimaID">Nama Penerima </label>
            <input id="penerimaID" type="text" class="form-control" style="width:320px" name="namaPenerima" value="{{$orderKiriman->namaPIC}}" readonly>
        </div>

        <div class="col-sm-4">
            <label for="notelpID">No. Telp Penerima </label>
            <input id="notelpID" type="text" class="form-control" style="width:320px" name="notelp" value="{{$orderKiriman->noPenerima}}" readonly>
        </div>
    </div>

    <br>

    <div class="row">
        <div class="col-sm-4">
            <label for="alamatID">Alamat Pengiriman </label>
            <textarea name="alamat" id="alamatID" cols="30" rows="5" class="form-control" readonly>{{$orderKiriman->alamat}}</textarea>
        </div>

        <div class="col-sm-4">
            <label for="dokumenID">Dokumen </label>
            <input id="dokumenID" type="text" class="form-control" style="width:320px" name="notelp" value="{{$orderKiriman->dokumen}}" readonly>
        </div>
    </div>

    <hr>

    @if ($orderKiriman->status != 'PENDING' && $orderKiriman->status != 'Waiting for Approval' && $orderKiriman->status != 'REJECTED')
        <div class="row">
            <div class="col-sm-12">
                <label for="">Status Detail</label>
                <textarea class="form-control" name="statusDetail" id="" cols="30" rows="5" readonly>{{$orderKiriman->statusDetail}}</textarea>
            </div>
        </div>

        <hr>
    @endif

    <a href="/mykiriman" class="btn btn-dark">Back</a>

@endsection