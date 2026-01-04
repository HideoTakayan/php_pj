<?php

namespace App\Http\Controllers\Client;

use App\Models\LienHe;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class LienHeController extends Controller
{
    public $lien_he;
    public function __construct(){
        $this->lien_he = new LienHe();
    }
    public function index(){
        return view('client.contact');
    }

    public function admin_contact(){
        $listLienHe = $this->lien_he->getListLH();

        return view('admin.lien_hes.index',compact('listLienHe'));
    }

    public function store(Request $request){

        // if($request -> isMethod('POST')){
        //     $params = $request->validate([
        //         'name'=>'required',
        //         'phone'=>'required|numeric',
        //         'email'=>'required',
        //         'describe'=>'required',
        //     ],
        //     [
        //         'name.required'=>'Tên bắt buộc điền',
        //     ]);
        //     //$this->lien_he->createLH($params);

        //     LienHe::createLH($request->all());
        //     return redirect()->route('client.contact');
        // }
        $this->lien_he->createLH($request->all());
            return redirect()->route('client.contact');
    }
}
