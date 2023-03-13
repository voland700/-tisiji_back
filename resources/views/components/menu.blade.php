<ul class="nav-list" id="menuList">
    @foreach ($menu as $item)
        <li class="nav-item"><a href="{{route($item['route'])}}" class="nav-item_link @if($item['active']) active @endif">{{$item['title']}}</a></li>
    @endforeach
</ul>
