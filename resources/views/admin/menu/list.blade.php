@section('title')
     Menu
@endsection
@include('partials.header')
@include('partials.slidebar')
@section('main-content')
<div class="container">
	<div class="row"> 
        <div class="page-breadcrumb bg-white">
                <div class="row align-items-center">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Menu</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <div class="d-md-flex">
                            <ol class="breadcrumb ms-auto">
                                <li><a href="{{route('menu.index')}}" class="fw-normal">Menu List</a></li>
                            </ol>
                            <a href="{{route('menu.create')}}"
                                class="btn btn-success  d-none d-md-block pull-right ms-3 hidden-xs hidden-sm waves-effect waves-light text-white">Create Menu Item</a>
                        </div>
                    </div>
                </div>
        </div> 
	</div>
	<div class="row">
        <div class="container">
            <h1 class="text-center">MENU</h1>
            @if(Session::has('message'))

                <div class="alert alert-success">

                    {{Session::get('message')}}

                </div>

            @endif 
	<table class="table table-hover table-bordered">
        <thead class="table-dark" style="width: 100%">
            <tr>
            <th scope="col">#</th>
            <th scope="col">Name Item Menu</th>
            <th style="width: 8%">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($menus as $item)
            <tr>
                <td>{{$item->id}}</td>
                <td>{{$item->menu_name}}</td>
                <td>
                    <a href="{{route('menu.edit',['menu'=>$item->id])}}" class="btn btn-success btn-sm text-white" ><i class="fas fa-edit"></i></a>
                    @include('partials.delete',[
                        'route'=>'menu.destroy',
                        'item_name'=>'menu',
                        'item'=>$item
                    ])
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
        </div>
        <div class="d-flex justify-content-center">
            {{$menus->links()}}
        </div>
	</div>
</div>
@endsection
@include('partials.main')
@include('partials.footer')