@extends('layouts.master')

@section('admin_content')
	<div class="pagetitle">
		<h1>View Category wise Product</h1>
		<nav>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('categories.index')}}">Category</a></li>
				<li class="breadcrumb-item active">Category wise Product</li>
			</ol>
		</nav>
	</div><!-- End Page Title -->

	<section class="section">
		<div class="row">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title">Category wise Product List</h5>
                        <div class="add_button">
                            <a href="{{route('categories.index')}}">
                                <button type="button" class="btn btn-primary">Back</button>
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
                                    <th scope="col">Image</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Sub Category</th>
									<th scope="col">Name</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Quantity</th>
									{{-- <th scope="col">Action</th> --}}
								</tr>
							</thead>
							<tbody>
								@foreach ($products as $key => $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            @php
                                                $getImage = App\Models\ProductImage::where('product_id', $item->id)->first();
                                            @endphp
                                            <img src="{{ asset('images/product').'/'.$getImage->images }}" height="100px" width="100px">
                                        </td>
                                        <td>{{ $item->category->name }}</td>
                                        <td>{{ $item->subCategory->name }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->price }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        {{-- <td>
                                            <form action="{{ route('products.destroy',$item->id) }}" method="POST">
                                                <a class="btn btn-info" href="{{ route('products.show',$item->id) }}"><i class="bi bi-eye"></i></a>
                                                <a class="btn btn-primary" href="{{ route('products.edit',$item->id) }}"><i class="bi bi-pencil"></i></a>

                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger"><i class="bi bi-trash"></i></button>
                                            </form>
                                        </td> --}}
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
