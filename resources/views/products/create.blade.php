@extends('layouts.template')

@section('title','Register New Product')

@section('body')

<div class="'mt-4 p-5 bg-black text-white rounded">
    <h1>Register New product</h1>
</div>
<div class="row my-5">
    <div class="col-12 px-5">
        @if ($errors->any())
        <div class="alert alert-danger mt-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif

        <form action={{route('products.store')}} method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class=" form-group">
                <label for="product_name">ID</label>
                <input type="text" class="form-control" id="id"placeholder="id" name="id" required value="{{old('id')}}">
            </div>
            <div class=" form-group">
                <label for="product_name">Product_name</label>
                <input type="text" class="form-control" id="product_name"placeholder="Product Name" name="product_name" required value="{{old('product_name')}}">
            </div>
            <div class=" form-group">
                <label for="description">Description</label>
                <input type="text" class="form-control" id="description" placeholder="description" name="description" required value="{{old('description')}}">
            </div>
            <div class=" form-group">
                <label for="retail_price">Retail_price</label>
                <input type="text" class="form-control" id="retail_price"placeholder="retail price" name="retail_price" value="{{old('retail_price')}}">
            </div>
            <div class=" form-group">
                <label for="wholesale_price">Wholesale_price</label>
                <input type="text" class="form-control" id="wholesale_price"placeholder="wholesale price" name="wholesale_price" value="{{old('wholesale_price')}}">
            </div>
            <div class=" form-group">
                <label for="origin">origin</label>
                <input type="text" class="form-control" id="origin"placeholder="origin " name="origin" value="{{old('origin')}}">
            </div>
            <div class=" form-group">
                <label for="quantity">quantity</label>
                <input type="text" class="form-control" id="quantity"placeholder="quantity" name="quantity" value="{{old('quantity')}}">
            </div>
            <div class=" form-group">
                <label for="product_image">product_image</label>
                <input type="file" class="form-control" id="product_image"name="product_image">
            </div>
            
            <button type="submit" class="btn btn-primary btn-block">save</button>
        </form>
    </div>
</div>

@endsection