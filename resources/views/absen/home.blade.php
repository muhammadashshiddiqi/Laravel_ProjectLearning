@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Informasi</div>
                
                <div class="card-body">
                  <!-- alert yang di lempar -->
                  <div class="alert alert-info">
                    <p>{{ $info['status'] }}</p>
                  </div>
                    
                  <form action="absen/absen" method="post">
                    @csrf <!-- {{ csrf_field() }} -->
                    <div class="table-responsive">
                      <table class="table">
                        <tr>
                          <td width="56%"><input placeholder="Keterangan ..." name="note" class="form-control" type="text"></td>
                          <td width="22%"><button type="submit" name="timeIN" value="a" class="btn btn-primary" {{ $info['timeIN'] }}>ABSEN MASUK</button></td>
                          <td width="22%"><button type="submit" name="timeOUT" value="a" class="btn btn-primary" {{ $info['timeOUT'] }}>ABSEN KELUAR</button></td>
                        </tr>
                      </table>
                    </div>
                  </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Riwayat Absensi</div>
                
                <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped">
                        <thead>
                          <tr>
                            <th>Date</th>
                            <th>Time In</th>
                            <th>Time Out</th>
                            <th>Keterangan</th>
                          </tr>
                        </thead>
                        <tbody>
                          @forelse($DataAbsen as $absen)
                            <tr>
                              <td>{{ $absen->date }}</td>
                              <td>{{ $absen->time_in }}</td>
                              <td>{{ $absen->time_out }}</td>
                              <td>{{ $absen->note }}</td>
                            </tr>
                          @empty
                            <p>DATA HAS EMPTY</p>
                          @endforelse

                        </tbody>
                      </table>
                    </div>
                      <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-end">
                          <li>
                            {!! $DataAbsen->links() !!}
                          </li>
                        </ul>
                      </nav>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
