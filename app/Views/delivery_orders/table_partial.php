<div class="col-xl-12 col-lg-12 col-md-12 card-box pb-10">
    <div class="row h5 pd-20 mb-0">
        <div class="col-md-4">Delivery Orders</div>
        <div class="col-md-4">
            <div class="from-group">
                <div class="dropdown bootstrap-select form-control">
                    <select name="" id="" class="selectpicker form-control" data-style=btn-outline-primary>
                        <option value="">---Select Transporter---</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="col-md-2 text-right">

        </div>
    </div>
    <table class="data-table table nowrap">
        <thead>
            <tr>
                <th class="table-plus">Order No</th>
                <th>Delivery Date</th>
                <th>Ship Party</th>
                <th>Sold Party</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($orders)): ?>
                <?php foreach ($orders as $order): ?>
                    <tr>
                        <td>
                            <div class="form-group">
                                <div class="custom-control custom-checkbox mb-5">
                                    <input type="checkbox" class="custom-control-input" id="customCheck_<?php echo $order['id']; ?>">
                                    <label class="custom-control-label" for="customCheck_<?php echo $order['id']; ?>">
                                        <?php echo $order['order_no']; ?>
                                    </label>                                    
                                </div>                               
                            </div>
                        </td>
                        <td><?php echo $order['delivery_date']; ?></td>
                        <td><?php echo "Code - ".$order['ship_to_party_code']."<br> Name - ".$order['ship_to_party_name']; ?></td>
                        <td><?php echo "Code - ".$order['sold_to_party_code']."<br> Name - ".$order['sold_to_party_name']; ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="7" class="py-3 px-6 text-center text-gray-500">No users found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<div class="mt-6 flex justify-center">
    <!-- Render pagination links -->
    <?= $pager->links('default', 'bootstrap_full') ?>
</div>