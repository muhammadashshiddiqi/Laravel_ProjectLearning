@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="col-sm-12">
			<div class="card">
				<div class="card-header">Crud Ajax</div>
				<div class="card-body">
					<a href="{{ route('user.create') }}" class="btn btn-info pull-right modal-show" title="Create User">+ Tambah</a>

					<div class="table-responsive">
						<table id="datatable" class="table table-striped">
							<thead class="text-danger">
								<tr>
									<th>#</th>
									<th>Foto</th>
									<th>Nip</th>
									<th>Nama</th>
									<th>Jabatan</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
							<tfoot>
								<tr>
									<th>#</th>
									<th>Foto</th>
									<th>Nip</th>
									<th>Nama</th>
									<th>Jabatan</th>
									<th>Action</th>
								</tr>
							</tfoot>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Modal -->
	@include('crud_ajax._modal')
@endsection

@section('js_body')
	$.ajaxSetup({
	    headers: {
	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    }
	});

	$('body').on('click','.modal-show', function(event){
		event.preventDefault();

		var me = $(this),
			url = me.attr('href'),
			title = me.attr('title');

		$('#modal-title').text(title);
		$('#modal-btn-save').text('Create');

		$.ajax({
			url: url,
			dataType: 'HTML',
			success: function(response){
				$('.modal-body').html(response);
				$('#modal').modal({
								show: true,
		                        backdrop: 'static',
		                        keyword: false
							});
			}
		});
		
	});

	$('#modal-btn-save').click(function(event){
		event.preventDefault();
		var form = $('.modal-body form'),
			url = form.attr('action'),
			method = $('input[name=_method]').val() == undefined ? 'POST' : 'PUT';
			
			form.find('.help-block').remove();
			form.find('.form-group').removeClass('has-error');

		$.ajax({
			url: url,
			method: method,
			data: new FormData($(form)[0]),
			processData: false,
   			contentType: false,
			success: function(data){
				form.trigger('reset');
				$('#modal').modal('hide');
				$('#datatable').DataTables().ajax.reload();
			},
			error: function(jqXHR){

				if(jqXHR.status == 422){
					var res = jqXHR.responseText;
					var data_json = JSON.parse(res);
					$.each(data_json.errors, function(key, value){
						$('#'+key)
						.closest('.form-group')
						.addClass('has-error')
						.append('<span class="help-block text-danger">'+ value +'</span>');
					});
				}
			}
		});
	});
@endsection

@push('scripts')
	$(document).ready(function(){
		$('#datatable').DataTable({
			responsive: true,
			processing: true,
			serverSide: true,
			ajax: "{{ route('table.user') }}",
			columns: [
				{data: 'DT_RowIndex', name:'id'},
				{data: 'image', name:'image'},
				{data: 'nip', name:'nip'},
				{data: 'nama', name:'nama'},
				{data: 'jabatan', name:'jabatan'},
				{data: 'action', name:'action'}
			]
		});
	});
@endpush


@section('js_head')
	<link href="{{ asset('assets/vendor/datatables/DataTables-1.10.18/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/datatables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <!-- <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>   -->
    <script src="{{ asset('assets/vendor/datatables/DataTables-1.10.18/js/jquery.dataTables.min.js') }}"></script>
    <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script> -->
    <script src="{{ asset('assets/vendor/datatables/DataTables-1.10.18/js/dataTables.bootstrap4.min.js') }}"></script>
@endsection