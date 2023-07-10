@extends('frontend.front_master')

@section('front_content')


<!-- Page Wrapper -->
<section class="page-wrapper success-msg">
    <div class="container">
      <div class="row">
        <div class="col-md-6 col-md-offset-3">
          <div class="block text-center">
              <i class="tf-ion-android-checkmark-circle"></i>
            <h2 class="text-center">Thank you! For your payment</h2>
            {{-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, sed.</p> --}}
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Deserunt ipsa dolores quod eaque. Ipsa autem eius pariatur fugiat, similique dignissimos odit quia odio harum eveniet. Tempore accusamus perferendis minima earum.</p>
            <a href="{{route('product.index')}}" class="btn btn-main mt-20">Continue Shopping</a>
          </div>
        </div>
      </div>
    </div>
  </section><!-- /.page-warpper -->

@endsection
