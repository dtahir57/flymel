@extends('layouts.admin')
@section('title','Edit News')
@section('style')
@endsection
@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Edit News</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{route('news.index')}}">News</a></li>
              <li class="breadcrumb-item active">Edit News</li>
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
            <div class="card-body">
            <a href="{{route('news.index')}}" role="button" class="btn btn-primary float-right">Show All</a>
            <form action="{{route('news.update',$news->id)}}" method="POST">
            @csrf
            @method('PATCH')
                <div class="card-body">
                  <div class="form-group">
                    <label>Title</label>
                    <input type="text" class="form-control" required name="title" id="title"  value="{{$news->title}}">
                    @error('title')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                  </div>
                </div>
                <h4>Status</h4>
                <hr>
                <div class="card-block">
                    <div class="input-group skin skin-square">
                        <div class="col-lg-3 col-md-4 col-sm-6">
                          <fieldset>
                          <input  type="checkbox" name="is_active" value="1" @if($news->is_active == 1) checked @endif>
                          <label for="permission">Is_Active</label>
                          </fieldset>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Edit</button>
                </div>
              </form>
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
@endsection
@section('script')
@endsection