@extends(backpack_view('blank'))
@section('content')
  <form method="post" action="{{route("xupload.upload")}}" enctype="multipart/form-data" lang="vi">
      @csrf
      <div class="form-group">
          <label for="file">Import xlsx file</label>
          <input type="file" name="excel" class="form-control-file" id="file" placeholder="Chọn file" required>
      </div>
      <button class="btn btn-primary" type="submit">Inport</button>
  </form>
@endsection
