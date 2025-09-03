<?php echo $this->extend('template/admin_template'); ?>

<?php $this->section('content') ?>

<div class="xs-pd-20-10 pd-ltr-20">
    <div class="min-height-200px">
        <div class="title pb-20">
            <h2 class="h3 mb-0">Overview</h2>
        </div>
        <div class="row pb-10">
            <?php
                if(session()->get('group') == 'superadmin' || session()->get('group') == 'admin') {
                    $class = "col-xl-3 col-lg-3 col-md-3"; 
                }
                else if(session()->get('group') == 'transporter') {
                    $class = "col-xl-6 col-lg-6 col-md-6"; 
                }
            ?>
            <?php if(session()->get('group') == 'superadmin' || session()->get('group') == 'admin') : ?>   
            <div class="<?php echo $class; ?>">
                <div class="card-box height-100-p widget-style3">
                    <div class="d-flex flex-wrap">
                        <div class="widget-data">
                            <div class="weight-700 font-24 text-dark">75</div>
                            <div class="font-14 text-secondary weight-500">
                                Delivery Orders
                            </div>
                        </div>
                        <div class="widget-icon">
                            <div class="icon">
                                <i class="icon-copy bi bi-cart-check"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="<?php echo $class; ?>">
                <div class="card-box height-100-p widget-style3">
                    <div class="d-flex flex-wrap">
                        <div class="widget-data">
                            <div class="weight-700 font-24 text-dark">124,551</div>
                            <div class="font-14 text-secondary weight-500">
                                ASN/Trips
                            </div>
                        </div>
                        <div class="widget-icon">
                            <div class="icon">
                                <i class="icon-copy fa fa-file-text-o" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            <?php if(session()->get('group') == 'superadmin' || session()->get('group') == 'admin' || session()->get('group') == 'transporter') : ?>
            <div class="<?php echo $class; ?>">
                <div class="card-box height-100-p widget-style3">
                    <div class="d-flex flex-wrap">
                        <div class="widget-data">
                            <div class="weight-700 font-24 text-dark">400+</div>
                            <div class="font-14 text-secondary weight-500">
                                Users
                            </div>
                        </div>
                        <div class="widget-icon">
                            <div class="icon">
                               <i class="icon-copy bi bi-people"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="<?php echo $class; ?>">
                <div class="card-box height-100-p widget-style3">
                    <div class="d-flex flex-wrap">
                        <div class="widget-data">
                            <div class="weight-700 font-24 text-dark">50,000</div>
                            <div class="font-14 text-secondary weight-500">Transporters</div>
                        </div>
                        <div class="widget-icon">
                            <div class="icon">
                                <i class="icon-copy bi bi-person-workspace"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif;?>
        </div>
    </div>
</div>


<?php $this->endSection() ?>