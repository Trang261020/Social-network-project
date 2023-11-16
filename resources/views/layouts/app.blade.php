<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    {{ini_set('MAX_EXECUTION_TIME', 3600)}}
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>T8 Social Media</title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('build/assets/app-add.css') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
{{--{{ $noimage = asset('build/assets/images/Hinh-nen-cute-338x600.jpg')}}--}}
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">T8 Social Media</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->username }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="body__content">
            <div class="container-fluid">
                <div class="row">
                        @yield('content')
                </div>
            </div>
        </main>
        <section class="form-publish-post" style="display: none">
            <div class="container">
                <div class="form-popup">
                    <form action="{{route('home')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row publish-post">
                            <div class="content-post title">
                                <h3>Add Post</h3>
                            </div>
                            <div class="content-post title-inputtext title-caption">
                                <label>Post Caption</label>
                                <input type="text" class="@error('caption') is-invalid @enderror" name="caption" value="{{old('caption')}}" placeholder="How do you feel ?">
                                @error('caption')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('caption') }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="content-post title-inputtext title-description">
                                <label>Post Description</label>
                                <textarea type="textarea" class="@error('description') is-invalid @enderror" name="description" value="{{old('description')}}" placeholder="How do you feel ?"></textarea>
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
                                    <img id="img-preview" src="{{asset('build/assets/images/image-gallery.png')}}" alt="image-post">
                                </div>
                                @error('image_video')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('image_video') }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="content-post publish-cancel">
                                <button class="pub-post" type="submit">Publish Post</button>
                                <button class="cancel-post" type="button">Cancel</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
        <footer class="footer">

        </footer>
    </div>
</body>
</html>
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
    jQuery(document).ready(function($){

        $('.add-post').on('click', function(){
            $('.form-publish-post').css("display", "block");
        });
        $('.cancel-post').on('click', function(){
            $('.form-publish-post').css("display", "none");
        });
        $('.eye-slash').on('click', function(){
            var id = $(this).data('id');
            console.log(id);
            $('#add-upload-' + id).css("display", "none");
        });
        $('.bi-bi-heart').on('click', function(){
            var id_post = $(this).data('id');
            var link = '{{route('like')}}';
            $.ajax({
                type: 'POST',
                url: link,
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": id_post,
                },
                dataType: 'json',
                success: function (data) {
                    // console.log(data);
                    if(data.data == 1){
                        $('#bi-heart-' + id_post).addClass('active');
                        $('.count-likes').text(data.number + ' Like' );
                        alert('You need to like the post.');
                    }
                    if(data.data == 0){
                        $('#bi-heart-' + id_post).removeClass('active');
                        $('.count-likes').text(data.number + ' Like' );
                        alert('You need to unlike the post.');
                    }
                    if(data.data != 0 && data.data !=1){
                        alert('You like the post fail.');
                    }
                },
                error: function (data) {
                    console.log(data);
                }
            });
        });
    });
</script>
<script>
    jQuery(document).ready(function($){
        // $('.reply_action').on('click', function (){
        //     var a_id = $(this).parent().get(0).className;
        //     var b_id = $('.'+ a_id).parent().get(0).className;
        //     var c_id = $('.'+ b_id).parent().get(0).className;
        // });
        $('.button_add_friend').on('click', function (){
            var id_post = $(this).data('id');
            var link = '{{route('friend.add')}}';
            $.ajax({
                type: 'POST',
                url: link,
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": id_post,
                },
                dataType: 'json',
                success: function (data) {
                    alert(data.message);
                    if(data.key == 0){
                        $('#add-friend-' + id_post).text('Add friend');
                    }
                    if(data.key == 1){
                        $('#add-friend-' + id_post).text('Cancel request');
                    }
                },
                error: function (data) {
                    console.log(data);
                }
            });
        });
        $('.friend_accept').on('click', function (){
            var id = $(this).data('id');
            var action = 2;
            actionFriend(id, action);
        });
        $('.friend_cancel').on('click', function (){
            var id = $(this).data('id');
            var action = 0;
            actionFriend(id, action);
        });
        function actionFriend (id, action){
            var link = '{{route('friend.accept')}}';
            $.ajax({
                type: 'POST',
                url: link,
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": id,
                    "action": action,
                },
                dataType: 'json',
                success: function (data) {
                    alert(data.message);
                    if(data.key == 0){
                        $('#friend_request_' + id).remove();
                        $('#notice_friends_' + id).removeClass('notice_friends');
                        $('#notice_friends_' + id).append('<button class="add-friend button_add_friend" id="add-friend-'+ id +'" data-id="'+ id +'" type="button">Add friend</button>');
                    }
                    if(data.key == 2){
                        $('#friend_request_' + id).remove();
                        $('#notice_friends_' + id).removeClass('notice_friends');
                        $('#notice_friends_' + id).append('<button class="add-friend button_add_friend" id="add-friend-'+ id +'" data-id="'+ id +'" type="button">Friend</button>');
                    }
                },
                error: function (data) {
                    console.log(data);
                }
            });
        }


    });
</script>
<script>
    jQuery(document).ready(function($){
        $('.like_action').on('click', function (){
            var id_comment = $(this).data('id');
            var id_post = $('.id_post_comment').val();
            console.log(id_comment);
            var link = '{{route('like_comment')}}';
            $.ajax({
                type: 'POST',
                url: link,
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": id_comment,
                    "id_post": id_post,
                },
                dataType: 'json',
                success: function (data) {
                    if(data.data == 1){
                        $('#like-action-' + id_comment).addClass('active');
                    }
                    if(data.data == 0){
                        $('#like-action-' + id_comment).removeClass('active');
                        alert('You need to unlike the comment.');
                    }
                    if(data.data != 0 && data.data !=1){
                        alert('You like the comment fail.');
                    }
                },
                error: function (data) {
                    console.log(data);
                }
            });
        });
    });
</script>
