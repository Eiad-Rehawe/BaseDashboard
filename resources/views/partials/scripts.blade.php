<!-- Import Js Files -->

<script src="{{ asset('assets/dashboard/libs/jquery/dist/jquery.min.js') }}"></script>

<script src="{{asset('assets/dashboard/js/app.min.js')}}"></script>
<script src="{{asset('assets/dashboard/js/app.rtl.init.js')}}"></script>
<script src="{{ asset('assets/dashboard/libs/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{ asset('assets/dashboard/libs/simplebar/dist/simplebar.min.js')}}"></script>

<script src="{{asset('assets/dashboard/js/sidebarmenu.js')}}"></script>
<script src="{{asset('assets/dashboard/js/theme.js')}}"></script>
<script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>


<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('assets/dashboard/custom/script.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/quagga/0.12.1/quagga.min.js"></script>
<script src="{{ asset('assets/dashboard/custom/scanners.js') }}"></script>
<script>
    $(document).on('click','a[href="#finish"]',function(){
       $('.validation-wizard').submit()
    })
</script>

<script>
    $(document).on('click','#change_password',function(){
     
        $('#change_password_modal').modal('show')
    })
    $(document).on('click','#close',function(){
     
     $('#change_password_modal').modal('hide')
 })
 $(document).on('click','#export-pdf',function(){
     
     $('.export-pdf').modal('show')
 })

 $(document).on('click','#close_export-pdf',function(){
     
     $('.export-pdf').modal('hide')
 })
</script>

@stack('script')
