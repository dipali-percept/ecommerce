@extends('frontend.front_master')

@section('front_content')

<section class="page-header">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="content">
					<h1 class="page-name">Product</h1>
					<ol class="breadcrumb">
						<li><a href="{{url('/')}}">Home</a></li>
						<li class="active">Product</li>
					</ol>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="products section">
	<div class="container">
		<div class="row">

            @foreach ($products as $item)
                @php
                    $getImage = App\Models\ProductImage::where('product_id', $item->id)->first();
                @endphp
                <div class="col-md-4">
                    <div class="product-item">
                        <div class="product-thumb">
                            {{-- <span class="bage">Sale</span> --}}
                            <img class="img-responsive" src="{{ asset('images/product').'/'.$getImage->images }}" alt="product-img" />
                            <div class="preview-meta">
                                <ul>
                                    <li>
                                        <span  data-toggle="modal" data-target="#product-modal">
                                            <i class="tf-ion-ios-search-strong"></i>
                                        </span>
                                    </li>
                                    <li>
                                        <a href="{{route('product.wishlist'), $item->id}}" ><i class="tf-ion-ios-heart"></i></a>
                                    </li>
                                    <li>
                                        <a href="{{route('product.cart')}}"><i class="tf-ion-android-cart"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="product-content">
                            <h4><a href="product-single.html">{{$item->name}}</a></h4>
                            <p class="price">₹{{$item->price}}</p>
                        </div>
                    </div>
                </div>
            @endforeach

		<!-- Modal -->
		<div class="modal product-modal fade" id="product-modal">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<i class="tf-ion-close"></i>
			</button>
		  	<div class="modal-dialog " role="document">
		    	<div class="modal-content">
			      	<div class="modal-body">
			        	<div class="row">
			        		<div class="col-md-8 col-sm-6 col-xs-12">
			        			<div class="modal-image">
				        			<img class="img-responsive" src="images/shop/products/modal-product.jpg" alt="product-img" />
			        			</div>
			        		</div>
			        		<div class="col-md-4 col-sm-6 col-xs-12">
			        			<div class="product-short-details">
			        				<h2 class="product-title">GM Pendant, Basalt Grey</h2>
			        				<p class="product-price">$200</p>
			        				<p class="product-short-description">
			        					Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rem iusto nihil cum. Illo laborum numquam rem aut officia dicta cumque.
			        				</p>
			        				<a href="cart.html" class="btn btn-main">Add To Cart</a>
			        				<a href="product-single.html" class="btn btn-transparent">View Product Details</a>
			        			</div>
			        		</div>
			        	</div>
			        </div>
		    	</div>
		  	</div>
		</div><!-- /.modal -->

		</div>
	</div>
</section>

@endsection
