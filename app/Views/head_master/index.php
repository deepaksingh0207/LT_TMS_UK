<?php echo $this->extend('template/admin_template'); ?>

<?php $this->section('content') ?>

<div class="xs-pd-20-10 pd-ltr-20">
    <div class="row pb-10" id="data-container">
        <div class="col-xl-12 col-lg-12 col-md-12 card-box pb-10">
            <div class="row h5 pd-20 mb-0">
                <div class="col-md-10">Head Master</div>
            </div>
            <?php echo view('users/head_masters_table_partial', ['head_masters' => $head_masters, 'pager' => $pager]); ?>
        </div>
    </div>
</div>

<?php $this->endSection() ?>