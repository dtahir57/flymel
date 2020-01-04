@extends('layouts.admin')
@section('title','Edit User')
@section('style')
@endsection
@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Edit User</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{route('user.index')}}">Users</a></li>
              <li class="breadcrumb-item active">Edit User</li>
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
            <a href="{{route('user.index')}}" role="button" class="btn btn-primary float-right">Show All</a>
            <form action="{{route('user.update',$user->id)}}" method="POST">
            @csrf
            @method('PATCH')
                <div class="card-body">
                  <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control"  name="name" id="name"  required value="{{$user->name}}">
                    @error('name')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control"  name="email" id="email" required value="{{$user->email}}">
                    @error('email')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                  </div>
                </div>
                <h4>Assign Role</h4>
                <hr>
                <div class="card-block">
                    <div class="input-group skin skin-square">
                        @foreach($roles as $role)
                        <div class="col-lg-3 col-md-4 col-sm-6">
                          <fieldset>
                          <input  type="checkbox" name="roles[]" value="{{$role->name}}"
                          @if($user->hasRole($role)) checked @endif>
                          <label for="role">{{$role->name}}</label>
                          </fieldset>
                        </div>
                        @endforeach
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Create</button>
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