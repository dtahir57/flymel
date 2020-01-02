@extends('layouts.admin')
@section('title','Edit Blog')
@section('style')
@endsection
@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Edit Blog</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.home')}}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{route('blog.index')}}">Blogs</a></li>
              <li class="breadcrumb-item active">Edit Blog</li>
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
            <a href="{{route('blog.index')}}" role="button" class="btn btn-primary float-right">Show All</a>
            <form action="{{route('blog.update',$blog->id)}}" method="POST">
            @csrf
            @method('PATCH')
                <div class="card-body">
                  <div class="form-group">
                    <label>Title</label>
                    <input type="text" class="form-control"  name="title" id="title"  value="{{$blog->title}}">
                    @error('title')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label>Content</label>
                    <textarea class="description" name="content" style="width:110%">{!! $blog->content !!}</textarea>
                    @error('content')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
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
<script src="{{ asset('node_modules/tinymce/tinymce.js') }}"></script>
<script>
  var editor_config = {
      path_absolute : "{{ URL::to('/') }}/",
      selector: "textarea.description",
      menubar: false,
      width: '100%',
      height: 500,
      branding: false,
      plugins: [
        "advlist autolink lists link image charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars code fullscreen",
        "insertdatetime media nonbreaking save table contextmenu directionality",
        "emoticons template paste textcolor colorpicker textpattern"
      ],
      toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
      relative_urls: false,
      file_picker_callback: function (callback, value, meta) {
              let x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
              let y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

              let type = 'image' === meta.filetype ? 'Images' : 'Files',
                  url  = editor_config.path_absolute + 'laravel-filemanager?editor=tinymce5&type=' + type;

              tinymce.activeEditor.windowManager.openUrl({
                  url : url,
                  title : 'Filemanager',
                  width : x * 0.8,
                  height : y * 0.8,
                  onMessage: (api, message) => {
                      callback(message.content);
                  }
              });
          }
    };

    tinymce.init(editor_config);
</script>
@endsection