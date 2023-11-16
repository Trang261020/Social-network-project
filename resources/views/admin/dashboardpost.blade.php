@extends('layouts.admin')

@section('content')
    {{--    @dd($user)--}}
    @if(Session::has('message'))
        <script>
            alert('{{ Session::get('message') }}');
        </script>
    @endif
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 col-xl-2 col-lg-2 col-sm-2 col-12 container-fluid__body">
                <ul class="dash-broad">
                    <a href="{{route('dashboard.user')}}"><li class="{{(route('dashboard.user') == url()->full())? 'active' : ''}}"><i class="bi bi-people"></i>User</li></a>
                    <a href="{{route('dashboard.post')}}"><li class="{{(route('dashboard.post') == url()->full())? 'active' : ''}}"><i class="bi bi-file-earmark-post"></i>Post</li></a>
{{--                    <a href="{{route('user.index')}}"><li class="{{(route('user.index')== url()->full())? 'active' : ''}}"><i class="bi bi-gear"></i>Setting</li></a>--}}
                </ul>
            </div>
            <div class="col-md-10 col-xl-10 col-lg-10 col-sm-10 col-12 container-fluid__body">
                <div class="container row__content">
                    <div class="row">
                        <div class="upload-post admin-items">
                            <h2 class="title_admin">Administrator</h2>
                            <div class="search_item">
                                <div class="input_search">
                                    <div>
                                        <input type="text" class="key_word" name="key_word" value="" placeholder="Search">
                                        <button type="button" id="search_post">Search</button>
                                    </div>
                                </div>
                            </div>
                            <div class="list_items">
                                <div class="table_item">
                                    <table>
                                        <tr class="title_table">
                                            <th>STT</th>
                                            <th>User</th>
                                            <th>Status</th>
                                            <th>Content</th>
                                            <th>Create at</th>
                                            <th>Actions</th>
                                        </tr>
                                        @foreach($post as $key => $value)
                                            <tr>
                                                <td>{{$key+1}}</td>
                                                <td><a href="{{route('show.user', ['id'=>$value->user_id])}}">{{\App\Models\User::find($value->user_id)->username}}</a></td>
                                                <td><a href="{{route('show.post', ['id'=>$value->id])}}">{{$value->title}}</a></td>
                                                <td>{{$value->content}}</td>
                                                <td>{{$value->created_at}}</td>
                                                <td>
                                                    <a href="{{route('edit.post', ['id'=>$value->id])}}"><button>Edit</button></a>
                                                    <a href="{{route('delete.post', ['id'=>$value->id])}}"><button>Delete</button></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
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
        $('#search_post').on('click', function(){
            var key = $('.key_word').val();
            console.log(key);
            var link = '{{route('search.post')}}';
            $.ajax({
                type: 'POST',
                url: link,
                data: {
                    "_token": "{{ csrf_token() }}",
                    "key": key,
                },
                dataType: 'json',
                success: function (data) {
                    console.log(data.html);
                    $('table').html(data.html);
                },
                error: function (data) {
                    console.log(data);
                }
            });
        });
    });
</script>
