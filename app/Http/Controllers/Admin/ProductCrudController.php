<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ProductRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ProductCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ProductCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Product::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/product');
        CRUD::setEntityNameStrings('Ấn phẩm', 'Các ấn phẩm');
        $this->crud->addButtonFromModelFunction("line","viewOnWeb","viewOnWeb","line");
        $this->crud->denyAccess("show");
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        if(backpack_user()->role!=0){
            $this->crud->addClause("where","published_id","=",backpack_user()->id);
        }
        CRUD::column('name')->label("Tên sách");
        CRUD::column('price')->label("Giá thuê");
        CRUD::column('status')->label("Trạng thái")->type("select_from_array")->options(["Chưa được mượn", "Đã mượn"]);
        CRUD::column('main_thumbnail')->type("image")->label("Ảnh");
        CRUD::addColumn([
            'name' => 'category_id',
            'label'=>'Danh mục',
            'type' => 'select',
            'entity'=>'Category',
            'model'=>'App\Models\Category',
            'attribute'=>"name",
        ]);
        CRUD::addColumn([
            'name' => 'published_id',
            'label'=>'Chủ sở hữu',
            'type' => 'select',
            'entity'=>'Published',
            'model'=>'App\Models\User',
            'attribute'=>'name',
        ]);

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']);
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(ProductRequest::class);


        CRUD::field('name')->label("Tên sách");
        CRUD::field('price')->label("Giá cho thuê")->attributes(["placeholder"=>"Để trống nếu miễn phí cho thuê"]);
        CRUD::field('description')->type("ckeditor")->label("Giới thiệu về sách");
        CRUD::field('status')->label("Trạng thái")->type("select_from_array")->options(["Chưa được mượn", "Đã mượn"]);
        CRUD::field('first_thumbnail')->type("image")->label("Ảnh bìa thứ nhất (Nên chọn ảnh bìa rộng)");
        CRUD::field('second_thumbnail')->type("image")->label("Ảnh bìa thứ hai (Nên chọn ảnh bìa rộng)");
        CRUD::field('main_thumbnail')->type("image")->label("Ảnh sản phẩm (Nên chọn ảnh dọc)");
        CRUD::field("slug")->type("hidden")->value("a");
        CRUD::addField([
            'name' => 'category_id',
            'label'=>'Danh mục',
            'type' => 'select',
            'entity'=>'Category',
            'model'=>'App\Models\Category',
            'attribute'=>"name"
        ]);
       if(backpack_user()->role!=0){
           CRUD::addField([
               'name' => 'published_id',
               'type'=>'hidden',
               'value'=>backpack_user()->id,
           ]);

       }
        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number']));
         */
    }

    /**
     * Define what happens when the Update operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
