<?php
/**
 * Bootstrap 4 Simple Pager Template
 *
 * Outputs only Previous / Next links
 *
 * @var CodeIgniter\Pager\PagerRenderer $pager
 */
?>
<?php if ($pager->hasPrevious() || $pager->hasNext()) : ?>
    <nav aria-label="<?= lang('Pager.pageNavigation') ?>">
        <ul class="pagination justify-content-center">

            <?php if ($pager->hasPrevious()) : ?>
                <li class="page-item">
                    <a class="page-link" href="<?= $pager->getPreviousPage() ?>" aria-label="<?= lang('Pager.previous') ?>">
                        <span aria-hidden="true">&laquo; <?= lang('Pager.previous') ?></span>
                    </a>
                </li>
            <?php else: ?>
                <li class="page-item disabled">
                    <span class="page-link">&laquo; <?= lang('Pager.previous') ?></span>
                </li>
            <?php endif; ?>

            <?php if ($pager->hasNext()) : ?>
                <li class="page-item">
                    <a class="page-link" href="<?= $pager->getNextPage() ?>" aria-label="<?= lang('Pager.next') ?>">
                        <span aria-hidden="true"><?= lang('Pager.next') ?> &raquo;</span>
                    </a>
                </li>
            <?php else: ?>
                <li class="page-item disabled">
                    <span class="page-link"><?= lang('Pager.next') ?> &raquo;</span>
                </li>
            <?php endif; ?>

        </ul>
    </nav>
<?php endif; ?>
