@extends('layouts.app')

@section('content')
    @if(Session::has('message'))
        <script>
            alert('{{ Session::get('message') }}');
        </script>
    @endif
{{--    @dd(\App\Models\Post::find(39)->comments)--}}
{{--        @dd(auth()->user()->find(46)->userDetail)--}}
    <div class="col-md-2 col-xl-2 col-lg-2 col-sm-2 col-12 container-fluid__body">
        <ul class="dash-broad">
            <a href="{{route('home')}}">
                <li class="{{(route('home') == url()->full())? 'active' : ''}}"><i class="bi bi-house"></i> Home</li>
            </a>
{{--            <a href="{{route('home')}}">--}}
{{--                <li class=""><i class="bi bi-bell"></i>Notification</li>--}}
{{--            </a>--}}
            <a href="{{route('post_likes')}}">
                <li class="{{(route('post_likes') == url()->full())? 'active' : ''}}"><i class="bi bi-heart"></i>Likes
                </li>
            </a>
{{--            <a href="{{route('home')}}">--}}
{{--                <li class=""><i class="bi bi-chat-dots"></i>Messages</li>--}}
{{--            </a>--}}
            <a href="{{route('user.show', ['user'=>auth()->id()])}}">
                <li class="{{(route('user.show', ['user'=>auth()->id()]) == url()->full())? 'active' : ''}}"><i
                        class="bi bi-person"></i>Profile
                </li>
            </a>
            <a href="{{route('user.index')}}">
                <li class="{{(route('user.index')== url()->full())? 'active' : ''}}"><i class="bi bi-gear"></i>Setting
                </li>
            </a>
            <a href="{{ route('logout') }}" onclick="event.preventDefault();
                       document.getElementById('logout-form').submit();">
                <li><i class="bi bi-box-arrow-right"></i>Logout</li>
            </a>
        </ul>
    </div>
    <div class="col-md-7 col-xl-7 col-lg-7 col-sm-7 col-12 container-fluid__body">
        <div class="container row__content">
                <div class="row container__row">
                    <div class="upload-post">
                        <div class="add-upload">
                            <div class="add-status">
                                <img
                                    src="{{auth()->user()->userDetail ? Storage::url(auth()->user()->userDetail->avatar) : asset('build/assets/videos/macdinh_2.jpg')}}"
                                    alt="">
                                <input type="text" name="status" value="" v-model="status"
                                       placeholder="What's happening ?">
                            </div>
                            <div class="add-post">
                                <a href="#"><i class="bi bi-emoji-smile"></i>Feeling</a>
                                <a href="#"><i class="bi bi-image"></i>Photo</a>
                                <a href="#"><i class="bi bi-camera-video"></i>Video</a>
                                <button>Post</button>
                            </div>
                        </div>
                        @foreach($list_post as $value)
                            <div class="add-upload add-post-second" id="add-upload-{{$value->id}}">
                                <div class="item-post">
                                    <div class="info">
                                        <div class="info-name">
                                            <a class="info-name-title"
                                               href="{{route('user.show', ['user'=>$value->user_id])}}">
                                                <img
                                                    src="{{isset($value->user->userDetail)&& $value->user->userDetail->avatar ? Storage::url($value->user->userDetail->avatar) : asset('build/assets/videos/macdinh_2.jpg')}}"
                                                    alt="info">
                                                <h4>{{isset($value->user->userDetail) && $value->user->userDetail->nick_name ? $value->user->userDetail->nick_name : 'Nick name' }}</h4>
                                            </a>
                                            <p>
                                                Public {{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $value->created_at)->format('d F Y')}}</p>
                                        </div>
                                        <div class="icon">
                                            <i class="bi bi-three-dots"></i>
                                            <div class="item-choice">
                                                <ul>
                                                    <li class="eye-slash" data-id="{{$value->id}}"><i
                                                            class="bi bi-eye-slash"></i>Hide post
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="status-description">
                                        <h5 class="status">{{$value->title}}</h5>
                                        <p>{{$value->content}}</p>
                                    </div>
                                    @if($value->type_post == 1)
                                        <figure>
                                            <img src="{{Storage::url($value->file)}}" alt="">
                                        </figure>
                                    @elseif($value->type_post == 2)
                                        <video autoplay="autoplay" controls width="600" height="400">
                                            <source src="{{Storage::url($value->file)}}" type=video/mp4>
                                        </video>
                                    @else
                                    @endif
                                    <div class="count-like-comment-share">
                                        <div class="count-action">
                                            <p class="count-likes">{{\App\Models\Favouriste::where('post_id','=', $value->id)->count()}}
                                                Like</p>
                                        </div>
                                        <div class="count-action">
                                            <p><span class="count-comment">{{\App\Models\Post::find($value->id)->comments->count()}} Comment</span></p>
                                        </div>
                                    </div>
                                    <div class="action-like_comment_share">
                                        <div class="action-friends bi-bi-heart" id="bi-heart" data-id="{{$value->id}}">
                                            <i class="bi bi-heart {{!empty((\App\Models\Favouriste::where(['user_id'=>auth()->id(),'post_id'=>$value->id, 'likes'=>1])->get())[0]) ? 'active' : ''}}"
                                               id="bi-heart-{{$value->id}}"></i><span>Like</span>
                                        </div>
                                        <div class="action-friends" id="bi-chat-square" data-id="{{$value->id}}">
                                            <i class="bi bi-chat-square" id="chat-square-{{$value->id}}"></i><span>Comment</span>
                                        </div>
                                        <div class="action-friends" id="bi-reply-all" data-id="{{$value->id}}">
                                            <a href="https://www.facebook.com/sharer/sharer.php?u={{route('index', ['id', $value->id])}}"
                                               target="_blank"><i class="bi bi-reply-all" id="reply-all-{{$value->id}}"></i><span>Share</span></a>
                                        </div>
                                    </div>
                                    <input hidden class="id_post_comment" value="{{$value->id}}">
                                    @if((\App\Models\Post::find($value->id)->comments)->isNotEmpty())
                                    <a class="hidden-parent collapsed" href="#parent-comment-{{$value->id}}" aria-expanded="false" data-bs-toggle="collapse">See more comments</a>
                                    <div class="list-comment collapse" class="collapse" id="parent-comment-{{$value->id}}">
                                        @foreach(\App\Models\Post::find($value->id)->comments->where('parent_id', '=', 0) as $pa => $com)
{{--                                            @if($com->parent_id == 0)--}}
                                        <div class="action-comment">
                                            <a class="info-name-title" href="{{route('user.show', ['user'=>$com->user_id])}}">
                                                <img src="{{Storage::url(auth()->user()->find($com->user_id)->userDetail->avatar)}}" alt="info">
                                            </a>
                                            <div class="friend-comment">
                                                <h5>{{auth()->user()->find($com->user_id)->userDetail->nick_name}}</h5>
                                                <p>{{$com->description}}</p>
                                                <div class="like-comment">
                                                    <span class="like_action" data-id="{{$com->id}}" id="like-action-{{$com->id}}">Like</span>
                                                        <a class="hidden-parent collapsed" href="#reply-comment-{{$value->id.$com->id}}" aria-expanded="false" data-bs-toggle="collapse"><span class="reply_action">Reply</span></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="reply-comment reply-comment-input collapse" id="reply-comment-{{$value->id.$com->id}}">
                                            <a class="info-name-title" href="{{route('user.show', ['user'=>auth()->id()])}}">
                                                <img src="{{auth()->user()->userDetail ? Storage::url(auth()->user()->userDetail->avatar) : asset('build/assets/videos/macdinh_2.jpg')}}" alt="info">
                                            </a>
                                                <div class="content-comment">
                                                    <input class="content" id="content-{{$com->id}}" type="text" name="content" value="" placeholder="Write a comment .....">
                                                    <input class="parent_id" id="parent-id-{{$com->id}}" hidden name="parent_id" value="{{$com->id}}">
                                                    <button type="button" class="button-comment" data-name="child_comment" data-key="{{$com->id}}" data-id="{{$value->id}}"><i class="bi bi-send"></i></button>
                                                </div>
                                        </div>
                                            @if((\App\Models\Post::find($value->id)->comments->where('parent_id', '=', $com->id))->isNotEmpty())
                                                <a href="#box-comment-{{$value->id.$com->id}}" class="hidden-comment" aria-expanded="false" data-bs-toggle="collapse">See more</a>
                                                <div class="collapse" id="box-comment-{{$value->id.$com->id}}">
                                                    @foreach(\App\Models\Post::find($value->id)->comments->where('parent_id', '=', $com->id) as $sub => $subO)
                                                            <div class="child_comment">
                                                                <div class="reply-comment">
                                                                    <a class="info-name-title" href="{{route('user.show', ['user'=>$subO->user_id])}}">
                                                                        <img src="{{Storage::url(auth()->user()->find($subO->user_id)->userDetail->avatar)}}" alt="info">
                                                                    </a>
                                                                    <div class="friend-comment">
                                                                        <h5>{{auth()->user()->find($subO->user_id)->userDetail->nick_name}}</h5>
                                                                        <p>{{$subO->description}}</p>
                                                                        <div class="like-comment">
                                                                            <span class="like_action" data-id="{{$subO->id}}" id="like-action-{{$subO->id}}">Like</span>
                                                                            <a class="hidden-parent collapsed" href="#reply-comment-{{$value->id.$com->id.$subO->id}}" aria-expanded="false" data-bs-toggle="collapse"><span class="reply_action">Reply</span></a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="reply-comment reply-comment-input collapse" id="reply-comment-{{$value->id.$com->id.$subO->id}}">
                                                                    <a class="info-name-title" href="{{route('user.show', ['user'=>auth()->id()])}}">
                                                                        <img src="{{auth()->user()->userDetail ? Storage::url(auth()->user()->userDetail->avatar) : asset('build/assets/videos/macdinh_2.jpg')}}" alt="info">
                                                                    </a>
                                                                    <div class="content-comment">
                                                                        <input type="text" name="status" id="content-{{$subO->id}}" value="" placeholder="Write a comment .....">
                                                                        <input hidden name="parent_id" id="parent-id-{{$subO->id}}" value="{{$subO->id}}">
                                                                        <button type="button" class="button-comment" data-name="sub_comment_content" data-key="{{$subO->id}}" data-id="{{$value->id}}"><i class="bi bi-send"></i></button>
                                                                    </div>
                                                                </div>
                                                                @foreach(\App\Models\Post::find($value->id)->comments->where('parent_id', '=', $subO->id) as $suT => $subT)
                                                                        <a href="#sub_comment_parent-{{$value->id.$subO->id}}" class="hidden-comment" aria-expanded="false" data-bs-toggle="collapse">See more</a>
                                                                        <div class="sub_comment_parent collapse" id="sub_comment_parent-{{$value->id.$subO->id}}">
                                                                            <div class="sub_comment_content">
                                                                                <div class="reply-comment">
                                                                                    <a class="info-name-title" href="{{route('user.show', ['user'=>$subT->user_id])}}">
                                                                                        <img src="{{Storage::url(auth()->user()->find($subT->user_id)->userDetail->avatar)}}" alt="info">
                                                                                    </a>
                                                                                    <div class="friend-comment">
                                                                                        <h5>{{auth()->user()->find($subT->user_id)->userDetail->nick_name}}</h5>
                                                                                        <p>{{$subT->description}}</p>
                                                                                        <div class="like-comment">
                                                                                            <span class="like_action" data-id="{{$subT->id}}" id="like-action-{{$subT->id}}">Like</span>
                                                                                            <a class="hidden-parent collapsed" href="#reply-comment-{{$value->id.$com->id.$subO->id.$subT->id}}" aria-expanded="false" data-bs-toggle="collapse"><span class="reply_action">Reply</span></a>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="reply-comment reply-comment-input collapse" id="reply-comment-{{$value->id.$com->id.$subO->id.$subT->id}}">
                                                                                    <a class="info-name-title" href="{{route('user.show', ['user'=>auth()->id()])}}">
                                                                                        <img src="{{auth()->user()->userDetail ? Storage::url(auth()->user()->userDetail->avatar) : asset('build/assets/images/Hinh-nen-cute-338x600.jpg')}}" alt="info">
                                                                                    </a>
                                                                                    <div class="content-comment">
                                                                                        <input type="text" id="content-{{$subT->id}}" name="status" value="" placeholder="Write a comment .....">
                                                                                        <input hidden name="parent_id" id="parent-id-{{$subT->id}}" value="{{$subT->id}}">
                                                                                        <button type="button" class="button-comment" data-name="sub_comment_child" data-key="{{$subT->id}}" data-id="{{$value->id}}"><i class="bi bi-send"></i></button>
                                                                                    </div>
                                                                                </div>
                                                                                @foreach(\App\Models\Post::find($value->id)->comments->where('parent_id', '=', $subT->id) as $suTh => $subTh)
                                                                                        <a href="#sub_comment_child-{{$value->id.$subTh->id}}" class="hidden-comment" aria-expanded="false" data-bs-toggle="collapse">See more</a>
                                                                                        <div class="sub_comment_child collapse" id="sub_comment_child-{{$value->id.$subTh->id}}">
                                                                                            <div class="sub_child_comment_content">
                                                                                                <div class="reply-comment">
                                                                                                    <a class="info-name-title" href="{{route('user.show', ['user'=>$subTh->user_id])}}">
                                                                                                        <img src="{{Storage::url(auth()->user()->find($subTh->user_id)->userDetail->avatar)}}" alt="info">
                                                                                                    </a>
                                                                                                    <div class="friend-comment">
                                                                                                        <h5>{{auth()->user()->find($subTh->user_id)->userDetail->nick_name}}</h5>
                                                                                                        <p>{{$subTh->description}}</p>
                                                                                                        <div class="like-comment">
                                                                                                            <span class="like_action" data-id="{{$subTh->id}}" id="like-action-{{$subTh->id}}">Like</span>
                                                                                                            <a class="hidden-parent collapsed" href="#reply-comment-{{$value->id.$com->id.$subO->id.$subT->id.$subTh->id}}" aria-expanded="false" data-bs-toggle="collapse"><span class="reply_action">Reply</span></a>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="reply-comment reply-comment-input collapse" id="reply-comment-{{$value->id.$com->id.$subO->id.$subT->id.$subTh->id}}">
                                                                                                    <a class="info-name-title" href="{{route('user.show', ['user'=>auth()->id()])}}">
                                                                                                        <img src="{{auth()->user()->userDetail ? Storage::url(auth()->user()->userDetail->avatar) : asset('build/assets/videos/macdinh_2.jpg')}}" alt="info">
                                                                                                    </a>
                                                                                                    <div class="content-comment">
                                                                                                        <input type="text" id="content-{{$subTh->id}}" name="status" value="" placeholder="Write a comment .....">
                                                                                                        <input hidden id="parent-id-{{$subTh->id}}" name="parent_id" value="{{$subTh->id}}">
                                                                                                        <button type="button" class="button-comment" data-name="sub_end_comment_content" data-key="{{$subTh->id}}" data-id="{{$value->id}}"><i class="bi bi-send"></i></button>
                                                                                                    </div>
                                                                                                </div>
                                                                                                @foreach(\App\Models\Post::find($value->id)->comments->where('parent_id', '=', $subTh->id) as $suf => $subF)
                                                                                                        <a href="#sub_comment_end-{{$value->id.$subF->id}}" class="hidden-comment" aria-expanded="false" data-bs-toggle="collapse">See more</a>
                                                                                                        <div class="sub_comment_end collapse" id="sub_comment_end-{{$value->id.$subF->id}}">
                                                                                                            <div class="sub_end_comment_content">
                                                                                                                <div class="reply-comment">
                                                                                                                    <a class="info-name-title" href="{{route('user.show', ['user'=>$subF->user_id])}}">
                                                                                                                        <img src="{{Storage::url(auth()->user()->find($subF->user_id)->userDetail->avatar)}}" alt="info">
                                                                                                                    </a>
                                                                                                                    <div class="friend-comment">
                                                                                                                        <h5>{{auth()->user()->find($subF->user_id)->userDetail->nick_name}}</h5>
                                                                                                                        <p>{{$subF->description}}</p>
                                                                                                                        <div class="like-comment">
                                                                                                                            <span class="like_action" data-id="{{$subF->id}}" id="like-action-{{$subF->id}}">Like</span>
                                                                                                                        <a class="collapsed hidden-parent" href="#button-comment-{{$value->id.$com->id.$subO->id.$subT->id.$subTh->id.$subF->id}}" aria-expanded="false" data-bs-toggle="collapse"><span class="reply_action">Reply</span></a>                                                                                </div>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                                <div class="collapsed reply-comment reply-comment-input" id="button-comment-{{$value->id.$com->id.$subO->id.$subT->id.$subTh->id.$subF->id}}">
                                                                                                                    <a class="info-name-title" href="{{route('user.show', ['user'=>auth()->id()])}}">
                                                                                                                        <img src="{{auth()->user()->userDetail ? Storage::url(auth()->user()->userDetail->avatar) : asset('build/assets/videos/macdinh_2.jpg')}}" alt="info">
                                                                                                                    </a>
                                                                                                                    <div class="content-comment">
                                                                                                                        <input type="text" id="content-{{$subF->id}}" name="status" value="" placeholder="Write a comment .....">
                                                                                                                        <input hidden id="parent-id-{{$subF->id}}" name="parent_id" value="{{$subF->id}}">
                                                                                                                        <button type="button" class="button-comment" data-name="sub_end_comment_content" data-key="{{$subF->id}}" data-id="{{$value->id}}"><i class="bi bi-send"></i></button>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                            @foreach(\App\Models\Post::find($value->id)->comments->where('parent_id', '=', $subF->id) as $sus => $subS)
                                                                                                                    <div class="sub_comment_end">
                                                                                                                        <div class="sub_end_comment_content">
                                                                                                                            <div class="reply-comment">
                                                                                                                                <a class="info-name-title" href="{{route('user.show', ['user'=>$subS->user_id])}}">
                                                                                                                                    <img src="{{Storage::url(auth()->user()->find($subS->user_id)->userDetail->avatar)}}" alt="info">
                                                                                                                                </a>
                                                                                                                                <div class="friend-comment">
                                                                                                                                    <h5>{{auth()->user()->find($subS->user_id)->userDetail->nick_name}}</h5>
                                                                                                                                    <p>{{$subS->description}}</p>
                                                                                                                                    <div class="like-comment">
                                                                                                                                        <span class="like_action" data-id="{{$subS->id}}"  id="like-action-{{$subS->id}}">Like</span>
                                                                                                                                        <a class="hidden-parent collapsed" href="#button-comment-{{$value->id.$com->id.$subO->id.$subT->id.$subTh->id.$subS->id}}" aria-expanded="false" data-bs-toggle="collapse"><span class="reply_action">Reply</span></a>                                                                                </div>
                                                                                                                                </div>
                                                                                                                            </div>
                                                                                                                            <div class="reply-comment reply-comment-input collapsed" id="button-comment-{{$value->id.$com->id.$subO->id.$subT->id.$subTh->id.$subS->id}}">
                                                                                                                                <a class="info-name-title" href="{{route('user.show', ['user'=>auth()->id()])}}">
                                                                                                                                    <img src="{{auth()->user()->userDetail ? Storage::url(auth()->user()->userDetail->avatar) : asset('build/assets/videos/macdinh_2.jpg')}}" alt="info">
                                                                                                                                </a>
                                                                                                                                <div class="content-comment">
                                                                                                                                    <input type="text" id="content-{{$subS->id}}" name="status" value="" placeholder="Write a comment .....">
                                                                                                                                    <input hidden id="parent-id-{{$subS->id}}" name="parent_id" value="{{$subS->id}}">
                                                                                                                                    <button type="button" class="button-comment" data-name="sub_end_comment_content" data-key="{{$subS->id}}" data-id="{{$value->id}}"><i class="bi bi-send"></i></button>
                                                                                                                                </div>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                            @endforeach
                                                                                                        </div>
                                                                                                @endforeach
                                                                                            </div>
                                                                                        </div>
                                                                                @endforeach
                                                                            </div>
                                                                        </div>
                                                                @endforeach
                                                            </div>
                                                    @endforeach
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                    @endif
                                    <div class="action-comment">
                                        <a class="info-name-title" href="{{route('user.show', ['user'=>auth()->id()])}}">
                                            <img src="{{auth()->user()->userDetail ? Storage::url(auth()->user()->userDetail->avatar) : asset('build/assets/videos/macdinh_2.jpg') }}" alt="info">
                                        </a>
                                            <div class="content-comment">
                                                <input class="content" id="content-{{$value->id}}" type="text" name="content" value="" placeholder="Write a comment .....">
                                                <input class="parent_id" id="parent-id-{{$value->id}}" hidden name="parent_id" value="0">
                                                <button type="button" class="button-comment" data-name="list-comment" data-key="{{$value->id}}" data-id="{{$value->id}}"><i class="bi bi-send"></i></button>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
        </div>
    </div>
    <div class="col-md-3 col-xl-3 col-lg-3 col-sm-3 col-12 container-fluid__body">
        <div class="scroll-y-auto">
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
                        <h3>Friends request</h3>
                        <i class="bi bi-three-dots"></i>
                    </div>
                    <div class="current-friend">
                        @foreach($friend_waiting as $value)
                            <div class="item-friend notice_friends" id="notice_friends_{{$value->user_id}}">
                                <a href="{{route('user.show', ['user'=>$value->user_id])}}">
                                    <img
                                        src="{{ $value->avatar ? Storage::url($value->avatar)  : asset('build/assets/videos/macdinh_2.jpg') }}"
                                        alt="" class="avatar">
                                    <h4>{{$value->nick_name}}</h4>
                                </a>
                                <div class="friend_request" id="friend_request_{{$value->user_id}}">
                                    <button class="friend friend_accept" id="accept-friend-{{$value->user_id}}"
                                            data-id="{{$value->user_id}}" type="button">Accept
                                    </button>
                                    <button class="friend friend_cancel" id="cancel-friend-{{$value->user_id}}"
                                            data-id="{{$value->user_id}}" type="button">Cancel
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="friend-title">
                        <h3> Sent a friend request</h3>
                        <i class="bi bi-three-dots"></i>
                    </div>
                    <div class="current-friend">
                        @foreach($friend_add as $value)
                            {{--                            @if($value->status == 1 && $value->user_id==auth()->id())--}}
                            <div class="item-friend">
                                <a href="{{route('user.show', ['user'=>$value->user_id])}}">
                                    <img
                                        src="{{ $value->avatar ? Storage::url($value->avatar)  : asset('build/assets/videos/macdinh_2.jpg') }}"
                                        alt="" class="avatar">
                                    <h4>{{$value->nick_name}}</h4>
                                </a>
                                <div class="friend_request">
                                    <button class="add-friend button_add_friend" id="add-friend-{{$value->user_id}}"
                                            data-id="{{$value->user_id}}" type="button">Cancel request
                                    </button>
                                </div>
                            </div>
                            {{--                            @endif--}}
                        @endforeach
                    </div>
                    <div class="friend-title">
                        <h3>Recommend Friends</h3>
                        <i class="bi bi-three-dots"></i>
                    </div>
                    <div class="current-friend">
                        @foreach($friends  as $item)
                            @if(auth()->id() != $item->user_id)
                                <div class="item-friend">
                                    <a href="{{route('user.show', ['user'=>$item->user_id])}}">
                                        <img
                                            src="{{ $item->avatar ? Storage::url($item->avatar)  : asset('build/assets/videos/macdinh_2.jpg') }}"
                                            alt="" class="avatar">
                                        <h4>{{$item->nick_name}}</h4>
                                    </a>
                                    <button class="add-friend button_add_friend" id="add-friend-{{$item->user_id}}"
                                            data-id="{{$item->user_id}}" type="button">Add friend
                                    </button>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    jQuery(document).ready(function($){
        $('.button-comment').on('click', function (){
            var id_post = $(this).data('id');
            var key = $(this).data('key');
            var name = $(this).data('name');
            var parent_id = $('#parent-id-' + key).val();
            var content = $('#content-' + key).val();
            console.log(id_post);
            console.log(key);
            console.log(parent_id);
            console.log(content);
            console.log(name);
            var link = '{{route('comment')}}';
            $.ajax({
                type: 'POST',
                url: link,
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": id_post,
                    "parent_id": parent_id,
                    "content": content,
                },
                dataType: 'json',
                success: function (data) {
                    alert(data.html);
                    $("." + name).append('<div class="reply-comment">' +
                        '<a class="info-name-title" href=" ' + "{{route('user.show', ['user'=>auth()->id()])}}" +' "> ' +
                        '<img src=" ' + "{{auth()->user()->userDetail ? Storage::url(auth()->user()->userDetail->avatar) : ''}}" + ' alt="info"> ' +
                        '</a> ' +
                        '<div class="friend-comment"> ' +
                        '<h5>' + "{{auth()->user()->userDetail->nick_name}}" +'</h5>' +
                        '<p>' + content +'</p>'+
                        '<div class="like-comment">' +
                        '<span class="like_action" data-id="' + parent_id +'" id="like-action-' + parent_id +'">Like</span> ' +
                        '<a class="hidden-parent collapsed" href="#reply-comment-'+ id_post +"{{$com->id}}" + parent_id + '" aria-expanded="false" data-bs-toggle="collapse"><span class="reply_action">Reply</span></a> ' +
                        '</div> ' +
                        '</div> ' +
                        '</div> ' +
                        '<div class="reply-comment reply-comment-input collapse" id="reply-comment-'+ id_post +"{{$com->id}}" + parent_id +'"> ' +
                        '<a class="info-name-title" href="' + "{{route('user.show', ['user'=>auth()->id()])}}"+'"> ' +
                        '<img src="' + "{{auth()->user()->userDetail ? Storage::url(auth()->user()->userDetail->avatar):''}}" +'" alt="info">' +
                        '</a> ' +
                        '<div class="content-comment"> ' +
                        '<input type="text" name="status" id="content-' + parent_id +'" value="" placeholder="Write a comment ....."> ' +
                        '<input hidden name="parent_id" id="parent-id-' + parent_id +'" value="' + parent_id +'"> ' +
                        '<button type="button" class="button-comment" data-name="'+ name +'" data-key="' + parent_id +'" data-id="' + id_post +'"><i class="bi bi-send"></i></button> ' +
                        '</div>' +
                        '</div>');
                },
                error: function (data) {
                    console.log(data);
                }
            });
        });
    });
</script>

