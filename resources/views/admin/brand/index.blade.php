@extends('admin-layout')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Brands</h1>
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
                        <th colspan="2" width="5%">Action</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($listBrands as $key => $item)
                    <tr>
                        <td>{{$item->id}}</td>
                        <td>{{$item->name}}</td>
                        <td>{!! $item->description !!}</td>
                        <td>
                            <a href="#" class="btn btn-info">Edit</a>
                        </td>
                        <td>
                            <button id="{{$item->id}}" class="btn btn-danger js-delete-brand">Delete</button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div class="text-center">
                {{-- Hien thi phan trang --}}
                {{ $listBrands->links() }}
            </div>
        </div>
    </div>
@endsection
@push('javascripts')
    <script type="text/javascript" src="{{asset('admin/js/admin-brands.js')}}"></script>
@endpush
