<ul>
    @foreach($childs as $key => $child)
        <li>
            {{$child->name}}
            <a href="#"><i class="fa fa-pencil-square-o"> edit </i></a>
            @if(count($child->childs))
                {{-- De Quy --}}
                @include('admin.category.child-category',['childs' => $child->childs])
            @endif
        </li>
    @endforeach
</ul>
