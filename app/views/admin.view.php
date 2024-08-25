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
          <a class="btn btn-outline-primary" aria-current="page" href="<?= ROOT ?>/employees">Employees</a>
          <a class="btn btn-outline-primary" aria-current="page" href="<?= ROOT ?>/locations">Working Locations</a>
          <a class="btn btn-outline-warning" data-toggle="modal" data-target="#Searching">Searching</a>
          <a class="btn btn-outline-primary" aria-current="page" href="<?= ROOT ?>/historypay">History</a>
          <a class="btn btn-outline-secondary" href="<?= ROOT ?>/logout">Logout</a>
        </div>
      </div>
      <hr />
      <div class="table-responsive">
        <table id="example" class="table table-hover dt-responsive display table-bordered nowrap" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th>Employee Name</th>
              <th>Working Day</th>
              <th>Regular HRS</th>
              <th>Bonus HRS</th>
              <th>Total HRS</th>
              <th>Regular Roll</th>
              <th>Bonus Roll</th>
              <th>Total Roll</th>
              <th></th>
            </tr>
          </thead>

          <tbody>
            <?php
            if (!empty($data['info'])) {
              foreach ($data['info'] as $dts) {
                echo "<tr>";
                echo "<td>" . $dts['u_name'] . "</td>";
                echo "<td>" . $dts['u_date'] . "</td>";
                echo "<td>" . $dts['reg'] . "</td>";
                echo "<td>" . $dts['bn'] . "</td>";
                echo "<td>" . $dts['tt_hrs'] . "</td>";
                echo "<td>" . $dts['reg_t'] . "</td>";
                echo "<td>" . $dts['bn_t'] . "</td>";
                echo "<td>" . $dts['tt_roll'] . "</td>";
                if ($data['rsn_cd'] == 1) {
                  echo '<td><form method="post"><input type="hidden" name="users_id" value="' . $dts['u_id'] . '">
                  <input type="hidden" name="s_dt" value="' . $dts['u_sdt'] . '">
                  <input type="hidden" name="e_dt" value="' . $dts['u_edt'] . '">
                  <input type="hidden" name="work_dt" value="' . $dts['u_date'] . '">
                  <input type="hidden" name="tt_hrs" value="' . $dts['tt_hrs'] . '">
                  <input type="submit" name="view" value="Edit" class="btn btn-info"/></form></td>';
                } else {
                  echo '<td><form method="post"><input type="hidden" name="users_id" value="' . $dts['u_id'] . '">
                  <input type="hidden" name="s_dt" value="' . $dts['u_sdt'] . '">
                  <input type="hidden" name="e_dt" value="' . $dts['u_edt'] . '">
                  <input type="hidden" name="work_dt" value="' . $dts['u_date'] . '">
                  <input type="hidden" name="tt_hrs" value="' . $dts['tt_hrs'] . '">
                  <input type="submit" name="view" value="View" class="btn btn-info"/></form></td>';
                }

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
        <hr />
        <div class="row">
          <div class="col-sm-2 text-center">
            <?php if (!empty($data["tot_r_hrs"])) {
              echo "Regular HRS: " . $data['tot_r_hrs'];
            } ?>
          </div>
          <div class="col-sm-2 text-center">
            <?php if (!empty($data["tot_b_hrs"])) {
              echo "Bonus HRS: " . $data['tot_b_hrs'];
            } ?>
          </div>
          <div class="col-sm-2 text-center">
            <?php if (!empty($data["total"])) {
              echo "Total HRS: " . $data['total'];
            } else {
              echo "Total HRS: 0.00";
            } ?>
          </div>
          <div class="col-sm-2 text-center">
            <?php if (!empty($data["tot_rpay"])) {
              echo "Regular Roll: " . $data['tot_rpay'];
            } ?>
          </div>
          <div class="col-sm-2 text-center">
            <?php if (!empty($data["tot_bpay"])) {
              echo "Bonus Roll: " . $data['tot_bpay'];
            } ?>
          </div>
          <div class="col-sm-2 text-center">
            <?php if (!empty($data["tot_pay"])) {
              echo "Total Roll: " . $data['tot_pay'];
            } else {
              echo "Total Roll: 0.00";
            } ?>
          </div>
        </div>
        <hr /><br /><br />
        <?php if ($data["rsn_cd"] == 1) { ?>
          <div class="row">
            <div class="col-sm-12 text-center">
            <a class="btn btn-outline-danger" data-toggle="modal" data-target="#Submitdate">Select Date</a>
            </div>
          <?php } ?>
          </div><br /><br />
    </section>

  </div>



  <!-- Searching-->
  <form name="UploadPage" method="post" enctype="multipart/form-data">
    <div class="modal fade" id="Searching" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-body">
            <p style="color:#e99c31;"><i class="fa fa-search fa-lg"></i>&nbsp;Search Date Range:</p>
            <hr>
            <?php if (isset($data["error"])) { ?>
              <div class="alert alert-danger">
                <?php echo $data["error"]; ?>
              </div>
              <br>
            <?php unset($data["error"]);
            } ?>
            <label for="first_dt" class="form-group">Start Date:</label>
            <div class="form-group mb-4">
              <div class="datepicker date input-group">
                <input type="text" placeholder="Choose Date" name="start_dt" class="form-control" id="first_dt" required>
                <div class="input-group-append">
                  <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                </div>
              </div>
            </div>
            <label for="end_dt" class="form-group">End Date:</label>
            <div class="form-group mb-4">
              <div class="datepicker date input-group">
                <input type="text" placeholder="Choose Date" name="end_dt" class="form-control" id="end_dt" required>
                <div class="input-group-append">
                  <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                </div>
              </div>
            </div>
            <label for="locations" class="form-group">Choose a location:</label>
            <div class="form-group mb-4">
              <select name="r_ip" id="locations" class="form-control" required>
                <option value="">--Please choose an location--</option>
                <option value="all">All locations</option>
                <?php foreach ($data['location'] as $dts) {
									echo "<option value='" . $dts->w_id . "'>" . $dts->w_address . "</option>";
								} ?>
              </select>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
            <input type="submit" name="select_dt" value="Submit" class="btn btn-info" />
          </div>
        </div>
      </div>
    </div>
  </form>
  <!-- Submit Date-->
  <form name="UploadPage" method="post" enctype="multipart/form-data">
    <div class="modal fade" id="Submitdate" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-body">
            <p style="color:#e99c31;"><i class="fa fa-search fa-lg"></i>&nbsp;Select Submit Date Range:</p>
            <hr>
            <?php if (isset($data["error"])) { ?>
              <div class="alert alert-danger">
                <?php echo $data["error"]; ?>
              </div>
              <br>
            <?php unset($data["error"]);
            } ?>
            <label for="first_dt" class="form-group">Start Date:</label>
            <div class="form-group mb-4">
              <div class="datepicker date input-group">
                <input type="text" placeholder="Choose Date" name="start_dt" class="form-control" id="sfirst_dt" required>
                <div class="input-group-append">
                  <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                </div>
              </div>
            </div>
            <label for="end_dt" class="form-group">End Date:</label>
            <div class="form-group mb-4">
              <div class="datepicker date input-group">
                <input type="text" placeholder="Choose Date" name="end_dt" class="form-control" id="send_dt" required>
                <div class="input-group-append">
                  <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
            <input type="submit" name="submit_dt" value="Submit" class="btn btn-info" />
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
        searching: false,
        buttons: ['excel', 'csv', 'pdf']
      });

      table.buttons().container()
        .appendTo('#example_wrapper');
    });
  </script>
  <script>
    $("#first_dt").datepicker({
      language: "es",
      autoclose: true,
      format: "yyyy-mm-dd"
    });
    $("#end_dt").datepicker({
      language: "es",
      autoclose: true,
      format: "yyyy-mm-dd"
    });
    $("#sfirst_dt").datepicker({
      language: "es",
      autoclose: true,
      format: "yyyy-mm-dd"
    });
    $("#send_dt").datepicker({
      language: "es",
      autoclose: true,
      format: "yyyy-mm-dd"
    });
  </script>
</body>

</html>