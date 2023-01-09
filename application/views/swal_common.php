<script type="text/javascript">
    $(document).ready(function(){

      Swal.fire({
        title: '<?= $content ?>',
  // text: "You won't be able to revert this!",
        type: '<?= (isset($icon)) ? $icon : 'info' ?>',
  // showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'OK'
      }).then((result) => {
        // if (result.value) {
        //   Swal.fire(
        //     'Deleted!',
        //     'Your file has been deleted.',
        //     'success'
        //   )
        // }
      })
    });
</script>
