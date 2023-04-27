<div class="d-flex justify-content-end pb-5" data-kt-customer-table-toolbar="base">
    <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
        <div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
            <!--begin::Title-->
            <h1 class="page-heading d-flex flex-column justify-content-center text-dark fw-bold fs-3 m-0"><?php echo $title ?></h1>
            <!--end::Title-->
        </div>

        <!--end::Add customer-->
    </div>
    <!--end::Toolbar-->
</div>

<!--begin::Card-->
<div class="card_new">
    <!--begin::Card header-->
    
    <!--end::Card header-->
    <div class="card mb-5 mb-xl-10">
        <div class="card-body pt-9 pb-0">
            <div class="d-flex flex-wrap flex-sm-nowrap mb-3">
                <div class="flex-grow-1">
                    <!--begin::Title-->
                    <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                        <!--begin::User-->
                        <div class="d-flex flex-column">
                            <!--begin::Name-->
                            <div class="d-flex align-items-center mb-2">
                                <a href="#" class="text-gray-900 text-hover-primary fs-2 fw-bold me-1"><?php echo $module_name_heading = sprintf($this->lang->line("heading_group_name_permissions"),$group["name"]); ?></a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bold" id="pills-tab" role="tablist">
                <?php 
                $cnt=0;
                foreach($permissions as $module => $module_detail) { 
                    $module_name = ucwords( strtolower(str_replace('_', ' ', $module)) );
                ?>
                <!--begin::Nav item-->
                <li class="nav-item mt-2"  role="presentation">
                    <a class="nav-link text-active-primary ms-0 me-10 py-5 cursor-pointer <?php echo ++$cnt==1 ?"active":""; ?>" id="pills-<?php echo $module ?>-tab" data-bs-toggle="pill" data-bs-target="#pills-<?php echo $module ?>" role="tab" aria-controls="pills-<?php echo $module ?>" aria-selected="true"><?php echo $module_name;  ?></a>
                </li>
                <?php } ?>
            </ul>
        </div>
    </div>
    
    <div class="card mb-5 mb-xl-10">
        <div class="tab-content" id="pills-tabContent">
            <?php 
            $module_cnt=0;
            foreach($permissions as $module => $module_detail) { 
                $module_name = ucwords( strtolower(str_replace('_', ' ', $module)) );
            ?>
            <div class="tab-pane fade  <?php echo ++$module_cnt==1?"active show":""; ?>" id="pills-<?php echo $module ?>" role="tabpanel" aria-labelledby="pills-<?php echo $module ?>-tab">
                
                <?php foreach($module_detail as $permission_group_name=>$module_permission){ ?>
                <div class="accordion" id="accordionPanelsStay<?php echo $permission_group_name ?>Example">
                    <div class="accordion-item" style="border-radius: 0;">
                        <h2 class="accordion-header" id="panelsStayOpen-<?php echo "{$module}_{$permission_group_name}" ?>">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpencollapse-<?php echo "{$module}_{$permission_group_name}" ?>" aria-expanded="true" aria-controls="panelsStayOpen-<?php echo "{$module}_{$permission_group_name}" ?>"  style="border-top-left-radius: 0;border-top-right-radius: 0;">
                                <?php echo $permission_group_name ?>
                            </button>
                        </h2>
                        <div id="panelsStayOpencollapse-<?php echo "{$module}_{$permission_group_name}" ?>" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-<?php echo "{$module}_{$permission_group_name}" ?>">
                            <div class="accordion-body">
                                <?php 
                                $total_cnt = $cnt = 0;
                                foreach( $module_permission as $permission_name=>$permission_slug ) {
                                    if($cnt==0){
                                        echo "<div class='row'>";
                                    }
                                ?>
                                <div class="col-md-4">
                                    <div class="row mb-3">
                                        <div class="col-md-12 col-sm-12 d-flex">
                                            <div class="form-check form-switch form-check-custom form-check-solid ">

                                                <input class="form-check-input group_permission" type="checkbox" value="<?php echo $permission_slug ?>" name="<?php echo $module ?>" <?php echo ( !empty($group_permissions[$module]) && is_array($group_permissions[$module]) &&  in_array($permission_slug,$group_permissions[$module]) ) ? "checked=''":"" ?>  value="<?php echo $permission_slug ?>" />
                                            </div>
                                            <label class="m-3 mt-1 mb-1"><?php echo $permission_name ?></label>
                                        </div>

                                    </div>
                                </div>
                                <?php $cnt++; $total_cnt++;
                                    if($cnt==3 || $total_cnt==count($module_permission)){
                                        echo "</div>";
                                        $cnt=0;
                                    }
                                } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
            <?php } ?>
        </div>
    </div>
    
    

</div>
<!--end::Card-->

<script type="text/javascript">
    $(function(){
        $('.submit_permission').click(function (){
            $.ajax({
                type: "POST",
                cache: false,
                url: '<?php echo superadmin_url('roles_permission/assign_roles_permission') ?>',
                data: $("#permissions").serializeArray(),
                success: function (data)
                {
                    var array = JSON.parse(data);
                    $('.notification_wrap').html(array.data).fadeIn().delay(1500).fadeOut();
                    ;
                }
            });
        });
   
        $(document).on("click", ".group_permission", function () {
            var $this = $(this);
            permission = $this.val();
            permtype = $this.attr('name');
            keepPermission = $this.prop("checked");
            $.ajax({
                type: "POST",
                cache: false,
                url: '<?php echo $main_form_url; ?>',
                data: {keep: keepPermission, name: permission, type: permtype },
                success: function (data) {
                    //console.log(data);
                }
            });

        });
    })

    
</script>