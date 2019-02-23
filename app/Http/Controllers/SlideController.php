<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slide;

class SlideController extends Controller
{
    //
    public function getDanhSach()
    {
        $slide = Slide::all();
        //$tintuc = TinTuc::orderBy('id','DESC')::paginate(10);
        //$tintuc = $tintuc::paginate(10);

        return view('admin.slide.danhsach',['slide' => $slide]);
    }

    public function getThem()
    {
        return view('admin.slide.them');
    }
    public function postThem(Request $request)
    {
        // Validate
        $this->validate($request,
            [
                'txtName' => 'required|min:3|unique:slide,Ten|max:250',
                'txtFile' => 'required',
                'txtContent' => 'required',
                'txtLink'  => 'required'
            ],
            [
                'txtFile.required'         => 'Bạn chưa chọn Hình',

                'txtName.required' => 'Bạn chưa nhập tên tiêu đề thể loại',
                'txtName.min'      => 'Tên tên tiêu đề phải lớn hơn 3 kí tự',
                'txtName.unique'   => 'Tên tiêu đề đã tồn tại',
                'txtName.max'      => 'Tên thể loại phải nhỏ hơn 250 kí tự',

                'txtContent.required'     => 'Nội dung là bắt buộc',
                'txtLink.required'     => 'Tóm tắt là bắt buộc',
            ]);


        // Insert for database
        $slide = new Slide;

        $slide->Ten            = $request->txtName;
        //$slide->Hinh           = $request->txtFile;
        $slide->link           = $request->txtLink;
        $slide->NoiDung        = $request->txtContent;

        if ($request->hasFile('txtFile')){
            $file = $request->file('txtFile');

            $fileExtend = $file->getClientOriginalExtension(); // lay duoi file
            $name = $file->getClientOriginalName(); // lay ten file

            // check file extendtion
            if ($fileExtend != 'jpg' && $fileExtend != 'png' && $fileExtend != 'jpeg' && $fileExtend != 'jpe' && $fileExtend != 'gif' && $fileExtend != 'bmp' && $fileExtend != 'jfif'){
                return redirect('admin/slide/them')->with('err','Thêm không thành công, đuôi file không đúng.');
            }
            $Hinh = str_random(4). "_" . $name;
            while(file_exists('upload/slide/' . $Hinh)){
                $Hinh = str_random(4). "_" . $name;
            }
            // luu hinh
            $file->move('upload/slide/', $Hinh);

            // luu ten database
            $slide->Hinh = $Hinh;
        }else{
            $slide->Hinh = '';
        }

        $slide->save();
        return redirect('admin/slide/them')->with('thongbao','Thêm thành công');
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
        $slide = Slide::find($id);
        $slide->delete();

        return redirect('admin/slide/danhsach')->with('thongbao','Bạn đã xóa thành công');
    }
}
