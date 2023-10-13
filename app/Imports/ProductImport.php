<?php

namespace App\Imports;

use App\Models\product;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Facades\Validator;  


class ProductImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public function model(array $row)
    {
        return new product([
            'make' => $row['brand_name'],
            'model' => $row['model_name'],
            'colour' => $row['colour_name'],
            'capacity' => $row['gb_spec_name'],
            'network' => $row['network_name'],
            'grade' => $row['grade_name'],
            'condition_details' => $row['condition_name'],

        ]);
    }
}
