<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Crud;
use DataTables;

class CrudAjaxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    /*public function index()
    {
        $id_user  = Auth::user()->id;
        if(is_null($id_user)){
        return view('auth.login');
        }else{
        $isi_data = Crud::orderBy('id', 'DESC')->paginate(6);
        return view('crud_ajax.index', compact('isi_data'));
        }
    }*/

    /*public function store(Request $request)
    {
        $request->validate([
            'foto'    => 'required|image|max:3048',
            'nama'    => 'required',
            'nip'     => 'required:numeric',
            'jabatan' => 'required'
        ]);

        $img      = $request->file('foto');
        $new_foto = date('ymd').''.rand(4,4).'.'.$img->getClientOriginalExtension();
        $img->move(public_path('UploadFile/foto'), $new_foto);

        $isi_data = array(
            'nip'     => $request->nip,    
            'nama'    => $request->nama,    
            'jabatan' => $request->jabatan,    
            'foto'    => $new_foto 
        );

        $oklah = Crud::create($isi_data);
        return response()->json(array($oklah), 200);
    }*/

    public function index(){
        return view('crud_ajax.index');
    }

    public function create(){
        $model = new Crud();
        return view('crud_ajax.form', compact('model'));
    }

    public function store(Request $request){
        $request->validate([
            'foto'    => 'required|image|max:3048',
            'nama'    => 'required|max:225',
            'nip'     => 'required|numeric|unique:cruds',
            'jabatan' => 'required|max:225'
        ]);

        $img = $request->file('foto');
        $new_foto = date('ymd').'_'.rand(1000,9999).'_'.$img->getClientOriginalExtension();
        $img->move(public_path('UploadFile/foto'), $new_foto);

        $isi_data = array(
            'nip'     => $request->nip,
            'nama'    => $request->nama,
            'jabatan' => $request->jabatan,
            'foto'    => $new_foto
        );

        $model = Crud::create($isi_data);
        return $model; 
    }
    
    public function show($id)
    {
    }


    public function edit($id)
    {   
        $check_data = Crud::find($id);
        return response()->json(array('data'=>$check_data), 200);

    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

    public function dataTable(){
        $qry = Crud::query();
        return DataTables::of($qry)
            ->addColumn('image', function ($qry) { 
                $url = asset('UploadFile/foto/'.$qry->foto);
                return '<img src="'.$url.'" border="0" width="40" class="img-rounded" align="center" />';
            })
            ->addColumn('action', function($qry){
                return view('crud_ajax/_action', [
                  'model'       => $qry,
                  'url_show'    => route('user.show', $qry->id),
                  'url_edit'    => route('user.edit', $qry->id),
                  'url_destroy' => route('user.destroy', $qry->id)
                ]);
            })
            ->addIndexColumn()
            ->rawColumns(['image','action'])
            ->make(true);
    }
}
