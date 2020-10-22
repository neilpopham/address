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

    <div class="grid-container">

        <div class="grid-x grid-padding-x">
            <div class="cell">
                <nav aria-label="You are here:" role="navigation">
                    <ul class="breadcrumbs">
                        <li>
                            <span class="show-for-sr">Current: </span>
                            View Addresses
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="cell large-7 medium-5">
                <div class="input-group">
                    <input id="search" class="input-group-field" type="text" value="<?= esc($search); ?>" />
                    <button type="button"
                        id="clear" class="input-group-button primary button">Clear</button>
                </div>
            </div>
            <div class="cell large-3 medium-4 small-8">
                <select id="showing" name="showing">
                    <option <?php if ($hidden == 0) { print "selected"; } ?> value="0">Disabled: Visible</option>
                    <option <?php if ($hidden == 1) { print "selected"; } ?> value="1">Disabled: Hidden</option>
                </select>
            </div>
            <div class="cell large-2 medium-3 small-4">
                <a id="add" class="primary button float-right" href="address/edit" >Add New</a>
            </div>
        </div>

        <div id="container">
            <?= view_cell(
                '\App\Libraries\Address::render',
                ['limit' => $limit, 'offset' => $offset]
            )
            ?>
        </div>

    </div>

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
    <script src="/public/js/index.js"></script>
</html>