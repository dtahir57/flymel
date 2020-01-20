@extends('layouts.user')
@section('title','Contact Support')
@section('style')
@endsection
@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Contact Support</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('user.home')}}">Home</a></li>
              <li class="breadcrumb-item active">Contact Support</li>
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
            @if(session('sent'))
                    <li class="alert alert-success">{{ session('sent') }}</li>
              @endif
            <form action="{{route('user.message')}}" method="POST">
            @csrf
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Name</label>
                            <input type="text" name="name" required class="form-control">
                            <span style="color:red">
                            @error('name')
                            <strong>{{$message}}</strong>
                            @enderror
                            </span>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Email</label>
                            <input type="email" name="email" required class="form-control">
                            <span style="color:red">
                            @error('email')
                            <strong>{{$message}}</strong>
                            @enderror
                            </span>
                        </div>
                        
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Subject</label>
                            <input type="text" name="subject" required class="form-control">
                            <span style="color:red">
                            @error('subject')
                            <strong>{{$message}}</strong>
                            @enderror
                            </span>
                        </div>
                        <div class="form-group col-md-6" style="margin-top:-168px">
                            <label>Message</label>
                            <textarea name="message" id="message" required class="form-control" rows="8"></textarea>
                            <span style="color:red">
                            @error('message')
                            <strong>{{$message}}</strong>
                            @enderror
                            </span>
                        </div>
                    </div>

                    <div class="form-group">
                          <button type="submit" name="submit" class="btn btn-primary">Submit Message <i class="fa fa-caret-right"></i></button>
                        </div>
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