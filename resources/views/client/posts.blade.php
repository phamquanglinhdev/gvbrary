@extends("layout.client")
@section("banner")
    <!-- ***** Main Banner Area Start ***** -->
    <div class="page-heading about-page-heading" id="top">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="inner-content">
                        <h2>Bài viết</h2>
                        <span></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ***** Main Banner Area End ***** -->
@endsection
@section("content")
    <div class="container">
        @if(isset($posts))
            @foreach($posts as $post)

                   <div class="row mt-5">
                       <div class="col-md-3 col-sm-6 col-12">
                           <a href="{{route("post",$post->id)}}"><img src="{!! $post->Crawler() !!}" class="w-100"></a>
                       </div>
                       <div class="col-md-9 col-md-6 col-12">
                           <a href="{{route("post",$post->id)}}" class="text-dark">
                               <div class="h4">{{$post->name}}</div>
                               <div class="font-italic">{{$post->ContentTrim()}}</div>
                               <div>Upload bởi : <a href="{{route("user.profile",$post->User()->first()->email)}}">{{$post->User()->first()->name}}</a></div>
                               <div class="text-muted">{{$post->updated_at}}</div>
                           </a>
                       </div>
                   </div>
            @endforeach
        @endif
    </div>
@endsection
