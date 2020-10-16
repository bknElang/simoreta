@extends($layout)

@section('content')

    <h2>User's Detail</h2>
    <hr>

    @if(Session::has('updateAvaSuccess'))
        <div class="alert alert-success">{{ Session::get('updateAvaSuccess') }}</div>
    @endif

    <div class="row">
        <div class="col-sm-4" style="margin-left:15px">
            <div class="row">
                <label for="NIPID">NIP</label>
            </div>
            <div class="row">
                <input type="text" id="NIPID" class="form-control" name="nip" placeholder="NIP" value="{{$user->NIP}}" readonly>
            </div>

            <br>

            <div class="row">
                <label for="emailID">Email</label>
            </div>
            <div class="row">
                <input type="text" id="emailID" class="form-control" name="email" placeholder="Email" value="{{$user->email}}" readonly>
            </div>
                
            <br>

            <div class="row">
                <label for="nohpID">No. HP</label>
            </div>
            <div class="row">
                <input type="text" id="nohpID" class="form-control" name="nohp" placeholder="No. HP" value="{{$user->nohp}}" readonly>
            </div>
                
            <br>
        
            <div class="row">
                <label for="nameID">Name</label>
            </div>
            <div class="row">
                <input type="text" id="login" class="form-control" name="name" placeholder="Name" value="{{$user->name}}" readonly>
            </div>
              
            <br>

            <div class="row">
                <label for="cabangID">Cabang</label>
            </div>
            <div class="row">
                <select id="cabangID" class="form-control roles-select" name="cabang" disabled>
                    @foreach ($cabangs as $cabang)
                        <option value="{{$cabang->id}}" @if ($cabang->id == $user->cabang_id) {{'selected'}} @endif>{{$cabang->name}}</option>  
                    @endforeach
                </select>
            </div>

            <br>
        
            <div class="row">
                <label for="roleID">Role</label>
            </div>
            <div class="row">
                <select id="roleID" class="form-control roles-select" name="role" disabled>
                    @foreach ($roles as $role)
                        <option value="{{$role->id}}" @if ($role->id == $user->role_id) {{'selected'}} @endif>{{$role->name}}</option>  
                    @endforeach
                </select>
            </div>
        </div>
        
        <br>

        <div class="col-sm-2"></div>

        <div class="col-sm-4">
            <br>
            <div class="row">
                <form action="{{$user->id}}" enctype="multipart/form-data" method="POST">
                    @csrf

                    <div class="container" >
 				        <img src="{{asset('images/'.$user->avatar)}}" class="rounded mx-auto d-block image">
                        <div class="middle">
                            <div class="text">
                                <label>
                                    <input type="file" name="file" style="display: none;" onchange="this.form.submit()">
                                    Change Avatar
                                </label>
                            </div>
                        </div>
                    </div>	

                    <br>

                    @error('file')</label> <label style="color:red"> {{$message}}</label> @enderror
                </form>
            </div>
        </div>

    </div>
    
    <br>

    <a href="/" class="btn btn-dark">Back to Home</a>   

        
<script>
    $(function(){
    $("#upload_link").on('click', function(e){
        e.preventDefault();
        $("#upload:hidden").trigger('click');
    });
});
</script>    
@endsection