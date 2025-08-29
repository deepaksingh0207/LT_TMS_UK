<?php echo $this->extend('template/admin_template'); ?>

<?php $this->section('content') ?>

<div class="xs-pd-20-10 pd-ltr-20">
    <div class="row pb-10" id="head_master_table">
        <?php echo view('delivery_orders/table_partial', ['orders' => $orders, 'pager' => $pager]); ?>
    </div>
</div>

<script src="<?php echo base_url(); ?>portal/delivery_orders/index.js"></script>
<?php $this->endSection() ?>