<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;


use App\LoaiTin;

class ajaxController extends Controller
{
    //This is class for TheLoaiController
    public function getLoaiTin()
    {
        $idTheLoai = $_GET['idTheLoai'];
        $loaitin = LoaiTin::where('idTheLoai',$idTheLoai)->get();

//        $loaitin = DB::table('loaitin')
//            ->where('idTheLoai',$idTheLoai)
//            ->get();

        if ( isset($loaitin)){
            foreach ($loaitin as $lt)
            {
                echo '<option value="'. $lt->id .'"> '. $lt->Ten .'</option>';
            }
        }
        else{
            echo '<option value=""> Choose option </option>';
        }

    }


    //this is function test ajax
    public function test()
    {
        $loaitin = LoaiTin::all();
        //return '<p>Test</p>';
        return $loaitin;
    }

}
