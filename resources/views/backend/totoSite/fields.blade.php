<section class="content">
    <div class="container">




    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- jquery validation -->
          <div class="card card-primary">
            <div class="card-header">

              @if (isset($totoSite))
              <h3 class="card-title">Edit Toto Site :{{ $totoSite->siteName }}</h3>
              @else <h3 class="card-title">Add New Toto Site</h3>
              @endif
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form id="quickForm">
              <div class="card-body">


                <div class="form-group">
                  <div class="row  justify-content-between" >
                    <div class="col-md-4">
                    <label >Site Name</label>
                    </div>
                    <div class="col-md-4">
                      <label >Status</label>
                      </div>
                    <div class="col-md-4">
                      <label for="exampleInputPassword1">Flag</label>
                  </div>


                  </div>


                  <!--input-->

                    <div class="row  mb-3 justify-content-between" >

                      <div class="col-md-4">

                         @if (isset($totoSite))
                         <input type="siteName" name="siteName" class="form-control" id="exampleInputName" placeholder="Enter Site Name" value="{{ $totoSite->siteName }}" required autocomplete="siteName" autofocus >
                         <span class="text-danger">@error('siteName') {{ $errors->first('siteName') }} @enderror</span>
                       </div>

                       <div class="col-md-4">
                        <select class="form-control @error('status') is-invalid @enderror" name="status" style="width: 100%;" >
                          @if($totoSite->status=='active')
                            <option value="{{ $totoSite->status }}">{{ $totoSite->status }}</option>
                            <option value="inactive">inactive</option>
                          @else
                            <option value="{{ $totoSite->status }}">{{ $totoSite->status }}</option>
                            <option value="active">active</option>
                          @endif
                          </select>
                        <span class="text-danger">@error('status') {{ $errors->first('status') }} @enderror</span>
                     </div>

                       <div class="col-md-4">
                         <input type="flag" name="flag" class="form-control @error('flag') is-invalid @enderror"  id="flag" placeholder="flag eg.SG" value="{{ $totoSite->flag }}" required autocomplete="flag" autofocus>
                         <span class="text-danger">@error('flag') {{ $errors->first('flag') }} @enderror</span>
                     </div>


                         @else

                         <input type="siteName" name="siteName" class="form-control" id="siteName" placeholder="Enter Site Name" value="{{ old('siteName') }}" required autocomplete="siteName" autofocus >
                        <span class="text-danger">@error('siteName') {{ $errors->first('siteName') }} @enderror</span>
                      </div>

                      <div class="col-md-4">
                        <select class="form-control @error('status') is-invalid @enderror" name="status" style="width: 100%;" >
                            <option value="active">active</option>
                            <option value="inactive">inactive</option>
                          </select>
                        <span class="text-danger">@error('status') {{ $errors->first('status') }} @enderror</span>
                      </div>

                      <div class="col-md-4">
                        <input type="flag" name="flag" class="form-control @error('flag') is-invalid @enderror"  id="flag" placeholder="flag eg. SG" value="{{ old('flag') }}" required autocomplete="flag" autofocus>
                        <span class="text-danger">@error('flag') {{ $errors->first('flag') }} @enderror</span>
                    </div>
                         @endif




                </div>
              </div>
                <!--end input-->


                <div class="form-group">
                  <div class="row  justify-content-between" >
                    <div class="col-md-6">
                      <label for="country">Country</label>
                    </div>

                    <div class="col-md-6">
                      <label for="country">Color</label>
                    </div>

                  </div>



                  <!--Country with color-->
                  <div class="row  mb-2 justify-content-between" >
                    <div class="col-md-6">
                      <select class="form-control @error('flag') is-invalid @enderror" name="country" style="width: 100%;" >
                        @if (isset($totoSite))
                        @if($totoSite->country==='MY/SG')
                            <option value="{{ $totoSite->country }}">{{ $totoSite->country }}</option>
                            <option value="Other">Other</option>
                        @else
                            <option value="{{ $totoSite->country }}">{{ $totoSite->country }}</option>
                            <option value="MY/SG">MY/SG</option>
                        @endif
                          @else
                              <option value="MY/SG">MY/SG</option>
                              <option value="Other">Other</option>
                        @endif
                        </select>
                      <span class="text-danger">@error('country') {{ $errors->first('country') }} @enderror</span>
                    </div>

                    <div class="col-md-6">
                      <input  name="color" class="form-control "  placeholder="Enter Color or  Color code eg. black or #000000" value="@if(isset($totoSite)){{ $totoSite->color }}@else{{ old('color') }}@endif" required autocomplete="color" autofocus>
                      <span class="text-danger">@error('color') {{ $errors->first('color') }} @enderror</span>
                    </div>

                  </div>

                </div>



                    <!-- image-->
                    <div class="form-group">
                      <div class="row " >
                        <div class="col-md-12">
                          <label>Site Image</label>
                        </div>
                       </div>





                      <div class="row " >
                        <div class="col-md-12">
                         <div class="drop-zone">
                           @if(isset($totoSite))
                          <img class="OldImage" src="/public/images/{{ ($totoSite->siteImage) }}" height="100px" width="100px">
                          @else <img class="OldImage" src="">
                          @endif
                           <span class="drop-zone__prompt">Drop file here or click to upload</span>
                           <input type="file" name="siteImage" class="drop-zone__input" accept="image/png, image/jpeg,image/jpg, image/gif, image/svg" value="@if(isset($totoSite)){{ $totoSite->siteImage }}@endif" >
                         </div>
                        </div>
                       </div>
                    </div>

              </div>
              <!-- /.card-body -->
              <div class="card-footer">

                 <div class="row " >
                  <div class="col-md-10">
                    <a class="btn  btn-info btn-lg " style="float:right;"   href="{{ route('totoSite.index') }}">Back</a>

                  </div>
                  @if(isset($totoSite))
                  <a href="" class="btn  btn-warning btn-lg " style="float:right;margin-right:1%;"  >Clear</a>
                  @else
                  <a href="{{ route('totoSite.create') }}" class="btn  btn-warning btn-lg " style="float:right;margin-right:1%;"  >Clear</a>
                  @endif

                  @if (isset($totoSite))
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


