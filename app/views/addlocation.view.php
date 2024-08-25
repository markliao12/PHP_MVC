<!DOCTYPE HTML>
<html>

<head>
    <title>EH Employees System</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/admin.css" />
    <link rel="stylesheet" href="<?= ROOT ?>/css/bootstrap.css" />
    <noscript>
        <link rel="stylesheet" href="<?= ROOT ?>/assets/css/noscript.css" />
    </noscript>
</head>

<body class="is-loading">
    <div id="wrapper">
        <h2 style=" text-align:center; font-size:2em; color:white;">Employees Timesheet System</h2>
        <section id="main" style="min-height: 80vh">
            <img src="<?= ROOT ?>/images/clock.svg" width="102px" alt="" />

            <form class="form-signin" method="post">
                <h2 class="form-signin-heading">Create Work Location</h2>
                <?php if (!empty($errors)) : ?>
                    <div class="alert alert-danger">
                        <?= implode("<br>", $errors) ?>
                    </div>
                <?php endif; ?>
                <hr style="margin: 3em 0;" />
                <label for="address" class="sr-only">Work Address</label>
                <input type="text" name="w_address" id="address" class="form-control" placeholder="Address" required autofocus><br>
                <label for="sta-select" class="sr-only">Choose a status:</label>
                <select name="w_status" id="sta-select" class="form-control" required>
                    <option value="">--Please choose an option--</option>
                    <?php foreach ($data['statu'] as $dts) {
                        echo "<option value=" . $dts->ws_id . ">" . $dts->ws_name . "</option>";
                    } ?>
                </select><br>
                <button class="btn btn-lg btn-outline-primary" type="submit">Submit</button>
            </form>
            <hr style="margin: 3em 0;" />
            <a class="btn btn-lg btn-outline-primary" aria-current="page" href="<?= ROOT ?>/locations">Back</a>

        </section>
        <footer id="footer">
            <ul class="copyright">
                <li>&copy; Walvis Teach</li>
                <li>Design </li>
            </ul>
        </footer>
    </div>
    <script src="https://maps.googleapis.com/maps/api/js?libraries=places&callback=initAutocomplete&language=nl&output=json&key=AIzaSyBisY_3sQZ2Vqx1hxuyuF3gSyweCeg_2po" async defer></script>
    <script type="text/javascript">
        var autocomplete = null;
        var componentForm = {
            street_number: 'short_name',
            route: 'long_name',
            locality: 'long_name',
            administrative_area_level_2: 'long_name',
            country: 'long_name',
            postal_code: 'short_name'
        };

        function initAutocomplete() {
            var address = document.getElementById('address');
            var options = {
                types: ['address'],
                componentRestrictions: {
                    country: ['ca']
                }
            };

            autocomplete = new google.maps.places.Autocomplete(address, options);
            autocomplete.addListener('place_changed', fillInAddress);
        }

        function fillInAddress() {
            // Get the place details from the autocomplete object.
            var place = autocomplete.getPlace();

            for (var component in componentForm) {
                document.getElementById(component).value = '';
                document.getElementById(component).disabled = false;
            }

            // Get each component of the address from the place details
            // and fill the corresponding field on the form.
            for (var i = 0; i < place.address_components.length; i++) {
                var addressType = place.address_components[i].types[0];
                if (componentForm[addressType]) {
                    var val = place.address_components[i][componentForm[addressType]];
                    document.getElementById(addressType).value = val;
                }
            }
        }
    </script>
    <script>
        if ('addEventListener' in window) {
            window.addEventListener('load', function() {
                document.body.className = document.body.className.replace(/\bis-loading\b/, '');
            });
            document.body.className += (navigator.userAgent.match(/(MSIE|rv:11\.0)/) ? ' is-ie' : '');
        }
    </script>

</body>

</html>