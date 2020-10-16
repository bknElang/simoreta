@extends($layout)

@php
    $date = new Datetime();
@endphp

@section('content')
    <h1>Kiriman Dokumen</h1>
    <hr>

    @if(Session::has('successOrder'))
        <div class="alert alert-success">{{ Session::get('successOrder') }}</div>
    @endif

    <form action="{{route('kiriman')}}" enctype="multipart/form-data" method="POST">
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
                <label for="jenisID">Jenis Pengiriman<label style="color: red">*</label></label>
                <select name="jenisKiriman" id="jenisID" class="form-control" style="width:320px">
                    <option value="TOP URGENT">TOP URGENT</option>
                    <option value="URGENT">URGENT</option>
                    <option value="NORMAL">NORMAL</option>
                </select>
            </div>

            <div class="col-sm-4">
                <br>
                <br>
                <label for="asuransiID">Asuransi <label style="color: red">*</label></label>
                <input type="radio" onclick="yesnoCheck()" name="asuransi" id="yesCheck" value="Ya"><label for="asuransiID">Ya</label>
                <input type="radio" onclick="yesnoCheck()" name="asuransi" id="noCheck" value="Tidak"><label for="asuransiID">Tidak</label>
            </div>

            <div id="ifYes" class="col-sm-4" style="display:none">
                <label for="pihakID">Nilai Pertanggungan <label style="color: red">*</label></label>
                <input type='text' id='pihakID' name='pertanggungan' class="form-control @error('pertanggungan') is-invalid @enderror">
                @error('pertanggungan') <label style="width: 5px"></label> <label style="color:red"> {{$message }}</label> @enderror
            </div>
        </div>

        <br>

        <div class="row">
            <div class="col-sm-4"> 
                <label for="pihakID">Nama Debitur/Nasabah/Pihak yang Dituju <label style="color: red">*</label></label>
                <input id="pihakID" type="text" class="form-control @error('namaTujuan') is-invalid @enderror" style="width:320px" name="namaTujuan">
                @error('namaTujuan') <label style="width: 5px"></label> <label style="color:red"> {{$message }}</label> @enderror

            </div>

            <div class="col-sm-4">
                <label for="penerimaID">Nama Penerima <label style="color: red">*</label></label>
                <input id="penerimaID" type="text" class="form-control @error('namaPenerima') is-invalid @enderror" style="width:320px" name="namaPenerima">
                @error('namaPenerima') <label style="width: 5px"></label> <label style="color:red"> {{$message }}</label> @enderror
            </div>

            <div class="col-sm-4">
                <label for="notelpID">No. Telp Penerima <label style="color: red">*</label></label>
                <input id="notelpID" type="text" class="form-control @error('notelp') is-invalid @enderror" style="width:320px" name="notelp">
                @error('notelp') <label style="width: 5px"></label> <label style="color:red"> {{$message }}</label> @enderror
            </div>
        </div>

        <br>

        <div class="row">
            <div class="col-sm-4">
                <label for="alamatID">Alamat Pengiriman <label style="color: red">*</label></label>
                <textarea name="alamat" id="alamatID" cols="30" rows="5" class="form-control @error('alamat') is-invalid @enderror"></textarea>
                @error('alamat') <label style="width: 5px"></label> <label style="color:red"> {{$message }}</label> @enderror
            </div>

            <div class="col-sm-4">
                <label for="dokumenID">Dokumen <label style="color: red">*</label></label>
                <input id="dokumenID" type="text" class="form-control @error('dokumen') is-invalid @enderror" style="width:320px" name="dokumen">
                @error('dokumen') <label style="width: 5px"></label> <label style="color:red"> {{$message }}</label> @enderror
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

    </form>

<script type="text/javascript">

    function yesnoCheck() {
        if (document.getElementById('yesCheck').checked) {
            document.getElementById('ifYes').style.display = 'block';
        }
        else document.getElementById('ifYes').style.display = 'none';

    }

</script>


@endsection