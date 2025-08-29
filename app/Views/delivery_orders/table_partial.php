<div class="col-xl-12 col-lg-12 col-md-12 card-box pb-10">
    <div class="row h5 pd-20 mb-0">
        <div class="col-md-10">Delivery Orders</div>
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
                        <td><?php echo $order['order_no']; ?></td>
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