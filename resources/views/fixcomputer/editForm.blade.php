@extends($layout)

@php
    $date = new Datetime();

    $orderDate = strftime('%Y-%m-%dT%H:%M:%S', strtotime($orderfixcomputer->orderDate));

@endphp

@section('content')
    <h1>Perbaikan Komputer</h1>
    <hr>

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
            <input id="datefinishedID" type="datetime-local" class="form-control" style="width:270px" name="orderdate" value="{{$orderDate}}" readonly>  
        </div>
    </div>
        
    <br>

    <div class="row">
        <div class="col-sm-4">
            <label for="">Komponen Komputer</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="jenisDescID">{{$jenis->name}}</label>
                </div>
            </div>
        </div>
    </div>

    <br>

    <div class="row">
        <div class="col-sm-3">
            <label for="ketID">Keterangan</label>
            <textarea id="ketID" class="form-control" name="keterangan" cols="40" rows="5" readonly>{{$orderfixcomputer->keterangan}}</textarea>
        </div>
            
    </div>
        
    <hr>
    
    @if(Session::has('successDetail'))
        <div class="alert alert-success">{{ Session::get('successDetail') }}</div>
    @endif
    <form action="{{$orderfixcomputer->id}}" method="POST">
        @method('patch')
        @csrf
        <div class="row">

            <div class="col-sm-12">
                <label for="">Status Detail</label>
                <textarea class="form-control" name="statusDetail" id="" cols="30" rows="5" @if ($orderfixcomputer->status == 'FINISHED') readonly @endif >{{$orderfixcomputer->statusDetail}}</textarea>
            </div>
        </div>

        <br>

        @if ($orderfixcomputer->status != 'FINISHED')
            <button type="submit" class="btn btn-info">Update</button>        
        @endif
    </form>

    <hr>

    <div class="row">
        <div class="col-sm-1">
            <a href="/todofixcomputer" class="btn btn-dark">Back</a>        
        </div>

        @if ($orderfixcomputer->status == 'IN PROGRESS')
            <div class="col-sm-1">
                <form action="{{$orderfixcomputer->id}}/finish" method="post" class="form-inline">
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