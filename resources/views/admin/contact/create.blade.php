@section('title')
    Create Contact
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
            <h1 class="text-center">CREATE CONTACT INFORMATION</h1> 
            <form action="{{route('contact.store')}}" method="post">
                 @csrf
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" id="address" aria-describedby="address" placeholder="Enter address of your shop" name="address">
                </div>
                <div class="form-group">
                    <label for="talk">Lets Talk</label>
                     <input type="text" class="form-control" id="talk" aria-describedby="talk" placeholder="Lets Talk" name="talk">
                </div>
                 <div class="form-group">
                    <label for="salesEmail">Sales Support Email</label>
                     <input type="email" class="form-control" id="sales_email" aria-describedby="sales_email" placeholder="Enter Sales Email Support" name="sales_email">
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