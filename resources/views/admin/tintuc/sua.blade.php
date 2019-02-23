@extends('admin.layout.index')

@section('content')
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            {{--Edit News--}}
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Tin tức
                        <small>{{ $tintuc->TieuDe }}</small>

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

                    @if(session('err'))
                        <div class="alert alert-danger alertBox">
                            {{ session('err') }}
                        </div>
                    @endif

                    <form action="admin/tintuc/sua/{{ $tintuc->id }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label>Thể loại</label>
                            <select class="form-control" name="selTheLoai" id="txtTheLoai">
                                <option value="">Chọn thể loại</option>
                                @foreach($theloai as $tl)
                                    <option value="{{ $tl->id }}">
                                        {{ $tl->Ten }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Loại tin</label>
                            <select class="form-control" name="selLoaiTin" id="txtLoaiTin">
                                <option value="">Chọn Loại tin</option>
                                @foreach($loaitin as $lt)
                                    <option value="{{ $lt->id }}"
                                        @if($lt->id == $tintuc->idLoaiTin)
                                            {{ "selected" }}
                                        @endif
                                            >
                                        {{ $lt->Ten }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Tiêu đề</label>
                            <input value="{{ $tintuc->TieuDe }}" class="form-control" name="txtTieuDe" placeholder="Nhập tiêu đề" " />
                        </div>

                        <div class="form-group">
                            <label>Tóm tắt</label>
                            <textarea class="form-control ckeditor" name="txtAreaTomTat" id="txtTomTat" cols="30" rows="4">{!! $tintuc->TomTat !!}" </textarea>
                        </div>

                        <div class="form-group">
                            <label>Nội dung</label>
                            <textarea class="form-control ckeditor" name="txtAreaNoiDung" id="txtAreaNoiDung" cols="30" rows="4" placeholder="Nhập nội dung">{{ $tintuc->NoiDung }}</textarea>
                        </div>

                        <div class="form-group">
                            <p>
                                <img src="upload/tintuc/{{ $tintuc->Hinh }}" width="300px" height="300px" style="object-fit: cover" alt="">
                            </p>
                            <label>Hình ảnh</label>

                            <input value="{{ $tintuc->Hinh }}" type="file" name="hinhanh" id="hinhanh" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Bài viết nổi bật</label><br>
                            <input type="radio" name="rdoNoiBat" value="1" @if($tintuc->NoiBat == 0) {{ "checked" }} @endif> Có
                            <input type="radio" name="rdoNoiBat" value="0" @if($tintuc->NoiBat == 1) {{ "checked" }} @endif> Không
                        </div>

                        {{--<div class="form-group">--}}
                        {{--<label>Price</label>--}}
                        {{--<input class="form-control" name="txtPrice" placeholder="Please Enter Password" />--}}
                        {{--</div>--}}

                        <button type="submit" class="btn btn-default">Cập nhật</button>
                        <button type="reset" class="btn btn-default">Reset</button>

                    </form>
                </div>
            </div>

            {{--Edit comment--}}
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Comment
                        <small>Danh sách</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                    <tr align="center">
                        <th>ID</th>
                        <th>Người dùng</th>
                        <th>Nội dung</th>
                        <th>Ngày đăng</th>
                        <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($tintuc->comment as $cm)
                        <tr class="odd gradeX" align="center">
                            <td>{{ $cm->id }}</td>
                            <td>{{ $cm->user->name }}</td>
                            <td>{{ $cm->NoiDung }}</td>
                            <td>{{ $cm->created_at }}</td>
                            <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/comment/xoa/{{ $cm->id }}/{{ $tintuc->id }}"> Delete</a></td>
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


@section('script')
    <script type="text/javascript" language="javascript" src="assets/admin/ckeditor/ckeditor.js" ></script>
    <script>
        $(document).ready(function () {
            var myController = {
                init: function () {
                    myController.eventHanler();
                },
                eventHanler: function () {
                    $('#txtTheLoai').change(function () {
                        var idTheLoai = $(this).val();

                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                            }
                        });
                        $.ajax({
                            type: "GET",
                            url: '{{ url('admin/ajax/loaitin') }}',
                            data: {
                                idTheLoai: idTheLoai
                            },
                            success: function (data) {
                                $('#txtLoaiTin').html(data);
                                // console.log(data);
                            }
                        });


                    });

                    $('#btn_test').click(function () {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                            }
                        });

                        {{--$url = 'admin/ajax/loaitin' + idTheLoai;--}}
                        {{--$.ajax({--}}
                        {{--type: "GET",--}}
                        {{--url: '{{ url('admin/ajax/loaitin') }}',--}}
                        {{--success: function (data) {--}}
                        {{--$('#test').html(data);--}}
                        {{--}--}}
                        {{--});--}}


                        {{--$.get("{{ URL::to('admin/ajax/test') }}", function (data) {--}}
                        {{--$('#txtLoaiTin').html(data);--}}
                        {{--});--}}


                    });

                }
            }

            myController.init();
        });
    </script>

@endsection
