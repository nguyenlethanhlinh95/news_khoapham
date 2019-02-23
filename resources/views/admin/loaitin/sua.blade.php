@extends('admin.layout.index')

@section('content')
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Loại Tin
                        <small>Edit</small>
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

                    <form action="admin/loaitin/sua/{{ $loaitin->id }}" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label>Thể loại</label>
                            <select class="form-control" name="txtTheLoai">
                                <option value="">Chọn thể loại</option>
                                @foreach( $theloai as $tl)
                                    <option
                                        @if( $tl->id == $loaitin->idTheLoai) {{ "selected" }}
                                        @endif
                                        value="{{ $tl->id }}"> {{ $tl->Ten }}</option>
                                @endforeach

                            </select>
                        </div>

                        <div class="form-group">
                            <label>Tên</label>
                            <input class="form-control" name="txtTenLoaiTin" placeholder="Nhập loại tin" value="{{ $loaitin->Ten  }}"/>
                        </div>

                        <button type="submit" class="btn btn-default">Cập nhật</button>
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
