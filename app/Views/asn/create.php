<?php echo $this->extend('template/admin_template'); ?>

<?php $this->section('content') ?>

<div class="pd-ltr-20 xs-pd-20-10">
    <div class="min-height-200px">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="title">
                        <h4>Create ASN</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="pd-20 bg-white border-radius-4 box-shadow mb-30">
            <form action="" method="post">
                <div class="form-group row">
                    <label class="col-sm-12 col-md-3 col-form-label">Number Of Vehicles : </label>
                    <div class="col-sm-12 col-md-9">
                        <input class="form-control" type="number" placeholder="No Of Vehicles">
                    </div>
                </div>
                <div class="form-group row">
                    <table class="table table-bordered">
                        <thead>
                            <th>Order No</th>
                            <th>Ship Party</th>
                            <th>Sold Party</th>
                            <th>Item Details</th>
                            <th>Assign Load</th>
                        </thead>
                        <tbody>
                            <?php foreach($orders_data as $orders) : ?>
                                <tr>
                                    <td></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $this->endSection() ?>