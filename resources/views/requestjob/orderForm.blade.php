@extends($layout)

@php
    $date = new Datetime();
@endphp

@section('content')
    <h1>Request Job</h1>
    <hr>

    @if(Session::has('successOrder'))
        <div class="alert alert-success">{{ Session::get('successOrder') }}</div>
    @endif

    <form action="{{route('requestjob')}}" method="POST">
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
                <label for="orderdateID">Tanggal Order <label style="color: red">*</label></label>
                <input id="orderdateID" type="datetime-local" class="form-control" style="width:320px" name="orderdate" value="{{$date->format('Y-m-d\TH:i:s')}}" readonly>
            </div>
        </div>

        <br>

        <div class="row">
            <div class="col-sm-4">
                <label for="jenis">Jenis Permohonan <label style="color: red">*</label></label>
                <input type="text" id="jenis" class="form-control @error('jenis') is-invalid @enderror" name="jenis" placeholder="Jenis Permohonan" style="width:320px">
                @error('jenis') <label style="width: 5px"></label> <label style="color:red"> {{$message }}</label> @enderror
            </div>

            <div class="col-sm-4">
                <label for="jumlahID">Unit APK <label style="color: red">*</label></label>
                <select name="unitAPK" id="" class="form-control">
                    @foreach ($roles as $row)
                        @if($row->id == 2 || $row->id == 3 || $row->id == 4) <option value="{{$row->id}}">{{$row->name}}</option> @endif
                    @endforeach
                </select>
            </div>
        </div>

        <br>

        <div class="row">
            <div class="col-sm-4">
                <label for="ketID">Keterangan <label style="color: red">*</label></label>
                <textarea id="ketID" class="form-control @error('keterangan') is-invalid @enderror" name="keterangan" cols="40" rows="4"></textarea>
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

    </form>
@endsection