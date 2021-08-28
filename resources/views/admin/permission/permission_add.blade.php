@section('title')
    Create Permission
@endsection
@include('partials.header')
@include('partials.slidebar')
@section('main-content')
<div class="container">
	<div class="row">            
		<div class="page-breadcrumb bg-white">
                <div class="row align-items-center">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Permission</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <div class="d-md-flex">
                            <ol class="breadcrumb ms-auto">
                                <li><a href="{{route('permission.index')}}" class="fw-normal">Permission List</a></li>
                            </ol>
                            <a href="{{route('permission.create')}}"
                                class="btn btn-success  d-none d-md-block pull-right ms-3 hidden-xs hidden-sm waves-effect waves-light text-white">Create Permission</a>
                        </div>
                    </div>
                </div>
                <!-- /.col-lg-12 -->
            </div>
	</div>
  <div class="row">
   <h1 class="text-center">Create Permission</h1>
   @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form action="{{route('permission.store')}}" method="post">
            @csrf
        <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12">
                       <div class="form-group">
                        <label >Modul Name</label>
                        <select name="permisionF"class="form-control">
                            @foreach (config('permissions.table_modul') as $tableModulItem)
                                 <option value="{{$tableModulItem}}">{{$tableModulItem}}</option>
                            @endforeach
                           
                        </select>
                    </div>
                </div>
                </div>   
                <div class="container">
                    <div class="col-md-12">
                            <div class="row">
                                @foreach (config('permissions.modul_childrent') as $ModulChilrentItem)
                    <div class="card-body col-md-3 ml-5">
                            <h5 class="card-title">
                            <label>
                            <input type="checkbox" name="modulChild[]" multiple class="checkbox_childrent" value={{$ModulChilrentItem}}>
                            </label>
                            {{$ModulChilrentItem}}
                            </h5>                
                    </div>
                    
                                @endforeach
                  
                            </div>
                    </div>
                </div>
                
            </div>
              
        <div class="d-grid gap-2">
          <button type="submit" class="btn btn-primary text-white mb-2">Create</button>
        </div>
    </form>
  </div>

</div>
@endsection
@include('partials.main')
@include('partials.footer')