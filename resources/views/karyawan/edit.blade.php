@extends('layouts.app')
@section('content')

<div class="container">
	  <h4 class="title" id="title">Karyawan Edit</h4>
	  <form id="formEdit" method="post" action="{{ url('crud/editData/'.$dataEdit['id']) }}" enctype="multipart/form-data">

		@csrf
		@method('put')
	    <div class="modal-body">

			  <input type="hidden" id="id" name="id" value="{{ $dataEdit['id'] }}">	
	          <div class="form-group">
	          	<img src="{{ asset('UploadFile/foto/'.$dataEdit['foto']) }}" alt="{{ $dataEdit['foto'] }}" height="200" width="200">
			    <label for="foto2" class="text-danger">Foto</label>
			    <input type="file" class="form-control-file" id="foto2" name="foto2" placeholder="Enter Photo">
			    <input type="hidden" class="form-control-file" id="foto2_hidden" name="foto2_hidden" value="{{ $dataEdit['foto'] }}">
			  </div>
				<div class="form-group">
			    <label for="nip2" class="text-danger">Nomer Induk Pegawai</label>
			    <input type="type" class="form-control" id="nip2" name="nip2" value="{{ $dataEdit['nip'] }}" placeholder="Enter Nomer Induk Pegawai">
			  </div>
				<div class="form-group">
			    <label for="nama2" class="text-danger">Nama Pegawai</label>
			    <input type="type" class="form-control" id="nama2" name="nama2" value="{{ $dataEdit['nama'] }}" placeholder="Enter Nama Pegawai">
			  </div>
			  <div class="form-group">
			    <label for="jabatan2" class="text-danger">Jabatan</label>
			    <input type="type" class="form-control" id="jabatan2" name="jabatan2" value="{{ $dataEdit['jabatan'] }}" placeholder="Enter jabatan">
			  </div>
	    </div>

	    <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	        <button type="submit" id="saveData" name="saveData" class="btn btn-primary">Save</button>
	    </div>
	</form>
</div>

@endsection