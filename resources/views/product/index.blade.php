@extends('product.layout')
 
@section('content')
<div class="form-group">
    <h3 align="Center">Import File for Product</h3>
    @if (count($errors) > 0)
        <div class="alert alert-danger">
             Upload Validation Error <br><br>
             <ul>
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
             </ul>
        </div>
    @endif
    
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert"> X </button>
            <strong>{{ $message }}</strong>
        </div>
    @endif
    <br/>
    <form method="post" enctype="multipart/form-data" action="{{route('import')}}">
    {{ csrf_field() }}
    <div class="form-group">
        <table class="table">
            <tr>
                <td width="40%" align="right"><label> Select for upload</label></td>
                <td width="30%">
                    <input type="file" name="select_file" class="form-control"/>
                </td>
                <td width="30%" align="left">
                    <input type="submit" name="upload" class="btn btn-primary" value="Upload">
                </td>
            </tr>
            <tr>
                <td width="40%" align="right"></td>
                <td width="30%">
                    <span class="text-muted"> .csv,.xls,.xlsx</span>
                </td>
                <td width="30%" align="left"></td>
            </tr>

        </table>

    </div>
    </form>

  
    <br />
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-left">
                    <h3 class="panel-title"> Product Data </h3>
                    </div>
                    <!-- <div class="pull-right">
                        <a class="btn btn-success" href="{{ route('products.create') }}"> Create New Product</a>
                    </div>-->
                </div>
            </div>
  
        </div>
        <div class="panel-body">
            <div class="table-responsive">             
                <table class="table table-bordered table-striped">
                    <tr>
                        <th>No</th>
                        <th>Make</th>
                        <th>Model</th>
                        <th>Colour</th>
                        <th>Capacity</th>
                        <th>Network</th>
                        <th>Grade</th>
                        <th>Condition</th>
                        <th>Count</th>
                       
                        <!--<th width="280px">Action</th> -->
                    </tr>
                    @foreach ($products as $product)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $product->make }}</td>
                        <td>{{ $product->model }}</td>
                        <td>{{ $product->colour }}</td>
                        <td>{{ $product->capacity }}</td>
                        <td>{{ $product->network }}</td>
                        <td>{{ $product->grade }}</td>
                        <td>{{ $product->condition }}</td>
                        <td></td>
                       <!-- <td>
                            <form action="{{ route('products.destroy',$product->id) }}" method="POST">
                                <a class="btn btn-primary" href="{{ route('products.edit',$product->id) }}">Edit</a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td> -->
                    </tr>
                    @endforeach
                </table>
            
            </div>
        </div>

    </div>
 
   
    {!! $products->links() !!}
    </div>        

@endsection