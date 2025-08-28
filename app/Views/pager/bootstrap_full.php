<?php if ($pager->hasPreviousPage() || $pager->hasNextPage()) : ?>
    <nav aria-label="<?= lang('Pager.pageNavigation') ?>">
        <ul class="pagination justify-content-center">

            <!-- Previous Page -->
            <?php if ($pager->hasPreviousPage()) : ?>
                <li class="page-item">
                    <a class="page-link" href="<?= $pager->getPreviousPage() ?>" aria-label="<?= lang('Pager.previous') ?>">
                        <span aria-hidden="true">&laquo;</span>
                        <span class="sr-only"><?= lang('Pager.previous') ?></span>
                    </a>
                </li>
            <?php else: ?>
                <li class="page-item disabled">
                    <span class="page-link">&laquo;</span>
                </li>
            <?php endif; ?>

            <!-- Numbered Links -->
            <?php foreach ($pager->links() as $link) : ?>
                <li class="page-item <?= $link['active'] ? 'active' : '' ?>">
                    <a class="page-link" href="<?= $link['uri'] ?>">
                        <?= $link['title'] ?>
                        <?php if ($link['active']) : ?>
                            <span class="sr-only">(current)</span>
                        <?php endif; ?>
                    </a>
                </li>
            <?php endforeach; ?>

            <!-- Next Page -->
            <?php if ($pager->hasNextPage()) : ?>
                <li class="page-item">
                    <a class="page-link" href="<?= $pager->getNextPage() ?>" aria-label="<?= lang('Pager.next') ?>">
                        <span aria-hidden="true">&raquo;</span>
                        <span class="sr-only"><?= lang('Pager.next') ?></span>
                    </a>
                </li>
            <?php else: ?>
                <li class="page-item disabled">
                    <span class="page-link">&raquo;</span>
                </li>
            <?php endif; ?>

        </ul>
    </nav>
<?php endif; ?>