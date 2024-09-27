<?php

namespace App\Imports;

use App\Product;
use App\Seller_area;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;

class PincodeImport implements ToModel, WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Seller_area([
            'pincode'   => $row['pincode'],
        ]);
    }
	public function startRow(): int
    {
        return 2;
    }
}
