@extends('admin-layout')

@push('stylesheets')
    <link href="{{asset('admin/css/treeview.css')}}" rel="stylesheet">
{{--    <link rel="stylesheet" href="{{asset('admin/css/dropzone.css')}}">--}}
    <style type="text/css">
        .hover-pointer{
            cursor: pointer;
        }
    </style>
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
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-6 col-xl-6 col-lg-6">
                            <li class="hover-pointer">
                                {{$item->name}}
                                @if(count($item->childs))
                                    {{-- De Quy --}}
                                    @include('admin.category.child-category',['childs' => $item->childs])
                                @endif
                            </li>
                        </div>
                        <div class="col-12 col-sm-12 col-md-6 col-xl-6 col-lg-6">
                            <a class="float-right mt-0" href="{{route('admin.edit.category',['slug'=> $item->slug, 'id' => $item->id])}}"><i class="fas fa-edit"></i></a>
                        </div>
                    </div>
                @endforeach
            </ul>
            <hr>
            <div class="row ml-3">
                {{ $viewCate->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <form method="post" action="" enctype="multipart/form-data" class="dropzone" id="dropzone">
                @csrf
{{--                <input type="text" placeholder="sasas">--}}
            </form>
        </div>
    </div>
@endsection

@push('javascripts')
    <script src="{{asset('admin/js/treeview.js')}}"></script>
{{--    <script src="{{asset('admin/js/dropzone.js')}}"></script>--}}
    <script type="text/javascript">
        // Dropzone.autoDiscover = false;
        // $(document).ready(function () {
        //     $("#dropzone").dropzone({
        //         maxFiles: 2000,
        //         // url: "/ajax_file_upload_handler/",
        //         acceptedFiles: ".jpeg,.jpg,.png,.gif",
        //         timeout: 5000,
        //         success: function (file, response) {
        //             console.log(response);
        //         }
        //     });
        // })
        // Dropzone.options.dropzone = {
        //     maxFilesize: 12,
        //     renameFile: function(file) {
        //         var dt = new Date();
        //         var time = dt.getTime();
        //         return time+file.name;
        //     },
        //     acceptedFiles: ".jpeg,.jpg,.png,.gif",
        //     addRemoveLinks: true,
        //     timeout: 5000,
        //     success: function(file, response)
        //     {
        //         console.log(response);
        //     },
        //     error: function(file, response)
        //     {
        //         return false;
        //     }
        // };
    </script>
@endpush
