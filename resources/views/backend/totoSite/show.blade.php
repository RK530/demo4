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
            <h1>Show User <span style="font-size:18px;color:#869099">P0000010</span></h1>
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
                  
                  
                  <h3 class="card-title">Show User :{{ $totoSite->id }}</h3>
                 
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form id="quickForm">
                  <div class="card-body">
             
                    <div class="form-group">
                      <div class="row  justify-content-between" > 
                        <div class="col-md-8">
                        <label >Site Name<span>*</span></label>
                        </div>
                        <div class="col-md-4">
                          <label>Flag</label>
                      </div>
                      
                     
                      </div>
                    
                    
                      <!--input-->
                      
                        <div class="row  mb-2 justify-content-between" >
                        
                          <div class="col-md-8">
                          
                            
                             <input  name="siteName" class="form-control" id="exampleInputName" value="{{ $totoSite->siteName }}"   disabled="disabled" style="background-color: white;">
                             
                           </div>
                           
                           <div class="col-md-4">
                             <input  name="flag" class="form-control "    value="{{ $totoSite->flag }}" style="background-color: white;"  disabled="disabled">
                            
                         </div>
                         
                       
                             
    
                            
                           
                            
                      
                        </div>
                      </div>
                    
                    <!--end input-->

                    <div class="form-group">
                      <div class="row  justify-content-between" > 
                        <div class="col-md-6">
                        <label >Country<span>*</span></label>
                        </div>
                        <div class="col-md-6">
                          <label>Color</label>
                      </div>
                      
                     
                      </div>
                    
                    
                      <!--input-->
                      
                        <div class="row  mb-2 justify-content-between" >
                        
                          <div class="col-md-6">
                          
                            
                             <input  name="country" class="form-control"  value="{{ $totoSite->country }}"   disabled="disabled" style="background-color: white;">
                             
                           </div>
                           
                           <div class="col-md-6">
                             <input  name="color" class="form-control "    value="{{ $totoSite->color }}" style="background-color: white;"  disabled="disabled">
                            
                         </div>
                         
                       
                             
    
                            
                           
                            
                      
                        </div>
                      </div>
    
    
                   
    
                        <!-- image-->
                        <div class="form-group">
                          <div class="row " >
                            <div class="col-md-12">
                              <label>Image</label>
                            </div>
                           </div>
                        
    
                       
    
                        
                          <div class="row " >
                            <div class="col-md-12">
                              <img src="../public/images/{{ ($totoSite->siteImage) }}" height="45px" width="50px"></td>
                            </div>
                           </div>
                        </div>
               
    
                    
    
    
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer">
                  
                     <div class="row " >
                      <div class="col-md-11">
                      </div>
                      @if(url()->previous()!='http://127.0.0.1:8000/totoSite')
                    <a class="btn  btn-info btn-lg " style="float:right;"   href="{{ url()->previous() }}">Back</a>
                    @else
                    <a class="btn  btn-info btn-lg " style="float:right;"   href="{{ route('totoSite.index') }}">Back</a>
                    @endif
                    
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