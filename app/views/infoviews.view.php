<!DOCTYPE html>
<html>

<head>

    <link rel="stylesheet" href="<?= ROOT ?>/assets/css/admin.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap4.min.css">


    <link href="https://unpkg.com/gijgo@1.9.14/css/gijgo.min.css" rel="stylesheet" type="text/css" />

    <title></title>
</head>

<body>
    <div id="wrapper">
        <section id="main" style="color:black;min-height: 85vh">
            <h2 style=" text-align:center; font-size:2em; color:black;">Eastern Hill Landscaping</h2>
            <div class="row">
                <div class="col-sm-12 text-center">
                    <a class="btn btn-outline-primary" aria-current="page" href="<?= ROOT ?>/admin">Home</a>
                    <a class="btn btn-outline-warning" data-toggle="modal" data-target="#Searching">Add new Datetime</a>
                </div>
            </div>
            <hr />
            <div class="table-responsive">
                <table class="table table-hover dt-responsive display table-bordered nowrap" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Employee Name</th>
                            <th>Working Day</th>
                            <th>Total HRS</th>
                            <th>Regular Rate</th>
                            <th>Bonus Rate</th>
                            <th>Base HRS</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?=$data['usrinfo']->u_fname." ".$data['usrinfo']->u_lname?></td>
                            <td><?=$data['u_date']?></td>
                            <td><?=$data['tt_hrs']?></td>
                            <td><?=$data['usrinfo']->u_reg_pay?></td>
                            <td><?=$data['usrinfo']->u_pay?></td>
                            <td><?=$data['usrinfo']->u_base_hrs?></td>
                            <td><?php echo '<form method="post"><input type="hidden" name="users_id" value="'.$data['usrinfo']->u_id.'">
                                     <input type="submit" name="empedit" value="Edit" class="btn btn-info"/></form>' ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <hr />
            <div class="table-responsive">
                <table id="example" class="table table-hover dt-responsive display table-bordered nowrap" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Employee Name</th>
                            <th>Working Time</th>
                            <th>Status</th>
                            <th>Locatin</th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        if (!empty($data['timeinfo'])) {
                            foreach ($data['timeinfo'] as $dts) {
                                echo "<tr>";
                                echo "<td>" . $dts->u_fname ." ". $dts->u_lname . "</td>";
                                echo "<td>" . $dts->r_time . "</td>";
                                if($dts->r_state==1)
                                {
                                    echo "<td>Clock In</td>";
                                }else
                                {
                                    echo "<td>Clock Out</td>";
                                }
                                echo "<td>" . $dts->w_address . "</td>";
                                echo '<td><form method="post"><input type="hidden" name="r_id" value="' . $dts->r_id . '">
                                      <input type="submit" name="viewtime" value="Edit" class="btn btn-info"/>
                                      <input type="submit" name="deletetime" value="Delete" class="btn btn-danger"/>
                                      </form></td>';
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr class='table-primary'>";
                            echo "<td colspan='5'>No Data Available</td>";
                            echo "</tr>";
                        }
                        ?>

                    </tbody>
                </table>
                <hr />
                <div class="row">
                    <div class="col-sm-8 text-center">
                        
                    </div>
                    <div class="col-sm-4 text-right">
                        <?php if (!empty($data["u_date"])) {
                            echo $data['u_date'];
                        } else {
                            echo "Total HRS: 0.00";
                        } ?>
                    </div>
                </div>
                
        </section>

    </div>



    <!-- Searching-->
    <form name="UploadPage" method="post" enctype="multipart/form-data">
    <div class="modal fade" id="Searching" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-body">
            <p style="color:#e99c31;"><i class="fa fa-search fa-lg"></i>&nbsp;Add Date Time:</p>
            <hr>
            <?php if (isset($data["error"])) { ?>
              <div class="alert alert-danger">
                <?php echo $data["error"]; ?>
              </div>
              <br>
            <?php unset($data["error"]);
            } ?>
            <label for="first_dt" class="form-group">Start Date:</label>
            <input type="text" placeholder="Choose Date" name="start_dt" class="form-control" id="first_dt" autocomplete="off" required>
               
            <label for="locations" class="form-group">Choose a location:</label>
            <div class="form-group mb-4">
              <select name="r_ip" id="locations" class="form-control" required>
                <option value="">--Please choose an location--</option>
                <option value="all">All locations</option>
                <?php foreach ($data['location'] as $dts) {
									echo "<option value=" . $dts->w_id . ">" . $dts->w_address . "</option>";
								} ?>
              </select>
            </div>
            <label for="r_state" class="form-group">Choose time state:</label>
            <div class="form-group mb-4">
              <select name="r_state" id="r_state" class="form-control" required>
                <option value="">--Please choose time state--</option>
                <option value=1>Clock In</option>
                <option value=2>Clock Out</option>
              </select>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
            <input type="submit" name="add_dt" value="Submit" class="btn btn-info" />
          </div>
        </div>
      </div>
    </div>
  </form>

    <footer id="footer">
        <ul class="copyright">
            <li>&copy; Walvis</li>
            <li>Design </li>
        </ul>
    </footer>
    <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.min.js"></script>
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
    <script src="https://unpkg.com/gijgo@1.9.14/js/gijgo.min.js" type="text/javascript"></script>
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
    <script>
        $('#first_dt').datetimepicker({
            uiLibrary: 'bootstrap4',
            modal: true,
            footer: true
        });
    </script>
</body>

</html>