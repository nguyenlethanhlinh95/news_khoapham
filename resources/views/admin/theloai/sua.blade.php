@extends('admin.layout.index')

@section('content')
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Thể Loại
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
                        {{ alert('suc',session('thongbao')) }}
                    @endif

                    <form action="admin/theloai/sua/{{ $theloai->id }}" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label>Tên thể loại</label>
                            <input class="form-control" name="txtName" placeholder="Please Enter Username" value="{{ $theloai->Ten }}" />
                        </div>

                        <button type="submit" class="btn btn-default">Product Edit</button>
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
