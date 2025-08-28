<div class="row" style="display: flex; justify-content: flex-end;">
    <div class="col-md-2">
        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#bd-example-modal-lg" >+ Add</button>
    </div>
</div>
<div class="row pt-2">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Vehicle No</th>
                <th scope="col">Weight</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($head_masters)): ?>
                <?php foreach ($head_masters as $row): ?>
                    <tr>
                        <th scope="row"><?php echo $row['id'] ?></th>
                        <td><?php echo $row['vehicle_no'] ?></td>
                        <td><?php echo $row['weight'] ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="3" class="py-3 px-6 text-center text-gray-500">No Records found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<div class="mt-6 ">
    <!-- Render pagination links -->
    <?php // dd($pager->getPageCount()); ?>
    <?= $pager->links('default', 'bootstrap_full') ?>
</div>
<div class="modal fade bs-example-modal-lg " id="bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-modal="true">
    <div class="modal-dialog modal-lg modal-dialog-top">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Add</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"> × </button>
            </div>
            <div class="modal-body">
                <form id="head_master_form" method="post">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="vehicle_no">Vehicle No. : </label>
                                <input type="text" name="vehicle_no" id="vehicle_no" class="form-control" placeholder="Enter Vehicle No">
                                <small class="form-text text-danger" id="vehicle_no_feedback"></small>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="weight">Weight : </label>
                                <input type="text" name="weight" id="weight" class="form-control" placeholder="Enter Weight">
                                <small class="form-text text-danger" id="weight_feedback"></small>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="add_head_master_btn" onclick="add_head_master()">Submit</button>
            </div>
        </div>
    </div>
</div>