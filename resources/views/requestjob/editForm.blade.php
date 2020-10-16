@extends($layout)

@php
    $date = new Datetime();

    $orderDate = strftime('%Y-%m-%dT%H:%M:%S', strtotime($orderRequestJob->orderDate));

@endphp

@section('content')
    <h1>Requested Job's Detail</h1>
    <hr>

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
        </div>

        <hr>

        @if ($orderRequestJob->status == 'PENDING')
            <form action="/todojob/{{$orderRequestJob->id}}/change" method="post">
                @method('patch')
                @csrf
                <div class="row">
                    <div class="col-sm-4">
                        <label for="assignedID">Assigned to</label>
                        <select name="unitAPK" id="assignedID" class="form-control">
                            @foreach ($roles as $row)
                               <option value="{{$row->id}}" @if ($row->id == $roleto->id) selected @endif>{{$row->name}}</option>
                               @php
                                   $roleto = $row
                               @endphp
                            @endforeach
                        </select>
                    </div>
                </div>

                <br>
                
                <div class="row">
                    <div class="col-sm-4">         
                        <button type="submit" class="btn btn-primary">Change</button>               
                    </div>              
                </div>
            </form>

        @else
            <div class="row">
                <div class="col-sm-4">
                    <label for="assignedID">Assigned to</label>
                    <input type="text" id="assignedID" class="form-control" name="unitkerja" style="width:300px" value="{{$roleto->name}}" readonly>
                </div>
            </div>
        @endif

        
        <hr>

        @if(Session::has('successDetail'))
            <div class="alert alert-success">{{ Session::get('successDetail') }}</div>
        @endif
        <form action="{{$orderRequestJob->id}}" method="POST">
            @method('patch')
            @csrf
            <div class="row">
                <div class="col-sm-12">
                    <label for="">Status Detail</label>
                    <textarea class="form-control" name="statusDetail" id="" cols="30" rows="5" @if ($orderRequestJob->status == 'FINISHED') readonly @endif >{{$orderRequestJob->statusDetail}}</textarea>
                </div>
            </div>

            <br>

            @if ($orderRequestJob->status != 'FINISHED')
                <button type="submit" class="btn btn-info">Update</button>        
            @endif
        </form>

        <hr>
        
        <div class="row">
            <div class="col-sm-1">
                <a href="/todojob" class="btn btn-dark">Back</a>        
            </div>

            @if ($orderRequestJob->status == 'IN PROGRESS')
                <div class="col-sm-1">
                    <form action="{{$orderRequestJob->id}}/finish" method="post" class="form-inline">
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