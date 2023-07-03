@extends('layouts.master')

@section('admin_content')
	<div class="pagetitle">
		<h1>Manage Posts</h1>
		<nav>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
				<li class="breadcrumb-item active">Posts</li>
			</ol>
		</nav>
	</div><!-- End Page Title -->

	<section class="section">
		<div class="row">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title">Posts List</h5>
                        <div class="add_button">
                            <a href="{{route('posts.create')}}">
                                <button type="button" class="btn btn-primary">Add Post</button>
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
                                    <th scope="col">Username</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Description</th>
									<th scope="col">Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($posts as $key => $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->user->name }}</td>
                                        <td>{{ $item->title }}</td>
                                        <td>{{ $item->description }}</td>
                                        <td>
                                            <form action="{{ route('posts.destroy',$item->id) }}" method="POST">
                                                <a class="btn btn-info" href="{{ route('posts.show',$item->id) }}"><i class="bi bi-eye"></i></a>
                                                <a class="btn btn-primary" href="{{ route('posts.edit',$item->id) }}"><i class="bi bi-pencil"></i></a>

                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger"><i class="bi bi-trash"></i></button>
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
