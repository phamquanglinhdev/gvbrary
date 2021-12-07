<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'name'=>'Thư viện trường',
            'slug'=>"thu-vien-truong.aspx",
        ];
        Category::create($data);
        $data = [
            'name'=>'Sách của thành viên',
            'slug'=>"sach-cua-thanh-vien.aspx",
        ];
        Category::create($data);
        $data = [
            'name'=>'Sách miễn phí',
            'slug'=>"sach-mien-phi.aspx",
        ];
        Category::create($data);
        $data = [
            'name'=>'Ebook và sách nói',
            'slug'=>"ebook-va-sach-noi.aspx",
        ];
        Category::create($data);
    }
}
