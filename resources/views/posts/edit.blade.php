@extends('layouts.app')

@section('content')
{{--    @dd($id)--}}
    <section class="form-publish-post form-edit-post">
        <div class="container">
            <div class="form-popup">
                <form action="{{route('edit',['id'=>$id])}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row publish-post">
                        <div class="content-post title">
                            <h3>Edit Post</h3>
                        </div>
                        <div class="content-post title-inputtext title-caption">
                            <label>Post Caption</label>
                            <input type="text" class="@error('caption') is-invalid @enderror" name="caption" value="{{$detail->title}}" placeholder="How do you feel ?">
                            @error('caption')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('caption') }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="content-post title-inputtext title-description">
                            <label>Post Description</label>
                            <textarea type="textarea" class="@error('description') is-invalid @enderror" name="description" value="{{$detail->content}}" placeholder="How do you feel ?">{{$detail->content}}</textarea>
                            @error('description')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="post-images">
                            <div class="content-post title-image">
                                <label>Post Image</label>
                                <input type="file" name="image_video"  data-max_length="20" class="@error('image_video') is-invalid @enderror" id="file-input" onchange="readURL(this);" value="{{old('image_video')}}" accept="audio/*,video/*,image/*" multiple="multiple">

                            </div>
                            <div class="show-image">
                                <img id="img-preview" src="{{Storage::url($detail->file)}}" alt="image-post">
                            </div>
                            @error('image_video')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('image_video') }}</strong>
                                </span>
                            @enderror
                        </div>
                        <input type="hidden" name="type_post" value="{{$detail->type_post}}">
                        <div class="content-post publish-cancel">
                            <button class="pub-post" type="submit">Publish Post</button>
                            <button class="cancel-post" type="button">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection


