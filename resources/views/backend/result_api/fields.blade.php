<section class="content">
    <div class="container">
        
        

      
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- jquery validation -->
          <div class="card card-primary">
            <div class="card-header">
              
              @if (isset($result_api))
              <h3 class="card-title">Edit Result Api :{{ $result_api->api_url }}</h3>
              @else <h3 class="card-title">Add New Result Api</h3>
              @endif
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form id="quickForm">
              <div class="card-body">
                
                 
                <div class="form-group">
                  <div class="row  justify-content-between" > 
                    <div class="col-md-6">
                    <label >Api URL</label>
                    </div>
                    <div class="col-md-6">
                      <label for="exampleInputPassword1">Toto Site</label>
                  </div>
                  
               
                  </div>
                
                
                  <!--input-->
                  
                    <div class="row  mb-2 justify-content-between" >
                    
                      <div class="col-md-6">
                      
                         @if (isset($result_api))
                         <input type="api_url" name="api_url" class="form-control" id="exampleInputName" placeholder="Enter Api URL" value="{{ $result_api->api_url }}" required autocomplete="api_url" autofocus >
                         <span class="text-danger">@error('api_url') {{ $errors->first('api_url') }} @enderror</span>
                       </div>

                       @else
                        
                       <input type="api_url" name="api_url" class="form-control" id="api_url" placeholder="Enter Api URL" value="{{ old('api_url') }}" required autocomplete="api_url" autofocus >
                      <span class="text-danger">@error('api_url') {{ $errors->first('api_url') }} @enderror</span>
                    </div>
                    @endif

                       <div class="col-md-6">
                        <select class="select2bs4 select2-hidden-accessible @error('toto_site') is-invalid @enderror" name="toto_site[]" multiple="multiple" data-placeholder="Select the toto site" style="width: 100%;" >
                          @if (isset($result_api))

                          @foreach ( $totoSite as $totoSite)
                          
                          <option value="{{ $totoSite->flag }}"{{ in_array($totoSite->flag,$result_api->toto_site) ? 'selected' : '' }}>{{ $totoSite->flag }}</option>                       
                          @endforeach
                        </select>
                         @else 
                          @foreach ( $totoSite as $totoSite)
                          <option value="{{ $totoSite->flag }}">{{ $totoSite->flag }}</option>                       
                          @endforeach
                        </select>
                        @endif
                      
                           
                        <span class="text-danger">@error('toto_site') {{ $errors->first('toto_site') }} @enderror</span>
                     </div>

                    
                </div>
              </div>
                <!--end input-->


                <div class="form-group">
                  <div class="row  justify-content-between" > 
                    <div class="col-md-6">
                      <label for="country">Status</label>
                    </div>
     
                  </div>


                
                  <!--Country with color-->
                  <div class="row   justify-content-between" > 
                    <div class="col-md-6">
                      <select class="form-control @error('status') is-invalid @enderror" name="status" style="width: 100%;" >
                        @if (isset($result_api))
                        @if($result_api->status=='active')
                            <option value="{{ $result_api->status }}">{{ $result_api->status }}</option>
                            <option value="inactive">inactive</option>
                        @else
                            <option value="{{ $result_api->status }}">{{ $result_api->status }}</option>
                            <option value="active">active</option>
                        @endif
                        @else
                          <option value="active">active</option>
                          <option value="inactive">inactive</option>
                        
                        @endif
                      </select>
                      <span class="text-danger">@error('status') {{ $errors->first('status') }} @enderror</span>
                    </div>

                  

                  </div>

                </div>

    



              </div>
              <!-- /.card-body -->
              <div class="card-footer">
              
                 <div class="row " >
                  <div class="col-md-10">
                    @if(url()->previous()!='http://127.0.0.1:8000/result_api')
                    <a class="btn  btn-info btn-lg " style="float:right;"   href="{{ url()->previous() }}">Back</a>
                    @else
                    <a class="btn  btn-info btn-lg " style="float:right;"   href="{{ route('result_api.index') }}">Back</a>
                    @endif
                  
                  </div>
                  @if(isset($result_api))
                  <a href="" class="btn  btn-warning btn-lg " style="float:right;margin-right:1%;"  >Clear</a>
                  @else
                  <a href="{{ route('result_api.create') }}" class="btn  btn-warning btn-lg " style="float:right;margin-right:1%;"  >Clear</a>
                  @endif
                 
                  @if (isset($result_api))
                  <button type="submit" class="btn btn-success" id="submitForm" style="float:right;font-size:19px">Submit</button>
                 
                  
                 
                  @else
                  <button type="submit" class="btn btn-success" id="submitButton" style="float:right;font-size:19px">Submit</button>
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

  
  