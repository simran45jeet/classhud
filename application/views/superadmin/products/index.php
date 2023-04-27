<section id="horizontal-form-layouts">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h2 class="pull-left full-width-res">
                        <?php echo $this->lang->line('heading_filter') ?>
                    </h2>
                    <div class="pull-right full-width-res">
                        <div class="dispaly-content-center">
                            <?php
                            if (hasPermission($this->userData['group_id'], "{$controllerName}.add", "{$moduleName}")) {
                            ?>
                            <a href="<?php echo superadmin_url("{$controllerName}/add"); ?>">
                                <button type="button" class="btn btn-success">
                                    <?php echo $this->lang->line('heading_product_add'); ?>
                                </button>
                            </a>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card" id="restaurant_data">
                <div class="card-body" >
                    <table class="table table-bordered table-hover table-checkable" id="crm_datatable">
                        <thead>
                            <tr>
                                <th width="5%">#</th> 
                                <th><?php echo $this->lang->line('heading_name'); ?></th> 
                                <th width="10%"><?php echo $this->lang->line('heading_action') ?></th>
                            </tr>
                        </thead> 
                        <tbody></tbody> 
                    </table>
                </div>
            </div>
        </div>  
    </div>
    <div class="clearfix"></div>  
</section>
<script type="text/javascript">
    $(function () {
        var formData = serializeObject($('form#filter_form'));
        $('#crm_datatable').DataTable({
            'processing': true,
            'serverSide': true,
            'serverMethod': 'post',
            'ajax': {
                url:"<?php echo superadmin_url("{$controllerName}/index") ?>",
                dataSrc:function(response){
                    return response.records;
                },
                type : 'post',
                data : formData
            },
            'columns': [
                {data: 'sr_no'},
                {data: 'name'},
                {data: 'action',orderable: false }
            ]
        });
    });
</script>

