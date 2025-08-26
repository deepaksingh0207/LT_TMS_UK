<table class="table table-striped table-bordered">
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
                    <th scope="row"><?php echo $row->id ?></th>
                    <td><?php echo $row->vehicle_no ?></td>
                    <td><?php echo $row->weight ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else : ?>
            <tr>
                <td colspan="3" class="py-3 px-6 text-center text-gray-500">No Records found.</td>
            </tr>
        <?php endif; ?>    
    </tbody>
</table>
<div class="mt-6 flex justify-center">
    <!-- Render pagination links -->
    <?= $pager->links('default', 'bootstrap_full') ?>
</div>