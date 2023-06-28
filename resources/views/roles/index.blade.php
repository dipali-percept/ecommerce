@extends('layouts.master')

@section('admin_content')
	<div class="pagetitle">
		<h1>Manage Roles</h1>
		<nav>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
				<li class="breadcrumb-item active">Roles</li>
			</ol>
		</nav>
	</div><!-- End Page Title -->

	<section class="section">
		<div class="row">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title">Roles List</h5>
                        <div class="add_button">
                            <a href="{{route('roles.create')}}">
                                <button type="button" class="btn btn-primary">Add Role</button>
                            </a>
                        </div>

                        @if ($message = Session::get('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{$message}}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        @if ($message = Session::get('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{$message}}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

						<!-- Table with stripped rows -->
						<table class="table datatable">
							<thead>
								<tr>
									<th scope="col">#</th>
									<th scope="col">Name</th>
									<th scope="col">Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($roles as $key => $role)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $role->name }}</td>
                                        <td>
                                            <form action="{{ route('roles.destroy',$role->id) }}" method="POST">
                                                <a class="btn btn-info" href="{{ route('roles.show',$role->id) }}"><i class="bi bi-eye"></i></a>
                                                @can('role-edit')
                                                <a class="btn btn-primary" href="{{ route('roles.edit',$role->id) }}"><i class="bi bi-pencil"></i></a>
                                                @endcan

                                                @csrf
                                                @method('DELETE')
                                                @can('role-delete')
                                                <button type="submit" class="btn btn-danger"><i class="bi bi-trash"></i></button>
                                                @endcan
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
							</tbody>
						</table>
						<!-- End Table with stripped rows -->
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection
