@extends('admin-layout')

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit brands : {{ $infoBrand->name }}</h1>
        <a href="{{route('admin.brands')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">List banrds</a>
    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-12 col-sm-12 col-lg-12 col-xl-12 col-md-12 mb-4">

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
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
            @endif

            <form action="{{route('admin.update.brand')}}" method="post">
                @csrf
                <div class="form-group">
                    <label for="nameBrand">Name Brand</label>
                    <input
                        class="form-control"
                        type="text"
                        id="nameBrand"
                        name="nameBrand"
                        value="{{$infoBrand->name}}"
                    />
                </div>
                <div class="form-group">
                    <label for="descBrand">Description Brand</label>
                    <textarea
                        class="form-control"
                        id="descBrand"
                        name="descBrand"
                        rows="8"
                    >{!! $infoBrand->description !!}</textarea>
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control">
                        <option value="1" {{$infoBrand->status == 1 ? 'selected' : ''}} >Active</option>
                        <option value="0" {{$infoBrand->status == 0 ? 'selected' : ''}} >Deactive</option>
                    </select>
                </div>
                <input type="hidden" name="hddIdBrand" value="{{$infoBrand->id}}"/>
                <button class="btn btn-primary" type="submit"> Submit </button>
            </form>
        </div>
    </div>
@endsection
