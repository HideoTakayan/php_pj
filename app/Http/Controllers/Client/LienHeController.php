<?php

namespace App\Http\Controllers\Client;

use App\Models\LienHe;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Controller liên hệ
 * Hiển thị form liên hệ, lưu thông tin liên hệ
 * Quản lý danh sách liên hệ (Admin)
 */
class LienHeController extends Controller
{
    public $lien_he;
    
    public function __construct(){
        $this->lien_he = new LienHe();
    }
    
    // Trang liên hệ
    public function index(){
        return view('client.contact');
    }

    // Danh sách liên hệ (Admin)
    public function admin_contact(){
        $listLienHe = $this->lien_he->getListLH();

        return view('admin.lien_hes.index',compact('listLienHe'));
    }

    // Lưu thông tin liên hệ
    public function store(Request $request){
        $this->lien_he->createLH($request->all());
        return redirect()->route('client.contact');
    }
}
