@extends('layouts.admin')
@section('title','News')
@section('style')
<!-- DataTables -->
<link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.css">
@endsection
@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">News</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
              <li class="breadcrumb-item active">News</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
    <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">News List</h3>
              <a href="{{route('news.create')}}" role="button" class="btn btn-primary float-right"><i class="fa fa-plus"></i> Create New</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example2" class="table table-bordered table-hover">
              @if(session('created'))
                    <li class="alert alert-success">{{ session('created') }}</li>
              @endif
              @if(session('updated'))
                    <li class="alert alert-success">{{ session('updated') }}</li>
              @endif
              @if(session('deleted'))
                    <li class="alert alert-danger">{{ session('deleted') }}</li>
              @endif
                <thead>
                <tr>
                  <th>Id</th>
                  <th>Title</th>
                  <th>Status</th>
                  <th>Created_At</th>
                  <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($news as $new)
                <tr>
                  <td>{{$loop->iteration}}</td>
                  <td>{{$new->title}}</td>
                  <td>@if($new->is_active == 1)Active @else Not Active @endif</td>
                  <td>{{$new->created_at}}</td>
                  <td>
                  <a href="{{route('news.edit',$new->id)}}" role="button" class="btn"><i class="fa fa-edit text-primary"></i></a>
                  /
                  <a href="" role="button" class="btn remove" data-toggle="modal" data-target="#modal-danger" data-id="{{$new->id}}" data-url="{{route('news.destroy',$new->id)}}"><i class="fa fa-trash text-danger"></i></a>
                  </td>
                </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                  <th>Id</th>
                  <th>Title</th>
                  <th>Status</th>
                  <th>Created_At</th>
                  <th>Actions</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
<form class="form" method="POST"> 
    @csrf
    @method('DELETE')
    <div class="modal fade" id="modal-danger">
        <div class="modal-dialog">
          <div class="modal-content bg-danger">
            <div class="modal-header">
              <h4 class="modal-title">Delete News</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>Are you sure,you want to delete this news?</p>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-outline-light form-data" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-outline-light">Delete</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
</form>
@endsection
@section('script')
<!-- DataTables -->
<script src="../../plugins/datatables/jquery.dataTables.js"></script>
<script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<script src="{{asset('js/custom.js')}}"></script>
<script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
    });
  });
</script>
@endsection