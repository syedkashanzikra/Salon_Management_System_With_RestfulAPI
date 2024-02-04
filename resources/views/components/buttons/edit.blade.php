@props(["route"=>"", "icon"=>"fa-solid fa-pen-clip", "title", "small"=>"", "class"=>""])

@if($route)
<a href='{{$route}}'
    class='btn btn-primary {{($small=='true')? 'btn-sm' : ''}} {{$class}}'
    data-bs-toggle="tooltip"
    title="{{ $title }}">
    <i class="{{$icon}}"></i>
    {{ $slot }}
</a>
@else
<button type="submit"
    class='btn btn-primary {{($small=='true')? 'btn-sm' : ''}} {{$class}}'
    data-bs-toggle="tooltip"
    title="{{ $title }}">
    <i class="{{$icon}}"></i>
    {{ $slot }}
</button>
@endif
