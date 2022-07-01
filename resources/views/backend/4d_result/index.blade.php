@extends('backend.layouts.heade')

@section('content')

<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">4D Result <span style="font-size:18px;color:#869099">P0000015</span></h1>
        </div><!-- /.col -->
        <div class="col-sm-7">
          <ol class="breadcrumb float-sm-left">
           <!--breadcrumb-->

          </ol>

        </div><!-- /.col -->

      </div><!-- /.row -->
      <form action="{{ route('result.index') }}" method="GET" >
       @csrf
        <div class="form-group">
            <div class="row">
            <div class="col-md-6">
            <label>Date :</label>
            </div>
            </div>
            <div class="row">
            <div class="col-md-6">
              <div class="input-group date"  id="reservationdate" data-target-input="nearest" >
                  <input type="text" name="dd" class="form-control datetimepicker-input @error('dd') is-invalid @enderror" value="{{ $date }}" data-target="#reservationdate"/>
                  <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                      <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                  </div>
                  @error('dd')
                  <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                  </span>
                  @enderror
              </div>
            </div>
            <div class="col-md-1">
              <button type="submit" class="btn btn-success" id="submitButton" style="float:right;font-size:17px">Submit</button>
            </div>
            </div>
          </div>
      </form>
    </div>
    <!-- /.container-fluid -->
  </section>

   <!-- Main content -->
   <section class="content">
    <div class="container-fluid">
      <div class="row ">
        <div class="col-sm-12">
          <div class="card">
          @include('backend.4d_result.list1')
        </div>
      </div>
    </div>
    </div>
  </section>
<script type="text/javascript">
    $(function () {

        $('#reservationdate').datetimepicker({
            format: 'YYYY-MM-DD',
            maxDate:new Date()


        });

    });
</script>
  @include('backend.footerJS.create')


  @include('sweetalert::alert')


@endsection
