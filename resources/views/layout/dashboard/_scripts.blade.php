<script src="{{ asset('asset/dashboard') }}/vendors/js/vendors.min.js"></script>


<script src="{{ asset('asset/dashboard') }}/vendors/js/timeline/horizontal-timeline.js"></script>

<script src="{{ asset('asset/dashboard') }}/js/core/app-menu.js"></script>
<script src="{{ asset('asset/dashboard') }}/js/core/app.js"></script>
<script src="{{ asset('asset/dashboard') }}/js/scripts/customizer.js"></script>
<script src="{{ asset('asset/dashboard') }}/vendors/js/forms/icheck/icheck.min.js" type="text/javascript"></script>
<script src="{{ asset('asset/dashboard') }}/vendors/js/forms/toggle/bootstrap-checkbox.min.js"></script>



 {{-- File Input  --}}
 <script src="{{ asset('vendor/file-input/js/fileinput.min.js') }}"></script>
 <script src="{{ asset('vendor/file-input/themes/fa5/theme.min.js') }}"></script>





<script>
    $(function (){
        $('#singlimage').fileinput({
    theme: 'fa5',
              showCancel: true,
              
                 maxFileCount: 1,
    showUpload: false,
    showRemove: true,        
    enableResumableUpload: false,
    browseLabel: 'select image', 
        });

    });
</script>






{{-- alert sweet Delete--}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  $(document).on('click', '.delete_confirm', function (e) {
    e.preventDefault();
    form =$(this).closest('form');
    const swalWithBootstrapButtons = Swal.mixin({
      customClass: {
        confirmButton: "btn btn-success",
        cancelButton: "btn btn-danger"
      },
      buttonsStyling: true
    });
    swalWithBootstrapButtons.fire({
      title: "Are you sure?",
      text: "You won't be able to revert this!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonText: "Yes, delete it!",
      cancelButtonText: "No, cancel!",
      reverseButtons: true
    }).then((result) => {
      if (result.isConfirmed) 
      form.submit(),
      swalWithBootstrapButtons.fire({
        
        title: "Deleted!",
        text: "Your file has been deleted.",
        icon: "success"
      });
      else if (result.dismiss === Swal.DismissReason.cancel)
        /* Read more about handling dismissals below */
        swalWithBootstrapButtons.fire({
          title: "Cancelled",
          text: "Your imaginary file is safe :)",
          icon: "error"
        });
    });
  });
</script>
{{-- End alert sweet Delete --}}
{{--  alert sweet status --}}
<script>
$(document).on('click','.change_status',function(e){
  e.preventDefault();
 let form=$(this).closest('form');
  
Swal.fire({
  title: "Are you sure?",
  text: "Do you want to change the status of this ?",
  icon: "warning",
  showCancelButton: true,
  confirmButtonColor: "#3085d6",
  cancelButtonColor: "#d33",
  confirmButtonText: "Yes, change status!"
}).then((result) => {
  if (result.isConfirmed)
  form.submit();

});
});
</script>
{{-- End alert sweet status --}}


{{-- DataTables Cdn --}}

 {{-- Cdn DataTable --}}
  <script src="https://cdn.datatables.net/2.3.8/js/dataTables.min.js" type="text/javascript"></script>
  {{-- Cdn Button --}}
  <script src="https://cdn.datatables.net/buttons/3.2.6/js/dataTables.buttons.min.js" type="text/javascript"></script>
  {{-- Cdn colVis --}}
  <script src="https://cdn.datatables.net/buttons/3.2.6/js/buttons.colVis.min.js" type="text/javascript"></script>
  {{-- Cdn print --}}
  <script src="https://cdn.datatables.net/buttons/3.2.6/js/buttons.print.min.js" type="text/javascript"></script>
  {{-- Cdn copy --}}
  <script src="https://cdn.datatables.net/buttons/3.2.6/js/buttons.html5.min.js" type="text/javascript"></script>
  {{-- Cdn excel --}}
  <script src="{{ asset('vendor/datatables/excel/jszip.min.js') }}"></script>
  {{-- Cdn pdf --}}
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.66/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.66/vfs_fonts.js"></script>
  {{-- Cdn responsive --}}
  <script src="https://cdn.datatables.net/responsive/3.0.8/js/dataTables.responsive.min.js"></script>
  {{-- Cdn colReorder --}}
  <script src="https://cdn.datatables.net/colreorder/2.1.2/js/dataTables.colReorder.min.js"></script>

  {{-- Cdn rowReorder --}}
  {{-- <script src="https://cdn.datatables.net/rowreorder/1.5.1/js/dataTables.rowReorder.min.js"></script> --}}

  {{-- Cdn select --}}
  <script src="https://cdn.datatables.net/select/3.1.3/js/dataTables.select.min.js"></script>
  {{-- Cdn Scroller --}}
  <script src="https://cdn.datatables.net/scroller/2.4.3/js/dataTables.scroller.min.js"></script>
  {{-- Cdn FixedHeader --}}
  <script src="https://cdn.datatables.net/fixedcolumns/5.0.5/js/fixedColumns.bootstrap5.min.js"></script>
  <script src="https://cdn.datatables.net/fixedcolumns/5.0.5/js/dataTables.fixedColumns.min.js"></script>

  {{-- End  DataTables Cdn --}}

@stack('scripts')