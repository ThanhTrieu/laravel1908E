@extends('admin-layout')

@push('stylesheets')
    <link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link href="{{asset('admin/css/image-uploader.min.css')}}" rel="stylesheet">
@endpush

@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Add Shoes</h1>
        <a href="{{route('admin.shoes.product')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">List shoes products</a>
    </div>

    @if ($errors->any())
    <div class="row my-2">
        <div class="col">
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    @endif

    <form action="{{route('admin.handle.add.shoes')}}" method="post" enctype="multipart/form-data" class="border p-3">
        @csrf
        <div class="row">
            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                <div class="form-group">
                    <label for="nameProduct">Ten san pham (*)</label>
                    <input name="nameProduct" class="form-control" id="nameProduct" />
                </div>
                <div class="form-group">
                    <label for="priceProduct">Gia san pham (*)</label>
                    <input type="text" name="priceProduct" class="form-control" id="priceProduct" />
                </div>
                <div class="form-group">
                    <label for="qtyProduct">So luong san pham (*)</label>
                    <input type="number" name="qtyProduct" class="form-control" id="qtyProduct" />
                </div>
                <div class="form-group">
                    <label for="saleOffProduct">Sale off %</label>
                    <input type="number" name="saleOffProduct" class="form-control" id="saleOffProduct" />
                </div>
                <div class="form-group">
                    <label for="codeProduct">Ma giam gia</label>
                    <input type="text" name="codeProduct" class="form-control" id="codeProduct" />
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
                <div class="form-group">
                    <label for="categoryProduct">Danh muc san pham (*)</label>
                    <select class="form-control js-select-category" name="categoryProduct" id="categoryProduct">
                        <option value=""> -- Chon danh muc --</option>
                        @foreach($category as $key => $item)
                            <option value="{{$item->id}}"> {{$item->name}} </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="brandProduct">Thuong hieu san pham (*)</label>
                    <select class="form-control js-seclect-brand" name="brandProduct" id="brandProduct">
                        <option value=""> -- Chon thuong hieu --</option>
                        @foreach($brands as $key => $item)
                            <option value="{{$item->id}}"> {{$item->name}} </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="colorProduct">Mau sac san pham (*)</label>
                    <select multiple class="form-control js-seclect-color" name="colorProduct[]" id="colorProduct">
                        <option value=""> -- Chon mau sac --</option>
                        @foreach($colors as $key => $item)
                            <option value="{{$item->id}}"> {{$item->name}} </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="sizeProduct">Size san pham (*)</label>
                    <select multiple class="form-control js-seclect-size" name="sizeProduct[]" id="sizeProduct">
                        <option value=""> -- Chon size --</option>
                        @foreach($sizes as $key => $item)
                            <option value="{{$item->id}}"> {{$item->size_number}} </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="tagProduct">Tag san pham</label>
                    <select multiple class="form-control js-seclect-tag" name="tagProduct[]" id="tagProduct">
                        <option value=""> -- Chon size --</option>
                        @foreach($tags as $key => $item)
                            <option value="{{$item->id}}"> {{$item->name_tag}} </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label class="active">Anh san pham (*)</label>
                    <div class="js-upload-image-shoes p-3"></div>
                </div>
                <button class="btn btn-primary btn-block btn-lg">Them san pham</button>
            </div>
        </div>
    </form>
@endsection
@push('javascripts')
    <script src="{{asset('admin/js/product-shoes.js')}}"></script>
    <script src="{{asset('admin/js/image-uploader.min.js')}}"></script>
    <script type="text/javascript">
        $(function () {
            $('.js-upload-image-shoes').imageUploader();
        })
    </script>
@endpush
