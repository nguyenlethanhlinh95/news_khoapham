<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\TheLoai;
use App\LoaiTin;

class LoaiTinController extends Controller
{
    // This is class for TheLoaiController
    public function getDanhSach()
    {
        $loaitin = LoaiTin::all();
        return view('admin.loaitin.danhsach',['loaitin' => $loaitin]);
    }

    public function getThem()
    {
        // get all TheLoai
        $theloai = TheLoai::all();
        return view('admin.loaitin.them',['theloai'=>$theloai]);
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
}
