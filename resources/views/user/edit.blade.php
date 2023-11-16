@extends('layouts.app')

@section('content')

            @if(Session::has('message'))
                <script>
                    alert('{{Session::forget('message')}}');
                </script>
            @endif
            <div class="col-md-2 container-fluid__body">
                <ul class="dash-broad">
                    <a href="{{route('home')}}"><li class="{{(route('home') == url()->full())? 'active' : ''}}"><i class="bi bi-house"></i> Home</li></a>
{{--                    <a href="{{route('home')}}"><li class=""><i class="bi bi-bell"></i>Notification</li></a>--}}
                    <a href="{{route('post_likes')}}"><li class="{{(route('post_likes') == url()->full())? 'active' : ''}}"><i class="bi bi-heart"></i>Likes</li></a>
{{--                    <a href="{{route('home')}}"><li class=""><i class="bi bi-chat-dots"></i>Messages</li></a>--}}
                    <a href="{{route('user.show', ['user'=>auth()->id()])}}"><li class="{{(route('user.show', ['user'=>auth()->id()]) == url()->full())? 'active' : ''}}"><i class="bi bi-person"></i>Profile</li></a>
                    <a href="{{route('user.index')}}"><li class="{{(route('user.index')== url()->full())? 'active' : ''}}"><i class="bi bi-gear"></i>Setting</li></a>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
                       document.getElementById('logout-form').submit();">
                        <li><i class="bi bi-box-arrow-right"></i>Logout</li>
                    </a>
                </ul>
            </div>
            <div class="col-md-10 container-fluid__body container-edit-profile">
                <form action="{{route('user.edit', ['user'=>auth()->id()])}}" method="post" enctype="multipart/form-data">
                <div class="background-avatar">
                    <div class="image-background">
{{--                        @dd($detail->background)--}}
                        <img id="cover-preview" src="{{ $detail? Storage::url($detail->background) : asset('build/assets/videos/hinh-nen-facebook.jpg')}}" alt="img-background">
                        <div class="image-cover title-image">
                            <i class="bi bi-pencil"><label>Edit photo</label></i>
                            <input id="file-cover" type="file" name="file_cover"  data-max_length="20" class="@error('file_cover') is-invalid @enderror" onchange="loadFile(event)" value="" accept="image/*" multiple="multiple">
                            @error('file_cover')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{$errors->first('file_cover') }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="image-avatar">
                            <img id="avatar-preview" src="{{$detail? Storage::url($detail->avatar) : asset('build/assets/videos/macdinh_2.jpg')}}" alt="img-avatar">
                            <div class="input-image-avatar title-image">
                                <i class="bi bi-pencil"></i>
                                <input id="file-avatar" type="file" name="file_avatar"  data-max_length="20" class="@error('file_avatar') is-invalid @enderror" onchange="loadFile(event)" value="" accept="image/*" multiple="multiple">
                                @error('file_avatar')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('file_avatar') }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="account">
                                <h3>{{auth()->user()->username}}</h3>
                                <p>{{auth()->user()->email}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container row__content edit-profile">
                    <div class="row">
                        <div class="upload-post">
                            <section class="form-publish-post form-edit-profile" style="all: inherit">
                                <div class="container">
                                    <div class="form-popup">
                                            @csrf
                                            <div class="row publish-post form-popup__edit-profile">
                                                <div class="row gutters">
                                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                                        <div class="form-group">
                                                            <label for="nickname">Nick Name</label>
                                                            <input type="text" class="form-control nickname @error('nickname') is-invalid @enderror" name="nickname" value="{{$detail? $detail->nick_name : ''}}" id="nickname" placeholder="Enter nick name">
                                                            @error('nickname')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $errors->first('nickname') }}</strong>
                                                            </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                                        <div class="form-group">
                                                            <label for="birthday">Birthday</label>
                                                            <input type="date" class="form-control birthday @error('birthday') is-invalid @enderror" name="birthday" value="{{$detail? $detail->birthday : ''}}" id="birthday" placeholder="dd/mm/yyyy">
                                                            @error('birthday')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $errors->first('birthday') }}</strong>
                                                            </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                                        <div class="form-group">
                                                            <label for="career">Job</label>
                                                            <input type="text" class="form-control career @error('career') is-invalid @enderror" name="career" value="{{$detail? $detail->career : ''}}" id="career" placeholder="Enter career">
                                                            @error('career')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $errors->first('career') }}</strong>
                                                            </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                                        <div class="form-group">
                                                            <label for="gender">Gender</label>
                                                            <input type="text" class="form-control gender @error('gender') is-invalid @enderror" name="gender" value="{{$detail? $detail->gender : ''}}" id="career" placeholder="Enter career">
                                                            @error('gender')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $errors->first('gender') }}</strong>
                                                            </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="content-post publish-cancel save-changes">
                                                    <button class="pub-post" type="submit">Save changes</button>
                                                    <button class="cancel-post" type="button">Cancel</button>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
                </form>
            </div>

@endsection
<script>
    // JS
    function loadFile(event) {
        let id = event.target.id;
        // console.log(id);
        let theReader = new FileReader();
        theReader.onload = function() {
            if(id=='file-avatar'){
                var output = document.getElementById("avatar-preview");
            }
            else {
                var output = document.getElementById("cover-preview");
            }
            output.src = theReader.result;
        };
        theReader.readAsDataURL(event.target.files[0]);
    }
</script>
