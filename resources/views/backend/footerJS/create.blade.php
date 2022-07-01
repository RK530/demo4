<!-- jQuery -->
<script src="{{ asset('backend/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('backend/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- Select2 -->
<script src="{{ asset('backend/plugins/select2/js/select2.full.min.js') }}"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="{{ asset('backend/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js') }}"></script>
<!-- InputMask -->
<script src="{{ asset('backend/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('backend/plugins/inputmask/jquery.inputmask.min.js') }}"></script>
<!-- date-range-picker -->
<script src="{{ asset('backend/plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- bootstrap color picker -->
<script src="{{ asset('backend/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('backend/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- Bootstrap Switch -->
<script src="{{ asset('backend/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script>
<!-- BS-Stepper -->
<script src="{{ asset('backend/plugins/bs-stepper/js/bs-stepper.min.js') }}"></script>
<!-- dropzonejs -->
<script src="{{ asset('backend/plugins/dropzone/min/dropzone.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('backend/dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('backend/dist/js/demo.js') }}"></script>
<!-- SweetAlert2 -->
<script src="{{ asset('backend/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<!-- Toastr -->
<script src="{{ asset('backend/plugins/toastr/toastr.min.js') }}"></script>
<!-- Page specific script -->

<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date picker
    $('#reservationdate').datetimepicker({
        format: 'YYYY-MM-DD'
    });

    //Date and time picker
    $('#reservationdatetime').datetimepicker();

    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({
      timePicker: true,
      timePickerIncrement: 30,
      locale: {
        format: 'YYYY-MMM-DD'
      }
    })



    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Timepicker
    $('#timepicker').datetimepicker({
      format: 'LT'
    })

    //Bootstrap Duallistbox
    $('.duallistbox').bootstrapDualListbox()

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    $('.my-colorpicker2').on('colorpickerChange', function(event) {
      $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
    })

    $("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    })

  })
  // BS-Stepper Init
  document.addEventListener('DOMContentLoaded', function () {
    window.stepper = new Stepper(document.querySelector('.bs-stepper'))
  })

  // DropzoneJS Demo Code Start
  Dropzone.autoDiscover = false

  // Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
  var previewNode = document.querySelector("#template")
  previewNode.id = ""
  var previewTemplate = previewNode.parentNode.innerHTML
  previewNode.parentNode.removeChild(previewNode)

  var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
    url: "/target-url", // Set the url
    thumbnailWidth: 80,
    thumbnailHeight: 80,
    parallelUploads: 20,
    previewTemplate: previewTemplate,
    autoQueue: false, // Make sure the files aren't queued until manually added
    previewsContainer: "#previews", // Define the container to display the previews
    clickable: ".fileinput-button" // Define the element that should be used as click trigger to select files.
  })

  myDropzone.on("addedfile", function(file) {
    // Hookup the start button
    file.previewElement.querySelector(".start").onclick = function() { myDropzone.enqueueFile(file) }
  })

  // Update the total progress bar
  myDropzone.on("totaluploadprogress", function(progress) {
    document.querySelector("#total-progress .progress-bar").style.width = progress + "%"
  })

  myDropzone.on("sending", function(file) {
    // Show the total progress bar when upload starts
    document.querySelector("#total-progress").style.opacity = "1"
    // And disable the start button
    file.previewElement.querySelector(".start").setAttribute("disabled", "disabled")
  })

  // Hide the total progress bar when nothing's uploading anymore
  myDropzone.on("queuecomplete", function(progress) {
    document.querySelector("#total-progress").style.opacity = "0"
  })

  // Setup the buttons for all transfers
  // The "add files" button doesn't need to be setup because the config
  // `clickable` has already been specified.
  document.querySelector("#actions .start").onclick = function() {
    myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED))
  }
  document.querySelector("#actions .cancel").onclick = function() {
    myDropzone.removeAllFiles(true)
  }
  // DropzoneJS Demo Code End

</script>

<script>
  

   $('.submitForm').on('click',function(e){
        e.preventDefault();
      var form = $(this).parents('form');
      
      $delete_id =$('.deletebtn_id').val();
      $id = $delete_id;
      console.log($id);
        Swal.fire({
            title: 'Do you want to save the change?',
            text: "You won't be able to revert this!", 
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: `Don't save`,
            confirmButtonText: 'Save it',
            dangerMode:true,
        }).then((result) => {
            if (result.isConfirmed) {
              $.ajaxSetup({
              headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }});
              $.ajax({
                type:"GET",
                url:"/employee/" +$id,

                success:function(){
                  Swal.fire({
              title: 'Save Success',
              icon: 'success'
            }).then(function(){

              form.submit();
            });


                }
              });
              
               
            }else{
              Swal.fire('Cancelled','You file is safe','error');
            }
        });
    });
</script>

<script>
  $('.btn-success').on('click',function(e){
         e.preventDefault();
       var form = $(this).parents('form');
        Swal.fire({
             title: 'Are you sure to submit it?',
             text: "Make sure user information is correct it", 
             icon: 'warning',
             showCancelButton: true,
             confirmButtonColor: '#3085d6',
             cancelButtonColor: '#d33',
             cancelButtonText: `No`,
             confirmButtonText: 'Yes, Submit it',
             dangerMode:true,
         }).then((result) => {
             if (result.isConfirmed) {
                  form.submit();
          
             }else{
               Swal.fire('Cancelled','Make sure their are correct it','error');
             }
         });
     });
    
 </script>


