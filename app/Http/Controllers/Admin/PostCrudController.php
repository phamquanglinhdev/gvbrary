<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Http\Request;
use Prologue\Alerts\Facades\Alert;

/**
 * Class PostCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class PostCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Post::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/post');
        CRUD::setEntityNameStrings('Bài viết', 'Các bài viết');
        $this->crud->addButtonFromModelFunction("line","Accept","Accept","line");
        $this->crud->addButtonFromModelFunction("line","Draft","Draft","line");
        if(session("updated")){
            Alert::success("This item is being modified successfully");
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
            'entity'=>'User',
            'model'=>'App\Models\User',
            'attribute'=>'name',
            'label'=>'Tác giả',
        ]);
        CRUD::column('user_id');
        CRUD::column('name')->label("Tiêu đề");
        CRUD::column('status')->type("select_from_array")->options(["Đang chờ","Đã xuất bản"])->label("Trạng thái");


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
        CRUD::setValidation(PostRequest::class);

        CRUD::field('id');
        CRUD::field('user_id');
        CRUD::field('name');
        CRUD::field('status');
        CRUD::field('content');
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

    public function customCreatePost()
    {
        return view("vendor.backpack.page.post-create");
    }
    public function customUpdatePost($id)
    {
        return view("vendor.backpack.page.post-update",["post"=>Post::find($id)]);
    }
    public function updatedPost(Request $request,$id)
    {
        $data = [
            "name"=>$request->name,
            "content"=>$request->{"content"},
        ];
        Post::find($id)->update($data);
        return redirect("/admin/post")->with("updated",'updated');
    }
    public function changeStatus($id,$status){
        Post::find($id)->update(["status"=>$status]);
        return redirect("/admin/post")->with("updated",'updated');
    }
}
