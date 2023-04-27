<div id="kt_app_toolbar" class="app-toolbar pb-5 pb-lg-10">
    <!--begin::Toolbar container-->
    <div id="kt_app_toolbar_container" class="container-xxl d-flex flex-stack flex-wrap">        
        <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
            <!--begin::Page title-->
            <div class="page-title d-flex flex-column justify-content-center gap-1 me-3">
                <!--begin::Title-->
                <h1 class="page-heading d-flex flex-column justify-content-center text-dark fw-bold fs-3 m-0"><?php echo $this->lang->line("heading_dashboard_title") ?></h1>
                
            </div>
            
        </div><!--end::Toolbar wrapper-->
    </div>
    <!--end::Toolbar container-->
</div>
<div class="row gy-5 g-xl-10">
    <div class="col-sm-6 col-xl-3 mb-xl-10">
        <!--begin::Card widget 2-->
        <div class="card h-lg-100">
            <!--begin::Body-->
            <div class="card-body d-flex justify-content-between align-items-start flex-column">

                <!--begin::Section-->
                <div class="d-flex flex-column my-7">
                    <!--begin::Number-->
                    <span class="fw-semibold fs-3x text-gray-800 lh-1 ls-n2"><?php echo $total_pending_listing ?></span>
                    <!--end::Number-->
                    <!--begin::Follower-->
                    <div class="m-0">
                        <span class="fw-semibold fs-6 text-gray-400"><?php echo $this->lang->line("heading_dashboard_total_pending_listing_title") ?></span>
                    </div>
                    <!--end::Follower-->
                </div>
            </div>
            <!--end::Body-->
        </div>
        <!--end::Card widget 2-->
    </div>

    <div class="col-sm-6 col-xl-3 mb-xl-10">
        <!--begin::Card widget 2-->
        <div class="card h-lg-100">
            <!--begin::Body-->
            <div class="card-body d-flex justify-content-between align-items-start flex-column">

                <!--begin::Section-->
                <div class="d-flex flex-column my-7">
                    <!--begin::Number-->
                    <span class="fw-semibold fs-3x text-gray-800 lh-1 ls-n2"><?php echo $today_total_listing ?></span>
                    <!--end::Number-->
                    <!--begin::Follower-->
                    <div class="m-0">
                        <span class="fw-semibold fs-6 text-gray-400"><?php echo $this->lang->line("heading_dashboard_today_listing_title") ?></span>
                    </div>
                    <!--end::Follower-->
                </div>
            </div>
            <!--end::Body-->
        </div>
        <!--end::Card widget 2-->
    </div>

    <div class="col-sm-6 col-xl-3 mb-xl-10">
        <!--begin::Card widget 2-->
        <div class="card h-lg-100">
            <!--begin::Body-->
            <div class="card-body d-flex justify-content-between align-items-start flex-column">

                <!--begin::Section-->
                <div class="d-flex flex-column my-7">
                    <!--begin::Number-->
                    <span class="fw-semibold fs-3x text-gray-800 lh-1 ls-n2"><?php echo $total_listing ?></span>
                    <!--end::Number-->
                    <!--begin::Follower-->
                    <div class="m-0">
                        <span class="fw-semibold fs-6 text-gray-400"><?php echo $this->lang->line("heading_dashboard_total_listing_title") ?></span>
                    </div>
                    <!--end::Follower-->
                </div>
            </div>
            <!--end::Body-->
        </div>
        <!--end::Card widget 2-->
    </div>

    <div class="col-sm-6 col-xl-3 mb-xl-10">
        <!--begin::Card widget 2-->
        <div class="card h-lg-100">
            <!--begin::Body-->
            <div class="card-body d-flex justify-content-between align-items-start flex-column">

                <!--begin::Section-->
                <div class="d-flex flex-column my-7">
                    <!--begin::Number-->
                    <span class="fw-semibold fs-3x text-gray-800 lh-1 ls-n2"><?php echo $today_total_reviews ?></span>
                    <!--end::Number-->
                    <!--begin::Follower-->
                    <div class="m-0">
                        <span class="fw-semibold fs-6 text-gray-400"><?php echo $this->lang->line("heading_dashboard_today_reviews_title") ?></span>
                    </div>
                    <!--end::Follower-->
                </div>
            </div>
            <!--end::Body-->
        </div>
        <!--end::Card widget 2-->
    </div>

    <div class="col-sm-6 col-xl-3 mb-xl-10">
        <!--begin::Card widget 2-->
        <div class="card h-lg-100">
            <!--begin::Body-->
            <div class="card-body d-flex justify-content-between align-items-start flex-column">

                <!--begin::Section-->
                <div class="d-flex flex-column my-7">
                    <!--begin::Number-->
                    <span class="fw-semibold fs-3x text-gray-800 lh-1 ls-n2"><?php echo $total_reviews ?></span>
                    <!--end::Number-->
                    <!--begin::Follower-->
                    <div class="m-0">
                        <span class="fw-semibold fs-6 text-gray-400"><?php echo $this->lang->line("heading_dashboard_total_reviews_title") ?></span>
                    </div>
                    <!--end::Follower-->
                </div>
            </div>
            <!--end::Body-->
        </div>
        <!--end::Card widget 2-->
    </div>

    <div class="col-sm-6 col-xl-3 mb-xl-10">
        <!--begin::Card widget 2-->
        <div class="card h-lg-100">
            <!--begin::Body-->
            <div class="card-body d-flex justify-content-between align-items-start flex-column">

                <!--begin::Section-->
                <div class="d-flex flex-column my-7">
                    <!--begin::Number-->
                    <span class="fw-semibold fs-3x text-gray-800 lh-1 ls-n2"><?php echo $pending_total_reviews ?></span>
                    <!--end::Number-->
                    <!--begin::Follower-->
                    <div class="m-0">
                        <span class="fw-semibold fs-6 text-gray-400"><?php echo $this->lang->line("heading_dashboard_total_penging_reviews_title") ?></span>
                    </div>
                    <!--end::Follower-->
                </div>
            </div>
            <!--end::Body-->
        </div>
        <!--end::Card widget 2-->
    </div>
</div>
