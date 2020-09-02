@extends('admin.admin_layouts')

@section('admin_content')

  <div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
      <a class="breadcrumb-item" href="#">商品</a>
    <a class="breadcrumb-item" href="{{ route('index.product') }}">商品一覧</a>
      <span class="breadcrumb-item active">商品詳細</span>
    </nav>

    <div class="sl-pagebody">
      <div class="card pd-20 pd-sm-40">
        <h6 class="card-body-title">商品詳細</h6>

        <div class="form-layout">
          <div class="row mg-b-25">
            <div class="col-lg-4">
              <div class="form-group">
                <label class="form-control-label">商品名: <span class="tx-danger">*</span></label><br>
                <strong>{{ $product->product_name }}</strong>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="form-group">
                <label class="form-control-label">商品コード: <span class="tx-danger">*</span></label><br>
                <strong>{{ $product->product_code }}</strong>
              </div>
            </div>

            <div class="col-lg-4">
              <div class="form-group">
                <label class="form-control-label">個数: <span class="tx-danger">*</span></label><br>
                <strong>{{ $product->product_quantity }}</strong>
              </div>
            </div>

            <div class="col-lg-4">
              <div class="form-group mg-b-10-force">
                <label class="form-control-label">カテゴリー: <span class="tx-danger">*</span></label><br>
                <strong>{{ $product->category_name }}</strong>
              </div>
            </div>

            <div class="col-lg-4">
              <div class="form-group mg-b-10-force">
                <label class="form-control-label">サブカテゴリー: <span class="tx-danger">*</span></label><br>
                <strong>{{ $product->subcategory_name }}</strong>
              </div>
            </div>

            <div class="col-lg-4">
              <div class="form-group mg-b-10-force">
                <label class="form-control-label">ブランド: <span class="tx-danger">*</span></label><br>
                <strong>{{ $product->brand_name }}</strong>
              </div>
            </div>


            <div class="col-lg-4">
              <div class="form-group">
                <label class="form-control-label">サイズ: <span class="tx-danger">*</span></label><br>
                <strong>{{ $product->product_size }}</strong>
              </div>
            </div>

            <div class="col-lg-4">
              <div class="form-group">
                <label class="form-control-label">カラー: <span class="tx-danger">*</span></label><br>
                <strong>{{ $product->product_color }}</strong>
              </div>
            </div>

            <div class="col-lg-4">
              <div class="form-group">
                <label class="form-control-label">販売価格: <span class="tx-danger">*</span></label><br>
                <strong>{{ $product->selling_price }}</strong>
              </div>
            </div>

            <div class="col-lg-12">
              <div class="form-group">
                <label class="form-control-label">商品詳細: <span class="tx-danger">*</span></label><br/>
                <p>{!! $product->product_details !!}</p>
              </div>
            </div>

            <div class="col-lg-12">
              <div class="form-group">
                <label class="form-control-label">ビデオ Link: <span class="tx-danger">*</span></label><br>
                <strong>{{ $product->video_link }}</strong>
              </div>
            </div>

            <div class="col-lg-4">
              <div class="form-group">
                <label class="form-control-label">画像１(サムネイル): <span class="tx-danger">*</span></label><br />
                <img src="{{ URL::to( $product->image_one) }}" height="80px;" width="80px;" alt="">
              </div>
            </div>

            <div class="col-lg-4">
              <div class="form-group">
                <label class="form-control-label">画像２: <span class="tx-danger">*</span></label><br/>
                <img src="{{ URL::to( $product->image_two) }}" height="80px;" width="80px;" alt="">
              </div>
            </div>

            <div class="col-lg-4">
              <div class="form-group">
                <label class="form-control-label">画像３: <span class="tx-danger">*</span></label><br/>
                <img src="{{ URL::to( $product->image_three) }}" height="80px;" width="80px;" alt="">
              </div>
            </div>
          </div>
          <hr>
          <br>
          <br>
          <div class="row">
            <div class="col-lg-4">
              @if ($product->main_slider == 1)
                <span class="badge badge-success">有効</span>
              @else
                <span class="badge badge-danger">無効</span>
              @endif
              <span>Main Slider</span>
            </div>

            <div class="col-lg-4">
              @if ($product->hot_deal == 1)
                <span class="badge badge-success">有効</span>
              @else
                <span class="badge badge-danger">無効</span>
              @endif
              <span>Hot Deal</span>
            </div>

            <div class="col-lg-4">
              @if ($product->best_rated == 1)
                <span class="badge badge-success">有効</span>
              @else
                <span class="badge badge-danger">無効</span>
              @endif
              <span>Best Rated</span>
            </div>

            <div class="col-lg-4">
              @if ($product->trend == 1)
                <span class="badge badge-success">有効</span>
              @else
                <span class="badge badge-danger">無効</span>
              @endif
              <span>トレンド商品</span>
            </div>

            <div class="col-lg-4">
              @if ($product->mid_slider == 1)
                <span class="badge badge-success">有効</span>
              @else
                <span class="badge badge-danger">無効</span>
              @endif
              <span>Mid Slider</span>
            </div>

            <div class="col-lg-4">
              @if ($product->hot_new == 1)
                <span class="badge badge-success">有効</span>
              @else
                <span class="badge badge-danger">無効</span>
              @endif
              <span>Hot New</span>
            </div>
          </div>
        </div><!-- form-layout -->
      </div><!-- card -->
    </div>
  </div><!-- sl-mainpanel -->

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/bootstrap.tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>

@endsection
