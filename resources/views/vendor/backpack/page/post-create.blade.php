@extends(backpack_view('blank'))
@section('content')
    <script src="https://cdn.ckeditor.com/ckeditor5/31.0.0/decoupled-document/ckeditor.js"></script>
    <main class="main pt-2">
        <nav aria-label="breadcrumb" class="d-none d-lg-block">
            <ol class="breadcrumb bg-transparent p-0 justify-content-end">
                <li class="breadcrumb-item text-capitalize"><a
                        href="http://gvb-library.com.vn/admin/dashboard">Admin</a></li>
                <li class="breadcrumb-item text-capitalize"><a href="http://gvb-library.com.vn/admin/post">posts</a>
                </li>
                <li class="breadcrumb-item text-capitalize active" aria-current="page">Add</li>
            </ol>
        </nav>
        <section class="container-fluid">
            <h2>
                <span class="text-capitalize">post</span>
                <small>Add post.</small>

                <small><a href="http://gvb-library.com.vn/admin/post" class="d-print-none font-sm"><i
                            class="la la-angle-double-left"></i> Back to all <span>posts</span></a></small>
            </h2>
        </section>
        <div class="container-fluid animated fadeIn">
            <div class="row">
                <div class="col-md-8 bold-labels">
                    <!-- Default box -->
                    <form method="post" action="{{route('post.store')}}">
                    @csrf
                    <!-- load the view from the application if it exists, otherwise load the one in the package -->
                        <input type="hidden" name="http_referrer" value="http://gvb-library.com.vn/admin/post">
                        <input type="hidden" name="user_id" value="{{backpack_user()->id}}">
                        <input type="hidden" name="status" value="0">
                        <div class="card">
                            <div class="card-body row">
                                <!-- load the view from type and view_namespace attribute if set -->
                                <!-- text input -->
                                <div class="form-group col-sm-12" element="div"><label>Tiêu đề</label>
                                    <input type="text" name="name" value="" class="form-control">
                                </div>
                                <!-- text input -->
                                <input type="hidden" id="output" name="content" value="" class="form-control">
                                <!-- textarea -->
                                <div class="p-3 w-100">
                                    <label>Nội dung</label>
                                    <div id="toolbar-container"></div>

                                    <!-- This container will become the editable. -->
                                    <div id="editor" class="border" style="min-height: 50vh">
                                        <p></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="saveActions" class="form-group">
                            <input type="hidden" name="save_action" value="save_and_back">
                            <div class="btn-group" role="group">
                                <button type="submit" class="btn btn-success">
                                    <span class="la la-save" role="presentation" aria-hidden="true"></span> &nbsp;
                                    <span data-value="save_and_back">Save and back</span>
                                </button>
                                <div class="btn-group" role="group">
                                    <button id="btnGroupDrop1" type="button" class="btn btn-success dropdown-toggle"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span
                                            class="caret"></span><span class="sr-only">▼</span></button>
                                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                        <a class="dropdown-item" href="javascript:void(0);" data-value="save_and_edit">Save
                                            and edit this item</a>
                                        <a class="dropdown-item" href="javascript:void(0);" data-value="save_and_new">Save
                                            and new item</a>
                                        <a class="dropdown-item" href="javascript:void(0);"
                                           data-value="save_and_preview">Save and preview</a>
                                    </div>
                                </div>
                            </div>
                            <a href="{{route("post.index")}}" type="button" class="btn btn-default"><span
                                    class="la la-ban"></span> &nbsp;Cancel</a>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <script>
        $("#editor").on("DOMSubtreeModified", function () {
            console.log($("#output").val($("#editor").html()))
        });
        DecoupledEditor
            .create(document.querySelector('#editor'))
            .then(editor => {
                const toolbarContainer = document.querySelector('#toolbar-container');

                toolbarContainer.appendChild(editor.ui.view.toolbar.element);
            })
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
