<?php
$toast_success_msg = $toast_error_msg = "";

if ($this->session->flashdata('message')) {
    $toast_success_msg = $this->session->flashdata('message');
    $this->session->unset_userdata('message');
} elseif ($this->session->flashdata('error_message')) {
    $toast_error_msg = $this->session->userdata('error_message');
    $this->session->unset_userdata('error_message');
}


if ($toast_success_msg){ ?>
    <script type="text/javascript">
        $(function(){ success_message("<?php echo $toast_success_msg ?>"); });
    </script>
<?php }elseif ($toast_error_msg) { ?>
    <script type="text/javascript">
        $(function(){ error_message("<?php echo $toast_error_msg ?>"); });
    </script>
<?php } ?>
