@extends($layout)

@php
    $date = new Datetime();

    $orderDate = strftime('%Y-%m-%dT%H:%M:%S', strtotime($orderreimbursement->orderDate));

@endphp

@section('content')
    <h1>Reimbursement</h1>
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
            <div class="col-sm-8">
                <label for="">Jenis Reimbursement</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="jenisDescID">{{$jenis->name}}</label>
                    </div>
                    <input id="jenisDescID" type="text" class="form-control" value="{{$jenis->deskripsi}}" style="color:gray" readonly>
                </div>
            </div>
        </div>

        <br>

        <div class="row">
            <div class="col-sm-3">
                <label for="ketID">Keterangan</label>
                <textarea id="ketID" class="form-control" name="keterangan" cols="40" rows="5" readonly>{{$orderreimbursement->keterangan}}</textarea>
            </div>

            <div class="col-sm-9">
                <div class="row">
                    <div class="col-sm-3">
                        <label for="namaRekID">Nama Rekening</label>
                        <input type="text" id="namaRekID" class="form-control" name="namarekening" style="width:200px" value="{{$orderreimbursement->namaRek}}" readonly>
                    </div>

                    <div class="col-sm-3">
                        <label for="nomorekID">Nomor Rekening</label>
                        <input type="text" id="nomorekID" class="form-control" name="nomorrekening" placeholder="Nomor Rekening" style="width:200px" value="{{$orderreimbursement->nomorRek}}" readonly> 
                    </div>

                    <div class="col-sm-3">
                        <label for="bankrekID">Bank Rekening</label>
                        <input type="text" id="bankrekID" class="form-control" name="bankrekening" placeholder="Bank Rekening" style="width:200px" value="{{$orderreimbursement->bankRek}}" readonly>
                    </div>
                </div>

                <br>

                <div class="row">
                    <div class="col-sm-9">
                        <div class="input-group sm-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon3">Rp.</span>
                            </div>
                            <input type="text" id="basic-url" class="form-control" aria-describedby="basic-addon3"name="nominal" value="{{$orderreimbursement->nominal}}" readonly style="text-align: right">
                        </div>    
                    </div>
                </div>

            </div>
            
        </div>
        
        <hr>

        @if ($orderreimbursement->status != 'PENDING')
            <div class="row">
                <div class="col-sm-12">
                    <label for="">Status Detail</label>
                    <textarea class="form-control" name="statusDetail" id="" cols="30" rows="5" readonly>{{$orderreimbursement->statusDetail}}</textarea>
                </div>
            </div>

            <hr>
        @endif
    
        <a href="/myreimbursement" class="btn btn-dark">Back</a>   

        <br><br>

@endsection