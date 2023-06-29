@extends('layouts.master')

@section('admin_content')
<div class="pagetitle">
	<h1>Add Sub Category</h1>
		<nav>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
			<li class="breadcrumb-item"><a href="{{route('sub_category.index')}}">Sub Category</a></li>
			<li class="breadcrumb-item active">Add Sub Category</li>
		</ol>
	</nav>
</div><!-- End Page Title -->
<section class="section">
	<div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Sub Category Form</h5>
                    <!-- General Form Elements -->
                    <form method="POST" id="custom_form" action="{{ route('sub_category.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Select Category</label>
                            <div class="col-sm-10">
                                <select name="category_id" id="category_id" class="form-control p_input @error('category_id') is-invalid @enderror" autofocus>
                                    <option value="">Select Category</option>
                                    @foreach ($categories as $value)
                                        <option value="{{$value->id}}" {{ old('category_id') == $value->id ? 'selected' : '' }}>{{ucfirst($value->name)}}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="name" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autocomplete="name">
                                @error('name')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a href="{{route('sub_category.index')}}"><button type="button" class="btn btn-danger">Cancel</button></a>
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
			$("#custom_form").validate({
				rules: {
                    category_id: {required: true},
                    name: {required: true},
				},
			});
		});
	</script>
@endsection
