@extends('layouts.app')
@section('content')
<div class="container">
	<div class="col-sm-12">
		<div class="card">
			<div class="card-header">Crud Ajax</div>
			<div class="card-body">
				<button class="btn btn-info" data-toggle="modal" data-target="#NewData" >+ Tambah</button>
				<br>
				<div class="table-responsive">
					<table class="table table-striped">
						<thead class="text-danger">
							<tr>
								<td>#</td>
								<td>Foto</td>
								<td>Nip</td>
								<td>Nama</td>
								<td>Jabatan</td>
								<td>Action</td>
							</tr>
						</thead>
						<tbody>
							<?php $no = ($isi_data->currentpage()-1)* $isi_data->perpage() + 1; ?>
							@foreach($isi_data as $data)
								<tr>
									<td>{{ $no }}</td>
									<td><img src="{{ asset('UploadFile/foto/'.$data->foto) }}" width="30" height="30" alt="foto"></td>
									<td>{{ $data->nip }}</td>
									<td>{{ $data->nama }}</td>
									<td>{{ $data->jabatan }}</td>
									<td>
										<button onclick="EditData({{ $data->id }})" class="btn btn-success">Edit</button>
										<button href="{{ url('crud_ajax/destroy_ajax/'.$data->id) }}" class="btn btn-danger">Hapus</button></td>
								</tr>
							<?php $no++; ?>
							@endforeach
						</tbody>
					</table>

					{!! $isi_data->links() !!}
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade" id="NewData" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
			
	      <div class="modal-header">
	        <h5 class="modal-title" id="modalTambahTitle">CRUD AJAX NEW</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
		<form id="formNew" method="post" action="{{ url('crud_ajax/store_ajax') }}" enctype="multipart/form-data">
	   	  @csrf

	      <div class="modal-body">
	          <div class="form-group">
			    <label for="foto" class="text-danger">Foto</label>
			    <input type="file" class="form-control-file" id="foto" name="foto" placeholder="Enter Photo">
			  </div>
				<div class="form-group">
			    <label for="nip" class="text-danger">Nomer Induk Pegawai</label>
			    <input type="type" class="form-control" id="nip" name="nip" placeholder="Enter Nomer Induk Pegawai">
			  </div>
				<div class="form-group">
			    <label for="nama" class="text-danger">Nama Pegawai</label>
			    <input type="type" class="form-control" id="nama" name="nama" placeholder="Enter Nama Pegawai">
			  </div>
			  <div class="form-group">
			    <label for="jabatan" class="text-danger">Jabatan</label>
			    <input type="type" class="form-control" id="jabatan" name="jabatan" placeholder="Enter jabatan">
			  </div>
	      </div>

	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	        <button type="submit" id="saveData" name="saveData" class="btn btn-primary">Save</button>
	      </div>

		</form>
    </div>
  </div>
</div>

<div class="modal fade" id="EditData" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
			
	      <div class="modal-header">
	        <h5 class="modal-title" id="modalTambahTitle">CRUD AJAX EDIT</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
		<form id="formEdit" method="post" enctype="multipart/form-data">
	   	  @csrf

	      <div class="modal-body">
	          <div class="form-group">
			    <label for="foto" class="text-danger">Foto</label>
			    <input type="file" class="form-control-file" id="foto2" name="foto2" placeholder="Enter Photo">
			    <input type="hidden" class="form-control" id="id2" name="id2">
			  </div>
				<div class="form-group">
			    <label for="nip" class="text-danger">Nomer Induk Pegawai</label>
			    <input type="text" class="form-control" id="nip2" name="nip2" placeholder="Enter Nomer Induk Pegawai">
			  </div>
				<div class="form-group">
			    <label for="nama" class="text-danger">Nama Pegawai</label>
			    <input type="text" class="form-control" id="nama2" name="nama2" placeholder="Enter Nama Pegawai">
			  </div>
			  <div class="form-group">
			    <label for="jabatan" class="text-danger">Jabatan</label>
			    <input type="text" class="form-control" id="jabatan2" name="jabatan2" placeholder="Enter jabatan">
			  </div>
	      </div>

	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	        <button type="submit" id="saveData" name="saveData" class="btn btn-primary">Update</button>
	      </div>

		</form>
    </div>
  </div>
</div>
@endsection

@section('js')

	function EditData(id){
		$.ajax({
			type: "GET",
			url: "{{url('crud_ajax/edit_ajax')}}/"+ id,
			dataType: 'JSON',
			headers: {
			    'X-CSRF-Token': '{{ csrf_token() }}',
			},
			success: function(data) {
		        $('#id2').val(data.id);
		        $('#foto2').val(data.foto);
		        $('#jabatan2').val(data.jabatan);
		        $('#nip2').val(data.nip);
		        $('#nama2').val(data.nama);

				$('#EditData').modal('show');
		    	
		    }
		});
	}
@endsection