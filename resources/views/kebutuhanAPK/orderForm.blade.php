@extends($layout)

@php
    $date = new Datetime();
@endphp

@section('content')

<script language="javascript">
	function addRow(tableID) {

		var table = document.getElementById(tableID);

		var rowCount = table.rows.length;
		var row = table.insertRow(rowCount);

		var colCount = table.rows[0].cells.length;

		for(var i=0; i<colCount; i++) {

			var newcell	= row.insertCell(i);

			newcell.innerHTML = table.rows[0].cells[i].innerHTML;

			switch(newcell.childNodes[0].type) {
				case "text":
						newcell.childNodes[0].value = "";
						break;
				case "checkbox":
						newcell.childNodes[0].checked = false;
						break;
				case "select-one":
						newcell.childNodes[0].selectedIndex = 0;
						break;
			}
		}
	}

	function deleteRow(tableID) {
		try {
		var table = document.getElementById(tableID);
		var rowCount = table.rows.length;

		for(var i=0; i<rowCount; i++) {
			var row = table.rows[i];
			var chkbox = row.cells[0].childNodes[0];
			if(null != chkbox && true == chkbox.checked) {
				if(rowCount <= 1) {
					alert("Cannot delete all the rows.");
					break;
				}
				table.deleteRow(i);
				rowCount--;
				i--;
			}


		}
		}catch(e) {
			alert(e);
		}
	}
</script>

    <h1>Request ATK</h1>
    <hr>

    @if(Session::has('successOrder'))
        <div class="alert alert-success">{{ Session::get('successOrder') }}</div>
    @endif

    <form action="{{route('atk')}}" method="POST">
        {{csrf_field()}}

        <div class="row">
            <div class="col-sm-4">
                <label for="requesterID">Requester</label>
                <input type="text" id="requesterID" class="form-control" name="requester" placeholder="requester" style="width:320px" value="{{$currUser->name}}" readonly>
            </div>

            <div class="col-sm-4">
                <label for="nipID">NIP Requester</label>
                <input type="text" id="nipID" class="form-control" name="nip" placeholder="NIP" style="width:320px" value="{{$currUser->NIP}}" readonly>
            </div>

            <div class="col-sm-4">
                <label for="nohpID">No. Telp Requester</label>
                <input type="text" id="nohpID" class="form-control" name="nohp" placeholder="No. Telp" style="width:320px" value="{{$currUser->nohp}}" readonly>
            </div>

        </div>

        <br>

        <div class="row">
            <div class="col-sm-4">
                <label for="orderdateID">Tanggal Order <label style="color: red">*</label></label>
                <input id="orderdateID" type="datetime-local" class="form-control" style="width:320px" name="orderdate" value="{{$date->format('Y-m-d\TH:i:s')}}" readonly>
            </div>
        </div>

        <br>

        <div class="row">
            <div class="col-sm-4">
                <label for="ketID">Keterangan <label style="color: red">*</label></label>
                <textarea id="ketID" class="form-control @error('keterangan') is-invalid @enderror" name="keterangan" cols="40" rows="4"></textarea>
                @error('keterangan') <label style="width: 5px"></label> <label style="color:red"> {{$message }}</label> @enderror
            </div>
        </div>

        <br>

        <div class="row ">
            <div class="col-sm-8"></div>
            <div class="col-sm-4 float-sm-right">
                <input type="button" class="btn btn-info" value="Add Row" onclick="addRow('dataTable')">
	            <input type="button" class="btn btn-danger" value="Delete Row" onclick="deleteRow('dataTable')" >
            </div>
        </div>

        <br>

        <div class="row">
            <div class="col-sm-12">
                <table id="dataTable" class="table table-hover">
		            <tr>
			            <td><input type="checkbox" name="chk"></td>
			            <td><input type="text" name="nama[]" class="form-control" placeholder="Nama Barang"></td>
			            <td><input type="text" name="spesifikasi[]" class="form-control" placeholder="Spesifikasi Barang"></td>
			            <td><input type="number" name="jumlah[]" class="form-control" placeholder="Jumlah" style="width: 100px" min="1"></td>
		            </tr>
	            </table>
            </div>
        </div>

        <input type="submit" class="btn btn-success" value="Order">

    </form>

@endsection