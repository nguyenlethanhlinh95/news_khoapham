@extends('admin.layout.index')

@section('content')
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Thể Loại
                        <small>Thêm mới</small>

                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                <div class="col-lg-7" style="padding-bottom:120px">

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
                    <form action="admin/theloai/them" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label>Tên</label>
                            <input class="form-control" name="txtName" placeholder="Please Enter Name" />
                        </div>
                        {{--<div class="form-group">--}}
                            {{--<label>Price</label>--}}
                            {{--<input class="form-control" name="txtPrice" placeholder="Please Enter Password" />--}}
                        {{--</div>--}}

                        <button type="submit" class="btn btn-default">Product Add</button>
                        <button type="reset" class="btn btn-default">Reset</button>
                    </form>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
@endsection
