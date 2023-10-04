<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Imports\ProductImport;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = product::latest()->paginate(1000);
        //$products = DB::table('products')->select('make','model','colour','capacity','network','grade','condition', DB::raw('count(*) as count'))->groupBy('make')->get();
        /*$products = [];
        $columns = [
            'make' => 'make',
            'model' => 'model',
            'colour' => 'colour',
            'capacity' => 'capacity',
            'network' => 'network',
            'grade' => 'grade',
            // put your other columns in this array
        ];

        foreach($columns as $name => $column)
           $products[$name] = DB::table('products')->select($column, DB::raw('count(' . $column . ') as total'))->groupBy($column)->toSql();
        */
        return view('product.index',compact('products'))->with('i', (request()->input('page', 1) - 1) * 1000);

    }

    public function import(Request $request)
    {
      $this->validate($request, [
        'select_file' => 'required|mimes:xls,xlsx,csv'
      ]);
      $path = $request->file('select_file')->getRealPath();
      //$data = Excel::load($path)->get();
      $data = Excel::import(new ProductImport,$path);
      
        foreach($data->toArray() as $key =>$value)
        {
            foreach($value as $row)
            {
                $insert_data[]=array(
                    'make' => $row['brand_name'],
                    'model' => $row['model_name'],
                    'colour' => $row['colour_name'],
                    'capacity' => $row['gb_spec_name'],
                    'network' => $row['network_name'],
                    'grade' => $row['grade_name'],
                    'condition' => $row['condition_name'],
                );
            }
        
        if(!empty($insert_data))
        {
            DB::table('products')->insert($insert_data);
        }
      }
      return back()->with('success','Product Data Imported Sucessfully');
    }

    public function oldimport(Request $request)
    {
        $this->validate($request, [
            'select_file' => 'required|mimes:xls,xlsx,csv'
          ]);

        $file = $request->file('select_file');
        if($file){
            $path = $file->getRealPath();
            $data = Excel::load($path, function($reader) {
            })->get();
            if(!empty($data) && $data->count()){
                foreach ($data as $key => $value) {
                    $insert[] = ['make' => $value->make, 'model' => $value->model,'colour' => $value->colour, 'capacity' => $value->capacity, 'network' => $value->network, 'grade' => $value->grade, 'condition' => $value->condition];
                }
                if(!empty($insert)){
                    DB::table('products')->insert($insert);
                //  dd('Insert Record successfully.');
                }
            }
        } 
        return back()->with('success','Product Data Imported Sucessfully');

    }

    /*public function import(Request $request){

        $this->validate($request, ['select_file' => 'required|mimes:xls,xlsx,csv']);
        try
        {
            Excel::import(new ProductImport,request()->file('select_file'));
            return back()->withSuccess('Product Data imported successfully.');
        }
        catch(\Exception $ex)
        {
            return back()->withError('Someting went wrong please try again.');
        } 
    }*/

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //return view('product.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'make' => 'required',
            'model' => 'required',
        ]);
    
        product::create($request->all());
     
        return redirect()->route('product.index')->with('success','Product created successfully.');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(product $product)
    {
        return view('product.show',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(product $product)
    {
        return view('product.edit',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, product $product)
    {
        $request->validate([
            'make' => 'required',
            'model' => 'required',
        ]);
    
        $product->update($request->all());
    
        return redirect()->route('product.index')->with('success','Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(product $product)
    {
        $product->delete();
        return redirect()->route('product.index')->with('success','Product deleted successfully');

    }
}
