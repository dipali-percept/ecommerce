@extends('layouts.master')

@section('admin_content')
<div class="pagetitle">
	<h1>Edit Order Status</h1>
		<nav>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
			<li class="breadcrumb-item"><a href="{{route('order_status.index')}}">Order Status</a></li>
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
                    <form method="POST" id="custom_form" action="{{ route('order_status.update', $order_status->id) }}">
                        @csrf
                        @method('patch')
                        <input type="hidden" name="id" value="{{$order_status->id}}">
                        <div class="row mb-3">
                            <label for="name" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $order_status->name) }}" autocomplete="name" autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Update</button>
                                <a href="{{route('order_status.index')}}"><button type="button" class="btn btn-danger">Cancel</button></a>
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
                    name: {required: true},
				},
			});
		});
	</script>
@endsection
