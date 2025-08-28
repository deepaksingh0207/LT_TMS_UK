<div class="row" style="display: flex; justify-content: flex-end;">
    <div class="col-md-2">
        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#bd-example-modal-lg-1">+ Add</button>
    </div>
</div>
<div class="row pt-2">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Trolley No</th>
                <th scope="col">Capacity</th>
                <th scope="col">Weight</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($trolley_masters)): ?>
                <?php foreach ($trolley_masters as $row): ?>
                    <tr>
                        <th scope="row"><?php echo $row['id'] ?></th>
                        <td><?php echo $row['trolley_no'] ?></td>
                        <td><?php echo $row['capacity'] ?></td>
                        <td><?php echo $row['weight'] ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="4" class="py-3 px-6 text-center text-gray-500">No Records found.</td>
                </tr>     
            <?php endif; ?>    
        </tbody>
    </table>
</div>
<div class="mt-6 flex justify-center">
    <!-- Render pagination links -->
    <?= $pager->links('default', 'bootstrap_full') ?>
</div>
<div class="modal fade bs-example-modal-lg " id="bd-example-modal-lg-1" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-modal="true">
    <div class="modal-dialog modal-lg modal-dialog-top">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Add</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"> × </button>
            </div>
            <div class="modal-body">
                <form id="trolley_master_form" method="post">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="vehicle_no">Trolley No. : </label>
                                <input type="text" name="trolley_no" id="trolley_no" class="form-control" placeholder="Enter Trolley No">
                                <small class="form-text text-danger" id="trolley_no_feedback"></small>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="capacity">Capacity : </label>
                                <input type="text" name="capacity" id="capacity" class="form-control" placeholder="Enter Capacity">
                                <small class="form-text text-danger" id="capacity_feedback"></small>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="weight">Weight : </label>
                                <input type="text" name="trolley_weight" id="trolley_weight" class="form-control" placeholder="Enter Weight">
                                <small class="form-text text-danger" id="trolley_weight_feedback"></small>

                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="add_trolley_master_btn" onclick="add_trolley_master()">Submit</button>
            </div>
        </div>
    </div>
</div>