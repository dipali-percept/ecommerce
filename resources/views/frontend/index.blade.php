@extends('frontend.front_master')

@section('front_content')

{{-- @dd($bannerList) --}}
<div class="hero-slider">
    @foreach ($bannerList as $item)
        <div class="slider-item th-fullpage hero-area" style="background-image: url({{asset('images/banner').'/'.$item->image }});">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 text-center">
                        <p data-duration-in=".3" data-animation-in="fadeInUp" data-delay-in=".1">{{$item->description}}</p>
                        <h1 data-duration-in=".3" data-animation-in="fadeInUp" data-delay-in=".5">{{$item->title}}<br></h1>
                        <a data-duration-in=".3" data-animation-in="fadeInUp" data-delay-in=".8" class="btn" href="{{route('products.index')}}">Shop Now</a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

</div>

<section class="product-category section">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="title text-center">
					<h2>Product Category</h2>
				</div>
			</div>
            @if($productCategoryList->count() > 0)
            @foreach ($productCategoryList as $item)
			<div class="col-md-6">
				<div class="category-box">
					<a href="{{route('category.product')}}">
                        @php
                            $getImage = App\Models\ProductImage::where('product_id', $item->id)->first();
                        @endphp
						<img src="{{ asset('images/product').'/'.$getImage->images }}" alt="" />
						<div class="content">
							<h3>{{$item->category->name}}</h3>
							<p>{{$item->description}}</p>
						</div>
					</a>
				</div>
			</div>
            @endforeach
            @endif
		</div>
	</div>
</section>

<section class="products section bg-gray">
	<div class="container">
		<div class="row">
			<div class="title text-center">
				<h2>Trendy Products</h2>
			</div>
		</div>
		<div class="row">

            @if($productList->count() > 0)
            @foreach ($productList as $item)
                <div class="col-md-4">
                    <div class="product-item">
                        <div class="product-thumb">
                            <span class="bage">Sale</span>
                            @php
                                $getImage = App\Models\ProductImage::where('product_id', $item->id)->first();
                            @endphp
                            <img class="img-responsive" src="{{ asset('images/product').'/'.$getImage->images }}" alt="product-img" />
                            <div class="preview-meta">
                                <ul>
                                    <li>
                                        <span data-toggle="modal" data-target="#product-modal">
                                            <i class="tf-ion-ios-search-strong"></i>
                                        </span>
                                    </li>
                                    <li>
                                        <a href="#!" ><i class="tf-ion-ios-heart"></i></a>
                                    </li>
                                    <li>
                                        <a href="#!"><i class="tf-ion-android-cart"></i></a>
                                    </li>
                                </ul>
                                </div>
                        </div>
                        <div class="product-content">
                            <h4><a href="product-single.html">{{$item->name}}</a></h4>
                            <p class="price">Rs. {{$item->price}}</p>
                        </div>
                    </div>
                </div>
            @endforeach
            @endif

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
									<img class="img-responsive" src="{{asset('front/images/shop/products/modal-product.jpg')}}" alt="product-img" />
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


<!--
Start Call To Action
==================================== -->
<section class="call-to-action bg-gray section">
	<div class="container">
		<div class="row">
			<div class="col-md-12 text-center">
				<div class="title">
					<h2>SUBSCRIBE TO NEWSLETTER</h2>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugiat, <br> facilis numquam impedit ut sequi. Minus facilis vitae excepturi sit laboriosam.</p>
				</div>
				<div class="col-lg-6 col-md-offset-3">
					<div class="input-group subscription-form">
						<input type="text" class="form-control" placeholder="Enter Your Email Address">
						<span class="input-group-btn">
						<button class="btn btn-main" type="button">Subscribe Now!</button>
						</span>
					</div><!-- /input-group -->
				</div><!-- /.col-lg-6 -->

			</div>
		</div> 		<!-- End row -->
	</div>   	<!-- End container -->
</section>   <!-- End section -->

@endsection
