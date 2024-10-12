@extends('layouts.template')

@section('title','Product List')

@section('body')
<div class="mt-4 p-5 bg-black text-white rounded">
    <h1>All Products</h1>

    <a href="{{route('products.create')}}" class="btn btn-primary btn-sm">
        Create New product
    </a>
</div>

@if(@session()->has('success'))
<div class="alert alert-success mt-4">
    {{session()->get('success') }}
</div>
@endif

<div class="container mt-5">
    <table class="table table-bordered mb-5">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">product_name</th>
                <th scope="col">description</th>
                <th scope="col">retail_price</th>
                <th scope="col">wholesale_price</th>
                <th scope="col">origin</th>
                <th scope="col">quantity</th>
                <th scope="col">Created At</th>
                <th scope="col">Updated At</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($products as $products)
            <tr>
                <th scope="row">{{ $products->id}}</th>
                <td>
                    <a href="{{route('products.show',$products)}}">
                    {{$products->product_name}}
                </td>
                <td>{{ Str::limit($products->description, 50,'...') }}</td>
                <td>{{$products->retail_price}}</td>
                <td>{{$products->wholesale_price}}</td>
                <td>{{$products->origin}}</td>
                <td>{{$products->quantity}}</td>
                <td>{{$products->created_at}}</td>
                <td>{{$products->updated_at}}</td>
                <td>
                    <a href="{{route('products.edit',$products)}}" class="btn btn-primary btn-sm">
                        Edit
                    </a>
                    <form action={{route('products.destroy',$products)}} method="POST" class="d-inline-block">
                        @method('DELETE')
                        @csrf


                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                            DELETE
                        </button>
                    </form>
            </tr>
            @empty
            <tr>
                <td colspan="7">No product found</td>
            </tr>
            @endforelse
        </tbody>
    </table>

{{-- <div class="d-flx justify-content-center">
    {!! $products->links() !!} --}}
</div>
</div>

@endsection