@extends('layouts.master')

@section('admin_content')
<div class="pagetitle">
	<h1>Add Product</h1>
		<nav>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
			<li class="breadcrumb-item"><a href="{{route('products.index')}}">Product</a></li>
			<li class="breadcrumb-item active">Add Product</li>
		</ol>
	</nav>
</div><!-- End Page Title -->
<section class="section">
	<div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Product Form</h5>
                    <!-- General Form Elements -->
                    <form method="POST" id="custom_form" action="{{ route('products.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Category</label>
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
                            <label class="col-sm-2 col-form-label">Sub Category</label>
                            <div class="col-sm-10">
                                <select name="sub_category_id" id="sub_category_id" class="form-control p_input @error('sub_category_id') is-invalid @enderror" autofocus>
                                    {{-- <option value="">Select Sub Category</option>
                                    @foreach ($sub_categories as $value)
                                        <option value="{{$value->id}}" {{ old('sub_category_id') == $value->id ? 'selected' : '' }}>{{ucfirst($value->name)}}</option>
                                    @endforeach --}}
                                </select>
                                @error('sub_category_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="name" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autocomplete="name" autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="price" class="col-sm-2 col-form-label">Price</label>
                            <div class="col-sm-10">
                                <input id="price" type="text" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}" autocomplete="price">
                                @error('price')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="quantity" class="col-sm-2 col-form-label">Quantity</label>
                            <div class="col-sm-10">
                                <input id="quantity" type="text" class="form-control @error('quantity') is-invalid @enderror" name="quantity" value="{{ old('quantity') }}" autocomplete="quantity">
                                @error('quantity')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="description" class="col-sm-2 col-form-label">Description</label>
                            <div class="col-sm-10">
                                <input id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') }}" autocomplete="description">
                                @error('description')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="images" class="col-sm-2 col-form-label">Upload Image</label>
                            <div class="col-sm-10">
                                <input id="images" type="file" class="form-control @error('images') is-invalid @enderror" name="images[]" value="{{ old('images') }}" autocomplete="images" multiple>
                                @error('images')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a href="{{route('products.index')}}"><button type="button" class="btn btn-danger">Cancel</button></a>
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
                    sub_category_id: {required: true},
                    name: {required: true},
                    description: {required: true},
                    price: {required: true},
                    quantity: {required: true},
                    'images[]': {required: true},
				},
			});


            $('#category_id').on('change', function () {
                var idCategory = this.value;
                $("#sub_category_id").html('');
                $.ajax({
                    url: "{{route('products.getSubCategory') }}",
                    type: "POST",
                    data: {
                        category_id: idCategory,
                        _token: '{{csrf_token()}}'
                    },
                    dataType: 'json',
                    success: function (res) {
                        $('#sub_category_id').html('<option value="">-- Select Sub Category --</option>');
                        $.each(res, function (key, value) {
                            $("#sub_category_id").append('<option value="' + value
                                .id + '">' + value.name + '</option>');
                        });
                    }
                });
            });



		});
	</script>
@endsection
