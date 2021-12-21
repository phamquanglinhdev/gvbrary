<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ProductRequest;
use App\Mail\ProductStatusMail;
use App\Mail\RequestBook;
use App\Models\Product;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Support\Facades\Mail;

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
        $this->crud->addButtonFromModelFunction("line", "viewOnWeb", "viewOnWeb", "line");
        $this->crud->denyAccess("show");
        $this->crud->addButtonFromModelFunction("top","guide","guide","top");
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        if (backpack_user()->role != 0) {
            $this->crud->addClause("where", "published_id", "=", backpack_user()->id);
        }
        CRUD::column('name')->label("Tên sách");
        CRUD::addColumn(
            [   // relationship
                'type' => "relationship",
                'name' => 'Tags', // the method on your model that defines the relationship

                // OPTIONALS:
                'label' => "Thể loại ấn phẩm",
                'attribute' => "name",
                'entity' => 'Tags', // the method that defines the relationship in your Model
                'model' => "App\Models\Tag", // foreign key Eloquent model
                'placeholder' => "Chọn nhiều", // placeholder for the select2 input
            ]
        );
        CRUD::column('price')->label("Giá thuê");
        CRUD::column('status')->label("Trạng thái")->type("select_from_array")->options(["Còn sách", "Hết sách","Đang chờ duyệt","Bị từ chối"]);
        CRUD::column('main_thumbnail')->type("image")->label("Ảnh");
        CRUD::addColumn([
            'name' => 'category_id',
            'label' => 'Danh mục',
            'type' => 'select',
            'entity' => 'Category',
            'model' => 'App\Models\Category',
            'attribute' => "name",
        ]);
        CRUD::addColumn([
            'name' => 'published_id',
            'label' => 'Chủ sở hữu',
            'type' => 'select',
            'entity' => 'Published',
            'model' => 'App\Models\User',
            'attribute' => 'name',
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
    protected function setupCreateOperation($mode = 0)
    {
        CRUD::setValidation(ProductRequest::class);
        CRUD::field('name')->label("Tên sách");
        CRUD::addField(
            [   // relationship
                'type' => "relationship",
                'name' => 'Tags', // the method on your model that defines the relationship

                // OPTIONALS:
                'label' => "Thể loại ấn phẩm",
                'attribute' => "name",
                'entity' => 'Tags', // the method that defines the relationship in your Model
                'model' => "App\Models\Tag", // foreign key Eloquent model
                'placeholder' => "Chọn nhiều", // placeholder for the select2 input
            ]
        );
        CRUD::field('price')->label("Giá cho thuê")->attributes(["placeholder" => "Để trống nếu miễn phí cho thuê"]);
        CRUD::field('description')->type("ckeditor")->label("Giới thiệu về sách");
        if (backpack_user()->role > 1) {
            if ($mode == 1) {
                CRUD::field('status')->label("Trạng thái")->type("select_from_array")->options(["Còn sách", "Hết sách"]);
            } else {
                CRUD::field('status')->label("Trạng thái")->type("hidden")->value(2);
            }
        }else{
            CRUD::field('status')->label("Trạng thái")->type("select_from_array")->options(["Còn sách", "Hết sách"]);
        }
        CRUD::addField([
            'name' => 'first_thumbnail',
            'label'=>'Ảnh bìa thứ nhất',
            'type' => 'image',
            'crop' => true,
            'aspect_ratio' => 2,
        ]);
        CRUD::addField([
            'name' => 'second_thumbnail',
            'label'=>'Ảnh bìa thứ hải',
            'type' => 'image',
            'crop' => true,
            'aspect_ratio' => 2,
        ]);
        CRUD::addField([
            'name' => 'main_thumbnail',
            'label'=>'Ảnh bìa chính',
            'type' => 'image',
            'crop' => true,
            'aspect_ratio' => 1,
        ]);
        CRUD::field("slug")->type("hidden")->value("a");

        if(backpack_user()->role==-1){
            CRUD::addField([
                'name' => 'category_id',
                'type' => "hidden",
                'value'=>1,
            ]);
        }
        if(backpack_user()->role>1){
            CRUD::addField([
                'name' => 'category_id',
                'type' => "hidden",
                'value'=>2,
            ]);
        }
        if(backpack_user()->role<=1){
            CRUD::addField([
                'name' => 'category_id',
                'label' => 'Danh mục',
                'type' => 'select',
                'entity' => 'Category',
                'model' => 'App\Models\Category',
                'attribute' => "name"
            ]);
        }

        CRUD::addField([
            'name' => 'published_id',
            'type' => 'hidden',
            'value' => backpack_user()->id,
        ]);



        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number']);
         */
    }

    /**
     * Define what happens when the Update operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|void
     */
    public function draft()
    {
        $products = Product::where("status", "=", 2)->get();
        return view("vendor.backpack.page.draft", ['products' => $products]);
    }

    public function showDraft($slug)
    {
        $product = Product::where("slug", "=", $slug)->first();
        return view("client.product-draft", ['product' => $product]);
    }

    public function acceptDraft($id)
    {
        $product=Product::find($id);
        $product->update(['status' => 0]);
        Mail::to($product->Published()->first()->email)->send(new ProductStatusMail(0,$product->name));
        return redirect()->back()->with("success", "Thành công");
    }

    public function denyDraft($id)
    {
        $product=Product::find($id);
        $product->update(['status' => 3]);
        Mail::to($product->Published()->first()->email)->send(new ProductStatusMail(3,$product->name));
        return redirect()->back()->with("danger", "Xóa thành công");
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation(1);
    }
}
