@section('title')
  About
@endsection
@include('partials.header')
@include('partials.slidebar')
@section('main-content')
  <div class="container">
    <div class="row">
      <div class="page-breadcrumb bg-white">
        <div class="row align-items-center">
          <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">About</h4>
          </div>
          <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
            <div class="d-md-flex">
              <ol class="breadcrumb ms-auto">
                <li><a href="{{ route('about.index') }}" class="fw-normal">About Infor</a></li>
              </ol>
              <a href="{{ route('about.create') }}"
                class="btn btn-success  d-none d-md-block pull-right ms-3 hidden-xs hidden-sm waves-effect waves-light text-white">Create
                About</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <h2 class="text-center mt-3">ABOUT INFOR</h2>
        <table class="table table-hover table-bordered">
          <thead class="table-dark" style="width: 100%">
            <tr>
              <th scope="col">#</th>
              <th scope="col">Title</th>
              <th style="width: 20%">Thumbnail</th>
              <th scope="col">Description</th>
              <th scope="col">QUote</th>
              <th scope="col" style="width: 8%">Action</th>
            </tr>
          </thead>
          <tbody>
			@php  $id = 0 @endphp
			@foreach ($abouts as $item)
			@php $id ++ @endphp
			<tr>
			<th scope="row">@php echo $id @endphp</th>
                <td>{{ $item->title }}</td>
                <td><img src="{{ asset($item->thumbnail) }}" width="100%"></td>
                <td>{!! $item->des !!}</td>
                <td>{{ $item->quote }}</td>
                <td>
                  <a href="{{ route('about.edit', ['about' => $item->id]) }}"
                    class="btn btn-success btn-sm text-white"><i class="fas fa-edit"></i></a>
                  @include('partials.delete',[
                  'route'=>'about.destroy',
                  'item_name'=>'about',
                  'item'=>$item
                  ])
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <div class="d-flex justify-content-center">
        {{$abouts->links()}}
      </div>
    @endsection
    @include('partials.main')
    @include('partials.footer')
