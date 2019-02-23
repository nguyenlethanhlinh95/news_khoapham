<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\TheLoai;

class TheLoaiController extends Controller
{
    // This is class for TheLoaiController
    public function getDanhSach()
    {
        $theloai = TheLoai::all();
        return view('admin.theloai.danhsach',['theloai' => $theloai]);
    }

    public function getThem()
    {
        return view('admin.theloai.them');
    }
    public function postThem(Request $request)
    {
        // Validate
        $this->validate($request,
            [
                'txtName' => 'required|min:3|max:100'
            ],
            [
                'txtName.required' => 'Bạn chưa nhập tên thể loại',
                'txtName.min'      => 'Tên thể loại phải lớn hơn 3 kí tự',
                'txtName.max'      => 'Tên thể loại phải nhỏ hơn 100 kí tự'
            ]);


        // Insert for database
        $theloai = new TheLoai;
        $theloai->Ten = $request->txtName;
        $theloai->TenKhongDau = changeTitle($request->txtName);

        $theloai->save();
        return redirect('admin/theloai/them')->with('thongbao','Thêm thành công');
    }

    //edit
    public function getSua($id)
    {
        $theloai = TheLoai::find($id);

        return view('admin.theloai.sua', ['theloai' => $theloai]);

    }
    public function postSua(Request $request ,$id)
    {
        // Validate
        $this->validate($request,
            [
                'txtTheLoai' => 'required|unique:TheLoai,Ten|min:3|max:100'
            ],
            [
                'txtName.required' => 'Bạn chưa nhập tên thể loại',
                'txtName.unique'   => 'Tên thể loại đã tồn tại',
                'txtName.min'      => 'Tên thể loại phải lớn hơn 3 kí tự',
                'txtName.max'      => 'Tên thể loại phải nhỏ hơn 100 kí tự'
            ]);
        $theloai = TheLoai::find($id);
        $theloai->Ten = $request->txtName;
        $theloai->TenKhongDau = changeTitle($request->txtName);

        $theloai->save();

        return redirect('admin/theloai/sua/'. $id)->with('thongbao', 'Sửa thành công');
    }

    public function getXoa($id)
    {
        $theloai = TheLoai::find($id);
        $theloai->delete();

        return redirect('admin/theloai/danhsach')->with('thongbao','Bạn đã xóa thành công');
    }
}
