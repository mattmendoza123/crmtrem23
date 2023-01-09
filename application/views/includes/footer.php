
    <script>
        const base_url = '<?= base_url(); ?>';
    </script>
    <script src="<?=base_url()?>assets/module/jquery/jquery.min.js"></script>
   <!-- Bootstrap popper Core JavaScript -->
   <script src="<?=base_url()?>assets/module/bootstrap/js/popper.min.js"></script>
   <script src="<?=base_url()?>assets/module/bootstrap/js/bootstrap.min.js"></script>
   <!-- slimscrollbar scrollbar JavaScript -->
   <script src="<?=base_url()?>assets/module/ps/perfect-scrollbar.jquery.min.js"></script>
   <!--Wave Effects -->
   <script src="<?=base_url()?>assets/js/waves.js"></script>
   <!--Menu sidebar -->
   <script src="<?=base_url()?>assets/js/sidebarmenu.js"></script>
   <!--Custom JavaScript -->
   <script src="<?=base_url()?>assets/js/custom.min.js"></script>
   <!-- ============================================================== -->
   <!-- This page plugins -->
   <!-- ============================================================== -->
   <!--morris JavaScript -->
   <script src="<?=base_url()?>assets/module/raphael/raphael.min.js"></script>
   <script src="<?=base_url()?>assets/module/morrisjs/morris.min.js"></script>
   <!--c3 JavaScript -->
   <script src="<?=base_url()?>assets/module/d3/d3.min.js"></script>
   <script src="<?=base_url()?>assets/module/c3-master/c3.min.js"></script>
   <!-- Popup message jquery -->
   <script src="<?=base_url()?>assets/module/sweetalert2/dist/sweetalert2.min.js"></script>
   <!-- Sweet alert jquery -->
   <script src="<?=base_url()?>assets/module/toast-master/js/jquery.toast.js"></script>
   <!-- Chart JS -->
   <script src="<?=base_url()?>assets/js/dashboard1.js"></script>
   <!-- ============================================================== -->
   <!-- Style switcher -->
   <!-- ============================================================== -->
   <script src="<?=base_url()?>assets/module/styleswitcher/jQuery.style.switcher.js"></script>


   <?php

   if ($this->session->has_userdata('modal')) {
       $data['content']=$this->session->userdata('modal');
       $this->load->view('swal_common',$data);
       // $this->load->view('modal_common',$data);

       // echo "<script>alert('".$this->session->userdata('alert')."');</script>";
       $this->session->unset_userdata('modal');
   }

   if ($this->session->has_userdata('swal')) {
       // $data['content']=$this->session->userdata('swal');
       $this->load->view('swal_common', array('content' => $this->session->userdata('swal')));
       $this->session->unset_userdata('swal');
   }

   if($this->session->flashdata('swals')){
       $swal = $this->session->flashdata('swals');
       $this->load->view('swal_common',$swal);
   }

   if (isset($add_to_footer)) {
       $add_to_footer_files = explode(',',$add_to_footer);
       foreach ($add_to_footer_files as $value) {
           $this->load->view($value);
       }
   }

   

    ?>


