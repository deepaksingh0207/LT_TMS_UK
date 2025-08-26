<table class="table table-striped table-bordered">
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
                    <th scope="row"><?php echo $row->id ?></th>
                    <td><?php echo $row->trolley_no ?></td>
                    <td><?php echo $row->capacity ?></td>
                    <td><?php echo $row->weight ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else : ?>
            <tr>
                <td colspan="4" class="py-3 px-6 text-center text-gray-500">No Records found.</td>
            </tr>     
        <?php endif; ?>    
    </tbody>
</table>