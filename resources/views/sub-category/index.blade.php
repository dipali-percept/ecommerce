<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Sub Category') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="row">
                        <div class="col-lg-12 margin-tb">
                            <div class="pull-left">
                                {{-- <h2>Sub Category</h2> --}}
                            </div>
                            <div class="pull-right">
                                @can('product-create')
                                <a class="btn btn-success" href="{{ route('sub_category.create') }}"> Create New Sub Category</a>
                                @endcan
                            </div>
                        </div>
                    </div>


                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif


                    <table class="table table-bordered">
                        <tr>
                            <th>No</th>
                            <th>Category</th>
                            <th>Name</th>
                            <th width="280px">Action</th>
                        </tr>
                        @foreach ($sub_categories as $product)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $product->category->name }}</td>
                            <td>{{ $product->name }}</td>
                            <td>
                                <form action="{{ route('sub_category.destroy',$product->id) }}" method="POST">
                                    <a class="btn btn-info" href="{{ route('sub_category.show',$product->id) }}">Show</a>
                                    @can('product-edit')
                                    <a class="btn btn-primary" href="{{ route('sub_category.edit',$product->id) }}">Edit</a>
                                    @endcan


                                    @csrf
                                    @method('DELETE')
                                    @can('product-delete')
                                    <x-danger-button>{{ __('Delete') }}</x-danger-button>
                                    @endcan
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </table>


                    {!! $sub_categories->links() !!}

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
