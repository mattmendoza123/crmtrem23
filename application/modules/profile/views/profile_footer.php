<!-- Bootstrap popper Core JavaScript -->
<script src="<?= base_url() ?>assets/js/formvalidate.js"></script>
<script src="<?=base_url()?>assets/module/bootstrap/js/bootstrap.min.js"></script>
<script src="<?= base_url() . "assets"; ?>/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url() . "assets"; ?>/js/responsive.dataTables.min.js"></script>


<script type="text/javascript">
        $(document).ready(function() {
            $("input[type='radio']").change(function() {
                if ($(this).val() == "Other") {
                    $("#otheranswer").show();
                } else {
                    $("#otheranswer").hide();
                }
            });
        });

        $(document).ready(function() {
        $("#jobseeker").validate({
            rules: {
                postion_app: "required",

            },
            messages: {
                postion_app: "Please fill out this field",
            }
        });
    })

</script>
