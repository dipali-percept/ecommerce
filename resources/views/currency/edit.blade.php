<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Currency') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="row">
                        <div class="col-lg-12 margin-tb">
                            <div class="pull-left">
                                {{-- <h2>Edit Currency</h2> --}}
                            </div>
                            <div class="pull-right">
                                <a class="btn btn-primary" href="{{ route('currency.index') }}"> Back</a>
                            </div>
                        </div>
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif


                    <form action="{{ route('currency.update',$currency->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Code:</strong>
                                    <input type="text" name="code" value="{{ $currency->code }}" class="form-control" placeholder="Code">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Name:</strong>
                                    <input type="text" name="name" value="{{ $currency->name }}" class="form-control" placeholder="Name">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Symbol:</strong>
                                    <input type="text" name="symbol" value="{{ $currency->symbol }}" class="form-control" placeholder="Symbol">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                <x-primary-button>{{ __('Submit') }}</x-primary-button>
                            </div>
                        </div>


                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>