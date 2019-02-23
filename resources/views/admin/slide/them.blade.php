@extends('admin.layout.index')

@section('content')
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
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
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Category
                        <small>Add</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                <div class="col-lg-7" style="padding-bottom:120px">
                    <form action="admin/slide/them" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label>Tên slide</label>
                            <input class="form-control" name="txtName" placeholder="Nhập tên slide" />
                        </div>
                        <div class="form-group">
                            <label>Hình</label>
                            <input type="file" class="form-control" name="txtFile" id="txtFile"/>
                        </div>
                        <div class="form-group">
                            <label>Nội dung</label>
                            <input class="form-control" name="txtContent" placeholder="Nhập nội dung" />
                        </div>
                        <div class="form-group">
                            <label>Link</label>
                            <input class="form-control" name="txtLink" placeholder="Nhập Link" />
                        </div>

                        <button type="submit" class="btn btn-default">Thêm slide</button>
                        <button type="reset" class="btn btn-default">Reset</button>
                        <form>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
@endsection
