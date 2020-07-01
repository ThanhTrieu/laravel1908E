@extends('admin-layout')

@push('stylesheets')
    <link href="{{asset('admin/css/treeview.css')}}" rel="stylesheet">
@endpush
@push('javascripts')
    <script src="{{asset('admin/js/treeview.js')}}"></script>
@endpush

@section('content')
    <div class="row">
        <div class="col-12 col-sm-12 col-md-6 col-xl-6 col-lg-6">
            {{-- hien thi form add category --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if(!empty($message))
                <div class="alert alert-info">{{$message}}</div>
            @endif

            <form class="border p-2" action="{{route('admin.add.category')}}" method="post">
                @csrf
                <div class="form-group">
                    <label for="nameCate">Name</label>
                    <input type="text" class="form-control" id="nameCate" name="nameCate" />
                </div>
                <div class="form-group">
                    <label for="cateParent">Category parent</label>
                    <select class="form-control" id="cateParent" name="cateParent">
                        <option value="0"> -- Root --</option>
                        @foreach($allCate as $key => $item)
                            <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>
                <button class="btn btn-primary">Add + </button>
            </form>
        </div>
        <div class="col-12 col-sm-12 col-md-6 col-xl-6 col-lg-6">
            {{-- Hien thi danh sach category --}}
            <ul id="tree1">
                @foreach($viewCate as $key => $item)
                    <li>

                        {{$item->name}}
                        <a href="#"><i class="fa fa-pencil-square-o"> edit </i></a>
                        @if(count($item->childs))
                            {{-- De Quy --}}
                            @include('admin.category.child-category',['childs' => $item->childs])
                        @endif
                    </li>
                @endforeach
            </ul>
            <hr>
            <div class="row ml-3">
                {{ $viewCate->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
@endsection
