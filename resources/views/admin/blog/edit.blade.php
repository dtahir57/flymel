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
                    <input type="text" class="form-control" required name="title" id="title"  value="{{$blog->title}}">
                    @error('title')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label>Content</label>
                    <textarea class="description" name="content">{!! $blog->content !!}</textarea>
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
  tinymce.init({
  selector: 'textarea.description',
  branding: false,
  plugins: [
        "advlist autolink lists link image charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars code fullscreen",
        "insertdatetime media nonbreaking save table contextmenu directionality",
        "emoticons template paste textcolor colorpicker textpattern"
      ],
  toolbar:"insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
  // enable title field in the Image dialog
  image_title: true, 
  // enable automatic uploads of images represented by blob or data URIs
  automatic_uploads: true,
  // add custom filepicker only to Image dialog
  file_picker_types: 'image',
  file_picker_callback: function(cb, value, meta) {
    var input = document.createElement('input');
    input.setAttribute('type', 'file');
    input.setAttribute('accept', 'image/*');

    input.onchange = function() {
      var file = this.files[0];
      var reader = new FileReader();
      
      reader.onload = function () {
        var id = 'blobid' + (new Date()).getTime();
        var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
        var base64 = reader.result.split(',')[1];
        var blobInfo = blobCache.create(id, file, base64);
        blobCache.add(blobInfo);

        // call the callback and populate the Title field with the file name
        cb(blobInfo.blobUri(), { title: file.name });
      };
      reader.readAsDataURL(file);
    };
    
    input.click();
  }
  });
</script>
@endsection