  <!-- General JS Scripts -->
  <form action="" method="POST" id="delete-action">
    @csrf
    @method('DELETE')
  </form>
  
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
  <script src="{{ asset('/admin/assets/js/stisla.js') }}"></script>

  <!-- Template JS File -->
  <script src="{{ asset('/admin/assets/js/scripts.js') }}"></script>
  <script src="{{ asset('/admin/assets/js/custom.js') }}"></script>
  <script>
    function deleteRow(url, name) {
      event.preventDefault();

      if( confirm('Apakah anda yakin akan menghapus ' + name + '?') ) {
        const form_delete = document.getElementById('delete-action');

        form_delete.setAttribute('action', url);
        form_delete.submit();
      }
    }
  </script>