@extends('admin-layout')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">List shoes brands</h1>
        <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">

                <input type="text" class="form-control bg-light border-1 small js-keyword-brand" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" value="{{ $keyword }}">

                <div class="input-group-append">
                    <button class="btn btn-primary js-search-brand" type="button">
                        <i class="fas fa-search fa-sm"></i>
                    </button>
                </div>
            </div>
        </form>
        <a href="{{route('admin.add.brand')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Add Brand + </a>
    </div>
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            @if(!empty($message))
                <div class="alert alert-success">
                    {{$message}}
                </div>
            @endif
            <table class="table table-hover">
                <thead>
                    <tr>
                        <td>Id</td>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th colspan="2" width="5%">Action</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($listBrands as $key => $item)
                    <tr>
                        <td>{{$item->id}}</td>
                        <td>
                            <a href="{{route('admin.edit.brand',['slug' => $item->slug, 'id' => $item->id])}}">
                            {{$item->name}}
                            </a>
                        </td>
                        <td>{!! $item->description !!}</td>
                        <td>
                            {{ $item->status == 1 ? 'Active' : 'Deactive' }}
                        </td>
                        <td>
                            <a href="{{route('admin.edit.brand',['slug' => $item->slug, 'id' => $item->id])}}" class="btn btn-info">Edit</a>
                        </td>
                        <td>
                            @if($item->status == 1)
                                <button data-status="0" id="{{$item->id}}" class="btn btn-danger js-delete-brand">Block</button>
                            @else
                                <button data-status="1" id="{{$item->id}}" class="btn btn-primary js-delete-brand">Unblock</button>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div class="text-center">
                {{-- Hien thi phan trang --}}
                {{ $listBrands->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
@endsection
@push('javascripts')
    <script type="text/javascript">
        var urlAjax = "{{route('admin.delete.brand')}}";
        var urlSearch = "{{route('admin.brands')}}";
    </script>
    <script type="text/javascript" src="{{asset('admin/js/admin-brands.js')}}"></script>
@endpush
