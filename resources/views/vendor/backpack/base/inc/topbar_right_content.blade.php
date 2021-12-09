<!-- This file is used to store topbar (right) items -->

@php
    $notifications = \App\Models\Notification::where("user_id","=",backpack_user()->id)->orderBy("updated_at","DESC")->get();
@endphp
 <li class="nav-item d-md-down-none" style="position: relative">
     <a class="nav-link" href="#" id="dropdownMenuButton">
         <i class="la la-bell"></i><span class="badge badge-pill badge-danger">{{$notifications->count()}}</span>
     </a>
     <div  class="d-none bg-white text-left p-2 rounded" id="nof" style="position: absolute;right: 0;width: 400px;z-index: 9999">
         <div class=""><span class="h5 font-weight-bold">Thông báo</span> <span class="float-right"><a href="#" id="close-nof">Đóng</a></span></div>

         <hr>

         @foreach($notifications as $notification)
             <div class="no p-1">
                 <div class="font-weight-bold">{{$notification->title}}</div>
                 <div class="text-muted">{{$notification->message}}</div>
                 <small class="text-primary">{{$notification->updated_at}}</small>
             </div>
             <hr>
         @endforeach
     </div>
 </li>

<li class="nav-item d-md-down-none"><a class="nav-link" href="#"><i class="la la-list"></i></a></li>
<li class="nav-item d-md-down-none"><a class="nav-link" href="#"><i class="la la-map"></i></a></li>


<script src="{{asset("assets/js/jquery-2.1.0.min.js")}}"></script>
<script>
    let p = "hide";
    $("#dropdownMenuButton").click(function (){
        if(p==="hide"){
            $("#nof").removeClass("d-none");
            p="show";
        }else {
            $("#nof").addClass("d-none");
            p="hide";
        }
    });
    $("#close-nof").click(function (){
        $("#nof").addClass("d-none");
        p='hide';
    });
</script>
