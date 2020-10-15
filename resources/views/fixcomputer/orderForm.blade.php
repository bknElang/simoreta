@extends($layout)

@php
    date_default_timezone_set('Asia/Jakarta'); 
    $date = new Datetime(); 
@endphp

@section('content')
    <h1>Perbaikan Komputer</h1>
    <hr>

    @if(Session::has('successOrder'))
        <div class="alert alert-success">{{ Session::get('successOrder') }}</div>
    @endif

    <form action="{{route('fixcomputer')}}" method="POST" enctype="multipart/form-data">
        {{csrf_field()}}

        <div class="row">
            <div class="col-sm-3">
                <label for="requesterID">Requester</label>
                <input type="text" id="requesterID" class="form-control" name="requester" style="width:270px" value="{{$currUser->name}}" readonly>
            </div>

            <div class="col-sm-3">
                <label for="nipID">NIP Requester</label>
                <input type="text" id="nipID" class="form-control" name="nip" style="width:270px" value="{{$currUser->NIP}}" readonly>
            </div>

            <div class="col-sm-3">
                <label for="nohpID">Cabang</label>
                <input type="text" id="nohpID" class="form-control" name="cabang" style="width:270px" value="{{$cabang->name}}" readonly>
            </div>

            <div class="col-sm-3">
                <label for="nohpID">Unit Kerja</label>
                <input type="text" id="nohpID" class="form-control" name="unitkerja" style="width:270px" value="{{$role->name}}" readonly>
            </div>

        </div>

        <br>

        <div class="row">
             <div class="col-sm-4">
                <label for="datefinishedID">Tanggal Order</label>
                <input id="datefinishedID" type="datetime-local" class="form-control" style="width:270px" name="datefinished" value="{{$date->format('Y-m-d\TH:i:s')}}" readonly>  
            </div>
        </div>
        
        <br>

        <div class="row">
            <div class="col-sm-4">
                <label for="komponenkomputerID">Komponen Komputer</label><label style="color: red">*</label>
                <br>
                @foreach ($jenis as $jenis)
                <input type="radio" name="jenis" value="{{$jenis->id}}">
                    {{$jenis->name}}
                    <br>
                @endforeach
                @error('jenis') <label style="width: 5px"></label> <label style="color:red"> {{$message }}</label> @enderror
            </div>
        </div>
        
        <br>

        <div class="row">
            <div class="col-sm-3">
                <label for="ketID">Keterangan<label style="color: red">*</label>
                <textarea id="ketID" class="form-control @error('keterangan') is-invalid @enderror" name="keterangan" cols="40" rows="5">{{old('keterangan')}}</textarea>
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