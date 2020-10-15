@extends('layouts.pembukuan.app')

@section('content')
  
    <h1>Home APK - Pembukuan</h1>
    <hr>

    <h2>Your orders this month:</h2>
    <div class="card-deck">
        <div class="card border-danger bg-transparent sm-4">
            <div class="card-header bg-transparent border-danger">Pending</div>
            <div class="card-body text-danger">
                <h5 class="card-title">Total Pending: {{array_sum($pendinglogistik)}}</h5>
                <li>
                    <a href="#pendingLogis" data-toggle="collapse" aria-expanded="false">
                        Logistik
                    </a>
                    <ul class="collapse list-unstyled" id="pendingLogis">
                        <li>
                            Aktiva: {{$pendinglogistik[0]}}
                        </li>
                        <li>
                            Kebutuhan ATK: {{$pendinglogistik[1]}}
                        </li>
                        <li>
                            Kendaraan: {{$pendinglogistik[2]}}
                        </li>
                        <li>
                            Reimbursement: {{$pendinglogistik[3]}}
                        </li>
                        <li>
                            Kiriman: {{$pendinglogistik[4]}}
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
                <h5 class="card-title">Total In Progress: {{array_sum($progresslogistik)}}</h5>
                <li>
                    <a href="#progressLogis" data-toggle="collapse" aria-expanded="false">
                        Logistik
                    </a>
                    <ul class="collapse list-unstyled" id="progressLogis">
                        <li>
                            Aktiva: {{$progresslogistik[0]}}
                        </li>
                        <li>
                            Kebutuhan ATK: {{$progresslogistik[0]}}
                        </li>
                        <li>
                            Kendaraan: {{$progresslogistik[0]}}
                        </li>
                        <li>
                            Reimbursement: {{$progresslogistik[0]}}
                        </li>
                        <li>
                            Kiriman: {{$progresslogistik[0]}}
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
                <h5 class="card-title">Total Finished: {{array_sum($finishedlogistik)}}</h5>
                <li>
                    <a href="#finishLogis" data-toggle="collapse" aria-expanded="false">
                        Logistik
                    </a>
                    <ul class="collapse list-unstyled" id="finishLogis">
                        <li>
                            Aktiva: {{$finishedlogistik[0]}}
                        </li>
                        <li>
                            Kebutuhan ATK: {{$finishedlogistik[1]}}
                        </li>
                        <li>
                            Kendaraan: {{$finishedlogistik[2]}}
                        </li>
                        <li>
                            Reimbursemen: {{$finishedlogistik[3]}}
                        </li>
                        <li>
                            Kiriman: {{$finishedlogistik[4]}}
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