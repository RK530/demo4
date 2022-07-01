@extends('backend.layouts.heade1')

@section('content')

@if (Session::has('errors'))
<div class="alert alert-danger">
  {{ Session::get('errors') }}
</div>
  
@endif
    

<div class="content-wrapper" style="margin-left: 0">
    <!-- Content Header (Page header) -->
    <section class="content-header" >
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h1>Show User <span style="font-size:18px;color:#869099">P000005</span></h1>
          </div>
          
        </div>
        <div class="row">
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-left">
                  {{ Breadcrumbs::render() }}
                </ol>
              </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    
    <section class="content">
        <div class="container">
            
            
    
          
        <div class="container-fluid">
          <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- jquery validation -->
              <div class="card card-primary">
                <div class="card-header">
                  
                  
                  <h3 class="card-title">Show User :{{ $user->id }}</h3>
                 
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form id="quickForm">
                  <div class="card-body">
             
                    <div class="form-group">
                      <div class="row  justify-content-between" > 
                        <div class="col-md-4">
                        <label >User Name<span>*</span></label>
                        </div>
                        <div class="col-md-4">
                          <label for="exampleInputPassword1">Password</label>
                      </div>
                      
                      <div class="col-md-4">
                        <label for="password-confirm">Confirm Password</label>
                    </div>
                      </div>
                    
                    
                      <!--input-->
                      
                        <div class="row  mb-3 justify-content-between" >
                        
                          <div class="col-md-4">
                          
                            
                             <input type="name" name="name" class="form-control" id="exampleInputName" value="{{ $user->name }}"   disabled="disabled" style="background-color: white;">
                             
                           </div>
                           
                           <div class="col-md-4">
                             <input type="password" name="password" class="form-control "  id="exampleInputPassword1"  value="{{ $user->password }}" style="background-color: white;"  disabled="disabled">
                            
                         </div>
                         
                         <div class="col-md-4">
                           <input id="password-confirm" type="password" class="form-control" name="password_confirmation"   style="background-color: white;" value="{{ $user->password }}" disabled="disabled">
                          
                       </div>
                             
    
                            
                           
                            
                      
                        </div>
                      </div>
                    
                    <!--end input-->
    
    
                   
    
                        <!-- image-->
                        <div class="form-group">
                          <div class="row " >
                            <div class="col-md-12">
                              <label>Image</label>
                            </div>
                           </div>
                        
    
                       
    
                        
                          <div class="row " >
                            <div class="col-md-12">
                              <img src="../public/images/{{ ($user->image) }}" height="45px" width="50px"></td>
                            </div>
                           </div>
                        </div>
               
    
                    
    
    
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer">
                  
                     <div class="row " >
                      <div class="col-md-11">
                      </div>
                      <a class="btn  btn-default btn-lg " style="margin-right:1%"   href="{{ route('user.index') }}">Back</a>       
                    
                     </div>
                  </div>
                </form>
              </div>
              <!-- /.card -->
              </div>
            <!--/.col (left) -->
            <!-- right column -->
            <div class="col-md-6">
    
            </div>
            <!--/.col (right) -->
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </section>


   

</div>
@include('backend.footerJS.create')



@include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])

  @include('sweetalert::alert')


@endsection