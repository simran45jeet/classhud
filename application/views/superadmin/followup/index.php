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
                                        <?php echo $this->lang->line('heading_followup_add'); ?>
                                    </button>
                                </a>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <!-- Flash Message -->
                <form class="card-content collpase show" method="post" id="filter_form">

                    <div class="card-body card-dashboard">
                        <div class="row rfilters">
                            <div class="col-xl-3 col-lg-3  col-md-3 col-sm-3 lpad">
                                <label class="label-full-width" ><p><?php echo $this->lang->line('heading_followup_status'); ?>:</p>
                                    <select name="complete_status" id="complete_status" class="custom-select custom-select-sm form-control form-control-sm select2_single">
                                        <option value="<?php echo FOLLOWUP_STATUS_PENDING ?>" <?php echo ( isset($postData['complete_status']) && $postData['complete_status'] == FOLLOWUP_STATUS_PENDING )  ?"selected=''" :""?>><?php echo $this->lang->line('heading_followup_status_pending') ?></option>
                                        <option value="<?php echo FOLLOWUP_STATUS_COMPLETE ?>"  <?php echo ( !empty($postData['complete_status']) && $postData['complete_status'] == FOLLOWUP_STATUS_COMPLETE )  ?"selected=''" :""?>label=""><?php echo $this->lang->line('heading_followup_status_complete') ?></option>
                                        <option value="<?php echo FOLLOWUP_STATUS_CANCEL ?>"  <?php echo ( !empty($postData['complete_status']) && $postData['complete_status'] == FOLLOWUP_STATUS_CANCEL )  ?"selected=''" :""?>label=""><?php echo $this->lang->line('heading_followup_status_cancel') ?></option>
                                    </select>
                                </label>
                            </div>


                            <div class="col-xl-3 col-lg-3  col-md-3 col-sm-3 lpad">
                                <label class="label-full-width"><p><?php echo $this->lang->line('heading_date'); ?>:</p>
                                    <input type="text" name="follow_up_date" id="date" class="date form-control my-0 red-border" placeholder="" aria-controls="DataTables_Table_0" value="<?php echo $postData['follow_up_date']?:""; ?>"/>
                                </label>
                            </div>
                            <div class="col-xl-1 col-lg-1  col-md-1 col-sm-1 lpad">
                                <label class="label-full-width"><p>&nbsp;</p>
                                    <button type="submit" name="submit" class="btn btn-success form-control"><?php echo $this->lang->line('heading_save'); ?></button>
                                </label>
                            </div>
                        </div>
                    </div>
                </form>
                <!--row end-->
            </div>
            <div class="card" id="restaurant_data">
                <div class="card-body" >
                    <table class="table table-bordered table-hover table-checkable" id="crm_datatable">
                        <thead>
                            <tr>
                                <th width="5%">#</th> 
                                <th><?php echo $this->lang->line('heading_name'); ?></th> 
                                <th><?php echo $this->lang->line('heading_phone_no') ?></th>
                                <th><?php echo $this->lang->line('heading_date') ?></th>
                                <th><?php echo $this->lang->line('heading_action') ?></th>
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
                {data: 'phone_no'},
                {data: 'date'},
                {data: 'action',orderable: false }
            ]
        });
    });
</script>

