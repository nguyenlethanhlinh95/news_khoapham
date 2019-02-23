<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\TinTuc;
use App\LoaiTin;
use App\TheLoai;
use App\Comment;


class TinTucController extends Controller
{
    // This is class for TheLoaiController
    public function getDanhSach()
    {
        $tintuc = TinTuc::orderBy('id','DESC')->get();
        //$tintuc = TinTuc::orderBy('id','DESC')::paginate(10);
        //$tintuc = $tintuc::paginate(10);

        return view('admin.tintuc.danhsach',['tintuc' => $tintuc]);
    }

    public function getThem()
    {
        $theloai = TheLoai::all();
        $loaitin = LoaiTin::all();
        return view('admin.tintuc.them',['theloai'=> $theloai, 'loaitin'=> $loaitin]);
    }
    public function postThem(Request $request)
    {
        // Validate
        $this->validate($request,
            [
                'selTheLoai' => 'required',
                'selLoaiTin' => 'required',
                'txtTieuDe' => 'required|min:3|unique:TinTuc,TieuDe|max:250',
                'txtAreaNoiDung' => 'required',
                'txtAreaTomTat'  => 'required'
            ],
            [
                'selTheLoai.required'         => 'Bạn chưa chọn thể loại',
                'selLoaiTin.required'         => 'Bạn chưa chọn loại tin',

                'txtTieuDe.required' => 'Bạn chưa nhập tên thể loại',
                'txtTieuDe.min'      => 'Tên thể loại phải lớn hơn 3 kí tự',
                'txtTieuDe.unique'   => 'Tên tiêu đề đã tồn tại',
                'txtTieuDe.max'      => 'Tên thể loại phải nhỏ hơn 250 kí tự',

                'txtAreaNoiDung.required'     => 'Nội dung là bắt buộc',
                'txtAreaTomTat.required'     => 'Tóm tắt là bắt buộc',
            ]);


        // Insert for database
        $tintuc = new TinTuc;

        $tintuc->TieuDe         = $request->txtTieuDe;
        $tintuc->TieuDeKhongDau = changeTitle($request->txtTieuDe);
        $tintuc->idLoaiTin      = $request->selLoaiTin;
        $tintuc->TomTat         = $request->txtAreaTomTat;
        $tintuc->NoiDung        = $request->txtAreaNoiDung;
        $tintuc->SoLuotXem        = 0;

        if ($request->hasFile('hinhanh')){
            $file = $request->file('hinhanh');

            $fileExtend = $file->getClientOriginalExtension(); // lay duoi file
            $name = $file->getClientOriginalName(); // lay ten file

            // check file extendtion
            if ($fileExtend != 'jpg' && $fileExtend != 'png' && $fileExtend != 'jpeg' && $fileExtend != 'jpe' && $fileExtend != 'gif' && $fileExtend != 'bmp' && $fileExtend != 'jfif'){
                return redirect('admin/tintuc/them')->with('err','Thêm không thành công, đuôi file không đúng.');
            }
            $Hinh = str_random(4). "_" . $name;
            while(file_exists('upload/tintuc' . $Hinh)){
                $Hinh = str_random(4). "_" . $name;
            }
            // luu hinh
            $file->move('upload/tintuc', $Hinh);

            // luu ten database
            $tintuc->Hinh = $Hinh;
        }
        else{
            $tintuc->Hinh = "";
        }

        $tintuc->save();
        return redirect('admin/tintuc/them')->with('thongbao','Thêm thành công');
    }

    //edit
    public function getSua($id)
    {
        $theloai = TheLoai::all();
        $loaitin = LoaiTin::all();

        $tintuc = TinTuc::find($id);
        return view('admin.tintuc.sua',['tintuc' => $tintuc, 'theloai' => $theloai , 'loaitin' => $loaitin]);

    }
    public function postSua(Request $request ,$id)
    {
        // Validate
        $this->validate($request,
            [
                'selTheLoai' => 'required',
                'selLoaiTin' => 'required',
                'txtTieuDe' => 'required|min:3|unique:TinTuc,TieuDe|max:250',
                'txtAreaNoiDung' => 'required',
                'txtAreaTomTat'  => 'required'
            ],
            [
                'selTheLoai.required'         => 'Bạn chưa chọn thể loại',
                'selLoaiTin.required'         => 'Bạn chưa chọn loại tin',

                'txtTieuDe.required' => 'Bạn chưa nhập tên thể loại',
                'txtTieuDe.min'      => 'Tên thể loại phải lớn hơn 3 kí tự',
                'txtTieuDe.unique'   => 'Tên tiêu đề đã tồn tại',
                'txtTieuDe.max'      => 'Tên thể loại phải nhỏ hơn 250 kí tự',

                'txtAreaNoiDung.required'     => 'Nội dung là bắt buộc',
                'txtAreaTomTat.required'     => 'Tóm tắt là bắt buộc',
            ]);


        //  databasInsert fore
        $tintuc = TinTuc::find($id);

        $tintuc->TieuDe         = $request->txtTieuDe;
        $tintuc->TieuDeKhongDau = changeTitle($request->txtTieuDe);
        $tintuc->idLoaiTin      = $request->selLoaiTin;
        $tintuc->TomTat         = $request->txtAreaTomTat;
        $tintuc->NoiDung        = $request->txtAreaNoiDung;
        $tintuc->SoLuotXem        = 0;

        if ($request->hasFile('hinhanh')){
            $file = $request->file('hinhanh');

            $fileExtend = $file->getClientOriginalExtension(); // lay duoi file
            $name = $file->getClientOriginalName(); // lay ten file

            // check file extendtion
            if ($fileExtend != 'jpg' && $fileExtend != 'png' && $fileExtend != 'jpeg' && $fileExtend != 'jpe' && $fileExtend != 'gif' && $fileExtend != 'bmp' && $fileExtend != 'jfif'){
                return redirect('admin/tintuc/them')->with('err','Thêm không thành công, đuôi file không đúng.');
            }
            $Hinh = str_random(4). "_" . $name;
            while(file_exists('upload/tintuc' . $Hinh)){
                $Hinh = str_random(4). "_" . $name;
            }
            // luu hinh moi
            $file->move('upload/tintuc', $Hinh);
            // xoa hinh cu
            unlink( 'upload/tintuc/' .$tintuc->Hinh);

            // luu ten database
            $tintuc->Hinh = $Hinh;
        }

        $tintuc->save();

        return redirect('admin/tintuc/sua/' .$id)->with('thongbao','Sửa thành công');
    }

    public function getXoa($id)
    {
        $tintuc = TinTuc::find($id);
        $tintuc->delete();

        return redirect('admin/tintuc/danhsach')->with('thongbao','Bạn đã xóa thành công');
    }
}
