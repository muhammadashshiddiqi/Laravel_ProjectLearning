<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Absen;
use App\Http\Controllers\Redirect;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

      $id_user = Auth::user()->id;
      $id_date = date('Y-m-d');
      
      //double validasi
      $cekABSEN = Absen::where(['user_id' => $id_user, 'date' => $id_date])
                        ->get()
                        ->first();
      if(is_null($cekABSEN)){
        $info = array(
                    'status' => 'Anda belum mengisi absensi !',
                    'timeIN' => '',
                    'timeOUT' => 'disabled'
                  );
      }elseif($cekABSEN->time_out == NULL){
        $info = array(
                    'status' => 'Anda belum mengisi absen keluar !',
                    'timeIN' => 'disabled',
                    'timeOUT' => ''
                  );
      }else{
        $info = array(
                    'status' => 'Absen hari ini selesai !',
                    'timeIN' => 'disabled',
                    'timeOUT' => 'disabled'
                  );
      }
      //double validasi

      $DataAbsen = Absen::where([
        ['user_id', '=', $id_user]
      ])
      ->orderBy('date', 'desc')
      ->paginate(10);
      
      return view('absen.home', compact('DataAbsen', 'info'));
    }

    public function absen(Request $rek)
    {
        $absen = new Absen;
        $date = date('Y-m-d');
        $time = date('h:i:s');
        $note = $rek->note;

        //query double data
        $cek_double = $absen->where(['date' => $date,
                                     'user_id' => Auth::user()->id])
                            ->count();

        //input absen
        if(isset($rek->timeIN)){
          //cek double data
          if($cek_double > 0){
            return redirect()->back();
          }

          $absen->create([
              'user_id' => Auth::user()->id,
              'date' => $date,
              'time_in' => $time,
              'note' => $note
          ]);
          return redirect()->back()->with('msg', ['Successfuly data Absen']);

        }elseif(isset($rek->timeOUT)){
          $absen->where(['user_id' => Auth::user()->id, 'date' => $date])
                ->update([
                    'time_out' => $time,
                    'note' => $note
                ]);
          return redirect()->back()->with('msg', ['Successfuly data Absen']);
        }

    }
}
