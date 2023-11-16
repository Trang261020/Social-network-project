@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        @if(Session::has('error'))
            <div class="alert alert-success">
                {{ Session::get('error') }}
                @php
                    Session::forget('error');
                @endphp
            </div>
        @endif
            <div class="col-md-2 container-fluid__body">
                <ul class="dash-broad">
                    <a href="#"><li><i class="bi bi-house"></i> Feed</li></a>
                    <a href="#"><li><i class="bi bi-bell"></i>Notification</li></a>
                    <a href="#"><li><i class="bi bi-heart"></i>Likes</li></a>
                    <a href="#"><li><i class="bi bi-chat-dots"></i>Messages</li></a>
                    <a href="#"><li><i class="bi bi-person"></i>Profile</li></a>
                    <a href="#"><li><i class="bi bi-box-arrow-right"></i>Logout</li></a>
                </ul>
            </div>
            <div class="col-md-7 container-fluid__body">
                <div class="container row__content">
                    <div class="row">
                        <div class="upload-post">
                            <div class="add-upload">
                                <div class="add-status">
                                    <img src="{{asset('build/assets/images/hinh-anh-avatar-dep-cute-ngau-de-thuong.jpg')}}" alt="">
                                    <input type="text" name="status" value="" placeholder="What's happening ?">
                                </div>
                                <div class="add-post">
                                    <a href="#"><i class="bi bi-emoji-smile"></i>Feeling</a>
                                    <a href="#"><i class="bi bi-image"></i>Photo</a>
                                    <a href="#"><i class="bi bi-camera-video"></i>Video</a>
                                    <button>Post</button>
                                </div>
                            </div>
                            <div class="add-upload add-post-second">
                                <div class="item-post">
                                    <div class="info">
                                        <div class="info-name">
                                            <a class="info-name-title" href="#">
                                                <img src="{{asset('build/assets/images/Hinh-nen-cute-338x600.jpg')}}" alt="info">
                                                <h4>Chan Yeol</h4>
                                            </a>
                                            <p>15h publish</p>
                                        </div>
                                        <div class="icon">
                                            <i class="bi bi-three-dots"></i>
                                            <div class="item-choice">
                                                <ul>
                                                    <li><i class="bi bi-eye-slash"></i>Hide post</li>
                                                    <li><i class="bi bi-pencil-square"></i>Edit post</li>
                                                    <li><i class="bi bi-trash"></i>Delete post</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <figure>
                                        <img src="{{asset('build/assets/images/hinh-nen-hoa-1-1200x751.jpg')}}" alt="">
                                    </figure>
                                    <div class="count-like-comment-share">
                                        <div class="count-action">
                                            <p>1000 Like</p>
                                        </div>
                                        <div class="count-action">
                                            <p><span>20 Comment</span><span>18 Share</span></p>
                                        </div>
                                    </div>
                                    <div class="action-like_comment_share">
                                        <div class="action-friends">
                                            <i class="bi bi-heart"></i><span>Like</span>
                                        </div>
                                        <div class="action-friends">
                                            <i class="bi bi-chat-square"></i><span>Comment</span>
                                        </div>
                                        <div class="action-friends">
                                            <i class="bi bi-reply-all"></i><span>Share</span>
                                        </div>
                                    </div>
                                    <div class="action-comment">
                                        <a class="info-name-title" href="#">
                                            <img src="{{asset('build/assets/images/hinh-anh-avatar-dep-cute-ngau-de-thuong.jpg')}}" alt="info">
                                        </a>
                                        <div class="content-comment">
                                            <input type="text" name="status" value="" placeholder="Write a comment .....">
                                            <span><i class="bi bi-image"></i></span>
                                            <button type="button"><i class="bi bi-send"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="add-upload add-post-second">
                                <div class="item-post">
                                    <div class="info">
                                        <div class="info-name">
                                            <a class="info-name-title" href="#">
                                                <img src="{{asset('build/assets/images/hinh-anh-avatar-dep-cute-ngau-de-thuong.jpg')}}" alt="info">
                                                <h4>Chan Yeol</h4>
                                            </a>
                                            <p>15h publish</p>
                                        </div>
                                        <div class="icon">
                                            <i class="bi bi-three-dots"></i>
                                            <div class="item-choice">
                                                <ul>
                                                    <li><i class="bi bi-eye-slash"></i>Hide post</li>
                                                    <li><i class="bi bi-pencil-square"></i>Edit post</li>
                                                    <li><i class="bi bi-trash"></i>Delete post</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <figure>
                                        <img src="{{asset('build/assets/images/hinh-nen-hoa-bo-cong-anh_1.jpg')}}" alt="">
                                    </figure>
                                    <div class="count-like-comment-share">
                                        <div class="count-action">
                                            <p>1000 Like</p>
                                        </div>
                                        <div class="count-action">
                                            <p><span>20 Comment</span><span>18 Share</span></p>
                                        </div>
                                    </div>
                                    <div class="action-like_comment_share">
                                        <div class="action-friends">
                                            <i class="bi bi-heart"></i><span>Like</span>
                                        </div>
                                        <div class="action-friends">
                                            <i class="bi bi-chat-square"></i><span>Comment</span>
                                        </div>
                                        <div class="action-friends">
                                            <i class="bi bi-reply-all"></i><span>Share</span>
                                        </div>
                                    </div>
                                    <div class="action-comment">
                                        <a class="info-name-title" href="#">
                                            <img src="{{asset('build/assets/images/hinh-anh-avatar-dep-cute-ngau-de-thuong.jpg')}}" alt="info">
                                        </a>
                                        <div class="content-comment">
                                            <input type="text" name="status" value="" placeholder="Write a comment .....">
                                            <span><i class="bi bi-image"></i></span>
                                            <button type="button"><i class="bi bi-send"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="add-upload add-post-second">
                                <div class="item-post">
                                    <div class="info">
                                        <div class="info-name">
                                            <a class="info-name-title" href="#">
                                                <img src="{{asset('build/assets/images/hinh-anh-avatar-dep-cute-ngau-de-thuong.jpg')}}" alt="info">
                                                <h4>Chan Yeol</h4>
                                            </a>
                                            <p>15h publish</p>
                                        </div>
                                        <div class="icon">
                                            <i class="bi bi-three-dots"></i>
                                            <div class="item-choice">
                                                <ul>
                                                    <li><i class="bi bi-eye-slash"></i>Hide post</li>
                                                    <li><i class="bi bi-pencil-square"></i>Edit post</li>
                                                    <li><i class="bi bi-trash"></i>Delete post</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <figure>
                                        <img src="{{asset('build/assets/images/hinh-nen-hoa-bo-cong-anh-ve-3-11-15-38-51.jpg')}}" alt="">
                                    </figure>
                                    <div class="count-like-comment-share">
                                        <div class="count-action">
                                            <p>1000 Like</p>
                                        </div>
                                        <div class="count-action">
                                            <p><span>20 Comment</span><span>18 Share</span></p>
                                        </div>
                                    </div>
                                    <div class="action-like_comment_share">
                                        <div class="action-friends">
                                            <i class="bi bi-heart"></i><span>Like</span>
                                        </div>
                                        <div class="action-friends">
                                            <i class="bi bi-chat-square"></i><span>Comment</span>
                                        </div>
                                        <div class="action-friends">
                                            <i class="bi bi-reply-all"></i><span>Share</span>
                                        </div>
                                    </div>
                                    <div class="action-comment">
                                        <a class="info-name-title" href="#">
                                            <img src="{{asset('build/assets/images/hinh-anh-avatar-dep-cute-ngau-de-thuong.jpg')}}" alt="info">
                                        </a>
                                        <div class="content-comment">
                                            <input type="text" name="status" value="" placeholder="Write a comment .....">
                                            <span><i class="bi bi-image"></i></span>
                                            <button type="button"><i class="bi bi-send"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="add-upload add-post-second">
                                <div class="item-post">
                                    <div class="info">
                                        <div class="info-name">
                                            <a class="info-name-title" href="#">
                                                <img src="{{asset('build/assets/images/hinh-anh-avatar-dep-cute-ngau-de-thuong.jpg')}}" alt="info">
                                                <h4>Chan Yeol</h4>
                                            </a>
                                            <p>15h publish</p>
                                        </div>
                                        <div class="icon">
                                            <i class="bi bi-three-dots"></i>
                                            <div class="item-choice">
                                                <ul>
                                                    <li><i class="bi bi-eye-slash"></i>Hide post</li>
                                                    <li><i class="bi bi-pencil-square"></i>Edit post</li>
                                                    <li><i class="bi bi-trash"></i>Delete post</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <figure>
                                        <img src="{{asset('build/assets/images/hinh-nen-hoa-bo-cong-anh-ve-3-11-15-38-51.jpg')}}" alt="">
                                    </figure>
                                    <div class="count-like-comment-share">
                                        <div class="count-action">
                                            <p>1000 Like</p>
                                        </div>
                                        <div class="count-action">
                                            <p><span>20 Comment</span><span>18 Share</span></p>
                                        </div>
                                    </div>
                                    <div class="action-like_comment_share">
                                        <div class="action-friends">
                                            <i class="bi bi-heart"></i><span>Like</span>
                                        </div>
                                        <div class="action-friends">
                                            <i class="bi bi-chat-square"></i><span>Comment</span>
                                        </div>
                                        <div class="action-friends">
                                            <i class="bi bi-reply-all"></i><span>Share</span>
                                        </div>
                                    </div>
                                    <div class="action-comment">
                                        <a class="info-name-title" href="#">
                                            <img src="{{asset('build/assets/images/hinh-anh-avatar-dep-cute-ngau-de-thuong.jpg')}}" alt="info">
                                        </a>
                                        <div class="content-comment">
                                            <input type="text" name="status" value="" placeholder="Write a comment .....">
                                            <span><i class="bi bi-image"></i></span>
                                            <button type="button"><i class="bi bi-send"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="add-upload add-post-second">
                                <div class="item-post">
                                    <div class="info">
                                        <div class="info-name">
                                            <a class="info-name-title" href="#">
                                                <img src="{{asset('build/assets/images/hinh-anh-avatar-dep-cute-ngau-de-thuong.jpg')}}" alt="info">
                                                <h4>Chan Yeol</h4>
                                            </a>
                                            <p>15h publish</p>
                                        </div>
                                        <div class="icon">
                                            <i class="bi bi-three-dots"></i>
                                            <div class="item-choice">
                                                <ul>
                                                    <li><i class="bi bi-eye-slash"></i>Hide post</li>
                                                    <li><i class="bi bi-pencil-square"></i>Edit post</li>
                                                    <li><i class="bi bi-trash"></i>Delete post</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <figure>
                                        <img src="{{asset('build/assets/images/hinh-nen-hoa-bo-cong-anh-ve-3-11-15-38-51.jpg')}}" alt="">
                                    </figure>
                                    <div class="count-like-comment-share">
                                        <div class="count-action">
                                            <p>1000 Like</p>
                                        </div>
                                        <div class="count-action">
                                            <p><span>20 Comment</span><span>18 Share</span></p>
                                        </div>
                                    </div>
                                    <div class="action-like_comment_share">
                                        <div class="action-friends">
                                            <i class="bi bi-heart"></i><span>Like</span>
                                        </div>
                                        <div class="action-friends">
                                            <i class="bi bi-chat-square"></i><span>Comment</span>
                                        </div>
                                        <div class="action-friends">
                                            <i class="bi bi-reply-all"></i><span>Share</span>
                                        </div>
                                    </div>
                                    <div class="action-comment">
                                        <a class="info-name-title" href="#">
                                            <img src="{{asset('build/assets/images/hinh-anh-avatar-dep-cute-ngau-de-thuong.jpg')}}" alt="info">
                                        </a>
                                        <div class="content-comment">
                                            <input type="text" name="status" value="" placeholder="Write a comment .....">
                                            <span><i class="bi bi-image"></i></span>
                                            <button type="button"><i class="bi bi-send"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 container-fluid__body">
                <div class="lists-friend">
                    <div class="search-friend">
                        <form action="#">
                            <label class="input-search">
                                <i class="bi bi-search"></i>
                                <input type="text" name="search_friend" value="" placeholder="Search friends .....">
                            </label>
                        </form>
                    </div>
                    <div class="status-friend">
                        <div class="friend-title">
                            <h3>Friends</h3>
                            <i class="bi bi-three-dots"></i>
                        </div>
                        <div class="current-friend">
                            <div class="item-friend">
                                <a href="#">
                                    <img src="{{asset('build/assets/images/hinh-nen-hoa-dep-dong-tien-mau-hong-giua-bau-troi-xanh.jpg')}}" alt="" class="avatar">
                                    <h4>Nguyễn Ngọc Ánh</h4>
                                </a>

                            </div>
                            <div class="item-friend">
                                <a href="#">
                                    <img src="{{asset('build/assets/images/Hinh-nen-cute-338x600.jpg')}}" alt="" class="avatar">
                                    <h4>Nguyễn Ngọc Sang</h4>
                                </a>

                            </div>
                            <div class="item-friend">
                                <a href="#">
                                    <img src="{{asset('build/assets/images/hinh-nen-hoa-bo-cong-anh_1.jpg')}}" alt="" class="avatar">
                                    <h4>Nguyễn Ngọc Ngân</h4>
                                </a>
                            </div>
                            <div class="item-friend">
                                <a href="#">
                                    <img src="{{asset('build/assets/images/hinh-nen-hoa-bo-cong-anh-ve-3-11-15-38-51.jpg')}}" alt="" class="avatar">
                                    <h4>Nguyễn Ngọc Huyền</h4>
                                </a>

                            </div>
                            <div class="item-friend">
                                <a href="#">
                                    <img src="{{asset('build/assets/images/anh-nen-dep-hoa-002.jpg')}}" alt="" class="avatar">
                                    <h4>Nguyễn Ngọc Bội</h4>
                                </a>

                            </div>
                            <div class="item-friend">
                                <a href="#">
                                    <img src="{{asset('build/assets/images/2596782 (1).jpg')}}" alt="" class="avatar">
                                    <h4>Nguyễn Ngọc Hạnh</h4>
                                </a>

                            </div>
                            <div class="item-friend">
                                <a href="#">
                                    <img src="{{asset('build/assets/images/hinh-nen-hoa-1-1200x751.jpg')}}" alt="" class="avatar">
                                    <h4>Nguyễn Ngọc Anh</h4>
                                </a>

                            </div>
                        </div>
                        <div class="friend-title">
                            <h3>Recommend Friends</h3>
                            <i class="bi bi-three-dots"></i>
                        </div>
                        <div class="current-friend">
                            <div class="item-friend">
                                <a href="#">
                                    <img src="{{asset('build/assets/images/hinh-nen-hoa-dep-dong-tien-mau-hong-giua-bau-troi-xanh.jpg')}}" alt="" class="avatar">
                                    <h4>Nguyễn Ngọc Ánh</h4>
                                </a>

                            </div>
                            <div class="item-friend">
                                <a href="#">
                                    <img src="{{asset('build/assets/images/Hinh-nen-cute-338x600.jpg')}}" alt="" class="avatar">
                                    <h4>Nguyễn Ngọc Sang</h4>
                                </a>

                            </div>
                            <div class="item-friend">
                                <a href="#">
                                    <img src="{{asset('build/assets/images/hinh-nen-hoa-bo-cong-anh_1.jpg')}}" alt="" class="avatar">
                                    <h4>Nguyễn Ngọc Ngân</h4>
                                </a>
                            </div>
                            <div class="item-friend">
                                <a href="#">
                                    <img src="{{asset('build/assets/images/hinh-nen-hoa-bo-cong-anh-ve-3-11-15-38-51.jpg')}}" alt="" class="avatar">
                                    <h4>Nguyễn Ngọc Huyền</h4>
                                </a>

                            </div>
                            <div class="item-friend">
                                <a href="#">
                                    <img src="{{asset('build/assets/images/anh-nen-dep-hoa-002.jpg')}}" alt="" class="avatar">
                                    <h4>Nguyễn Ngọc Bội</h4>
                                </a>

                            </div>
                            <div class="item-friend">
                                <a href="#">
                                    <img src="{{asset('build/assets/images/2596782 (1).jpg')}}" alt="" class="avatar">
                                    <h4>Nguyễn Ngọc Hạnh</h4>
                                </a>

                            </div>
                            <div class="item-friend">
                                <a href="#">
                                    <img src="{{asset('build/assets/images/hinh-nen-hoa-1-1200x751.jpg')}}" alt="" class="avatar">
                                    <h4>Nguyễn Ngọc Anh</h4>
                                </a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</div>
@endsection
