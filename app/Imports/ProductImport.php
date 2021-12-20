<?php

namespace App\Imports;

use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToCollection;
//use Maatwebsite\Excel\Concerns\ToModel;

class ProductImport implements ToCollection
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $key => $row)
        {
            if($key != 0){
                Product::create([
                    'name' => $row[0],
                    'price' => $row[1],
                    'first_thumbnail' => $row[2],
                    'second_thumbnail' => $row[3],
                    'main_thumbnail' => $row[4],
                    'description' => $row[5],
                    'category_id' => 1,
                    'slug'=>Str::slug($row[0],"-")."aspx",
                    'published_id' => backpack_user()->id,
                    'status' => 0,
                ]);
            }
        }
    }
}
