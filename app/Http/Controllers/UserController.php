<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // This is class for TheLoaiController
    public function getDanhSach()
    {
        $users = User::all();
        return view('admin.user.danhsach',['users' => $users]);
    }

    public function getThem()
    {
        // get all TheLoai
        return view('admin.user.them');
    }
    public function postThem(Request $request)
    {
        // ValidatetxtTenLoaiTin
        $this->validate($request,
            [
                'txtTheLoai' => 'required',
                'txtTenLoaiTin' => 'required|unique:LoaiTin,Ten|min:3|max:100'
            ],
            [
                'txtTheLoai.required' => 'Vui lòng chọn Thể loại!',

                'txtTenLoaiTin.required' => 'Bạn chưa nhập tên Loại Tin',
                'txtTenLoaiTin.unique' => 'Tên Loại Tin đã tồn tại, vui lòng nhập tên khác!',
                'txtTenLoaiTin.min'      => 'Tên Loại Tin phải lớn hơn 3 kí tự',
                'txtTenLoaiTin.max'      => 'Tên Loại Tin phải nhỏ hơn 100 kí tự'
            ]);


        // Insert for database
        $loaitin = new LoaiTin;
        $loaitin->idTheLoai = $request->txtTheLoai;
        $loaitin->Ten = $request->txtTenLoaiTin;
        $loaitin->TenKhongDau = changeTitle($request->txtTenLoaiTin);

        $loaitin->save();
        return redirect('admin/loaitin/them')->with('thongbao','Thêm thành công');
    }

    //edit
    public function getSua($id)
    {
        $theloai = TheLoai::all();
        $loaitin = LoaiTin::find($id);

        return view('admin.loaitin.sua', ['loaitin' => $loaitin, 'theloai'=> $theloai]);

    }
    public function postSua(Request $request ,$id)
    {
        // Validate
        $this->validate($request,
            [
                'txtTheLoai'    => 'required',
                'txtTenLoaiTin' => 'required|unique:TheLoai,Ten|min:3|max:100'
            ],
            [
                'txtTheLoai'             => 'Bạn chưa chọn Thể loại',

                'txtTenLoaiTin.required' => 'Bạn chưa nhập tên thể loại',
                'txtTenLoaiTin.unique'   => 'Tên Loại tin đã tồn tại',
                'txtTenLoaiTin.min'      => 'Tên Loại tin phải lớn hơn 3 kí tự',
                'txtTenLoaiTin.max'      => 'Tên Loại tin phải nhỏ hơn 100 kí tự'
            ]);
        $loaitin = LoaiTin::find($id);

        $loaitin->idTheLoai = $request->txtTheLoai;
        $loaitin->Ten = $request->txtTenLoaiTin;
        $loaitin->TenKhongDau = changeTitle($request->txtTenLoaiTin);

        $loaitin->save();

        return redirect('admin/loaitin/danhsach')->with('thongbao', 'Sửa thành công');
    }

    public function getXoa($id)
    {
        $loaitin = LoaiTin::find($id);
        $loaitin->delete();

        return redirect('admin/loaitin/danhsach')->with('thongbao','Bạn đã xóa thành công');
    }


    // login admin
    public function loginAdmin()
    {
        return view('admin.login');
    }

    public function checkLoginAdmin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required|min:3|max:32'
        ], [
            'email.required'    => 'Bạn chưa nhập email',
            'password.requỉed'  => 'Bạn chưa nhập mật khẩu',
            'password.min'      => 'Mật khẩu phải lớn hơn 3 ký tự',
            'password.max'      => 'Mật khẩu phải nhỏ hơn 32 ký tự'
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password ]))
        {
            return redirect('admin/theloai/danhsach');
        }
        else{
            return redirect('admin/login')->with('err', 'Đăng nhập  thất bại.');
        }
    }

    // logout admin
    function logoutAdmin()
    {
        Auth::logout();
        return redirect('admin/login');
    }

}
