<style type="text/css">
    .custom-breadcrumb { display: none !important; }
    #submit-job-form .container.single-content-inner{padding:0}
    #wp-content{background:none}
</style>
<script type="text/javascript">
    lattude = "<?php echo $post_data["latitude"] ?>";
    lattude = "<?php echo $post_data["latitude"] ?>";
    google_location = "<?php echo $post_data["google_location"] ?>";
    place_id = "<?php echo $post_data["place_id"] ?>";
</script>
<?php $this->load->view("{$module_name}/listing/add"); ?>