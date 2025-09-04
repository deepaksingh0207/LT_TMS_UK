<div class="col-xl-12 col-lg-12 col-md-12 card-box pb-10">
    <div class="row h5 pd-20 mb-0">
        <?php if(session()->get('group') == 'admin' || session()->get('group') == 'superadmin') {
            $delivery_order_div_class = "col-md-8";
        }
        else {
            $delivery_order_div_class = "col-md-10";
        } 
        ?>
        <div class="<?php echo $delivery_order_div_class; ?>">Delivery Orders</div>
        <?php if(session()->get('group') == 'admin' || session()->get('group') == 'superadmin') : ?>
            <div class="col-md-3">
                <div class="from-group">
                    <div class="dropdown bootstrap-select form-control">
                        <select name="transporter_id" id="transporter_id" class="selectpicker form-control" data-style=btn-outline-primary>
                            <option value="">---Select Transporter---</option>
                            <?php foreach ($transporter_data as $transporter) : ?>
                                <option value="<?php echo $transporter->id; ?>"><?php echo $transporter->first_name . " " . $transporter->last_name; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-1 text-right">
                <a href="#" class="btn btn-info" data-toggle="modal" data-target="#confirmation-modal" type="button">
                    Assign
                </a>
            </div>
        <?php elseif(session()->get('group') == 'transporter') : ?>
            <div class="col-md-2 text-right">
                <form action="<?php echo base_url("asn/create")?>" method="post" id="create_asn_form">
                    <button type="button" class="btn btn-primary" id = "create_asn_btn">Create ASN</button>
                    <input type="hidden" name="order_ids" id="hidden_order_ids">
                </form>
            </div>
        <?php endif; ?>
    </div>
    <table class="data-table table nowrap">
        <thead>
            <tr>
                <th class="table-plus">Order No</th>
                <th>Delivery Date</th>
                <th>Ship Party</th>
                <th>Sold Party</th>
                <th>Transporter</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($orders)): ?>
                <?php foreach ($orders as $order): ?>
                    <tr>
                        <td>
                            <div class="form-group">
                                <div class="custom-control custom-checkbox mb-5">
                                    <input type="checkbox" class="custom-control-input order-checkbox" id="customCheck_<?php echo $order['id']; ?>" value="<?php echo $order['id']; ?>">
                                    <label class="custom-control-label" for="customCheck_<?php echo $order['id']; ?>">
                                        <?php echo $order['order_no']; ?>
                                    </label>
                                </div>
                            </div>
                        </td>
                        <td><?php echo $order['delivery_date']; ?></td>
                        <td><?php echo "Code - " . $order['ship_to_party_code'] . "<br> Name - " . $order['ship_to_party_name']; ?></td>
                        <td><?php echo "Code - " . $order['sold_to_party_code'] . "<br> Name - " . $order['sold_to_party_name']; ?></td>
                        <td><?php echo (!empty($order['transporter_name']) ? $order['transporter_name']."(".$order['sap_user_code'].")" : "-")?></td>
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