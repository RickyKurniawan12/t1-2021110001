@extends('layouts.template')

@section('title', 'Update Product')

@section('body')

<div class="mt-4 p-5 bg-black text-white rounded">
    <h1>Update Existing Product</h1>
</div>
<div class="row my-5">
    <div class="col-12 px-5">
        @if ($errors->any())
        <div class="alert alert-danger mt-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="id">ID</label>
                <input type="text" readonly class="form-control" id="id" name="id" required value="{{ old('id', $product->id) }}">
            </div>
            <div class="form-group">
                <label for="product_name">Product Name</label>
                <input type="text" class="form-control" id="product_name" name="product_name" required value="{{ old('product_name', $product->product_name) }}">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" class="form-control" id="description" name="description" required value="{{ old('description', $product->description) }}">
            </div>
            <div class="form-group">
                <label for="retail_price">Retail Price</label>
                <input type="text" class="form-control" id="retail_price" name="retail_price" value="{{ old('retail_price', $product->retail_price) }}">
            </div>
            <div class="form-group">
                <label for="wholesale_price">Wholesale Price</label>
                <input type="text" class="form-control" id="wholesale_price" name="wholesale_price" value="{{ old('wholesale_price', $product->wholesale_price) }}">
            </div>
            <div class="form-group">
                <label for="origin">Origin</label>
                <input type="text" class="form-control" id="origin" name="origin" value="{{ old('origin', $product->origin) }}">
            </div>
            <div class="form-group">
                <label for="quantity">Quantity</label>
                <input type="text" class="form-control" id="quantity" name="quantity" value="{{ old('quantity', $product->quantity) }}">
            </div>
            <div class="form-group">
                <label for="product_image">Product Image</label>
                <input type="file" class="form-control" id="product_image" name="product_image">
            </div>
            
            <button type="submit" class="btn btn-primary btn-block">Save</button>
        </form>
    </div>
</div>

@endsection
