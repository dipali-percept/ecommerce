@extends('layouts.master')

@section('admin_content')
	<div class="pagetitle">
		<h1>Manage Banner</h1>
		<nav>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
				<li class="breadcrumb-item active">Banner</li>
			</ol>
		</nav>
	</div><!-- End Page Title -->

	<section class="section">
		<div class="row">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title">Banner List</h5>
                        <div class="add_button">
                            <a href="{{route('banner.create')}}">
                                <button type="button" class="btn btn-primary">Add Banner</button>
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
                                    <th scope="col">Start Date</th>
                                    <th scope="col">End Date</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Status</th>
									<th scope="col">Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($banners as $key => $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->start_date }}</td>
                                        <td>{{ $item->end_date }}</td>
                                        <td>{{ $item->title }}</td>
                                        <td><img src="{{asset('images/banner')}}/{{ $item->image }}" height="100px" width="100px"></td>
                                        <td>
                                            @if($item->is_active==1)
                                            <a class="btn btn-success" onclick="return confirm('Are you sure to change banner status?')" href="{{route('banner.changeStatus', $item->id)}}">Active</a>
                                            @else
                                            <a class="btn btn-danger" onclick="return confirm('Are you sure to change banner status?')" href="{{route('banner.changeStatus', $item->id)}}">Inactive</a>
                                            @endif
                                        </td>
                                        <td>
                                            <form action="{{ route('banner.destroy',$item->id) }}" method="POST">
                                                <a class="btn btn-info" href="{{ route('banner.show',$item->id) }}"><i class="bi bi-eye"></i></a>
                                                <a class="btn btn-primary" href="{{ route('banner.edit',$item->id) }}"><i class="bi bi-pencil"></i></a>

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
