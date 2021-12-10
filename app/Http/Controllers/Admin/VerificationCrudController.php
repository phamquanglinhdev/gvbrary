<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\VerificationRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Prologue\Alerts\Facades\Alert;

/**
 * Class VerificationCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class VerificationCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Verification::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/verification');
        CRUD::setEntityNameStrings('Xác minh', 'Xác minh');
        $this->crud->denyAccess("show");
        $this->crud->denyAccess("update");
        $this->crud->denyAccess("create");
        $this->crud->denyAccess("delete");
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
        CRUD::addColumn([
            'name' => 'user_id',
            'type' => 'select',
            'entity'=>"User",
            'model'=>"App\Models\User",
            'attribute'=>'name',
        ]);
        CRUD::column('id_card')->label("Số id xác minh");
        CRUD::column('card_image')->type("image")->label("Ảnh");
        CRUD::column('grade')->label("Lớp học");


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
        CRUD::setValidation(VerificationRequest::class);

        CRUD::field('user_id');
        CRUD::field('id_card');
        CRUD::field('card_image');
        CRUD::field('grade');
        CRUD::field('created_at');
        CRUD::field('updated_at');

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
