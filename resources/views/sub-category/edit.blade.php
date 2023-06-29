@extends('layouts.master')

@section('admin_content')
<div class="pagetitle">
	<h1>Edit Order Status</h1>
		<nav>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
			<li class="breadcrumb-item"><a href="{{route('sub_category.index')}}">Order Status</a></li>
			<li class="breadcrumb-item active">Edit Order Status</li>
		</ol>
	</nav>
</div><!-- End Page Title -->
<section class="section">
	<div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Order Status Form</h5>
                    <!-- General Form Elements -->
                    <form method="POST" id="custom_form" action="{{ route('sub_category.update', $sub_category->id) }}">
                        @csrf
                        @method('patch')
                        <input type="hidden" name="id" value="{{$sub_category->id}}">
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Select Category</label>
                            <div class="col-sm-10">
                                <select name="category_id" id="category_id" class="form-control p_input @error('category_id') is-invalid @enderror" autofocus>
                                    <option value="">Select Category</option>
                                    @foreach ($categories as $value)
                                        <option value="{{$value->id}}" {{ old('category_id', $sub_category->category_id) == $value->id ? 'selected' : '' }}>{{ucfirst($value->name)}}</option>
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
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $sub_category->name) }}" autocomplete="name">
                                @error('name')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Update</button>
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
	<script>
		$(document).ready(function() {
			$("#custom_form").validate({
				rules: {
                    name: {required: true},
				},
			});
		});
	</script>
@endsection
