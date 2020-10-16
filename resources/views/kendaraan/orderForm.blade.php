@extends($layout)

@php
    date_default_timezone_set('Asia/Jakarta'); 
    $date = new Datetime();
@endphp

@section('content')
    <h1>Order Kendaraan</h1>
    <hr>
        @if(Session::has('successOrder'))
            <div class="alert alert-success">{{ Session::get('successOrder') }}</div>
        @endif
    <form action="{{route('ordercar')}}" method="POST">
        {{csrf_field()}}

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
                <label for="dateofuseID">Tanggal Pemakaian <label style="color: red">*</label></label>
                <input id="dateofuseID" type="datetime-local" class="form-control" style="width:320px" name="dateofuse">
            </div>

             <div class="col-sm-4">
                <label for="datefinishedID">Tanggal Selesai <label style="color: red">*</label></label>
                <input id="datefinishedID" type="datetime-local" class="form-control" style="width:320px" name="datefinished">  
            </div>
        </div>

        <br>

        <div class="row">
            <div class="col-sm-4">
                <label for="pickuplocationID">Lokasi Pick Up <label style="color: red">*</label></label>
                <textarea id="pickuplocationID" class="form-control @error('pickuplocation') is-invalid @enderror" name="pickuplocation" cols="40" rows="4">{{old('pickuplocation')}}</textarea>
                @error('pickuplocation') <label style="width: 5px"></label> <label style="color:red"> {{$message }}</label> @enderror
            </div>

            <div class="col-sm-4">
                <label for="destinationID">Destinasi <label style="color: red">*</label></label>
                <textarea id="destinationID" class="form-control @error('destination') is-invalid @enderror" name="destination" cols="40" rows="4">{{old('destination')}}</textarea>
                @error('destination') <label style="width: 5px"></label> <label style="color:red"> {{$message }}</label> @enderror
            </div>

            <div class="col-sm-4">
                <label for="needsID">Keperluan <label style="color: red">*</label></label>
                <select name="needs" id="needsID" class="form-control" style="width:320px">
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
                <label for="jumlahID">Jumlah Penumpang <label style="color: red">*</label></label>
                <input id="jumlahID" type="number" class="form-control @error('jumlah') is-invalid @enderror" style="width:320px" name="jumlah" placeholder="Jumlah penumpang" value="{{old('jumlah')}}" min=1>  
                @error('jumlah') <label style="width: 5px"></label> <label style="color:red"> {{$message }}</label> @enderror
            </div>
        </div>
        
        <br>

        <div class="row">
            <div class="col-sm-4">
                <label for="ketID">Keterangan <label style="color: red">*</label></label>
                <textarea id="ketID" class="form-control @error('keterangan') is-invalid @enderror" name="keterangan" cols="40" rows="4">{{old('keterangan')}}</textarea>
                @error('keterangan') <label style="width: 5px"></label> <label style="color:red"> {{$message }}</label> @enderror
            </div>
        </div>

        <br>

        <div class="row">
            <div class="col-sm-4">
                <label for="supervisorID">Supervisor <label style="color: red">*</label></label>
                <select name="hcname" id="supervisorID" class="form-control" style="width:320px">
                    @foreach ($hcs as $hc)
                        <option value="{{$hc->id}}">{{$hc->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        
        <br>

        <input type="submit" class="btn btn-success" value="Order">      

        <br><br>


    </form>
@endsection