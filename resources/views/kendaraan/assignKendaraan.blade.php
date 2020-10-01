@extends($layout)

@php
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

    <form action="{{$orderkendaraan->id}}" method="POST">
        @method('patch')
        @csrf
        <div class="row">
            <div class="col-sm-4">
                <label for="ketID">Keterangan</label>
                <textarea id="ketID" class="form-control" name="keterangan" cols="40" rows="4" placeholder="Tidak ada" @if ($orderkendaraan->status == 'PENDING' || $orderkendaraan->status == 'FINISHED') readonly @endif>{{$orderkendaraan->keterangan}}</textarea>
            </div>     
        </div>

        @if(Session::has('successNote'))
            <br>
            <div class="row">
                <div class="col-sm-12">
                        <div class="alert alert-success">{{ Session::get('successNote') }}</div>
                </div>
            </div>
        @endif

        @if ($orderkendaraan->status == 'IN PROGRESS')
            <br>

            <div class="row">
                <div class="col-sm-4">
                    <button type="submit" class="btn btn-success">Update</button>
                </div>
            </div> 
        @endif
    </form>
        
    <hr>

    @if(Session::has('successAssign'))
        <div class="row">
            <div class="col-sm-12">
                    <div class="alert alert-success">{{ Session::get('successAssign') }}</div>
            </div>
        </div>
    @endif

    @if ($orderkendaraan->status == "PENDING")
        <form action="{{route('assignkendaraan', [$orderkendaraan->id])}}" method="POST">
            @csrf
            <input type="hidden" name="orderID" value="{{$orderkendaraan->id}}">
            <div class="row">
                <div class="col-sm-4">
                    <label for="namadriverID">Nama Driver</label> <label style="color: red">*</label></label>
                    <input id="namadriverID" type="text" class="form-control @error('namadriver') is-invalid @enderror" style="width:320px" name="namadriver" placeholder="Nama Driver"  value="{{old('namadriver')}}">  
                    @error('namadriver') <label style="width: 5px"></label> <label style="color:red">{{$message }}</label> @enderror   
                </div>

                <div class="col-sm-4">
                    <label for="nomordriverID">Nomor HP Driver</label> <label style="color: red">*</label></label>
                    <input id="nomordriverID" type="text" class="form-control @error('nomordriver') is-invalid @enderror" style="width:320px" name="nomordriver" placeholder="Nomor HP"  value="{{old('nomordriver')}}">  
                    @error('nomordriver') <label style="width: 5px"></label> <label style="color:red">{{$message }}</label> @enderror   
                </div>
            </div>

            <br>

            <div class="row">
                <div class="col-sm-4">
                    <label for="jeniskendaraanID">Jenis Kendaraan</label> <label style="color: red">*</label></label>
                    <input id="jeniskendaraanID" type="text" class="form-control @error('jeniskendaraan') is-invalid @enderror" style="width:320px" name="jeniskendaraan" placeholder="Jenis Kendaraan"  value="{{old('jeniskendaraan')}}">  
                    @error('jeniskendaraan') <label style="width: 5px"></label> <label style="color:red">{{$message }}</label> @enderror   
                </div>

                <div class="col-sm-4">
                    <label for="platnomorID">Plat Nomor</label> <label style="color: red">*</label></label>
                    <input id="platnomorID" type="text" class="form-control @error('platnomor') is-invalid @enderror" style="width:320px" name="platnomor" placeholder="Plat Nomor"  value="{{old('platnomor')}}">  
                    @error('platnomor') <label style="width: 5px"></label> <label style="color:red">{{$message }}</label> @enderror   
                </div>
            </div>

            <br>

            <div class="row">
                <div class="col-sm-4">
                    <label for="pinpenumpangID">PIN Penumpang</label> <label style="color: red">*</label></label>
                    <input id="pinpenumpangID" type="text" class="form-control @error('pinpenumpang') is-invalid @enderror" style="width:320px" name="pinpenumpang" placeholder="PIN"  value="{{old('pinpenumpang')}}">
                    @error('pinpenumpang') <label style="width: 5px"></label> <label style="color:red">{{$message }}</label> @enderror   
                </div>
            </div>
         
            <br>

            <div class="row">
                <div class="col-sm-4">
                    <button type="submit" class="btn btn-success">Assign</button>
                </div>
            </div>
        </form>

    @else

        <div class="row">
            <div class="col-sm-4">
                <label for="namadriverID">Nama Driver</label>
                <input id="namadriverID" type="text" class="form-control" style="width:320px" name="namadriver" placeholder="Nama Driver" value="{{$assignKendaraan->namaDriver}}" readonly>
            </div>

            <div class="col-sm-4">
                <label for="nomordriverID">Nomor HP Driver</label>
                <input id="nomordriverID" type="text" class="form-control" style="width:320px" name="nomordriver" placeholder="Nomor HP" value="{{$assignKendaraan->nohpDriver}}" readonly>
            </div>
        </div>

        <br>

        <div class="row">
            <div class="col-sm-4">
                <label for="jeniskendaraanID">Jenis Kendaraan</label>
                <input id="jeniskendaraanID" type="text" class="form-control" style="width:320px" name="jeniskendaraan" placeholder="Jenis Kendaraan" value="{{$assignKendaraan->jenisKendaraan}}" readonly>  
            </div>

            <div class="col-sm-4">
                <label for="platnomorID">Plat Nomor</label>
                <input id="platnomorID" type="text" class="form-control" style="width:320px" name="platnomor" placeholder="Plat Nomor" value="{{$assignKendaraan->plateNumber}}" readonly>  
            </div>
        </div>

        <br>

        <div class="row">
            <div class="col-sm-4">
                <label for="pinpenumpangID">PIN Penumpang</label>
                <input id="pinpenumpangID" type="text" class="form-control" style="width:320px" name="pinpenumpang" placeholder="PIN" value="{{$assignKendaraan->pinPenumpang}}" readonly>
            </div>
        </div>
    @endif

    <hr>

    <div class="row">
        <div class="col-sm-1">
            <a href="/todocar" class="btn btn-dark">Back</a>
        </div>

        @if ($orderkendaraan->status == 'IN PROGRESS')
            <div class="col-sm-1">
                <form action="{{$orderkendaraan->id}}/finish" method="POST">
                    @method('patch')
                    @csrf
                    <button type="submit" class="btn btn-info">Finish</button>
                </form>
            </div>
        @endif
    </div>
    
    <br>

    @if(Session::has('successFinish'))
        <div class="row">
            <div class="col-sm-12">
                    <div class="alert alert-success">{{ Session::get('successFinish') }}</div>
            </div>
        </div>
    @endif


    
@endsection