<?php echo $this->extend('template/admin_template'); ?>

<?php $this->section('content') ?>

<div class="pd-ltr-5 xs-pd-20-10">
    <div class="min-height-200px">
        <div class="pd-10 bg-white border-radius-4 box-shadow mb-30">
            <div class="row d-flex justify-content-center">
                <div>
                    <h4>Create ASN</h4>
                </div>
            </div>
            <hr>
            <form action="" method="post">
                <div class="form-group row">
                    <label class="col-sm-12 col-md-3 col-form-label">Number Of Vehicles : </label>
                    <div class="col-sm-12 col-md-9">
                        <input class="form-control" type="number" placeholder="No Of Vehicles" id="no_of_vehicle" name="">
                    </div>
                </div>
                <div class="form-group row">
                    <table class="table table-bordered">
                        <thead>
                            <th>Order Data</th>
                            <th>Ship Party</th>
                            <th>Sold Party</th>
                            <th>Item Details</th>
                            <th>Assign Load</th>
                        </thead>
                        <tbody>
                            <?php foreach($orders_data as $order) : ?>
                                <tr>
                                    <td>
                                        <span> Order No : <?php echo $order['order_no'] ?></span><br>
                                        <span> Delivery Date : <?php echo $order['delivery_date'] ?></span>
                                    </td>
                                    <td>
                                        <span>Code : <?php echo $order['ship_to_party_code']; ?></span><br>
                                        <span>Name : <?php echo $order['ship_to_party_name']; ?></span>
                                    </td>
                                    <td>
                                        <span>Code : <?php echo $order['sold_to_party_code']; ?></span><br>
                                        <span>Name : <?php echo $order['sold_to_party_name']; ?></span>
                                    </td>
                                    <td>
                                        <?php foreach($order['order_items'] as $item) : ?>
                                            <span><?php echo $item['material_code']."-".$item['material_name']; ?></span><br>
                                            <span>Qty : <?php echo $item['delivery_qty']; ?> </span><br>
                                            <span>Plant : <?php echo $item['plant']; ?> Batch : <?php echo $item['batch'] ?></span>
                                            <br>
                                            <hr>
                                        <?php endforeach; ?>    
                                    </td>
                                    <td id = "order_id_<?php echo $order['id']; ?>" >
                                        <select name="" id="" class="form-control load-dropdown" data-style = "btn-outline-primary">
                                            <option value="" selected disabled>---Select Load---</option>
                                        </select>
                                        
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="vehicle_no">Vehicle No : </label>
                        <input type="text" name="vehicle_no" id="vehicle_no" class="form-control" placeholder="Enter Vehicle No">
                    </div>
                    <div class="col-md-6">
                        <label for="trolley_no">Trolley No : </label>
                        <input type="text" name="trolley_no" id="trolley_no" class="form-control" placeholder="Enter Trolley No">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6">
                        <label for="driver_name">Driver Name</label>
                        <input class = "form-control" type="text" name="" id="driver_name" placeholder="Enter Driver Name">
                    </div>
                    <div class="col-md-6">
                        <label for="driver_contact">Driver Contact</label>
                        <input class = "form-control" type="text" name="" id="driver_contact" placeholder="Enter Driver Name">
                    </div>
                </div>
                <div class="row d-flex justify-content-end">
                <div class="col-md-1 mr-2">
                    <button type="button" class="btn btn-primary">Submit</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>

<script src="<?php echo base_url(); ?>portal/asn/create.js"></script>
<?php $this->endSection() ?>