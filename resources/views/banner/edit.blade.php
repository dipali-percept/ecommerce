@extends('layouts.master')

@section('admin_content')
<div class="pagetitle">
	<h1>Edit Banner</h1>
		<nav>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
			<li class="breadcrumb-item"><a href="{{route('banner.index')}}">Banner</a></li>
			<li class="breadcrumb-item active">Edit Banner</li>
		</ol>
	</nav>
</div><!-- End Page Title -->
<section class="section">
	<div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Banner Form</h5>
                    <!-- General Form Elements -->
                    <form method="POST" id="custom_form" action="{{ route('banner.update', $banner->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('patch')
                        <input type="hidden" name="id" value="{{$banner->id}}">
                        <div class="row mb-3">
                            <label for="start_date" class="col-sm-2 col-form-label">Start Date</label>
                            <div class="col-sm-10">
                                <input id="start_date" type="date" class="form-control @error('start_date') is-invalid @enderror" name="start_date" value="{{ old('start_date', $banner->start_date) }}" autocomplete="start_date" autofocus>
                                @error('start_date')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="end_date" class="col-sm-2 col-form-label">End Date</label>
                            <div class="col-sm-10">
                                <input id="end_date" type="date" class="form-control @error('end_date') is-invalid @enderror" name="end_date" value="{{ old('end_date', $banner->end_date) }}" autocomplete="end_date">
                                @error('end_date')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="title" class="col-sm-2 col-form-label">Title</label>
                            <div class="col-sm-10">
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title', $banner->title) }}" autocomplete="title">
                                @error('title')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="description" class="col-sm-2 col-form-label">Description</label>
                            <div class="col-sm-10">
                                <input id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description', $banner->description) }}" autocomplete="description">
                                @error('description')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="image" class="col-sm-2 col-form-label">Upload Image</label>
                            <div class="col-sm-10">
                                <input id="image" type="file" class="form-control @error('image') is-invalid @enderror" name="image">
                                <img src="{{asset('images/banner')}}/{{ $banner->image }}" height="100px" width="100px">
                                @error('image')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Update</button>
                                <a href="{{route('banner.index')}}"><button type="button" class="btn btn-danger">Cancel</button></a>
                            </div>
                        </div>
                    </form><!-- End General Form Elements -->
                </div>
            </div>
        </div>
	</div>
</section>
@endsection


@section('custom_script')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
	<script>
		$(document).ready(function() {
            jQuery.validator.addMethod("greaterThan", function(value, element, params) {
                if (!/Invalid|NaN/.test(new Date(value))) {
                    return new Date(value) > new Date($(params).val());
                }
                return isNaN(value) && isNaN($(params).val()) || (Number(value) > Number($(params).val()));
            },'The end date field must be a date after start date.');

			$("#custom_form").validate({
				rules: {
					start_date: {required: true},
                    end_date: {required: true, greaterThan: "#start_date"},
                    title: {required: true},
                    description: {required: true},
                    image: {required: true},
				},
			});
		});
	</script>
@endsection
