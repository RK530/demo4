@extends('backend.layouts.heade')

@section('content')
<!-- Content Wrapper. Contains page content -->

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dream Wzt<span style="font-size:18px;color:#869099">P0000020</span></h1>
          </div><!-- /.col -->
          <div class="col-sm-7">
            <ol class="breadcrumb float-sm-left">
           
              {{ Breadcrumbs::render() }}
            </ol>
            
          </div><!-- /.col -->
          
        </div><!-- /.row -->
        <form method="GET" >
        <div class="row mb-2">
        <div class="col-sm-3">
          <input class="form-control" type="text" name="search"  value="{{ request()->get('search') }}"  placeholder="Search..." aria-label="Search" 
          aria-describedby="button-addon2">
        </div>
        <div class="col-sm-1">
          <button class="btn btn-primary" type="submit" id="button-addon2">Search</button>
        </div>
      </div>
        </form>
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content-header -->
        
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row ">
          <div class="col-sm-12">
            <div class="card">
            @include('backend.wzt.list')
          </div>
        </div>
      </div>
      </div>
    </section>
    
    <!-- /.content -->
  
  <!-- /.content-wrapper -->



@include('sweetalert::alert')
<!-- REQUIRED SCRIPTS -->
@include('backend.footerJS.footer2')

@endsection



</body>
</html>
