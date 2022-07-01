@extends('backend.layouts.heade1')

@section('content')


    

<div class="content-wrapper" style="margin-left: 0">
    <!-- Content Header (Page header) -->
    <section class="content-header" >
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6">
            <h1>Show Result Api <span style="font-size:18px;color:#869099">P0000014</span></h1>
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
                  
                  
                  <h3 class="card-title">Show Result Api :{{ $result_api->id }}</h3>
                 
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form id="quickForm">
                  <div class="card-body">
             
                    <div class="form-group">
                      <div class="row  justify-content-between" > 
                        <div class="col-md-6">
                        <label >Api URL <span>*</span></label>
                        </div>
                        <div class="col-md-6">
                          <label>Toto Site</label>
                      </div>
                      
                     
                      </div>
                    
                    
                      <!--input-->
                      
                        <div class="row  mb-2 justify-content-between" >
                        
                          <div class="col-md-6">
                          
                            
                             <input  name="api_url" class="form-control"  value="{{ $result_api->api_url }}"   disabled="disabled" style="background-color: white;">
                             
                           </div>
                           
                           <div class="col-md-6">
                             <input  name="toto_site" class="form-control "    value="@foreach($result_api->toto_site as $flag){{ $flag }},@endforeach" style="background-color: white;"  disabled="disabled">
              
                         </div>
                         
                       
                             
    
                            
                           
                            
                      
                        </div>
                      </div>
                    
                    <!--end input-->

                    <div class="form-group">
                      <div class="row  justify-content-between" > 
                        <div class="col-md-6">
                        <label >Status</label>
                        </div>
                        <div class="col-md-6">
                      </div>
                      
                     
                      </div>
                    
                    
                      <!--input-->
                      
                        <div class="row  mb-2 justify-content-between" >
                        
                          <div class="col-md-6">
                          
                            
                             <input  name="status" class="form-control"  value="{{ $result_api->status }}"   disabled="disabled" style="background-color: white;">
                             
                           </div>
                           
                           <div class="col-md-6">
                            
                            
                         </div>
                         
                       
                             
    
                            
                           
                            
                      
                        </div>
                      </div>

    
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer">
                  
                     <div class="row " >
                      <div class="col-md-11">
                      </div>
                      @if(url()->previous()!='http://127.0.0.1:8000/result_api')
                    <a class="btn  btn-info btn-lg " style="float:right;"   href="{{ url()->previous() }}">Back</a>
                    @else
                    <a class="btn  btn-info btn-lg " style="float:right;"   href="{{ route('result_api.index') }}">Back</a>
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