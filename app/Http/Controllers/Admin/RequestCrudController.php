<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\RequestRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Prologue\Alerts\Facades\Alert;

/**
 * Class RequestCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class RequestCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Request::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/request');
        CRUD::setEntityNameStrings('Yêu cầu', 'Các yêu cầu');
        $this->crud->denyAccess("delete");
        $this->crud->denyAccess("show");
        $this->crud->denyAccess("create");
        $this->crud->denyAccess("update");
        $this->crud->addButtonFromModelFunction("line","acceptRequest","acceptRequest","line");
        $this->crud->addButtonFromModelFunction("line","cancelRequest","cancelRequest","line");
        if(session("success")){
            Alert::success("Đã đồng ý");
        }
        if(session("fail")){
            Alert::error("Đã từ chối");
        }
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        $this->crud->addClause("where","owner_id","=",backpack_user()->id);
        $this->crud->addClause("where","status","=",1);
        CRUD::addColumn([
            'name' => 'product_id',
            'label'=>'Ấn phẩm',
            'type' => 'select',
            'entity'=>'Product',
            'model'=>'App\Models\Product',
            'attribute'=>"name",
        ]);
        CRUD::addColumn([
            'name' => 'user_id',
            'label'=>'Người mượn',
            'type' => 'select',
            'entity'=>'User',
            'model'=>'App\Models\User',
            'attribute'=>"name",
        ]);
        CRUD::column('expiry')->label("Hạn mượn mong muốn");
        CRUD::column('status')->type("select_from_array")->options(["Đồng ý","Đang chờ","Không đồng ý"])->label("Quyết định của chủ sở hữu");



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
        CRUD::setValidation(RequestRequest::class);

        CRUD::field('status')->type("select_from_array")->options(["Đồng ý","Đang chờ","Không đồng ý"])->label("Quyết định của chủ sở hữu");

        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::addField('price')->type('number');
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
