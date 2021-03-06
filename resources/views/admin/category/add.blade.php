@extends('layouts.admin')
<!-- //khi hoi tới sẽ load toàn bộ file layout.admin -->

@section('title')
    <title>Trang Chủ</title>
@endsection
<!-- @section('sidebar')
    @parent

        <p>This is appended to the master sidebar.</p>
@endsection -->

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @include('partial.content-header',['name'=>'category', 'key'=>'Add'])
    <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <!-- form  -->
                        <form action="{{route('categories.store')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label>Tên Danh Mục</label>
                                <input type="text" class="form-control" name="name" placeholder="Nhập tên Danh Mục">
                            </div>
                            <!-- //danh mục cha  -->
                            <div class="form-group">
                                <label>Chọn Danh Mục Cha</label>
                                <select class="form-control" name="parent_id">
                                    <option name="parent_id" value="0">Chọn danh mục cha</option>
                                    <!-- do kieu string nen dùng {4xChấm than}-->
                                    {!! $htmlOption !!}
                                </select>
                            </div>
                            <!-- end danh mục cha -->
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                        <!-- end form  -->
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection


