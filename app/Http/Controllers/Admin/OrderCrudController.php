<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\OrderRequest;
use App\Models\Request;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class OrderCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class OrderCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Order::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/order');
        CRUD::setEntityNameStrings('order', 'orders');
        $this->crud->denyAccess("create");
        $this->crud->denyAccess("show");
        $this->crud->denyAccess("update");
        $this->crud->denyAccess("delete");
        $this->crud->enableDetailsRow();
        $this->crud->enableExportButtons();
        $this->crud->addButtonFromModelFunction("line","AcceptOrder","AcceptOrder","line");
        $this->crud->addButtonFromModelFunction("line","DoneOrder","DoneOrder","line");
        $this->crud->addButtonFromModelFunction("line","CancelOrder","CancelOrder","line");
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
            'name' => 'customer_id',
            'type' => 'select',
            'entity'=>'Customer',
            'model'=>'App\Models\User',
            'attribute'=>'name',
        ]);
        CRUD::column('address')->label("Địa chỉ");
        CRUD::column('phone')->label("Số điện thoại");
        CRUD::column('payment_method')->label("Phương thức thanh toán")->type("select_from_array")->options(["GVB Coin","Trả khi nhận hàng"]);
        CRUD::column('status')->label("Trạng thái")->type("select_from_array")->options(["Đang chờ","Đã xác nhận","Đã giao","Đã hủy"]);

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
        CRUD::setValidation(OrderRequest::class);

        CRUD::field('id');
        CRUD::field('customer_id');
        CRUD::field('address');
        CRUD::field('phone');
        CRUD::field('note');
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
    public function showDetailsRow($id)
    {
        $items = Request::where("order_id","=",$id)->get();
        return view("client.detail",["items"=>$items]);
    }
}
