<!DOCTYPE HTML>
<html>

<head>
    <title>EH Employees System</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/admin.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://unpkg.com/gijgo@1.9.14/css/gijgo.min.css" rel="stylesheet" type="text/css" />
</head>

<body class="is-loading">
    <div id="wrapper">
        <h2 style=" text-align:center; font-size:2em; color:white;">Employees Timesheet System</h2>
        <section id="main" style="min-height: 80vh">
            <img src="<?= ROOT ?>/images/clock.svg" width="102px" alt="" />

            <form class="form-signin" method="post">
                <h2 class="form-signin-heading">Add New Time and Locatin</h2>
                <?php if (!empty($errors)) : ?>
                    <div class="alert alert-danger">
                        <?= implode("<br>", $errors) ?>
                    </div>
                <?php endif; ?>
                <hr style="margin: 3em 0;" />
                <label for="fname" class="sr-only">Employee Name</label>
                <div class="form-group mb-4">
                    <select name="u_id" id="locations" class="form-control" required autofocus>
                        <option value="">--Please choose an location--</option>
                        <?php foreach ($data['emp'] as $dts) {
                            echo "<option value=" . $dts->u_id . ">" . $dts->u_fname . " " . $dts->u_lname . "</option>";
                        } ?>
                    </select>
                </div><br>
                <label for="locations" class="form-group">Choose a location:</label>
                <div class="form-group mb-4">
                    <select name="r_ip" id="locations" class="form-control" required autofocus>
                        <option value="">--Please choose an location--</option>
                        <?php foreach ($data['location'] as $dts) {
                            echo "<option value=" . $dts->w_id . ">" . $dts->w_address . "</option>";
                        } ?>
                    </select>
                </div><br>
                <label for="r_time" class="form-group">Clock Time</label>
                <input type="text" name="r_time" id="r_time" class="form-control" placeholder="Clock Time" required><br>
                <label for="r_state" class="form-group">Choose time state:</label>
                <div class="form-group mb-4">
                    <select name="r_state" id="r_state" class="form-control" required>
                        <option value="">--Please choose time state--</option>
                        <option value=1>Clock In</option>
                        <option value=2>Clock Out</option>
                    </select>
                </div><br>

                <input type="submit" name="add_dt" value="Submit" class="btn btn-lg btn-outline-info" />
            </form>
            <hr style="margin: 3em 0;" />
            <a class="btn btn-lg btn-outline-primary" aria-current="page" href="<?= ROOT ?>/searchpage">Back</a>

        </section>
        <footer id="footer">
            <ul class="copyright">
                <li>&copy; Walvis Teach</li>
                <li>Design </li>
            </ul>
        </footer>
    </div>
    <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/gijgo@1.9.14/js/gijgo.min.js" type="text/javascript"></script>
    <script>
        if ('addEventListener' in window) {
            window.addEventListener('load', function() {
                document.body.className = document.body.className.replace(/\bis-loading\b/, '');
            });
            document.body.className += (navigator.userAgent.match(/(MSIE|rv:11\.0)/) ? ' is-ie' : '');
        }
    </script>
    <script>
        $('#r_time').datetimepicker({
            uiLibrary: 'bootstrap4',
            modal: true,
            footer: true
        });
    </script>

</body>

</html>