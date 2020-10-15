@extends($layout)

@section('content')
    
    <h1>Home Non - APK</h1>
    <hr>

    <form action="/getlaporan" method="get">
        <div class="row">
            <div class="col-sm-4 form-inline">
                <label for="monthID">Month</label>
                <input type="month" name="month" class="form-control">
            </div>
        
            <div class="col-sm-2"> 
                <button type="submit" class="btn btn-success">Search</button>
            </div>
        </div>
        
    </form>

    <hr>
    
    <h2>Your todo orders {{$month}}:</h2>
    <div class="card-deck">
        <div class="card border-danger bg-transparent sm-4">
            <div class="card-header bg-transparent border-danger">Pending</div>
            <div class="card-body text-danger">
                <h5 class="card-title">Total Pending:</h5>
                <li>
                    Aktiva: {{$pendinglogistik[0] ?? ''}}
                </li>
                <li>
                    Kebutuhan ATK: {{$pendinglogistik[1] ?? ''}}
                </li>
                <li>
                    Kendaraan: {{$pendinglogistik[2] ?? ''}}
                </li>
                <li>
                    Reimbursement: {{$pendinglogistik[3] ?? ''}}
                </li>
                <li>
                    Kiriman: {{$pendinglogistik[4] ?? ''}}
                </li>
            </div>
            
        </div>

        <div class="card border-primary bg-transparent sm-4">
            <div class="card-header bg-transparent border-primary">In Progress</div>
            <div class="card-body text-primary ">
                <h5 class="card-title">Total In Progress:</h5>
                <li>
                    Aktiva: {{$progresslogistik[0] ?? ''}}
                </li>
                <li>
                    Kebutuhan ATK: {{$progresslogistik[0] ?? ''}}
                </li>
                <li>
                    Kendaraan: {{$progresslogistik[0] ?? ''}}
                </li>
                <li>
                    Reimbursement: {{$progresslogistik[0] ?? ''}}
                </li>
                <li>
                    Kiriman: {{$progresslogistik[0] ?? ''}}
                </li>
            </div>
            
        </div>

        <div class="card border-success bg-transparent sm-4">
            <div class="card-header bg-transparent border-success">Finished</div>
            <div class="card-body text-success">
                <h5 class="card-title">Total Finished:</h5>
                <li>
                    Aktiva: {{$finishedlogistik[0] ?? ''}}
                </li>
                <li>
                    Kebutuhan ATK: {{$finishedlogistik[1] ?? ''}}
                </li>
                <li>
                    Kendaraan: {{$finishedlogistik[2] ?? ''}}
                </li>
                <li>
                    Reimbursemen: {{$finishedlogistik[3] ?? ''}}
                </li>
                <li>
                    Kiriman: {{$finishedlogistik[4] ?? ''}}
                </li>
            </div>
            
        </div>
    </div>
   
@endsection