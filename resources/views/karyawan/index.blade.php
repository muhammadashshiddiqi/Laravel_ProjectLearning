@extends('layouts.app')

@section('content')

	<div class="container">

		@if($message = Session::get('success') )
			<div class="alert alert-success">
				<p>{{ $message }}</p>
			</div>
		@else
			@if($errors->any())
				<div class="alert alert-danger">
					<ul>
						@foreach( $errors->all() as $error)
						<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
			@endif
		@endif

		<!-- Button trigger modal -->
		<button type="button" class="right btn btn-primary" data-toggle="modal" data-target="#modalTambah">+ Tambah </button>
		
		<div class="table-responsive">
			<table class="table table-bordered">
				<thead>
					<tr>
						<td scope="col">#</td>
						<td scope="col">Foto</td>
						<td scope="col">NIS</td>
						<td scope="col">Nama</td>
						<td scope="col">Jabatan</td>
						<td scope="col">Aksi</td>
					</tr>
				</thead>
				<tbody>
					<!-- $loop->iteration : looping number-->
					<?php $z = ($data->currentpage()-1)* $data->perpage() + 1;?>
					@forelse($data as $res)
					<tr>
						<td>{{ $z++ }}</td>
						<td><img src="{{ asset('UploadFile/foto/'.$res->foto) }}" alt="foto" width="30" height="30"></td>
						<td>{{ $res->nip }}</td>
						<td>{{ $res->nama }}</td>
						<td>{{ $res->jabatan }}</td>
						<td>
							<a href="{{ url('crud/showData', ['id' => $res->id ]) }}" id="id-edit" class=" btn btn-warning btn-sm">EDIT</a>
							<a href="{{ url('crud/hapus', ['id' => $res->id ]) }}" class=" btn btn-warning btn-sm">HAPUS</a>
						</td>
					</tr>
					@empty
					<p>Data Has Empty !</p>
					@endforelse
				</tbody>
			</table>
		</div>
		<nav aria-label="Page navigation example">
        	<ul class="pagination justify-content-end">
              <li>
                {!! $data->links() !!}
              </li>
            </ul>
        </nav>
	</div>

<!-- Modal -->
<div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
			
	      <div class="modal-header">
	        <h5 class="modal-title" id="modalTambahTitle">Karyawan New</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
		<form id="formInsert" method="post" action="{{ url('crud/simpanData') }}" enctype="multipart/form-data">
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

@endsection