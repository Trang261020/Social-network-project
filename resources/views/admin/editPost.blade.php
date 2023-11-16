@extends('layouts.admin')
@section('content')
    {{--    @dd($detail)--}}
    @if(Session::has('message'))
        <script>
            alert('{{ Session::get('message') }}');
        </script>
    @endif
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 container-fluid__body">
                <ul class="dash-broad">
                    <a href="{{route('dashboard.user')}}">
                        <li class=""><i class="bi bi-people"></i>User</li>
                    </a>
                    <a href="{{route('dashboard.post')}}">
                        <li class="active"><i class="bi bi-file-earmark-post"></i>Post</li>
                    </a>
{{--                    <a href="{{route('user.index')}}">--}}
{{--                        <li class="{{(route('user.index')== url()->full())? 'active' : ''}}"><i class="bi bi-gear"></i>Setting--}}
{{--                        </li>--}}
{{--                    </a>--}}
                </ul>
            </div>
            <div class="col-md-10 col-xl-10 col-lg-10 col-sm-10 col-12 container-fluid__body">
                <div class="container row__content">
                    <div class="row admin-edit-post">
                        <div class="upload-post admin-items">
                            <section class="form-publish-post">
                                <div class="container">
                                    <div class="form-popup">
                                        <form action="{{route('edit.post',['id'=>$id])}}" method="post"
                                              enctype="multipart/form-data">
                                            @csrf
                                            <div class="row publish-post">
                                                <div class="content-post title">
                                                    <h3>Edit Post</h3>
                                                </div>
                                                <div class="content-post title-inputtext title-caption">
                                                    <label>Post Caption</label>
                                                    <input type="text" class="@error('caption') is-invalid @enderror"
                                                           name="caption" value="{{$detail->title}}"
                                                           placeholder="How do you feel ?">
                                                    @error('caption')
                                                    <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('caption') }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="content-post title-inputtext title-description">
                                                    <label>Post Description</label>
                                                    <textarea type="textarea"
                                                              class="@error('description') is-invalid @enderror"
                                                              name="description" value="{{$detail->content}}"
                                                              placeholder="How do you feel ?">{{$detail->content}}</textarea>
                                                    @error('description')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('description') }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                                <div class="post-images">
                                                    <div class="content-post title-image">
                                                        <label>Post Image</label>
                                                        <input type="file" name="image_video" data-max_length="20"
                                                               class="@error('image_video') is-invalid @enderror"
                                                               id="file-input" onchange="readURL(this);"
                                                               value="{{old('image_video')}}"
                                                               accept="audio/*,video/*,image/*" multiple="multiple">
                                                    </div>
                                                    @if($detail->type_post == 1)
                                                        <div class="show-image">
                                                            <img id="img-preview" src="{{Storage::url($detail->file)}}"
                                                                 alt="image-post">
                                                        </div>
                                                    @elseif($detail->type_post == 2)
                                                        <video autoplay="autoplay" controls width="600" height="400">
                                                            <source src="{{Storage::url($detail->file)}}"
                                                                    type=video/mp4>
                                                        </video>
                                                    @else
                                                    @endif
                                                    @error('image_video')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('image_video') }}</strong>
                                                    </span>
                                                    @enderror
                                                </div>
                                                <input type="hidden" name="type_post" value="{{$detail->type_post}}">
                                                <div class="content-post publish-cancel">
                                                    <a href="{{route('edit.post', ['id'=>$id])}}">
                                                    <button class="pub-post" type="submit">Publish Post</button>
                                                    </a>
                                                    <a href="{{route('delete.post', ['id'=>$id])}}">
                                                        <button class="cancel-post" type="button">Delete</button>
                                                    </a>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#img-preview').attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
