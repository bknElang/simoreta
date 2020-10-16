@extends('layouts.logistik.app')

@section('content')
  
    <h1>Home APK - Logistik</h1>
    <hr>

    <h2>Your orders this month:</h2>
    <div class="card-deck">
        <div class="card border-danger bg-transparent sm-4">
            <div class="card-header bg-transparent border-danger">Pending</div>
            <div class="card-body text-danger">
                <h5 class="card-title">Total Pending: {{array_sum($pendingbuku)}}</h5>
                <li>
                    <a href="#pendingBuku" data-toggle="collapse" aria-expanded="false">
                        Pembukuan
                    </a>
                    <ul class="collapse list-unstyled" id="pendingBuku">
                        <li>
                            Jurnal AAK: {{$pendingbuku[0]}}
                        </li>
                        <li>
                            Jurnal Manual: {{$pendingbuku[1]}}
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#pendingSIC" data-toggle="collapse" aria-expanded="false">
                        SIC
                    </a>
                    <ul class="collapse list-unstyled" id="pendingSIC">
                        <li>
                            Komputer
                        </li>
                        <li>
                            Aplikasi
                        </li>
                        <li>
                            Hardware Lainnya
                        </li>
                    </ul>
                </li>
            </div>
            
        </div>

        <div class="card border-primary bg-transparent sm-4">
            <div class="card-header bg-transparent border-primary">In Progress</div>
            <div class="card-body text-primary ">
                <h5 class="card-title">Total In Progress: {{array_sum($progressbuku)}}</h5>
                <li>
                    <a href="#progressBuku" data-toggle="collapse" aria-expanded="false">
                        Pembukuan
                    </a>
                    <ul class="collapse list-unstyled" id="progressBuku">
                        <li>
                            Jurnal AAK: {{$progressbuku[0]}}
                        </li>
                        <li>
                            Jurnal Manual: {{$progressbuku[1]}}
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#progressSIC" data-toggle="collapse" aria-expanded="false">
                        SIC
                    </a>
                    <ul class="collapse list-unstyled" id="progressSIC">
                        <li>
                            Komputer
                        </li>
                        <li>
                            Aplikasi
                        </li>
                        <li>
                            Hardware Lainnya
                        </li>
                    </ul>
                </li>
            </div>
            
        </div>

        <div class="card border-success bg-transparent sm-4">
            <div class="card-header bg-transparent border-success">Finished</div>
            <div class="card-body text-success">
                <h5 class="card-title">Total Finished: {{array_sum($finishedbuku)}}</h5>
                <li>
                    <a href="#finishBuku" data-toggle="collapse" aria-expanded="false">
                        Pembukuan
                    </a>
                    <ul class="collapse list-unstyled" id="finishBuku">
                        <li>
                            Jurnal AAK: {{$finishedbuku[0]}}
                        </li>
                        <li>
                            Jurnal Manual: {{$finishedbuku[1]}}
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#finishSIC" data-toggle="collapse" aria-expanded="false">
                        SIC
                    </a>
                    <ul class="collapse list-unstyled" id="finishSIC">
                        <li>
                            Komputer
                        </li>
                        <li>
                            Aplikasi
                        </li>
                        <li>
                            Hardware Lainnya
                        </li>
                    </ul>
                </li>
            </div>
            
        </div>
    </div>
    
@endsection