@extends('layouts.master')

@section('admin_content')
<div class="pagetitle">
	<h1>Edit Role</h1>
		<nav>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
			<li class="breadcrumb-item"><a href="{{route('roles.index')}}">Roles</a></li>
			<li class="breadcrumb-item active">Edit Role</li>
		</ol>
	</nav>
</div><!-- End Page Title -->
<section class="section">
	<div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Role Form</h5>
                    <!-- General Form Elements -->
                    <form method="POST" id="custom_form" action="{{ route('roles.update', $role->id) }}">
                        @csrf
                        @method('patch')
                        <input type="hidden" name="id" value="{{$role->id}}">
                        <div class="row mb-3">
                            <label for="name" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $role->name) }}" autocomplete="name" autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="email" class="col-sm-2 col-form-label">Permission</label>
                            <div class="col-sm-10">
                                @foreach($permission as $value)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="permission" name="permission[]" value="{{$value->id}}" {{in_array($value->id, $rolePermissions) ? 'checked' : ''}}>
                                    <label class="form-check-label" for="gridCheck1">
                                        {{ $value->name }}
                                    </label>
                                </div>
                                @endforeach
                                @error('permission')
                                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Update</button>
                                <a href="{{route('roles.index')}}"><button type="button" class="btn btn-danger">Cancel</button></a>
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
                    'permission[]': {required: true},
				},
			});
		});
	</script>
@endsection
