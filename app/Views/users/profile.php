<?php echo $this->extend('template/admin_template'); ?>

<?php $this->section('content') ?>

<?php 

?>

<div class="pd-ltr-20 xs-pd-20-10">
    <div class="min-height-200px">
        <div class="row">
            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mb-30">
                <div class="pd-20 card-box height-100-p">
                    <div class="profile-photo">
                        
                        <img
                            src="<?php echo base_url(); ?>vendors/images/user.png"
                            alt=""
                            class="avatar-photo" />
                    </div>
                    <h5 class="text-center h5 mb-0"><?php echo session()->get('first_name'). " ". session()->get('last_name'); ?></h5>
                    
                    <div class="profile-info">
                        <h5 class="mb-20 h5 text-blue">Contact Information</h5>
                        <ul>
                            <li>
                                <span>SAP User Code : </span>
                                <?php echo session()->get('sap_user_code'); ?>
                            </li>

                            <li>
                                <span>Email Address:</span>
                                <?php echo session()->get('email'); ?>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <?php if(session()->get('group') == 'transporter') : ?>
            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 mb-30">
                <div class="card-box height-100-p overflow-hidden">
                    <div class="profile-tab height-100-p">
                        <div class="tab height-100-p">
                            <ul class="nav nav-tabs customtab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#head_masters" role="tab">Head Masters</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#trolley_masters" role="tab">Trolley Masters</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <!-- head_masters Tab start -->
                                <div class="tab-pane fade height-100-p active show" id="head_masters" role="tabpanel">
                                    <div class="profile-setting" id="head_master_table">
                                        
                                    </div>
                                </div>
                                <!-- head_masters Tab End -->
                                <!-- trolley_masters Tab start -->
                                <div class="tab-pane fade height-100-p" id="trolley_masters" role="tabpanel">
                                    <div class="profile-setting" id="trolley_master_table">
                                        
                                    </div>
                                </div>
                                <!-- trolley_masters Tab End -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<script>
    let get_head_master_data_url = "<?php echo base_url('users/get-head-master-data') ?>";
    let get_trolley_master_data_url = "<?php echo base_url('users/get-trolley-master-data') ?>";

    let add_head_master_url = "<?php echo base_url('users/add-head-master-data') ?>";
    let add_trolley_master_url = "<?php echo base_url("users/add-trolley-master-data");?>";
</script>
<script src="<?php echo base_url(); ?>portal/users/profile.js"></script>

<?php $this->endSection() ?>