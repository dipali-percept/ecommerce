@extends('layouts.master')

@section('admin_content')

<div class="pagetitle">
    <h1>Show Sub Category</h1>
		<nav>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
			<li class="breadcrumb-item"><a href="{{ route('sub_category.index') }}">Sub Category</a></li>
			<li class="breadcrumb-item active">Show Sub Category</li>
        </ol>
    </nav>
</div><!-- End Page Title -->


<section class="section profile">
    <div class="row">

        <div class="col-md-12">
            <div class="card">
                <div class="card-body pt-3">
                    <div class="tab-content pt-2">
                        <div class="tab-pane fade show active profile-overview" id="profile-overview">
                            <h5 class="card-title">Sub Category Details</h5>
                            <div class="row">
                                <div class="col-lg-3 col-md-4 label ">Category</div>
                                <div class="col-lg-9 col-md-8">{{$sub_category->category->name}}</div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 col-md-4 label ">Name</div>
                                <div class="col-lg-9 col-md-8">{{$sub_category->name}}</div>
                            </div>
                        </div>
                    </div><!-- End Bordered Tabs -->
                </div>
            </div>
        </div>

    </div>
</section>
@endsection
