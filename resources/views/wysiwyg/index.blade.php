@extends('layouts.app')

@section('content')
	<div class="container">
		<h1><b>GuestBook Sidiq Home's</b></h1>
		<hr>

		@foreach($tamu as $tamugw)
		<div class="card">
			<div class="card-body">
				<h3>{!! $tamugw->name_book !!}</h3>
				{!! $tamugw->message_book !!}
				
			</div>
			
		</div>
		@endforeach
		<hr>
		<h1><b>Leave your messages</b></h1>
		<hr>
		<div class="card">
			<div class="card-body">
				<form action="{{ route('simpanbook') }}" method="POST">
					@csrf
					<div class="form-group">
						<label class="label" for="nm_book">Name Book</label>
						<input type="text" name="nm_book" id="nm_book" class="form-control">
					</div>

					<div class="form-group">
						<label class="label" for="msg_book">Message Book</label>
						<textarea name="msg_book" id="msg_book" cols="30" rows="4" class="form-control"></textarea>
					</div>

					<div class="form-group">
						<input type="submit" value="Send" class="btn btn-primary">
					</div>
				</form>
			</div>
		</div>
	</div>

@endsection

@section('js_before')
		//CKEDITOR
            var options = {
                filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
                filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token=',
                filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
                filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token='
              };
            CKEDITOR.replace('msg_book', options);
        ///END CKEDITOR
@endsection