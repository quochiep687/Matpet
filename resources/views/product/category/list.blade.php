@extends('layouts.master')

@section('title')
    <title>Home page</title>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('home/home.css') }}">
@endsection


@section('js')
    <link rel="stylesheet" href="{{ asset('home/home.js') }}">
@endsection

@section('content')
    <section>
        <div class="container">
            <div class="row">
                <!-- cate -->
    <div class="col-sm-3">
                    <div class="left-sidebar">
                    <h2>Danh Mục</h2>
        <div class="panel-group category-products" id="accordian"><!--category-productsr-->

            @foreach($categorys as $category)
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                        @if($category->categoryChildrent->count())
                            <a href="{{ route('category.product',
                                        ['slug' => $category->slug, 'id' => $category->id]) }}">
                                {{ $category->name }}
                            </a>
                            <a data-toggle="collapse" data-parent="#accordian" href="#sportswear_{{$category->id}}">
                                <span class="badge pull-right">
                                   <i class="fa fa-plus"></i>
                                </span>
                            </a>
                            
                            @else
                            <a href="
                            {{ route('category.product',
                                        ['slug' => $category->slug, 'id' => $category->id]) }}
                            "
                            >
                                <!-- <span class="badge pull-right">
                                </span> -->
                                {{ $category->name }}
                            </a>
                        @endif
                        </h4>
                    </div>


                    <div id="sportswear_{{$category->id}}" class="panel-collapse collapse">
                        <div class="panel-body">
                            <ul>
                                @foreach($category->categoryChildrent as $categoryChilrent)
                                    <li>
                                        <a href="{{ route('category.product',
                                        ['slug' => $categoryChilrent->slug, 'id' => $categoryChilrent->id]) }}">
                                            {{ $categoryChilrent->name }}
                                        </a>
                                    </li>
                                @endforeach

                            </ul>
                        </div>
                    </div>

                </div>
            @endforeach

        </div><!--/category-products-->


    </div>
</div>
                <!-- end cate -->

                <div class="col-sm-9 padding-right">
                    <div class="features_items"><!--features_items-->
                        <h2 class="title text-center">Sản Phẩm</h2>
                        <div class="row row-sort">
                            <div class="col-md-4">
                                <label for="amount">Sắp xếp theo</label>
                                <form action="">
                                    @csrf
                                    <select name="sort" id="sort" class="form-control">
                                        <option disabled selected value="{{Request::url()}}?sort_by=none">--Lọc--</option>
                                        <option value="{{Request::url()}}?sort_by=tang_dan">Giá Tăng Dần</option>
                                        <option value="{{Request::url()}}?sort_by=giam_dan">Giá Giảm Dần</option>
                                        <option value="{{Request::url()}}?sort_by=a_z">Tên A-Z</option>
                                        <option value="{{Request::url()}}?sort_by=z_a">Tên Z-A</option>
                                    </select>
                                </form>
                            </div>
                            <div class="col-md-4 section_filter">
                                <label for="amount">Lọc Giá</label>
                                <form action="">
                                   <div id="slider-range"></div>
                                   <div class='price_filter_change'>
                                    <input type="text" id="amount_start" readonly style="border:0; color:#f6931f; font-weight:bold; width:30%; "><span>-</span>
                                    <input type="text" id="amount_end" readonly style="border:0; color:#f6931f; font-weight:bold;width:30%; ">
                                   </div>
                                   
                                   <input type="hidden" name="start_price" id="start_price">
                                   <input type="hidden" name="end_price" id="end_price">
                                   
                                   <input type="submit" name="filter_price" value="Lọc" class="btn-filter btn btn-sm btn-primary">
                                </form>
                            </div>
                        </div>
                        @foreach($products as $product)
                            <div class="col-sm-4">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <img src="{{ config('app.base_url') . $product->feature_image_path }}" alt=""/>
                                            <h2>{{ number_format($product->price) }} VNĐ</h2>
                                            <p>{{ $product->name }}</p>
                                            <a href="#" class="btn btn-default add-to-cart"><i
                                                    class="fa fa-shopping-cart"></i>Thêm Giỏ Hàng</a>
                                        </div>
                                        <div class="product-overlay">
                                        <a href="{{route('productdetail',['id' => $product->id])}}" style="
                                            display: block;
                                            width: 100%;
                                            height: 100%;
                                        "></a>
                                            <div class="overlay-content">
                                                <a href="{{route('productdetail',['id' => $product->id])}}"><h2>{{ number_format($product->price) }} VNĐ</h2></a>
                                                <a href="{{route('productdetail',['id' => $product->id])}}"><p>{{ $product->name }}</p></a>
                                                <a href="#" class="btn btn-default add-to-cart"><i
                                                        class="fa fa-shopping-cart"></i>Thêm Giỏ Hàng</a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <div class="choose">
                                        <ul class="nav nav-pills nav-justified">
                                            <li><a href=""><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                                            <li><a href=""><i class="fa fa-plus-square"></i>Add to compare</a></li>
                                        </ul>
                                    </div> -->
                                </div>
                            </div>
                        @endforeach


                       {{$products->links()}}

                    </div><!--features_items-->
                </div>
            </div>
        </div>
    </section>

@endsection




