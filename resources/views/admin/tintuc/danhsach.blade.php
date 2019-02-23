@extends('admin.layout.index')

@section('content')
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Tin tức
                        <small>Danh sách</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                @if(session('thongbao'))
                    <div class="col-lg-12 alert alert-success alertBox">
                        {{ session('thongbao') }}
                    </div>
                @endif
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                    <tr align="center">
                        <th>ID</th>
                        <th>Tiêu đề</th>
                        <th>Mô tả</th>
                        <th>Nội dung</th>
                        <th>Loại Tin</th>
                        <th>Thể loại</th>
                        <th>Delete</th>
                        <th>Edit</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($tintuc as $tt)
                        <tr class="odd gradeX" align="center">
                            <td>{{ $tt->id }}</td>
                            <td>
                                <p>{{ $tt->TieuDe }}</p>
                                <img src="upload/tintuc/{{ $tt->Hinh }}" alt="" style="width: 100px;height: 100px; object-fit: cover">
                            </td>
                            <td>{{ $tt->TomTat }}</td>
                            <td>{{ $tt->NoiDung }}</td>
                            <td>{{ $tt->loaitin->Ten }}</td>
                            <td>{{ $tt->loaitin->TheLoai->Ten }}</td>
                            <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/tintuc/xoa/{{ $tt->id }}"> Delete</a></td>
                            <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/tintuc/sua/{{ $tt->id }}">Edit</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
@endsection
