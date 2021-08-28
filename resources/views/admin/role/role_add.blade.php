@section('js')
      <script>
        $('.checkbox_warpper').on('click',function(){
          $(this).parents('.card').find('.checkbox_childrent').prop('checked',$(this).prop('checked'));
        })
    </script>    
@endsection
@section('title')
    Create User Role
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
   <h1 class="text-center">Create User Role</h1>
   @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form action="{{route('role.store')}}" method="post">
            @csrf
          <div class="col-md-12">
            <div class="form-group">
              <label for="role_name">Role Name:</label>
              <input type="text" class="form-control" id="role_name" aria-describedby="role_name" name="role_name" value="{{ old('role_name') }}" placeholder="Enter Role Name">
            </div>
            <div class="form-group">
              <label for="display_name">Role Description:</label>
              <textarea name="display_name" id="ckeditor_user_role_create" cols="30" rows="10" class="form-control" placeholder="Enter Role Description"></textarea>
            </div>
          </div>
            <div class="col-md-12">
                <div class="row">
              @foreach ($permission as $item)         
              <div class="card text-white col-md-12 mb-3">
                <div class="card-header text-dark bg-success">
                  <label>
                    <input type="checkbox" class="checkbox_warpper">                    
                  </label>
                  Model {{$item->permission_name}}
                </div>
                <div class="row">
                  @foreach ($item->permissions as $child)      
                <div class="card-body col-md-3 ml-1">
                    <h5 class="card-title">
                    <label>
                      <input type="checkbox" name="permission_id[]" class="checkbox_childrent" value={{$child->id}} multiple>
                    </label>
                      {{$child->permission_name}}
                    </h5>                
                </div>                                    
                  @endforeach  
                </div>
              </div>
               @endforeach
                </div>
            </div>
        <div class="d-grid gap-2">
          <button type="submit" class="btn btn-danger text-white">Create</button>
        </div>
    </form>
  </div>

</div>
@endsection
@include('partials.main')
@include('partials.footer')