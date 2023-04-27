<!--begin::Content container-->
<div id="kt_app_content_container" class="app-container container-fluid">
    <!--begin::Form-->
    <form id="kt_add_form" class="form d-flex flex-column flex-lg-row" action="<?php echo $main_form_url ?>" method="post">
        <div class="d-flex flex-column flex-lg-row-fluid gap-7 gap-lg-10">
            <!--begin::Order details-->
            <div class="card card-flush py-4">
                <!--begin::Card header-->
                <div class="card-header">
                    <div class="card-title">
                        <h2><?php echo $title; ?></h2>
                    </div>
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <div class="d-flex flex-column gap-10">
                        
                        <div class="separator"></div>
                        
                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_ecommerce_edit_order_product_table">
                            <!--begin::Table head-->
                            <thead>
                                <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                    <th class="w-25px pe-2"></th>
                                    <th class="min-w-200px"><?php echo $this->lang->line("heading_add_product_title") ?></th>
                                </tr>
                            </thead>
                            <!--end::Table head-->
                            <!--begin::Table body-->
                            <tbody class="fv-row fw-semibold text-gray-600">
                                <?php foreach( $products as $key => $product ) { ?>
                                <tr>
                                    <!--begin::Checkbox-->
                                    <td>
                                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                                            <input class="form-check-input" type="radio" name="product_id" value="<?php echo encrypt($product["id"]) ?>" />
                                        </div>
                                    </td>
                                    <!--end::Checkbox-->
                                    <!--begin::Product=-->
                                    <td>
                                        <div class="d-flex align-items-center" data-kt-ecommerce-edit-order-filter="product" data-kt-ecommerce-edit-order-id="product_1">
                                            <!--
                                            <a href="../../demo42/dist/apps/ecommerce/catalog/edit-product.html" class="symbol symbol-50px">
                                                <span class="symbol-label" style="background-image:url(assets/media//stock/ecommerce/1.gif);"></span>
                                            </a>
                                            -->
                                            <!--end::Thumbnail-->
                                            <div class="ms-5">
                                                <!--begin::Title-->
                                                <a href="#" class="text-gray-800 text-hover-primary fs-5 fw-bold"><?php echo $product["name"]; ?></a>
                                                <!--end::Title-->
                                                <!--begin::Price-->
                                                <div class="fw-semibold fs-7">Price: 
                                                    <span data-kt-ecommerce-edit-order-filter="price"><?php echo round($product["product_price"],2) ?></span>
                                                </div>
                                            
                                                    
                                                <!--end::Price-->
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                            <!--end::Table body-->
                        </table>
                        <!--end::Table-->
                    </div>
                </div>
                <!--end::Card header-->
            </div>
            <!--end::Order details-->
            <!--begin::Order details-->
            <div class="card card-flush py-4">
                <!--begin::Card header-->
                <div class="card-header">
                    <div class="card-title">
                        <h2><?php echo $this->lang->line("heading_order_address_detail_title") ?></h2>
                    </div>
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <!--begin::Billing address-->
                    <div class="d-flex flex-column gap-5 gap-md-7">
                        <!--begin::Title-->
                        <div class="fs-3 fw-bold mb-n2"><?php echo $this->lang->line("heading_order_billing_address_detail_title") ?></div>
                        
                        <div class="d-flex flex-column flex-md-row gap-5">
                            <div class="fv-row flex-row-fluid">
                                <!--begin::Label-->
                                <label class="required form-label"><?php echo $this->lang->line("heading_listing_user_title") ?></label>
                                
                               <select  class="form-select"  name="user_id" data-control="select2">
                                    <?php foreach( $listing_users as $key=>$listing_user ) {?>
                                    <option value="<?php echo encrypt($listing_user["user_id"]) ?>" ><?php echo "{$listing_user["full_name"]} ({$listing_user["phone_no"]})" ?></option>
                                    <?php } ?>
                                </select> 
                                
                            </div>
                            <div class="fv-row flex-row-fluid">
                                <!--begin::Label-->
                                <label class="required form-label"><?php echo $this->lang->line("heading_address") ?></label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                
                                <input class="form-control" name="address" value="<?php echo $listing_data["address"]?:"" ?>" />
                                <!--end::Input-->
                            </div>
                        </div>
                        
                        <div class="d-flex flex-column flex-md-row gap-5">
                            <div class="fv-row flex-row-fluid <?php echo count($countries)==1 ?"d-none":"" ?>">
                                <!--begin::Label-->
                                <label class="required form-label"><?php echo $this->lang->line("heading_country") ?></label>
                                
                                <select  class="form-select"  name="country" data-control="select2">
                                    <?php foreach( $countries as $key=>$country ) {?>
                                    <option value="<?php echo encrypt($country["id"]) ?>" <?php echo ( count($countries)==1 || $country["id"]==$listing_data["|country"] )  ? "selected=''":"" ?>><?php echo $country["name"] ?></option>
                                    <?php } ?>
                                </select>
                                
                            </div>
                            
                            <div class="fv-row flex-row-fluid">
                                <!--begin::Label-->
                                <label class="required form-label"><?php echo $this->lang->line("heading_state") ?></label>
                                <select  class="form-select" name="state" data-control="select2">
                                    <?php 
                                    if( !empty($states) ) { 
                                        foreach( $states as $key=>$state ) {
                                    ?>
                                    <option value="<?php echo encrypt($state["id"]) ?>" <?php echo (  $state["id"]==$listing_data["state"] )  ? "selected=''":"" ?>><?php echo $state["name"] ?></option>
                                    <?php } 
                                    }?>
                                </select>
                            </div>
                            
                            <div class="fv-row flex-row-fluid">
                                <!--begin::Label-->
                                <label class="form-label"><?php echo $this->lang->line("heading_city") ?></label>
                                <select  class="form-select" name="city"  data-control="select2">
                                    <?php 
                                    if( !empty($cities) ) { 
                                        foreach( $cities as $key=>$city ) {
                                    ?>
                                    <option value="<?php echo encrypt($city["id"]) ?>" <?php echo (  $city["id"]==$listing_data["city"] )  ? "selected=''":"" ?>><?php echo $city["name"] ?></option>
                                    <?php } 
                                    }?>
                                </select>
                            </div>
                            <div class="fv-row flex-row-fluid">
                                <!--begin::Label-->
                                <label class="required form-label"><?php echo $this->lang->line("heading_zip_code") ?></label>
                                
                                <input class="form-control" name="postcode" placeholder="" value="<?php echo $listing_data["zip_code"] ?>" />
                               
                            </div>
                            
                        </div>
                    </div>
                    <!--end::Billing address-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Order details-->
            <div class="d-flex justify-content-end">
                <!--begin::Button-->
                <a href="<?php echo superadmin_url("listing/{$encoded_id}") ?>" id="kt_ecommerce_edit_order_cancel" class="btn btn-light me-5"><?php echo$this->lang->line("heading_cancel") ?></a>
                <!--end::Button-->
                <!--begin::Button-->
                <button type="submit" id="kt_submit_button" class="btn btn-primary">
                    <span class="indicator-label"><?php echo $this->lang->line("heading_submit_btn") ?></span>
                    <span class="indicator-progress"><?php echo $this->lang->line("heading_wait") ?>
                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                </button>
                <!--end::Button-->
            </div>
        </div>
        <!--end::Main column-->
    </form>
    <!--end::Form-->
</div>
<!--end::Content container-->
<script type="text/javascript">
    "use strict";
    var KTFormControls = function () {
        var t, e, i;
        return {
            init: function () {
                (i = document.querySelector("#kt_add_form")),
                        (t = document.getElementById("kt_submit_button")),
                        (e = FormValidation.formValidation(i, {
                            fields: {
                                postcode: { validators: { notEmpty: { message: "<?php echo sprintf($this->lang->line("message_field_required"),$this->lang->line("heading_zip_code")) ?>" } } },
                                user_id: { validators: { notEmpty: { message: "<?php echo sprintf($this->lang->line("message_field_required"),$this->lang->line("heading_listing_user_title")) ?>" } } },
                                address: { validators: { notEmpty: { message: "<?php echo sprintf($this->lang->line("message_field_required"),$this->lang->line("heading_address")) ?>" } } },
                                city: { validators: { notEmpty: { message: "<?php echo sprintf($this->lang->line("message_field_required"),$this->lang->line("heading_address")) ?>" } } },
                                
                                country: { validators: { notEmpty: { message: "<?php echo sprintf($this->lang->line("message_field_required"),$this->lang->line("heading_country")) ?>" } } },
                                state: { validators: { notEmpty: { message: "<?php echo sprintf($this->lang->line("message_field_required"),$this->lang->line("heading_state")) ?>" } } },
                                product_id: { validators: { notEmpty: { message: "<?php echo sprintf($this->lang->line("message_field_required"),$this->lang->line("heading_product_title")) ?>" } } },
                            },
                            plugins: {
                                trigger: new FormValidation.plugins.Trigger(),
                                bootstrap: new FormValidation.plugins.Bootstrap5({rowSelector: ".fv-row", eleInvalidClass: "", eleValidClass: ""}),
                                defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
                            },
                        })),
                        i.addEventListener("submit", function (i2) {
                            i2.preventDefault(),
                                    e &&
                                    e.validate().then(function (e) {
                                "Valid" == e
                                        ? (t.setAttribute("data-kt-indicator", "on"),
                                                (t.disabled = !0),
                                                setTimeout( function () {
                                                    t.removeAttribute("data-kt-indicator"),
                                                    (t.disabled = !1)
                                                }, 0) 
                                            )
                                        : Swal.fire({
                                            text: "<?php echo $this->lang->line("message_form_submit_error") ?>",
                                            icon: "error",
                                            buttonsStyling: !1,
                                            confirmButtonText: "<?php echo $this->lang->line("heading_form_submit_success_btn") ?>",
                                            customClass: {confirmButton: "btn btn-primary"},
                                        }).then(function (t) {
                                    KTUtil.scrollTop();
                                });
                            });
                        });
            },
        };
    
    }();
    $(function(){
        KTFormControls.init();
    });
    //kt_add_form
    
    
</script>