@extends($layout)

@section('content')
  
    <h1>My Order</h1>
    <hr>

    <!-- Logistik -->
    @if ($currUser->role_id != 2)
    <div class="row">
        <div class="col-sm-2">
            <h5>Logistik</h5>
        </div>

        <div class="col-sm-2">
            <a href="#" class="btn btn-dark">Data Aktiva</a>
        </div>

        <div class="col-sm-2">
            <a href="/myatk" class="btn btn-dark">Kebutuhan APK</a>
        </div>

        <div class="col-sm-2">
            <a href="/myordercar" class="btn btn-dark">Kendaraan</a>
        </div>

        <div class="col-sm-2">
            <a href="/myreimbursement" class="btn btn-dark">Reimbursement</a>
        </div>

        <div class="col-sm-2">
            <a href="/myjoblogistik" class="btn btn-dark">Requested Job</a>
        </div>
    </div>
    <br>
    @endif

    @if ($currUser->role_id != 3)
    <!-- Pembukuan -->
    <div class="row">
        <div class="col-sm-2">
            <h5>Pembukuan</h5>
        </div>
        <div class="col-sm-2">
            <a href="#" class="btn btn-dark">Coming Soon</a>
        </div>
    </div>
    <br>
    @endif

    @if ($currUser->role_id != 4)
    <!-- SIC -->
    <div class="row">
        <div class="col-sm-2">
            <h5>Sistem Informasi Cabang</h5>
        </div>
        <div class="col-sm-2">
            <a href="#" class="btn btn-dark">Coming Soon</a>
        </div>
    </div>
    @endif

    <hr>
    
@endsection