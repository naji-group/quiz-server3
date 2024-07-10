 <!--   Core JS Files   -->
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
 <script src="{{ url('assets/admin/js/core/popper.min.js') }}"></script>
 <script src="{{ url('assets/admin/js/core/bootstrap.min.js') }}"></script>
 <script src="{{ url('assets/admin/js/plugins/perfect-scrollbar.min.js') }}"></script>
 <script src="{{ url('assets/admin/js/plugins/smooth-scrollbar.min.js') }}"></script>
 <script src="{{ url('assets/admin/js/plugins/chartjs.min.js') }}"></script>
 
 <script>
     var win = navigator.platform.indexOf('Win') > -1;
     if (win && document.querySelector('#sidenav-scrollbar')) {
         var options = {
             damping: '0.5'
         }
         Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
     }
 </script>
 <!-- Github buttons -->
 <script async defer src="https://buttons.github.io/buttons.js"></script>
 <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
 <script src="{{ asset('assets/admin/js/material-dashboard.min.js?v=3.0.2') }}"></script>
 <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
     integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous">
 </script>
 <!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"-->
 <!--    integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous">-->
 <!--</script>-->

 <!--<script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>-->
 {{-- <script src="{{url("ckeditor/ckeditor.js")}}"></script> --}}
 <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
 <script src="{{ URL::asset('assets/admin/js/resumable.min.js') }}"></script>
 @if (session('success'))
     <script>
         swal("{{ session('success') }}");
     </script>
 @endif
 @yield('script')
 @yield('js')
</body>

</html>
<style>

</style>
