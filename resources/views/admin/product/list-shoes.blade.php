@extends('admin-layout')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">List shoes</h1>
{{--        <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">--}}
{{--            <div class="input-group">--}}
{{--                <input type="text" class="form-control bg-light border-1 small js-keyword-brand" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" value="{{ $keyword }}">--}}
{{--                <div class="input-group-append">--}}
{{--                    <button class="btn btn-primary js-search-brand" type="button">--}}
{{--                        <i class="fas fa-search fa-sm"></i>--}}
{{--                    </button>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </form>--}}
        <a href="{{route('admin.add.shoes')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">Add Product + </a>
    </div>
@endsection
