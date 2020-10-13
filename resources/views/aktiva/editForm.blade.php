@extends($layout)

@php
    $date = new Datetime();

    $orderDate = strftime('%Y-%m-%dT%H:%M:%S', strtotime($orderAktiva->orderDate));

@endphp

@section('content')
    <h1>Aktiva</h1>
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
                <label for="jenisID">Jenis Barang</label>
                <input type="text" id="jenisID" class="form-control" name="jenis" placeholder="Jenis Barang" style="width:320px" value="{{$orderAktiva->jenisBarang}}" readonly>
            </div>

            <div class="col-sm-4">
                <label for="spesifikID">Spesifikasi</label>
                <input type="text" id="spesifikID" class="form-control" name="spesifikasi" placeholder="Spesifikasi" style="width:320px" value="{{$orderAktiva->spesifikasi}}" readonly>
            </div>
        </div>

        <br>

        <div class="row">
            <div class="col-sm-4">
                <label for="ketID">Keterangan</label>
                <textarea id="ketID" class="form-control" name="keterangan" cols="40" rows="4" readonly>{{$orderAktiva->keterangan}}</textarea>
            </div>
        </div>

        <hr>

        @if(Session::has('successDetail'))
            <div class="alert alert-success">{{ Session::get('successDetail') }}</div>
        @endif
    
        <form action="{{$orderAktiva->id}}" method="POST">
        @method('patch')
        @csrf
            <div class="row">
                <div class="col-sm-12">
                    <label for="">Status Detail</label>
                    <textarea class="form-control" name="statusDetail" id="" cols="30" rows="5" @if ($orderAktiva->status == 'FINISHED') readonly @endif >{{$orderAktiva->statusDetail}}</textarea>
                </div>
            </div>

            <br>

            @if ($orderAktiva->status != 'FINISHED')
                <button type="submit" class="btn btn-info">Update</button>        
            @endif
        </form>

        <hr>

        <div class="row">
            <div class="col-sm-1">
                <a href="/todoaktiva" class="btn btn-dark">Back</a>
            </div>

            @if ($orderAktiva->status == 'IN PROGRESS')
                <div class="col-sm-1">
                    <form action="{{$orderAktiva->id}}/finish" method="post" class="form-inline">
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