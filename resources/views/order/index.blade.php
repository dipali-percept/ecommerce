<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Order') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">




                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif


                    <table class="table table-bordered">
                        <tr>
                            <th>No</th>
                            <th>Image</th>
                            <th>Product Name</th>
                            <th>User Name</th>
                            <th>Price</th>
                            <th>Order Date</th>
                            <th width="280px">Action</th>
                        </tr>
                        {{-- @foreach ($orders as $item)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->name }}</td>
                            <td>
                                <form action="{{ route('orders.destroy',$item->id) }}" method="POST">
                                    <a class="btn btn-info" href="{{ route('orders.show',$item->id) }}">Show</a>
                                    @can('product-edit')
                                    <a class="btn btn-primary" href="{{ route('orders.edit',$item->id) }}">Edit</a>
                                    @endcan

                                    @csrf
                                    @method('DELETE')
                                    @can('product-delete')
                                    <x-danger-button>{{ __('Delete') }}</x-danger-button>
                                    @endcan
                                </form>
                            </td>
                        </tr>
                        @endforeach --}}
                    </table>


                    {!! $orders->links() !!}

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

