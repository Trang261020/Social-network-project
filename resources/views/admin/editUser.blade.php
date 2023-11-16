@extends('layouts.admin')

@section('content')
{{--        @dd($detail)--}}
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 container-fluid__body">
                <ul class="dash-broad">
                    <a href="{{route('dashboard.user')}}"><li class="active"><i class="bi bi-people"></i>User</li></a>
                    <a href="{{route('dashboard.post')}}"><li class=""><i class="bi bi-file-earmark-post"></i>Post</li></a>
{{--                    <a href="{{route('user.index')}}"><li class="{{(route('user.index')== url()->full())? 'active' : ''}}"><i class="bi bi-gear"></i>Setting</li></a>--}}
                </ul>
            </div>
            <div class="col-md-10 container-fluid__body container-edit-profile">
                <form action="{{route('edit.user', ['id'=>$id])}}" method="post" enctype="multipart/form-data">
                    <div class="background-avatar">
                        <div class="image-background">
                            <img id="cover-preview" src="{{ !empty($detail->userDetail->background) ? Storage::url($detail->userDetail->background) : ''}}" alt="img-background">
                            <div class="image-cover title-image">
                                <i class="bi bi-pencil"><label>Edit photo</label></i>
                                <input id="file-cover" type="file" name="file_cover"  data-max_length="20" class="@error('file_cover') is-invalid @enderror" onchange="loadFile(event)" value="" accept="image/*" multiple="multiple">
                                @error('career')
                                <span class="invalid-feedback" role="alert">
                                <strong>{{$errors->first('file_cover') }}</strong>
                            </span>
                                @enderror
                            </div>
                            <div class="image-avatar">
                                <img id="avatar-preview" src="{{!empty($detail->userDetail->avatar) ? Storage::url($detail->userDetail->avatar) : ''}}" alt="img-avatar">
                                <div class="input-image-avatar title-image">
                                    <i class="bi bi-pencil"></i>
                                    <input id="file-avatar" type="file" name="file_avatar"  data-max_length="20" class="@error('file_avatar') is-invalid @enderror" onchange="loadFile(event)" value="" accept="image/*" multiple="multiple">
                                    @error('career')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('file_avatar') }}</strong>
                                </span>
                                    @enderror
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
                                                            <label for="usenrame">Username</label>
                                                            <input type="text" class="form-control userame @error('username') is-invalid @enderror" name="username" value="{{$detail? $detail->username : ''}}" id="username" placeholder="Enter username">
                                                            @error('username')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $errors->first('username') }}</strong>
                                                            </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                                        <div class="form-group">
                                                            <label for="email">Email</label>
                                                            <input type="email" class="form-control email @error('email') is-invalid @enderror" name="email" value="{{$detail? $detail->email : ''}}" id="email" placeholder="Enter email">
                                                            @error('email')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $errors->first('email') }}</strong>
                                                            </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                                        <div class="form-group">
                                                            <label for="nickname">Nick Name</label>
                                                            <input type="text" class="form-control nickname @error('nickname') is-invalid @enderror" name="nickname" value="{{ !empty($detail->userDetail->nick_name)? $detail->userDetail->nick_name : ''}}" id="nickname" placeholder="Enter nick name">
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
                                                            <input type="date" class="form-control birthday @error('birthday') is-invalid @enderror" name="birthday" value="{{!empty($detail->userDetail->birthday)? $detail->userDetail->birthday : ''}}" id="birthday" placeholder="dd/mm/yyyy">
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
                                                            <input type="text" class="form-control career @error('career') is-invalid @enderror" name="career" value="{{!empty($detail->userDetail->career)? $detail->userDetail->career : ''}}" id="career" placeholder="Enter career">
                                                            @error('career')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $errors->first('career') }}</strong>
                                                            </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                                        <div class="form-group">
                                                            <label for="gender">Job</label>
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
                                                    <a href="{{route('delete.user', ['id'=>$id])}}"><button class="cancel-post" type="button">Delete</button></a>
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
        </div>
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
