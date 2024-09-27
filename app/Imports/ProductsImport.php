<?php

namespace App\Imports;

use App\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ProductsImport implements ToModel, WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Product([
            'product_title'   => $row['product_title'],
            'product_desc'    => $row['product_desc'],
            'price'        	  => $row['price'],
            'old_price'       => $row['old_price'],
            'p_discount'       => $row['p_discount'],
            'quantity'        => $row['quantity'],
            'brand_id'        => $row['brand_id'],
            'category_id'        => $row['category_id'],
            'sub_shop_categorie'        => $row['sub_shop_categorie'],
        ]);
    }
	public function startRow(): int
    {
        return 2;
    }
}
