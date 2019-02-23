@extends('admin.layout.index')

@section('content')
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Thêm mới user
                        <small>Them</small>
                    </h1>
                </div>
                <!-- /.col-lg-12 -->
                <div class="col-lg-7" style="padding-bottom:120px">
                    <form action="" method="POST">
                        <div class="form-group">
                            <label>Tên user </label>
                            <input class="form-control" name="txtName" placeholder="Please Enter Name" />

                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email" placeholder="Please Enter Email" />
                        </div>
                        <div class="form-group">
                            <label>Quyền</label>
                            <input class="form-control" name="txtOrder" placeholder="Please Enter Category Order" />
                        </div>

                        <button type="submit" class="btn btn-default">Thêm user</button>
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
