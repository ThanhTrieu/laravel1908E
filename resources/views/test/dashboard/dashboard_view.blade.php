{{--ke thua file test layout--}}
@extends('test-layout')

{{--day view ra test layout--}}
@push('stylesheets')
    <link type="text/css" rel="stylesheet" href="{{asset('test/css/test.css')}}">
    <style>
        {{-- code css in here--}}
    </style>
@endpush



@section('content')
    <h3 class="text-secondary">This is content</h3>
    <p>My name: {{ $fullname }}</p>
    <p>My age: {{ $age }}</p>
    <table class="table table-hover table-striped">
        <thead>
            <tr>
                <th>Id</th>
                <th>username</th>
                <th>Email</th>
                <th>Gender</th>
                <th>Money</th>
            </tr>
        </thead>
        <tbody>
            @foreach($lstUsers as $key => $item)
                <tr>
                    <td>{{$item['id']}}</td>
                    <td> {!! $item['username'] !!} </td>
                    <td>{{$item['email']}}</td>
                    <td>{{ $item['gender'] == 1 ? 'Nam' : ($item['gender'] == 0 ? 'Nu' : '3D') }}</td>
                    <td>{{ number_format($item['money'])  }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection


@push('scripts')
    {{--    code js in here --}}
@endpush
