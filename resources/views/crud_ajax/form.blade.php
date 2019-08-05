{!! Form::model($model, [
	'route' => 'user.store',
	'method' => 'POST',
	'enctype' => 'multipart/form-data'
]) !!}
<div class="form-group">
	<label for="" class="control-label">NIP</label>
	{!! Form::text('nip', null, ['class' => 'form-control', 'id' => 'nip']) !!}
</div>

<div class="form-group">
	<label for="" class="control-label">Nama Karyawan</label>
	{!! Form::text('nama', null, ['class' => 'form-control', 'id' => 'nama']) !!}
</div> 

<div class="form-group">
	<label for="" class="control-label">Jabatan</label>
	{!! Form::text('jabatan', null, ['class' => 'form-control', 'id' => 'jabatan']) !!}
</div> 

<div class="form-group">
	<label for="" class="control-label">Foto</label>
	{!! Form::file('foto', null, ['class'=>'form-control', 'id'=>'foto']) !!}
</div>
{!! Form::close() !!}