<!DOCTYPE html>
<html>

<head>

    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/admin.css" />
    <link rel="stylesheet" href="<?= ROOT ?>/css/bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap4.min.css">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.min.css" />

    <title></title>
</head>

<body>
    <div id="wrapper">
        <section id="main" style="color:black;min-height: 85vh">
            <h2 style=" text-align:center; font-size:2em; color:black;">Eastern Hill Landscaping</h2>
            <div class="row">
                <div class="col-sm-12 text-center">
                    <a class="btn btn-outline-primary" aria-current="page" href="<?= ROOT ?>/historypay">Back</a>
                </div>
            </div>
            <hr />
            <div class="table-responsive">
                <table class="table table-hover dt-responsive display table-bordered nowrap" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Employees Name</th>
                            <th>Working Day</th>
                            <th>Total HRS</th>
                            <th>Total Regular HRS</th>
                            <th>Total Bonus HRS</th>
                            <th>Total Base Pay</th>
                            <th>Total Bonus Pay</th>
                            <th>Total Pay</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($data['info'])) {
                            foreach ($data['info'] as $dts) {
                                echo "<tr>";
                                echo "<td>" . $dts->u_fname .' '.$dts->u_lname. "</td>";
                                echo "<td>" . $_SESSION['history_view']['u_date'] . "</td>";
                                echo "<td>" . $dts->tot_hrs . "</td>";
                                echo "<td>" . $dts->reg_hrs . "</td>";
                                echo "<td>" . $dts->bonus_hrs . "</td>";
                                echo "<td>" . $dts->reg_pay . "</td>";
                                echo "<td>" . $dts->bonus_pay . "</td>";
                                echo "<td>" . $dts->tot_pay . "</td>";
                                echo '<td><form method="post"><input type="hidden" name="u_id" value="' . $dts->u_id . '">
                                      
                                      <input type="submit" name="pinfo" value="View" class="btn btn-info"/></form></td>';
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr class='table-primary'>";
                            echo "<td colspan='9'>No Data Available</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <hr />

            <div class="row">
                <div class="col-sm-8 text-center">

                </div>
                <div class="col-sm-4 text-right">

                </div>
            </div>

        </section>

    </div>



    <!-- Searching-->


    <footer id="footer">
        <ul class="copyright">
            <li>&copy; Walvis</li>
            <li>Design </li>
        </ul>
    </footer>
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js"></script>
    <script>
        $(document).ready(function() {
            var table = $('#example').DataTable({
                lengthChange: false,
                searching: true,
                buttons: ['excel', 'csv', 'pdf']
            });

            table.buttons().container()
                .appendTo('#example_wrapper');
        });
    </script>
    
</body>

</html>