<div class="cell">

    <nav aria-label="Pagination">
        <ul data-offset="<?= $offset ?>" class="pagination text-center">

            <?php if ($current == 1): ?>
                <li class="pagination-previous disabled">Previous <span class="show-for-sr">page</span></li>
            <?php else: ?>
                <li class="pagination-previous"><a
                    data-page="<?= $current-1 ?>" href="#" aria-label="Previous page"
                    >Previous <span class="show-for-sr">page</span></a></li>
            <?php endif; ?>

            <?php foreach($page as $i => $p): ?>
                <?php if ($current == $i): ?>
                    <li class="current"><span class="show-for-sr">You're on page </span><?= $i ?></li>
                <?php else: ?>
                    <li><a data-page="<?= $i ?>"href="#" aria-label="Page <?= $i ?>"><?= $i ?></a></li>
                <?php endif; ?>
            <?php endforeach; ?>

            <?php if ($current == $pages): ?>
                <li class="pagination-next disabled">Next <span class="show-for-sr">page</span></li>
            <?php else: ?>
                <li class="pagination-next"><a
                    data-page="<?= $current+1 ?>" href="#" aria-label="Next page"
                    >Next <span class="show-for-sr">page</span></a></li>
            <?php endif; ?>

        </ul>
    </nav>

</div>