<script type="text/javascript">
  
  document.querySelectorAll(".drop-zone__input").forEach(inputElement=>{
    const dropZoneElement = inputElement.closest('.drop-zone');

    dropZoneElement.addEventListener("click",e=>{
      inputElement.click();
    });
    //setting can click event

    inputElement.addEventListener("change",e=>{
      if(inputElement.files.length){
        updateThumbnail(dropZoneElement,inputElement.files[0]);
      }
    });

    dropZoneElement.addEventListener('dragover',e=>{
      e.preventDefault();
      dropZoneElement.classList.add('drop-zone--over');
    });

    ['dragleave','dragend'].forEach(type=>{
      dropZoneElement.addEventListener(type , e=>{
        dropZoneElement.classList.remove('drop-zone--over');
      });     
    });
    dropZoneElement.addEventListener('drop',e =>{
      e.preventDefault();
      //console.log(e.dataTransfer.files);
      if(e.dataTransfer.files.length){
        inputElement.files=e.dataTransfer.files;
       // console.log(e.dataTransfer.files[0]); upload file
        updateThumbnail(dropZoneElement,e.dataTransfer.files[0]);
      }
      dropZoneElement.classList.remove('drop-zone--over');//remove css
    });
  });

  function updateThumbnail(dropZoneElement,file){
    console.log(dropZoneElement);
    console.log(file);
    let thumbnailElement= dropZoneElement.querySelector('drop-zone__thumb');

    if(dropZoneElement.querySelector('.drop-zone__prompt')){
      dropZoneElement.querySelector('.drop-zone__prompt').remove();
      dropZoneElement.querySelector('.OldImage').remove();//remove image
    }
    if(!thumbnailElement){
      thumbnailElement =document.createElement('div');
      thumbnailElement.classList.add('drop-zone__thumb');
      dropZoneElement.appendChild(thumbnailElement);//add thumbnailElement in dropZone

      
    }
    thumbnailElement.dataset.label=file.name;//take css of label  rename to file name

    if(file.type.startsWith('image/')){
      const reader =new FileReader();
      reader.readAsDataURL(file);
      reader.onload=()=>{
        thumbnailElement.style.backgroundImage=`url('${reader.result}')`;
        let btn = document.createElement('button');//close button 
                    btn.innerHTML = "x";
                    btn.style.cssText = `
                        position: absolute; 
                        right: -2px; 
                        top:-10px;
                        color:red;
                        border:none;
                        background:none;
                        font-size:30px;
                    `;
    
                    //add btn to frame 
                    thumbnailElement.append(btn);

                   
                    
                    //set event btn and exec remove frame
                    btn.addEventListener('click', e => {
                        e.target.parentElement.remove();
                    });
      };
    }else{
      thumbnailElement.style.backgroundImage=null;
    }
  }
 

</script>


<style>
.drop-zone{
  max-width: 100%;
  height: 200px;
  padding: 10px;
  display: flex;
  align-items: center;
  justify-content: center;
  text-align: center;
  cursor: pointer;
  border-radius: 10px;
  border: 4px dashed #009678;
  
}

.drop-zone--over{
  border-style: solid;
}
.drop-zone__input{
  display: none;
}
.drop-zone__thumb{
  width: 100px;
  height: 100px;
  border-radius: 10px;
  overflow: hidden;
  background-color: #cccccc;
  background-size: cover;
  position: relative;
}
.drop-zone__thumb::after{
  content: attr(data-label);
  position: relative;
  bottom: 0;
  top: 0;
  width: 10px;
  padding: 5px 0;
  color: #ffffff;
  background-color: rgba(0, 0, 0,0.75);
  text-align: center;
  font-size: 14px
}
</style>
<!--edit and create alert-->
<script>
  $('.btn-success').on('click',function(e){
         e.preventDefault();
       var form = $(this).parents('form');
        Swal.fire({
             title: 'Are you sure to submit it?',
             text: "Make sure user information is correct it", 
             icon: 'warning',
             showCancelButton: true,
             confirmButtonColor: '#3085d6',
             cancelButtonColor: '#d33',
             cancelButtonText: `No`,
             confirmButtonText: 'Yes, Submit it',
             dangerMode:true,
         }).then((result) => {
             if (result.isConfirmed) {
                  form.submit();
          
             }else{
               Swal.fire('Cancelled','Make sure their are correct it','error');
             }
         });
     });
    
 </script>

 <!--delete alert-->
<script>
  $('.btn-danger').on('click',function(e){
         e.preventDefault();
       var form = $(this).parents('form');
        Swal.fire({
             title: 'Do you want to delete?',
             text: "You won't be able to revert this!", 
             icon: 'warning',
             showCancelButton: true,
             confirmButtonColor: '#3085d6',
             cancelButtonColor: '#d33',
             cancelButtonText: `Don't delete`,
             confirmButtonText: 'Yes, Delete it',
             dangerMode:true,
         }).then((result) => {
             if (result.isConfirmed) {
                  form.submit();
          
             }else{
               Swal.fire('Cancelled','You file is safe','error');
             }
         });
     });
    
 </script>

<script>
  $(function() {
      $("input.numonly").on('input', function(e) {
          $(this).val($(this).val().replace(/[^0-9]/g, ''));
      });
  });
</script>

