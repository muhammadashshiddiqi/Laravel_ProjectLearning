<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Crud;

class KaryawanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
    	$id_user = Auth::user()->id;

    	if(is_null($id_user)){
            return view('auth.login');
    	}else{
            $data = Crud::orderBy('id', 'DESC')->paginate(3);
            return view('karyawan.index', compact('data'))
                    ->with('i',(request()->input('page', 1) - 1) * 3);
    	}
    }

    public function storeData(Request $req){
       
        $req->validate([

            'foto'    => 'required|image|max:3048',
            'nip'     => 'required|numeric',
            'nama'    => 'required',
            'jabatan' => 'required'
        ]);

        

            $img = $req->file('foto');
            $new_name = rand().'.'.$img->getClientOriginalExtension();
            $img->move(public_path('UploadFile/Foto'), $new_name);

            $form_data = array(
                'nip'       => $req->nip,
                'nama'      => $req->nama,
                'jabatan'   => $req->jabatan,
                'foto'      => $new_name
            );

            Crud::create($form_data);
            return redirect('crud/')->with('success', 'Data added successfully.');
        
    }

    public function showData($id){
        $dataEdit = Crud::findOrFail($id);
        //dd($dataEdit);
        return view('karyawan/edit', compact('dataEdit'));
    }

    public function update(Request $req, $id){
        $img_name = $req->foto2_hidden;
        $img = $req->file('foto2');
        if($img != ''){
            $req->validate([
                'foto2'    => 'required|image|max:3048',
                'nip2'     => 'required|numeric',
                'nama2'    => 'required',
                'jabatan2' => 'required'
            ]);
            $img_new = rand().$img->getClientOriginalExtension();
            $img->move(public_path('UploadFile/Foto'), $img_new);

            $form_data = array(
                'foto'    => $img_new,
                'nip'     => $req->nip2,
                'nama'    => $req->nama2,
                'jabatan' => $req->jabatan2
            );
            
        }else{
            $req->validate([
                'nip2'     => 'required|numeric',
                'nama2'    => 'required',
                'jabatan2' => 'required'
            ]);

            $form_data = array(
                'foto'    => $img_name,
                'nip'     => $req->nip2,
                'nama'    => $req->nama2,
                'jabatan' => $req->jabatan2
            );
        }

        

        Crud::whereId($id)->update($form_data);
        return redirect('crud/')->with('success', 'Data is sucessfully updated');

    }

    public function delete($id){
        $dataDelete = Crud::findOrFail($id);
        $dataDelete->delete();

        return redirect('crud/')->with('success', 'Data deleted successfully.');
    }
   
}
