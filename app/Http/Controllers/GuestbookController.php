<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GuestBook;

class GuestbookController extends Controller
{
    function index(){

    	$tamubaru = GuestBook::latest()->get();
    	return view('wysiwyg/index', ['tamu' => $tamubaru]);
    }

    function store(Request $req){

    	$req->validate([
    		'nm_book' => 'required',
    		'msg_book' => 'required'
    	]);

    	$form_data = array(
                'name_book'    => $req->nm_book,
                'message_book'     => $req->msg_book
            );
    	GuestBook::create($form_data);
    	return redirect()->back();
    }

}
