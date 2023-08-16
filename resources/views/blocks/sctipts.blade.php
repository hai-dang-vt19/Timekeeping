<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.min.js" integrity="sha384-Rx+T1VzGupg4BHQYs2gCW9It+akI2MM/mndMCy36UVfodzcJcF0GGLxZIzObiEfa" crossorigin="anonymous"></script>
<script>
            $(document).ready(function(){
              var multipleCancelButton = new Choices('#choices-multiple-remove-button', {
                removeItemButton: true,
                maxItemCount:50,
                searchResultLimit:50,
                renderChoiceLimit:50
              });
          });
</script>
<script>
    const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]')
    const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl))
</script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@if (session()->has('success'))
      <script>
        swal({
              title: "{{session()->get('success')}}",
              icon: "success",
              button: "OK",
            });
      </script>
@endif
@if (session()->has('error'))
      <script>
        swal({
              title: "{{session()->get('error')}}",
              icon: "error",
              button: "OK",
            });
      </script>
@endif
@if (session()->has('warning'))
      <script>
        swal({
              title: "{{session()->get('warning')}}",
              icon: "warning",
              button: "OK",
            });
      </script>
@endif