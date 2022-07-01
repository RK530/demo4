<section class="content">
    <div class="container">




    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- jquery validation -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Edit Dream :{{ $dream->number }}</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form id="quickForm">
              <div class="card-body">


                <div class="form-group">
                  <div class="row  justify-content-between" >
                    <div class="col-md-4">
                    <label >Number</label>
                    </div>
                  </div>


                  <!--input-->

                    <div class="row " >

                      <div class="col-md-4">


                         <input name="number" class="form-control" id="" placeholder="Enter number" value="{{ $dream->number }}" required autocomplete="number" autofocus >
                         <span class="text-danger">@error('number') {{ $errors->first('number') }} @enderror</span>
                       </div>
                </div>
              </div>
                <!--end input-->


                <div class="form-group">
                  <div class="row mb-2 justify-content-between" >
                    <div class="col-md-6">
                      <label>中文</label>
                    </div>

                    <div class="col-md-6">
                      <label for="country">English</label>
                    </div>

                  </div>



                  <!--Country with color-->
                  <div class="row  mb-2 justify-content-between" >
                    <div class="col-md-6">
                      <input  name="cn" class="form-control "  value="{{ $dream->cn }}"  autofocus>
                      <span class="text-danger">@error('cn') {{ $errors->first('cn') }} @enderror</span>
                    </div>

                    <div class="col-md-6">
                      <input  name="en" class="form-control " value="{{ $dream->en }}"  autofocus>
                      <span class="text-danger">@error('en') {{ $errors->first('en') }} @enderror</span>
                    </div>

                  </div>

                </div>


                <div class="form-group">
                  <div class="row mb-2 justify-content-between" >
                    <div class="col-md-6">
                      <label>Malay</label>
                    </div>

                    <div class="col-md-6">
                      <label for="country">Thailand</label>
                    </div>

                  </div>



                  <!--Country with color-->
                  <div class="row  mb-2 justify-content-between" >
                    <div class="col-md-6">
                      <input  name="my" class="form-control "  value="{{ $dream->my }}"  autofocus>
                      <span class="text-danger">@error('my') {{ $errors->first('my') }} @enderror</span>
                    </div>

                    <div class="col-md-6">
                      <input  name="th" class="form-control " value="{{ $dream->th }}"  autofocus>
                      <span class="text-danger">@error('th') {{ $errors->first('th') }} @enderror</span>
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
                         <div class="drop-zone">
                          <img class="OldImage" src="/public/images/{{ ($dream->image) }}" height="100px" width="100px">
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
                    @if(url()->previous()!='http://127.0.0.1:8000/totoSite')
                    <a class="btn  btn-info btn-lg " style="float:right;"   href="{{ url()->previous() }}">Back</a>
                    @else
                    <a class="btn  btn-info btn-lg " style="float:right;"   href="{{ route('totoSite.index') }}">Back</a>
                    @endif

                  </div>
                  <a href="" class="btn  btn-warning btn-lg " style="float:right;margin-right:1%;"  >Clear</a>

                  <button type="submit" class="btn btn-success" id="submitForm" style="float:right;font-size:19px">Submit</button>

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


