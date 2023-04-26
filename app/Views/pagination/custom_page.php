<?php $pager->setSurroundCount(2) ?>

<div class="mt-2 d-flex justify-content-end">
    <nav aria-label="<?= lang('Pager.pageNavigation') ?>">
        <ul class="pagination">
            <?php if ($pager->hasPreviousPage()) : ?>
                <li class="page-item">
                    <a href="<?= $pager->getFirst() ?>" aria-label="<?= lang('Pager.first') ?>" class="page-link">
                        <span aria-hidden="true"><?= lang('Pager.first') ?></span>
                    </a>
                </li>
                <li class="page-item">
                    <a href="<?= $pager->getPreviousPage() ?>" aria-label="<?= lang('Pager.previous') ?>" class="page-link">
                        <span aria-hidden="true"><?= lang('Pager.previous') ?></span>
                    </a>
                </li>
            <?php endif ?>

            <?php foreach ($pager->links() as $link) : ?>
                <li <?= $link['active'] ? 'class="active"' : '' ?>>
                    <a href="<?= $link['uri'] ?>" class="page-link">
                        <?= $link['title'] ?>
                    </a>
                </li>
            <?php endforeach ?>

            <?php if ($pager->hasNextPage()) : ?>
                <li class="page-item">
                    <a href="<?= $pager->getNextPage() ?>" aria-label="<?= lang('Pager.next') ?>" class="page-link">
                        <span aria-hidden="true"><?= lang('Pager.next') ?></span>
                    </a>
                </li>
                <li class="page-item">
                    <a href="<?= $pager->getLast() ?>" aria-label="<?= lang('Pager.last') ?>" class="page-link">
                        <span aria-hidden="true"><?= lang('Pager.last') ?></span>
                    </a>
                </li>
            <?php endif ?>
        </ul>
    </nav>
</div>