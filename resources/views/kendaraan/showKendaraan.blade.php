@extends($layout)

@php
    date_default_timezone_set('Asia/Jakarta'); 
    $date = new Datetime();

    $orderDate = strftime('%Y-%m-%dT%H:%M:%S', strtotime($orderkendaraan->orderDate));
    $useDate = strftime('%Y-%m-%dT%H:%M:%S', strtotime($orderkendaraan->useDatetime));
    $finishDate= strftime('%Y-%m-%dT%H:%M:%S', strtotime($orderkendaraan->finishDatetime));
@endphp

@section('content')
    <h1>Order Kendaraan</h1>
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
            <label for="dateofuseID">Tanggal Pemakaian</label>
            <input id="dateofuseID" type="datetime-local" class="form-control" style="width:320px" value="{{$useDate}}" min="{{$orderDate}}" readonly>
        </div>

         <div class="col-sm-4">
            <label for="datefinishedID">Tanggal Selesai</label>
            <input id="datefinishedID" type="datetime-local" class="form-control" style="width:320px" name="datefinished" value="{{$finishDate}}" min="{{$orderDate}}" readonly>  
        </div>
    </div>

    <br>

    <div class="row">
        <div class="col-sm-4">
            <label for="pickuplocationID">Lokasi Pick Up</label>
            <textarea id="pickuplocationID" class="form-control" name="pickuplocation" cols="40" rows="4" readonly>{{$orderkendaraan->pickupAddress}}</textarea>
        </div>

        <div class="col-sm-4">
            <label for="destinationID">Destinasi</label>
            <textarea id="destinationID" class="form-control" name="destination" cols="40" rows="4" readonly>{{$orderkendaraan->destinationAddress}}</textarea>
        </div>

        <div class="col-sm-4">
            <label for="needsID">Keperluan</label>
            <select name="needs" id="needsID" class="form-control" style="width:320px" disabled>
                <option value="Lembur">Lembur</option>
                <option value="Meeting / Kunjungan Nasabah">Meeting / Kunjungan Nasabah</option>
                <option value="Event Khusus">Event Khusus</option>
                <option value="Ambil Dokumen">Ambil Dokumen</option>
                <option value="Besuk / Melayat">Besuk / Melayat</option>
                <option value="Perjalanan Dinas">Perjalanan Dinas</option>
                <option value="Lainnya">Lainnya</option>
            </select>
        </div>
    </div>
        
    <br>

    <div class="row">
        <div class="col-sm-4">
            <label for="jumlahID">Jumlah Penumpang</label>
            <input id="jumlahID" type="number" class="form-control" style="width:320px" name="jumlah" placeholder="Jumlah penumpang" value="{{$orderkendaraan->totalPassanger}}" readonly>  
        </div>
    </div>
        
    <br>

    <div class="row">
        <div class="col-sm-4">
            <label for="ketID">Keterangan</label>
            <input id="ketID" type="text" class="form-control" style="width:320px" name="keterangan" placeholder="Tidak ada" value="{{$orderkendaraan->keterangan}}" readonly>  
        </div>
    </div>
        
    <hr>

    @if ($orderkendaraan->status != "PENDING" && $orderkendaraan->status != "Waiting for Approval" && && $orderkendaraan->status != "REJECTED")
            <input type="hidden" name="orderID" value="{{$orderkendaraan->id}}">
            <div class="row">
                <div class="col-sm-4">
                    <label for="namadriverID">Nama Driver</label>
                    <input id="namadriverID" type="text" class="form-control" style="width:320px" value="{{$assign->namaDriver}}" readonly>  
                </div>

                <div class="col-sm-4">
                    <label for="nomordriverID">Nomor HP Driver</label>
                    <input id="nomordriverID" type="text" class="form-control" style="width:320px"  value="{{$assign->nohpDriver}}" readonly>  
                </div>
            </div>

            <br>

            <div class="row">
                <div class="col-sm-4">
                    <label for="jeniskendaraanID">Jenis Kendaraan</label>
                    <input id="jeniskendaraanID" type="text" class="form-control" style="width:320px" value="{{$assign->jenisKendaraan}}" readonly>  
                </div>

                <div class="col-sm-4">
                    <label for="platnomorID">Plat Nomor</label>
                    <input id="platnomorID" type="text" class="form-control" style="width:320px" name="platnomor" placeholder="Plat Nomor" value="{{$assign->plateNumber}}" readonly>   
                </div>
            </div>

            <br>

            <div class="row">
                <div class="col-sm-4">
                    <label for="pinpenumpangID">PIN Penumpang</label>
                    <input id="pinpenumpangID" type="text" class="form-control" style="width:320px" value="{{$assign->pinPenumpang}}" readonly>
                </div>
            </div>
    <hr>

    @endif

    <a href="/myordercar" class="btn btn-dark">Back</a>   

    <br><br>

@endsection