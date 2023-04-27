<h3 class="page-title"><?php echo $this->lang->line("heading_dashboard") ?></h3>
<div class="dashboard-inner-block">
    <div class="lg-block-grid-4">
        <div class="item-columns">
            <div class="dashboard-card all-listings">
                <div class="content-inner">
                    <div class="value"><?php echo $total_listing; ?></div>
                    <div class="label"><?php echo $this->lang->line("heading_all_listings") ?></div>
                </div>
<!--                <div class="icon">
                    <i class="fas fa-map-marked-alt">
                    </i>
                </div>-->
            </div>
        </div>
        
        <div class="item-columns">
            <div class="dashboard-card published">
                <div class="content-inner">
                    <div class="value"><?php echo $approved_listing ?></div>
                    <div class="label"><?php echo $this->lang->line("heading_published") ?></div>
                </div>
<!--                <div class="icon">
                    <i class="fas fa-calendar-check">
                    </i>
                </div>-->
            </div>
        </div>
        <div class="item-columns">
            <div class="dashboard-card pending">
                <div class="content-inner">
                    <div class="value"><?php echo $pending_listing ?></div>
                    <div class="label"><?php echo $this->lang->line("heading_pending") ?></div>
                </div>
<!--                <div class="icon">
                    <i class="fas fa-sync">
                    </i>
                </div>-->
            </div>
        </div>
        <div class="item-columns">
            <div class="dashboard-card expired">
                <div class="content-inner">
                    <div class="value"><?php echo $disapproved_listing ?></div>
                    <div class="label"><?php echo $this->lang->line("heading_rejected") ?></div>
                </div>
<!--                <div class="icon">
                    <i class="fas fa-calendar-times">
                    </i>
                </div>-->
            </div>
        </div>
    </div>
</div>