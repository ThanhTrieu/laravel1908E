@extends('admin-layout')

@section('content')
    <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-xl-12 col-lg-12">
            <h1>Update category - {{$infoCategory->name}}</h1>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form class="border p-2" action="{{route('admin.handle.update.category',['id' => $infoCategory->id])}}" method="post">
                @csrf
                <div class="form-group">
                    <label for="nameCate">Name category</label>
                    <input type="text" class="form-control" id="nameCate" name="nameCate" value="{{$infoCategory->name}}">
                </div>
                <div class="form-group">
                    <label for="cateParent">Category parent</label>
                    <select class="form-control" id="cateParent" name="cateParent">
                        <option {{$infoCategory->parent_id == 0 ? 'selected' : ''}} value="{{$infoCategory->id}}-0"> -- Root --</option>
                        @foreach($allCate as $key => $item)
                            <option {{$item->id == $infoCategory->parent_id ? 'selected' :''}} value="{{$item->id}}-{{$item->parent_id}}">{{$item->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="statusCate">Status</label>
                    <select id="statusCate" name="statusCate" class="form-control">
                        <option {{$infoCategory->status == 1 ? 'selected' : ''}} value="1">Active</option>
                        <option {{$infoCategory->status == 0 ? 'selected' : ''}} value="0">Deactive</option>
                    </select>
                </div>
                <button class="btn btn-primary"> Update  <i class="fas fa-edit"></i></button>
            </form>
        </div>
    </div>
@endsection
