@extends('layouts.master')

@section('admin_content')

<div class="pagetitle">
    <h1>Show Banner</h1>
		<nav>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
			<li class="breadcrumb-item"><a href="{{route('banner.index')}}">Banner</a></li>
			<li class="breadcrumb-item active">Show Banner</li>
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
                            <h5 class="card-title">Banner Details</h5>
                            <div class="row">
                                <div class="col-lg-3 col-md-4 label ">Start Date</div>
                                <div class="col-lg-9 col-md-8">{{$banner->start_date}}</div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">End Date</div>
                                <div class="col-lg-9 col-md-8">{{$banner->end_date}}</div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Title</div>
                                <div class="col-lg-9 col-md-8">{{$banner->title}}</div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 col-md-4 label">Description</div>
                                <div class="col-lg-9 col-md-8">{{$banner->description}}</div>
                            </div>
                        </div>
                    </div><!-- End Bordered Tabs -->
                </div>
            </div>
        </div>

        <div class="col-xl-4">
            <div class="card">
                <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                    <img src="{{asset('images/banner')}}/{{ $banner->image }}" >
                </div>
            </div>
        </div>

    </div>
</section>
@endsection
