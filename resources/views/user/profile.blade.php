@extends('layouts.user')
@section('title',"User Profile | $user->name")
@section('style')
@endsection
@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Profile</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('user.home')}}">Home</a></li>
              <li class="breadcrumb-item active">Profile</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
     <!-- Main content -->
     <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">
            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                    <img src="{{asset('profile/'.$profile->profile_pic)}}" height="150px" width="150px" style="border-radius: 50%;"/>
                </div>
                <h3 class="profile-username text-center">{{ucfirst($user->name)}}</h3>
                
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- About Me Box -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">About Me</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <strong><i class="fas fa-pencil-alt mr-1"></i>Name</strong>
                <p class="text-muted float-right" >
					        {{ucfirst($user->name)}}
                </p>

                <hr>
                <strong><i class="fas fa-pencil-alt mr-1"></i>Phone</strong>
                <p class="text-muted float-right">
					        {{$profile->phone}}
                </p>

                <hr>

                <strong><i class="fas fa-pencil-alt mr-1"></i>Country</strong>

                <p class="text-muted float-right">
			          	{{$profile->country}}
                </p>

                <hr>

                <strong><i class="fas fa-pencil-alt mr-1"></i>Zip Code</strong>

                <p class="text-muted float-right">
			          	{{$profile->zip_code}}
                </p>

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab">Edit</a></li>
                </ul>
                @if(session('updated'))
               		<li class="alert alert-success">{{ session('updated') }}</li>
            	  @endif
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="tab-pane  active" id="settings">
                    <form action="{{route('user.updateprofile')}}" class="form-horizontal" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control"  name="name" value="{{Auth::user()->name}}">
                          <span style="color:red">
                          @error('name')
                          <strong>{{$message}}</strong>
                          @enderror
                      	</span>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label">Phone</label>
                        <div class="col-sm-10">
                          <input type="number" class="form-control"  name="phone"value="{{$profile->phone}}">
                          <span style="color:red">
                          @error('phone')
                          <strong>{{$message}}</strong>
                          @enderror
                      	</span>
                        </div>
                      </div>
                      <div class="form-group row">
                         <label for="inputEmail" class="col-sm-2 col-form-label">Country</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control"  name="country" value="{{$profile->country}}">
                              <span style="color:red">
                              @error('country')
                              <strong>{{$message}}</strong>
                              @enderror
                              </span>
                            </div>
                      </div>
                      <div class="form-group row">
                         <label for="inputEmail" class="col-sm-2 col-form-label">Zip Code</label>
                            <div class="col-sm-10">
                              <input type="number" class="form-control"  name="zip_code" value="{{$profile->zip_code}}">
                              <span style="color:red">
                              @error('zip_code')
                              <strong>{{$message}}</strong>
                              @enderror
                              </span>
                            </div>
                      </div>
                      <div class="form-group row">
                        <label for="password" class="col-sm-2 col-form-label">Change Password</label>
                            <div class="col-md-10">
                                <input id="password" type="password" class="form-control" name="password"  placeholder="Enter New Password">
                                @error('password')
                                    <span style="color:red">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-sm-2 col-form-label">Confirm Password</label>
                            <div class="col-md-10">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                            </div>
                        </div>
                      <div>
                      <label>Select Image</label>
                      <input id="files" name="image"  type="file">
                      @error('image')
                      <span style="color:red">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                      </div>
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.nav-tabs-custom -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
@section('script')
@endsection