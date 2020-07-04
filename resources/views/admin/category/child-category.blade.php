<ul>
    @foreach($childs as $key => $child)
        <li class="hover-pointer">
            {{$child->name}}
            <span data-link="{{route('admin.edit.category',['slug'=> $child->slug, 'id' => $child->id])}}" class="ml-2 js-detail-category"><i class="fas fa-edit"></i></span>
            @if(count($child->childs))
                {{-- De Quy --}}
                @include('admin.category.child-category',['childs' => $child->childs])
            @endif
        </li>
    @endforeach
</ul>
@push('javascripts')
    <script type="text/javascript">
        $(function () {
            $('.js-detail-category').on('click', function () {
                var url = $(this).attr('data-link');
                window.location.href = url;
            });
        });
    </script>
@endpush
