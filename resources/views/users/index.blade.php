@extends('layouts.master')

@section('admin_content')
	<div class="pagetitle">
		<h1>Manage Users</h1>
		<nav>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
				<li class="breadcrumb-item active">Users</li>
			</ol>
		</nav>
	</div><!-- End Page Title -->

	<section class="section">
		<div class="row">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title">Users List</h5>
                        <div class="add_button">
                            <a href="{{route('users.create')}}">
                                <button type="button" class="btn btn-primary">Add User</button>
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
									<th scope="col">Profile Image</th>
                                    <th scope="col">Name</th>
									<th scope="col">Email</th>
									<th scope="col">Roles</th>
									<th scope="col">Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($data as $key => $user)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td><img src="{{asset('images/user')}}/{{ $user->profile_image }}" height="100px" width="100px"></td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            @if(!empty($user->getRoleNames()))
                                                @foreach($user->getRoleNames() as $v)
                                                    <span class="badge bg-warning">{{ $v }}</span>
                                                @endforeach
                                            @endif
                                        </td>
                                        <td>
                                            <form action="{{ route('users.destroy',$user->id) }}" method="POST">
                                                <a class="btn btn-info" href="{{ route('users.show',$user->id) }}"><i class="bi bi-eye"></i></a>
                                                @can('user-edit')
                                                <a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}"><i class="bi bi-pencil"></i></a>
                                                @endcan

                                                @csrf
                                                @method('DELETE')
                                                @can('user-delete')
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
