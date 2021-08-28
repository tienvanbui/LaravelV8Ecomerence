@section('title')
    Contact
@endsection
@include('partials.header')
@include('partials.slidebar')
@section('main-content')
<div class="container">
	<div class="row"> 
        <div class="page-breadcrumb bg-white">
                <div class="row align-items-center">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Contact</h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">z
                        <div class="d-md-flex">
                            <ol class="breadcrumb ms-auto">
                                <li><a href="{{route('contact.index')}}" class="fw-normal">Contact Information</a></li>
                            </ol>
                            <a href="{{route('contact.create')}}"
                                class="btn btn-success  d-none d-md-block pull-right ms-3 hidden-xs hidden-sm waves-effect waves-light text-white">Create Contact</a>
                        </div>
                    </div>
                </div>
        </div> 
	</div>
    <div class="row">
        <div class="container">
            <h1 class="text-center">CONTACT</h1>
            @if(Session::has('message'))

                <div class="alert alert-success">

                    {{Session::get('message')}}

                </div>

            @endif 
            <table class="table table-hover table-bordered">
                <thead class="table-dark" style="width: 100%">
                    <tr>
                    <th scope="col">Address</th>
                    <th scope="col">Lets Talk</th>
                    <th scope="col">Sales Support Email</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{$contact->address}}</td>
                        <td>{{$contact->talk}}</td>
                        <td>{{$contact->sales_email}}</td>
                        <td>
                            <a href="{{route('contact.edit',['contact'=>$contact->id])}}" class="btn btn-primary btn-sm text-white" ><i class="fas fa-edit"></i></a>
                            @include('partials.delete',[
                                'route'=>'contact.destroy',
                                'item_name'=>'contact',
                                'item'=>$contact
                            ])
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
	</div>
</div>
@endsection
@include('partials.main')
@include('partials.footer')