@extends('admin.layout.index')

@section('content')
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Slide
                        <small>Danh sach</small>
                    </h1>
                </div>

                @if(count($errors) > 0)
                    <div class="alert alert-danger alertBox">
                        @foreach($errors->all() as $err)
                            <strong>{{$err}}</strong><br/>
                        @endforeach
                    </div>
                @endif

                @if(session('thongbao'))
                    <div class="alert alert-success alertBox">
                        {{ session('thongbao') }}
                    </div>
                @endif

                @if(session('err'))
                    <div class="alert alert-danger alertBox">
                        {{ session('err') }}
                    </div>
            @endif
                <!-- /.col-lg-12 -->
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                    <tr align="center">
                        <th>ID</th>
                        <th>Tên</th>
                        <th>Nội dung</th>
                        <th>Hình</th>
                        <th>Link</th>
                        <th>Delete</th>
                        <th>Edit</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($slide as $sl)
                        <tr class="odd gradeX" align="center">
                            <td>{{ $sl->id }}</td>
                            <td>{{ $sl->Ten }}</td>
                            <td>{{ $sl->NoiDung }}</td>
                            <td>
                                <img style="width: 400px; height: 200px; object-fit: cover" src="upload/slide/{{ $sl->Hinh }}" alt="">
                            </td>
                            <td>{{ $sl->Link }}</td>
                            <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/slide/xoa/{{ $sl->id }}"> Delete</a></td>
                            <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/slide/sua/{{ $sl->id }}">Edit</a></td>
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
