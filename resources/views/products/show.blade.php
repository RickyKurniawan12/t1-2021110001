@extends('layouts.template')

@section('title',"product: $products->product_name")

@section('body')

@if($products->product_image)
    <img src="{{$products->product_image_url}}" class="rounded img-thumbnail mx-auto d-block my-3"/>
@endif

    <table class="table tabble-bordered">
        <tbody>
            <tr>
                <th scope="row">id</th>
                <td>{{$products->id}}</td>
            </tr>
            <tr>
                <th scope="row">product_name</th>
                <td>{{$products->product_name}}</td>
            </tr>
            <tr>
                <th scope="row">description</th>
                <td>{{$products->description}}</td>
            </tr>
            <tr>
                <th scope="row">retail_price</th>
                <td>{{$products->retail_price}}</td>
            </tr>
            <tr>
                <th scope="row">wholesale_price</th>
                <td>{{$products->wholesale_price}}</td>
            </tr>
            <tr>
                <th scope="row"> origin</th>
                <td>{{$products->origin}}</td>
            </tr>
            <tr>
                <th scope="row">quantity</th>
                <td>{{$products->quantity}}</td>
            </tr>
        </tbody>
    </table>
    <div>
        <small>Created at: {{$products->created_at}}</small>
        @if($products->updated_at)
        <br><small>Updated at:{{$products->updated_at}}</small>
        @endif
    </div>
@endsection
