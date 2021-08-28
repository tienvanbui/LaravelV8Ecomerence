@section('title')
    User Role List
@endsection
@include('partials.header')
@include('partials.slidebar')
@section('main-content')
<div class="container">
	<div class="row">            
		<div class="page-breadcrumb bg-white">
                <div class="row align-items-center">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">User Role</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <div class="d-md-flex">
                            <ol class="breadcrumb ms-auto">
                                <li><a href="{{route('role.index')}}" class="fw-normal">User Roles List</a></li>
                            </ol>
                            <a href="{{route('role.create')}}"
                                class="btn btn-success  d-none d-md-block pull-right ms-3 hidden-xs hidden-sm waves-effect waves-light text-white">Create User Role</a>
                        </div>
                    </div>
                </div>
                <!-- /.col-lg-12 -->
            </div>
	</div>
  <div class="row">
    <div class="container">
        <h1 class="text-center">USER ROLE LIST</h1> 
	<table class="table table-hover table-bordered">
        <thead class="table-dark">
            <tr>
            <th scope="col">#</th>
            <th scope="col">Role Name</th>
            <th scope="col">Role Description</th>
            <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @php  $id = 0 @endphp
            @foreach ($roles as $role)
            @php $id ++ @endphp
            <tr>
            <th scope="row">@php echo $id @endphp</th>
            <td>{{$role->role_name}}</td>
            <td>{!!$role->display_name!!}</td>
            <td>
                <a href="{{route('role.show',['role'=>$role->id])}}" class="btn btn-info btn-inline text-white btn-sm" ><i class="fas fa-eye"></i></a>
                <a href="{{route('role.edit',['role'=>$role->id])}}" class="btn btn-success btn-inline text-white btn-sm" ><i class="fas fa-edit"></i></a>
                @include('partials.delete',[
                    'route'=>'role.destroy',
                    'item_name'=>'role',
                    'item'=>$role->id
                ])
            </td>
            </tr>
            @endforeach

        </tbody>
    </table>
        </div>
  </div>
</div>
@endsection
@include('partials.main')
@include('partials.footer')