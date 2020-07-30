@extends('template')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Update Product</h2>
            </div>
        </div>
    </div>

    <form id="productForm" method="POST">
        @csrf
        <input type="hidden" name="id" class="form-control" value="{{$product->id}}">

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Name:</strong>
                    <p class="help-block err_msg" id="err_name" name="err_name"></p>
                    <input type="text" name="name" class="form-control" placeholder="Name" value="{{$product->name}}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Detail:</strong>
                    <p class="help-block err_msg" id="err_detail" name="err_detail"></p>
                    <textarea class="form-control" style="height:150px" name="detail" placeholder="Detail" >{{$product->detail}}</textarea>
                </div>
            </div>
        </div>
        <input id="image" name="image" type="hidden" value="{{$product->image}}">
    </form>

    <form id="uploadImageForm" name="uploadImageForm" action="{{url('/imageupload')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group col-md-6">
            <label>image</label>
            <p class="help-block err_msg" id="err_image" name="err_image"></p>
            <input type="file"  accept="image/*"  id="uploadImageFile" name="uploadImageFile" style="width:250px;">
            <img class="product-image" id="imagePreview" src="/images/products/{{$product->image}}">
        </div>
    </form>

    <div class="col-md-12 m-t-10">
        <div class="col-xs-6 col-sm-6 col-md-6 float-left">
            <a class="btn btn-primary" href="{{ route('products.index') }}"> Back</a>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6 float-right text-right">
            <button type="button" onclick="saveProduct()" class="btn btn-primary">Submit</button>
        </div>
    </div>
@endsection
