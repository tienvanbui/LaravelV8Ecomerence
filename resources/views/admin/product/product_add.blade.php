@section('title')
  Create Product
@endsection
@include('partials.header')
@include('partials.slidebar')
@section('main-content')
  <div class="container">
    <div class="row">
      <div class="page-breadcrumb bg-white">
        <div class="row align-items-center">
          <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Product</h4>
          </div>
          <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <div class="d-md-flex">
              <ol class="breadcrumb ms-auto">
                <li><a href="{{ route('product.index') }}" class="fw-normal">Products List</a></li>
              </ol>
              <a href="{{ route('product.create') }}"
                class="btn btn-success  d-none d-md-block pull-right ms-3 hidden-xs hidden-sm waves-effect waves-light text-white">Create
                Product</a>
            </div>
          </div>
        </div>
        <!-- /.col-lg-12 -->
      </div>
    </div>
    <div class="row">
      <div class="container">
        <h1 class="text-center">CREATE PRODUCT </h1>
        <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="form-group">
            <label for="name">Product Name</label>
            <input type="text" class="form-control" id="name" aria-describedby="name" placeholder="Enter Product Name"
              name="name">
          </div>
          <div class="form-group">
            <label for="seo_product">Product Seo</label>
            <input type="text" class="form-control" id="seo_product" aria-describedby="seo_product"
              placeholder="Enter Product Seo" name="seo_product">
          </div>
          <div class="form-group">
            <label for="feature_img">Feature Image</label>
            <input type="file" class="form-control-file" id="feature_img" aria-describedby="feature_img"
              name="feature_img">
          </div>
          <div class="form-group">
            <label for="img_path">Product Detail Image</label>
            <input type="file" class="form-control-file" id="img_path" aria-describedby="img_path" name="img_path[]"
              multiple>
          </div>
          <div class="form-group">
            <label for="Price">Price</label>
            <input type="number" class="form-control" id="Price" aria-describedby="Price" name="Price">
          </div>
          <div class="form-group">
            <label for="category_id">Category Id</label>
            <select name="category_id" class="form-control">
              @foreach ($category as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="color_id">Color Id</label>
            <select name="color_id[]" class="form-control" multiple style="height: 200px">
              @foreach ($color as $item)
                <option value="{{ $item->id }}">{{ ucwords($item->color_name)}}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="size_id">Size Id</label>
            <select name="size_id[]" class="form-select" multiple="multiple" style="height: 100px">
              @foreach ($size as $item)
                <option value="{{ $item->id }}">{{ ucwords($item->size_name) }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="des">Description</label>
            <textarea name="des" cols="30" rows="10" class="form-control" id="ckeditor_product_add"></textarea>
          </div>
          <div class="form-group">
            <label for="weight">Weight</label>
            <input type="number" class="form-control" id="weight" aria-describedby="weight" name="weight">
          </div>
          <div class="form-group">
            <label for="dimension">Dimension</label>
            <input type="text" class="form-control" id="dimension" aria-describedby="dimension" name="dimension">
          </div>
          <div class="d-grid gap-2">
            <button type="submit" class="btn btn-primary ">Create</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection
@include('partials.main')
@include('partials.footer')
