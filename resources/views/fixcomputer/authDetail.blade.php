@extends($layout)

@php
    $date = new Datetime();

    $orderDate = strftime('%Y-%m-%dT%H:%M:%S', strtotime($orderfixcomputer->orderDate));

@endphp

@section('content')
    <h1>Perbaikan Komputer</h1>
    <hr>

    @if(Session::has('success'))
            <div class="alert alert-success">{{ Session::get('success') }}</div>
    @endif

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

        @if ($orderfixcomputer->status == "Waiting for Approval")
            <div class="row">
                <form action="/authfixcomputer/{{$orderfixcomputer->id}}/approve" method="post">
                    @method('patch')
                    @csrf
                    <div class="col-sm-1">
                        <button type="submit" class="btn btn-success">Authorize</button>
                    </div>
                </form>

                <form action="/authfixcomputer/{{$orderfixcomputer->id}}/reject" method="post">
                    @method('patch')
                    @csrf
                    <div class="col-sm-1">
                        <button type="submit" class="btn btn-danger">Reject</button>
                    </div>
                </form>
            </div>

        <hr>

        @endif
    
        <a href="/myfixcomputer" class="btn btn-dark">Back</a>   

        <br><br>

@endsection