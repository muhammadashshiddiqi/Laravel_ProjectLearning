<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Crud;

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

    public function index()
    {
        $id_user = Auth::user()->id;
        if(is_null($id_user)){
            return view('auth.login');
        }else{
            $isi_data = Crud::orderBy('id', 'DESC')->paginate(6);
            return view('crud_ajax.index', compact('isi_data'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'foto' => 'required|image|max:3048',
            'nama' => 'required',
            'nip' => 'required:numeric',
            'jabatan' => 'required'
        ]);

        $img = $request->file('foto');
        $new_foto = date('ymd').''.rand(4,4).'.'.$img->getClientOriginalExtension();
        $img->move(public_path('UploadFile/foto'), $new_foto);

        $isi_data = array(
            'nip' => $request->nip,    
            'nama' => $request->nama,    
            'jabatan' => $request->jabatan,    
            'foto' => $new_foto 
        );

        Crud::create($isi_data);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $show_data = Crud::where('id', $id)->first();
        return response()->json($show_data, 200);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
