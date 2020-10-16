@extends($layout)

@section('content')
    
    <h1>Laporan Pembukuan</h1>
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
    
    <h2>Your to do orders {{$month}}:</h2>
    <div class="card-deck">
        <div class="card border-danger bg-transparent sm-4">
            <div class="card-header bg-transparent border-danger">Pending</div>
            <div class="card-body text-danger">
                <h5 class="card-title">Total Pending: {{array_sum($pendingbuku)}}</h5>
                <li>
                    Jurnal AAK: {{$pendingbuku[0]}}
                </li>
                <li>
                    Jurnal Manual: {{$pendingbuku[1]}}
                </li>
            </div>
            
        </div>

        <div class="card border-primary bg-transparent sm-4">
            <div class="card-header bg-transparent border-primary">In Progress</div>
            <div class="card-body text-primary ">
                <h5 class="card-title">Total In Progress: {{array_sum($progressbuku)}}</h5>
                <li>
                    Jurnal AAK: {{$progressbuku[0]}}
                </li>
                <li>
                    Jurnal Manual: {{$progressbuku[1]}}
                </li>
            </div>
            
        </div>

        <div class="card border-success bg-transparent sm-4">
            <div class="card-header bg-transparent border-success">Finished</div>
            <div class="card-body text-success">
                <h5 class="card-title">Total Finished: {{array_sum($finishedbuku)}}</h5>
                <li>
                    Jurnal AAK: {{$finishedbuku[0]}}
                </li>
                <li>
                    Jurnal Manual: {{$finishedbuku[1]}}
                </li>
            </div>
            
        </div>
    </div>
   
@endsection