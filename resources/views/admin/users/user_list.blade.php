@section('title')
    Users List
@endsection
@include('partials.header')
@include('partials.slidebar')
@section('main-content')
<div class="container">
	<div class="row">            
		<div class="page-breadcrumb bg-white">
                <div class="row align-items-center">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Users</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <div class="d-md-flex">
                            <ol class="breadcrumb ms-auto">
                                <li><a href="{{route('manage-user.index')}}" class="fw-normal">Users List</a></li>
                            </ol>
                            <a href="{{route('manage-user.create')}}"
                                class="btn btn-success  d-none d-md-block pull-right ms-3 hidden-xs hidden-sm waves-effect waves-light text-white">Add User</a>
                        </div>
                    </div>
                </div>
                <!-- /.col-lg-12 -->
            </div>
	</div>
	<div class="row">
        <div class="container">
            <h1 class="text-center">USERS LIST</h1> 
	<table class="table table-hover table-bordered">
        <thead class="table-dark">
            <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Username</th>
            <th scope="col">Email</th>
            <th scope="col">Phone</th>
            <th scope="col">Address</th>
            <th scope="col">Avatar</th>
            <th scope="col">Status</th>
            <th style="width: 10%">Action</th>
            </tr>
        </thead>
        <tbody>
            @php  $id = 0 @endphp
            @foreach ($users as $user)
            @php $id ++ @endphp
            <tr>
            <th scope="row">@php echo $id @endphp</th>
            <td>{{$user->name}}</td>
            <td>{{$user->username}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->phoneNumber}}</td>
            <td>{{$user->adrress}}</td>
            <td><img src="{{asset($user->avatar)}}" style="width:8rem;height:8rem"></td>
            <td>
                @if ($user->status == 1)
                    <label class=" mt-1 btn btn-danger">Blocked</label>
                @elseif ($user->status == 0)
                    <label class="mt-1 btn btn-primary btn-sm">Block</label>
                @endif
            </td>
            <td>
                <a href="{{route('manage-user.edit',['manage_user'=>$user->id])}}" class="btn btn-success btn-sm text-white" ><i class="fas fa-edit"></i></a>
                @include('partials.delete',[
                    'route'=>'manage-user.destroy',
                    'item_name'=>'manage_user',
                    'item'=>$user->id
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