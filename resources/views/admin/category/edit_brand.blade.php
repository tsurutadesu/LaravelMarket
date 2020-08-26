@extends('admin.admin_layouts')

@section('admin_content')

<div class="sl-mainpanel">
  <div class="sl-pagebody">
    <div class="sl-page-title">
      <h5>編集画面</h5>
    </div>

    <div class="card pd-20 pd-sm-40">
      <h6 class="card-body-title">ブランド 更新</h6>
      <div class="table-wrapper">

        @if ($errors->any())
          <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
        @endif

        <form action="{{ route('update.brand', ['id' => $brand->id]) }}" method="POST" enctype="multipart/form-data">
          @csrf

          <div class="modal-body pd-20">
            <div class="form-group">
              <label for="brand_name">ブランド名</label>
              <input type="text" class="form-control" id="brand_name" aria-describedby="emailHelp" value="{{ $brand->brand_name }}" name="brand_name">
            </div>

            <div class="form-group">
              <label for="brand_name">ブランドロゴ</label>
              <input type="file" class="form-control" id="brand_logo" aria-describedby="emailHelp"  name="brand_logo">
            </div>

            <div class="form-group">
              <label for="brand_name">現在のブランドロゴ</label>
              <img src="{{ URL::to($brand->brand_logo) }}" alt="" height="70px" width="80px">
              <input type="hidden" name="old_logo" value="{{ $brand->brand_logo }}">
            </div>

            <div class="modal-footer">
              <button type="submit" class="btn btn-info pd-x-20">更新する</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection