<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LienHe extends Model
{
    use HasFactory;



    protected $table = 'lien_hes';
    protected $fillable = [
        'name',
        'phone',
        'email',
        'describe',
        
    ];
    // public function getList(){
    //     $query = LienHe::all();
    //     return $query;
    // }
    public function getListLH(){
        $listLienHe = DB::table('lien_hes')->latest('id')->get();
        return $listLienHe;
    }

    public function createLH($data){
        $res = LienHe::create($data);
        return $res;
    }
    // public function createLH($data){
    //     DB::table('lien_hes')->insert($data);
    // }
}
