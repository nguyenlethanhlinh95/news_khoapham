<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TheLoai;
use App\Slide;
use App\LoaiTin;
use App\TinTuc;
use DB;
use Illuminate\Support\Facades\Auth;

class pagesController extends Controller
{
    function __construct()
    {
        $theloai = TheLoai::all();
        view()->share('theloai', $theloai);

        // check user login display name
        if (Auth::check())
        {
            view()->share('nguoidung', Auth::user());
        }
    }

    // pages controller
    function homePage()
    {
        $slide = DB::table('slide')->get();
         return view('pages.home', ['slide'=>$slide]);
    }

    function contactPage()
    {
        return view('pages.contact');
    }

    function loaitin($id)
    {
        $loaitin = LoaiTin::find($id);
        $tintuc = TinTuc::where('idLoaiTin', $id)->paginate(5);
        return view('pages.loaitin', ['loaitin'=> $loaitin, 'tintuc'=> $tintuc]);
    }

    function chitiet($id)
    {
        $tintuc = TinTuc::find($id);
        $tinNoiBat = TinTuc::where('NoiBat', 1)->take(5)->get();
        $tinlienquan = TinTuc::where('idLoaiTin', $tintuc->idLoaiTin)->take(4)->get();

        return view('pages.chitiet', ['tintuc'=>$tintuc, 'tinnoibat'=> $tinNoiBat, 'tinlienquan'=> $tinlienquan]);
    }


    function getDangNhap()
    {
        return view('pages.dangnhap');
    }

    function postDangNhap(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required|min:6|max:32'
        ], [
           'mail.required' =>'Bạn chưa nhập email',
            'password.required' =>'Bạn chưa nhập email',
            'password.min' =>'Mật khẩu phải lớn hơn bằng 6 ký tự',
            'password.max' =>'Mật khẩu phải nhỏ hơn bằng 32 ký tự',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password ]))
        {
            return redirect('home');
        }
        else{
            return redirect('dangnhap')->with('err', 'Đăng nhập  thất bại.');
        }
    }
}
