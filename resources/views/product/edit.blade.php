@extends('product.layout')
   
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Product</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('products.index') }}"> Back</a>
            </div>
        </div>
    </div>
   
    @if ($errors->any())
        <div class="alert alert-danger">
        There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
  
    <form action="{{ route('products.update',$product->id) }}" method="POST">
        @csrf
        @method('PUT')
   
         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Make:</strong>
                    <input type="text" name="make" value="{{ $product->make }}" class="form-control" placeholder="Make">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Model:</strong>
                    <input type="text" name="model" value="{{ $product->model }}" class="form-control" placeholder="Model">
              </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Colour:</strong>
                    <input type="text" name="colour" value="{{ $product->colour }}" class="form-control" placeholder="Colour">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Capacity:</strong>
                    <input type="text" name="capacity" value="{{ $product->capacity }}" class="form-control" placeholder="Capacity">
              </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Network:</strong>
                    <input type="text" name="network" value="{{ $product->network }}" class="form-control" placeholder="Network">
              </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Grade:</strong>
                    <input type="text" name="grade" value="{{ $product->grade }}" class="form-control" placeholder="Grade">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Condition:</strong>
                    <input type="text" name="condition" value="{{ $product->condition }}" class="form-control" placeholder="Condition">
              </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
   
    </form>
@endsection