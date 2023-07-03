@extends('layouts.master')

@section('admin_content')

<div class="pagetitle">
    <h1>Show Post</h1>
		<nav>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
			<li class="breadcrumb-item"><a href="{{ route('posts.index') }}">Post</a></li>
			<li class="breadcrumb-item active">Show Post</li>
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
                            <h5 class="card-title">Post Details</h5>
                            <div class="row">
                                <div class="col-lg-3 col-md-4 label ">User</div>
                                <div class="col-lg-9 col-md-8">{{$post->user->name}}</div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 col-md-4 label ">Title</div>
                                <div class="col-lg-9 col-md-8">{{$post->title}}</div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 col-md-4 label ">Description</div>
                                <div class="col-lg-9 col-md-8">{{$post->description}}</div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 col-md-4 label ">Body</div>
                                <div class="col-lg-9 col-md-8">{!! $post->body !!}</div>
                            </div>
                        </div>
                    </div><!-- End Bordered Tabs -->
                </div>
            </div>
        </div>

    </div>
</section>
@endsection
