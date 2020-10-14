@extends($layout)

@php
    $date = new Datetime();

    $orderDate = strftime('%Y-%m-%dT%H:%M:%S', strtotime($orderRequestJob->orderDate));

@endphp

@section('content')
    <h1>Requested Job's Detail</h1>
    <hr>

    @if(Session::has('success'))
            <div class="alert alert-success">{{ Session::get('success') }}</div>
    @endif

        <div class="row">
            <div class="col-sm-4">
                <label for="requesterID">Requester</label>
                <input type="text" id="requesterID" class="form-control" name="requester" style="width:300px" value="{{$currUser->name}}" readonly>
            </div>

            <div class="col-sm-4">
                <label for="nipID">NIP Requester</label>
                <input type="text" id="nipID" class="form-control" name="nip" style="width:300px" value="{{$currUser->NIP}}" readonly>
            </div>

            <div class="col-sm-4">
                <label for="nohpID">Unit Kerja</label>
                <input type="text" id="nohpID" class="form-control" name="unitkerja" style="width:300px" value="{{$role->name}}" readonly>
            </div>

        </div>

        <br>

        <div class="row">
             <div class="col-sm-4">
                <label for="datefinishedID">Tanggal Order</label>
                <input id="datefinishedID" type="datetime-local" class="form-control" style="width:300px" name="orderdate" value="{{$orderDate}}" readonly>  
            </div>
        </div>
        
        <br>

        <div class="row">
            <div class="col-sm-4">
                <label for="ketID">Keterangan</label>
                <textarea id="ketID" class="form-control" name="keterangan" cols="40" rows="5" readonly>{{$orderRequestJob->keterangan}}</textarea>
            </div>

            <div class="col-sm-4">
                <label for="requesterID">Jenis Permohonan</label>
                <input type="text" id="requesterID" class="form-control" name="requester" style="width:300px" value="{{$orderRequestJob->jenis}}" readonly>
            </div>

            <div class="col-sm-4">
                <label for="requesterID">Assigned to</label>
                <input type="text" id="requesterID" class="form-control" name="requester" style="width:300px" value="{{$roleto->name}}" readonly>
            </div>
        </div>

        <hr>

        @if ($orderRequestJob->status == "Waiting for Approval")
            <div class="row">
                <form action="/authjob/{{$orderRequestJob->id}}/approve" method="post">
                    @method('patch')
                    @csrf
                    <div class="col-sm-1">
                        <button type="submit" class="btn btn-success">Authorize</button>
                    </div>
                </form>

                <form action="/authjob/{{$orderRequestJob->id}}/reject" method="post">
                    @method('patch')
                    @csrf
                    <div class="col-sm-1">
                        <button type="submit" class="btn btn-danger">Reject</button>
                    </div>
                </form>
            </div>

        <hr>

        @endif
        
        <a href="/authjob" class="btn btn-dark">Back</a>   

        <br><br>

@endsection