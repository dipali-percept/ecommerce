<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Country') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="row">
                        <div class="col-lg-12 margin-tb">
                            <div class="pull-left">
                                {{-- <h2>Country</h2> --}}
                            </div>
                            <div class="pull-right">
                                <!-- @can('product-create') -->
                                <a class="btn btn-success" href="{{ route('order_status.create') }}"> Create New Country</a>
                                <!-- @endcan -->
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
                            <th>Name</th>
                            <th width="280px">Action</th>
                        </tr>
                        @foreach ($countries as $product)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $product->name }}</td>
                            <td>
                                <form action="{{ route('order_status.destroy',$product->id) }}" method="POST">
                                    <a class="btn btn-info" href="{{ route('order_status.show',$product->id) }}">Show</a>
                                    @can('product-edit')
                                    <a class="btn btn-primary" href="{{ route('order_status.edit',$product->id) }}">Edit</a>
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


                    {!! $countries->links() !!}

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

