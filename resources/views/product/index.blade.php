@extends('template')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Products</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active">Products</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="float-right">
                @if(in_array('ProductController@create',Auth::user()->permissions))
                    <a class="btn btn-success" href="{{ route('products.create') }}"> Create New Product</a>
                @endif
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
            <th>Image</th>

            <th>Name</th>

            <th>Details</th>

            <th width="280px">Action</th>

        </tr>

        @foreach ($products as $product)
            <tr>
                <td><img class="product-image" src="/images/products/{{ $product->image }}"></td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->detail }}</td>
                <td>
                    <form action="{{ route('products.destroy',$product->id) }}" method="POST">
                        <a class="btn btn-info" href="{{ route('products.show',$product->id) }}">Show</a>

                        @if(in_array('ProductController@edit',Auth::user()->permissions))
                            <a class="btn btn-primary" href="{{ route('products.edit',$product->id) }}">Edit</a>
                        @endif

                        @csrf
                    @if(in_array('ProductController@destroy',Auth::user()->permissions))
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        @endif

                    </form>

                </td>

            </tr>

        @endforeach

    </table>



    {!! $products->links() !!}



@endsection
