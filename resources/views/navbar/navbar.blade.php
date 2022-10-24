<ul class="nav navbar-nav">
    <li class="dropdown dropdown-notification nav-item">
        <a class="nav-link nav-link-label" href="#" data-toggle="dropdown" aria-expanded="true"><i class="ficon feather icon-bell"></i><span class="badge badge-pill badge-primary badge-up">{{\App\Models\Message::where('to_uid',auth()->id())->where('is_read',0)->count()}}</span></a>
        <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right ">
            <li class="dropdown-menu-header">
                <div class="dropdown-header m-0 p-2">
                    <h3 class="white">{{\App\Models\Message::where('to_uid',auth()->id())->where('is_read',0)->count()}} New</h3><span class="grey darken-2">App Notifications</span>
                </div>
            </li>
            <li class="scrollable-container media-list ps ps--active-y">
                @foreach(\App\Models\Message::where('to_uid',auth()->id())->where('is_read',0)->take(3)->get() as $item)
                <a class="d-flex justify-content-between message-item" href="javascript:void(0)" data-id="{{$item->id}}" data-url="{{$item->to_url}}">
                    <div class="media d-flex align-items-start" style="width:100%">
                        <div class="media-left"><i class="feather icon-alert-triangle font-medium-5 primary"></i></div>
                        <div class="media-body">
                            <h6 class="primary media-heading">{{$item->fromUser->name}}</h6><small class="notification-text">{{$item->content}}</small>
                        </div><small>
                            <time class="media-meta" datetime="2015-06-11T18:29:20+08:00">{{$item->created_at}}</time></small>
                    </div>
                </a>
                @endforeach
                {{-- <a class="d-flex justify-content-between" href="javascript:void(0)">
                    <div class="media d-flex align-items-start">
                        <div class="media-left"><i class="feather icon-download-cloud font-medium-5 success"></i></div>
                        <div class="media-body">
                            <h6 class="success media-heading red darken-1">99% Server load</h6>
                            <small class="notification-text">You got new order of goods.</small>
                        </div><small>
                            <time class="media-meta" datetime="2015-06-11T18:29:20+08:00">5 hour
                                ago</time></small>
                    </div>
                </a>
                <a class="d-flex justify-content-between" href="javascript:void(0)">
                    <div class="media d-flex align-items-start">
                        <div class="media-left"><i class="feather icon-alert-triangle font-medium-5 danger"></i></div>
                        <div class="media-body">
                            <h6 class="danger media-heading yellow darken-3">Warning notifixation
                            </h6><small class="notification-text">Server have 99% CPU usage.</small>
                        </div><small>
                            <time class="media-meta" datetime="2015-06-11T18:29:20+08:00">Today</time></small>
                    </div>
                </a> --}}
                <div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; right: 0px; height: 254px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 184px;"></div></div></li>
            <li class="dropdown-menu-footer"><a class="dropdown-item p-1 text-center" href="{{admin_url('messages')}}">查看列表</a></li>
        </ul>
    </li>
</ul>

<script>
    $('.message-item').click(function(){
        var id = $(this).data('id')
        var url = $(this).data('url')
        if(id){
            $.ajax({
                url:"{{route('pub.messageRead')}}",
                method: "POST",
                data :{id:id},
                success:function(d){
                    location.href=url;
                }
            })
        }
    })
</script>