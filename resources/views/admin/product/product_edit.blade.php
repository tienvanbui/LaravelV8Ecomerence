@section('title')
  Edit Product
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
                class="btn btn-success  d-none d-md-block pull-right ms-3 hidden-xs hidden-sm waves-effect waves-light text-white">Add
                Product</a>
            </div>
          </div>
        </div>
        <!-- /.col-lg-12 -->
      </div>
    </div>
    <div class="row">
      <h1 class="text-center mt-3">Edit Product</h1>
      @if ($errors->any())
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif
      <form action="{{ url('Admin/product/' . $product->id) }}" method="post" enctype="multipart/form-data">
        @method('put')
        @csrf
        <div class="form-group">
          <label for="name">Product Name:</label>
          <input type="text" class="form-control" id="name" aria-describedby="name" name="name"
            value="{{ $product->name }}">
        </div>
        <div class="form-group">
          <label for="seo_product">Product Seo</label>
          <input type="text" class="form-control" id="seo_product" aria-describedby="seo_product"
            placeholder="Enter Product Seo" name="seo_product" value="{{ $product->seo_product }}">
        </div>
        <div class="form-group">
          <label for="price">Price:</label>
          <input type="number" class="form-control" id="price" name='Price' value="{{ $product->Price }}">
        </div>
        <div class="form-group">
          <label for="featureImg">Feature Image:</label>
          <input type="file" class="form-control-file" name="feature_img" id="featureImg">
          <div id="featureImgHelpBlock" class="form-text text-dark">
            Your images must have type *jpeg, *png, *bmp, *gif, *svg.
          </div>
          <div class="card h-100" style="width: 18rem;">
            <img src="{{ asset($product->feature_img) }}" class="card-img-top" alt="{{ $product->feature_img_name }}"
              style="height: 100%">
            <div class="card-body">
              <p class="card-text text-center">{{ $product->feature_img_name }}</p>
            </div>
          </div>
        </div>

        <div class="form-group">
          <label for="imgDetail">Image Detail:</label>
          <input type="file" class="form-control-file" name="img_path[]" id="imgDetail" multiple>
          <div id="imgDetailHelpBlock" class="form-text text-dark">
            Your images must have type *jpeg, *png, *bmp, *gif, *svg.
          </div>
          <div class="card-group">
            @foreach ($product->productImgs as $itemImgs)
              <div class="card" style="width:18rem;">
                <img src="{{ asset($itemImgs->img_path) }}" class="card-img-top"
                  alt="{{ $itemImgs->img_path_name }}" height="100%" width="100%">
                <div class="card-body">
                  @php
                    $nameProductImgArray = explode('.', $itemImgs->img_path_name);
                    $nameProductImg = $nameProductImgArray[0];
                  @endphp
                  <h5 class="card-title text-center">{{ $nameProductImg }}</h5>
                </div>
              </div>
            @endforeach
          </div>
        </div>

        <div class="form-group">
          <label for="category_id">Category:</label>
          <select class="form-control" id="category_id" name="category_id">
            @foreach ($category as $itemcategory)
              <option name="category_id" value="{{ $product->category_id }}" value="{{ old('category_id') }}">
                {{ $itemcategory->name }}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group">
          <label for="color_id">Color Id</label>
          <select name="color_id[]" class="form-control" multiple style="height: 200px">
            @foreach ($color as $item)
                     <option  {{ $productHasColor->contains('id', $item->id) ? 'selected' : '' }} value ="{{$item->id}}">{{ $item->color_name }}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group">
          <label for="size_id">Size Id</label>
          <select name="size_id[]" class="form-select" multiple="multiple" style="height: 100px">
            @foreach ($size as $item)
               <option  {{ $productHasSize->contains('id', $item->id) ? 'selected' : '' }} value ="{{$item->id}}">{{ $item->size_name }}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group">
          <label for="des">Description:</label>
          <textarea name="des" id="ckeditor_product_edit" cols="30" rows="10"
            class="form-control">{{ $product->productdetail->des }}</textarea>
        </div>
        <div class="form-group">
          <label for="weight">Weight:</label>
          <input type="number" class="form-control" id="weight" name='weight'
            value="{{ $product->productdetail->weight }}" value="{{ old('weight') }}">
        </div>
        <div class="form-group">
          <label for="dimension">Dimension:</label>
          <input type="text" class="form-control" id="dimension" name='dimension'
            value="{{ $product->productdetail->dimension }}" value="{{ old('dimension') }}">
        </div>
        <div class="d-grid gap-2">
          <button type="submit" class="btn btn-primary text-white mb-2">Update</button>
        </div>
      </form>
    </div>
  </div>
@endsection
@include('partials.main')
@include('partials.footer')
