<div
    id="addresses"
    class="grid-x grid-padding-x"
    data-limit="<?= $limit ?>"
    data-offset="<?= $offset ?>"
    data-hidden="<?= $hidden ?>"
    data-search="<?= esc($search); ?>">

    <?php foreach($data as $address): ?>

    <div class="medium-6 large-4 cell">
        <div class="card disabled_<?= $address->disabled ?>">
            <div class="card-divider">
                <?= esc($address->fullName()) ?>
            </div>
            <div class="card-section">
                <h5><?= $address->fullAddress("<br />") ?></h5>
                <p>
                    <?= $address->tel ?>
                    <br />
                    <a href="mailto:<?= $address->email ?>"><?= $address->email ?></a>
                </p>
            </div>
            <div class="card-section">
                <div class="small expanded button-group">
                    <a
                        data-id="<?= $address->pk_id ?>"
                        class="primary button edit<?= $address->disabled ? " disabled" : "" ?>"
                        href="/public/address/edit/<?= $address->pk_id ?>"
                        >Edit</a>
                    <a
                        data-id="<?= $address->pk_id ?>"
                        data-disabled="<?= $address->disabled ?>"
                        class="<?= $address->disabled ? "success" : "alert" ?> button state"
                        ><?= $address->disabled ? "Enable" : "Disable" ?></a>
                </div>
            </div>
        </div>
    </div>

    <?php endforeach; ?>

    <?php if ($total > $count): ?>
        <?= view_cell(
            '\App\Libraries\Address::pagination',
            [
                'limit' => $limit,
                'offset' => $offset,
                'count' => $count,
                'total' => $total,
            ]
        ) ?>
    <?php endif; ?>

</div>
