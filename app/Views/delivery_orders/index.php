<?php echo $this->extend('template/admin_template'); ?>

<?php $this->section('content') ?>

<div class="xs-pd-20-10 pd-ltr-20">
    <div class="row pb-10" id="delivery_orders_table">
        <?php echo view('delivery_orders/table_partial', ['orders' => $orders, 'pager' => $pager]); ?>
    </div>
</div>
<div class="modal" id="confirmation-modal" tabindex="-1" role="dialog" aria-modal="true">
    <div class="modal-dialog modal-dialog-top" role="document">
        <div class="modal-content">
            <div class="modal-body text-center font-18">
                <h4 class="padding-top-30 mb-30 weight-500">
                    Are you sure you want to continue?
                </h4>
                <div class="padding-bottom-30 row" style="max-width: 170px; margin: 0 auto">
                    <div class="col-6">
                        <button type="button" class="btn btn-secondary border-radius-100 btn-block confirmation-btn" data-dismiss="modal">
                            <i class="fa fa-times"></i>
                        </button>
                        NO
                    </div>
                    <div class="col-6">
                        <button type="button" class="btn btn-primary border-radius-100 btn-block confirmation-btn" id="yes_confirm_btn">
                            <i class="fa fa-check"></i>
                        </button>
                        YES
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    let assign_transporter_url = "<?php echo base_url("delivery_orders/assign-transporter")?>";
</script>
<script src="<?php echo base_url(); ?>portal/delivery_orders/index.js"></script>
<?php $this->endSection() ?>