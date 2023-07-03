@extends('layouts.master')

@section('admin_content')

<div class="pagetitle">
    <h1>Show Product</h1>
		<nav>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
			<li class="breadcrumb-item"><a href="{{route('products.index')}}">Product</a></li>
			<li class="breadcrumb-item active">Show Product</li>
        </ol>
    </nav>
</div><!-- End Page Title -->


<section class="section profile">
    <div class="row">

        <div class="col-xl-8">
            <div class="card">
                <div class="card-body pt-3">
                    <div class="tab-content pt-2">
                        <div class="tab-pane fade show active profile-overview" id="profile-overview">
                            <h5 class="card-title">Product Details</h5>
                            <div class="row">
                                <div class="col-lg-3 col-md-4 label ">Category</div>
                                <div class="col-lg-9 col-md-8">{{$product->category->name}}</div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Sub Category</div>
                                <div class="col-lg-9 col-md-8">{{$product->subCategory->name}}</div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Name</div>
                                <div class="col-lg-9 col-md-8">{{$product->name}}</div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Price</div>
                                <div class="col-lg-9 col-md-8">{{$product->price}}</div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Quantity</div>
                                <div class="col-lg-9 col-md-8">{{$product->quantity}}</div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Description</div>
                                <div class="col-lg-9 col-md-8">{{$product->description}}</div>
                            </div>
                        </div>
                    </div><!-- End Bordered Tabs -->
                </div>
            </div>
        </div>

        <div class="col-xl-4">
            <div class="card">
                <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                    @foreach ($getImage as $item)
                        <img src="{{ asset('images/product').'/'.$item->images }}" >
                    @endforeach
                </div>
            </div>
        </div>

    </div>
</section>
@endsection
