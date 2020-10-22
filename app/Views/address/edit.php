<!DOCTYPE html>
<html lang="en">
    <head>
        <link
            rel="stylesheet"
            href="https://cdn.jsdelivr.net/npm/foundation-sites@6.6.3/dist/css/foundation.min.css"
            integrity="sha256-ogmFxjqiTMnZhxCqVmcqTvjfe1Y/ec4WaRj/aQPvn+I="
            crossorigin="anonymous">
        <link rel='stylesheet' href='/public/css/mprogress.min.css'/>
        <link rel="stylesheet" href="/public/css/core.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>

<form>
    <div class="grid-container">

        <div class="grid-x grid-padding-x">
            <div class="cell">
                <nav aria-label="You are here:" role="navigation">
                    <ul class="breadcrumbs">
                        <li><a href="/public/address">View Addresses</a></li>
                        <li>
                            <span class="show-for-sr">Current: </span>
                            <?= esc($title); ?>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>

        <div class="grid-x grid-padding-x">
            <div class="cell">
                <h2><?= esc($title); ?> <?= $address->dob ?></h2>
                <input type="hidden" name="pk_id" value="<?= $address->pk_id ?>" />
            </div>
        </div>

        <div class="grid-x grid-padding-x">
            <div class="medium-3 cell">
                <label>Salutation
                    <select name="fk_salutation_id">
                    <?php foreach ($salutations as $item):?>
                        <option
                            <?php if ($item->pk_id == $address->fk_salutation_id) { echo ' selected'; } ?>
                            value="<?= $item->pk_id ?>"><?= esc($item->value); ?></option>
                    <?php endforeach;?>
                    </select>
                </label>
            </div>
            <div class="medium-3 cell">
                <label>First Name <span class="required">*</span>
                    <input type="text" name="first_name" placeholder="First Name"
                        maxlength="100"
                        value="<?= esc($address->first_name); ?>">
                </label>
            </div>
            <div class="medium-3 cell">
                <label>Middle Name
                    <input type="text" name="middle_name" placeholder="Middle Name"
                        maxlength="100"
                        value="<?= esc($address->middle_name); ?>">
                </label>
            </div>
            <div class="medium-3 cell">
                <label>Last Name <span class="required">*</span>
                    <input type="text" name="last_name" placeholder="Last Name"
                        maxlength="100"
                        value="<?= esc($address->last_name); ?>">
                </label>
            </div>
        </div>

        <div class="grid-x grid-padding-x">
            <div class="medium-4 cell">
                <label>Address Line 1 <span class="required">*</span>
                    <input type="text" name="address_1" placeholder="Address Line 1"
                        maxlength="100"
                        value="<?= esc($address->address_1); ?>">
                </label>
            </div>
            <div class="medium-4 cell">
                <label>Address Line 2
                    <input type="text" name="address_2" placeholder="Address Line 2"
                        maxlength="100"
                        value="<?= esc($address->address_2); ?>">
                </label>
            </div>
            <div class="medium-4 cell">
                <label>Address Line 3
                    <input type="text" name="address_3" placeholder="Address Line 3"
                        maxlength="100"
                        value="<?= esc($address->address_3); ?>">
                </label>
            </div>
        </div>

        <div class="grid-x grid-padding-x">
            <div class="medium-4 cell">
                <label>City <span class="required">*</span>
                    <input type="text" name="city" placeholder="City"
                        maxlength="100"
                        value="<?= esc($address->city); ?>">
                </label>
            </div>
            <div class="medium-4 cell">
                <label>Post Code <span class="required">*</span>
                    <input type="text" name="postcode" placeholder="Post Code"
                        maxlength="10"
                        value="<?= esc($address->postcode); ?>">
                </label>
            </div>
            <div class="medium-4 cell">
                <label>Date of Birth <span class="required">*</span>
                    <input type="date" name="dob"
                         value="<?= $address->dob ?>">
                </label>
            </div>
        </div>

        <div class="grid-x grid-padding-x">
            <div class="medium-6 cell">
                <label>Telephone Number <span class="required">*</span>
                    <input type="text" name="tel" placeholder="Telephone Number"
                        maxlength="20"
                        value="<?= esc($address->tel); ?>">
                </label>
            </div>
            <div class="medium-6 cell">
                <label>Email Address <span class="required">*</span>
                    <input type="text" name="email" placeholder="Email Address"
                        maxlength="100"
                        value="<?= esc($address->email); ?>">
                </label>
            </div>
        </div>

        <div class="grid-x grid-padding-x">
            <div class="small-6 cell">
                <button id="save" type="button" class="primary button expanded">Save</button>
            </div>
            <div class="small-6 cell">
                <button id="cancel" type="button" class="alert button expanded">Cancel</button>
            </div>
        </div>

    </div>
</form>

    </body>
    <script
      src="https://code.jquery.com/jquery-3.5.1.min.js"
      integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
      crossorigin="anonymous"></script>
    <script
        src="https://cdn.jsdelivr.net/npm/foundation-sites@6.6.3/dist/js/foundation.min.js"
        integrity="sha256-pRF3zifJRA9jXGv++b06qwtSqX1byFQOLjqa2PTEb2o="
        crossorigin="anonymous"></script>
    <script src='/public/js/mprogress.min.js'></script>
    <script src="/public/js/edit.js"></script>
</html>