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
      <h4 style=" text-align:center; font-size:2em; color:black;">Search Result</h4>
      <div class="row">
        <div class="col-sm-12 text-center">
          <a class="btn btn-outline-primary" aria-current="page" href="<?= ROOT ?>/admin">Home</a>
          <a class="btn btn-outline-warning" aria-current="page" href="<?= ROOT ?>/addtime">Add new Datetime</a>
        </div>
      </div>
      <hr />
      <div class="table-responsive">
        <table id="example" class="table table-hover dt-responsive display table-bordered nowrap" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th>Employee Name</th>
              <th>Working Day</th>
              <th>Locations</th>
              <th>Total HRS</th>
              
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
                echo "<td></td>";
                echo "<td>" . $dts['tt_hrs'] . "</td>";
                
                echo '<td><form method="post"><input type="hidden" name="users_id" value="' . $dts['u_id'] . '">
                  <input type="hidden" name="s_dt" value="' . $dts['u_sdt'] . '">
                  <input type="hidden" name="e_dt" value="' . $dts['u_edt'] . '">
                  <input type="hidden" name="tt_hrs" value="' . $dts['tt_hrs'] . '">
                  <input type="hidden" name="u_date" value="' . $dts['u_date'] . '">
                  <input type="hidden" name="locations" value="' . $_SESSION['srch_dt']['locations'] . '">
                  <input type="submit" name="view" value="View" class="btn btn-warning"/></form></td>';
                echo "</tr>";
                foreach($dts['info'] as $d){
                  echo "<tr>";
                  echo "<td></td>";
                  echo "<td>" . $d['dates'] . "</td>";
                  echo "<td>" . $d['location'] . "</td>";
                  echo "<td>" . $d['hrs'] . "</td>";
                  echo '<td><form method="post"><input type="hidden" name="users_id" value="' . $dts['u_id'] . '">
                  <input type="hidden" name="d_date" value="' . $d['dates'] . '">
                  <input type="hidden" name="locations" value="' . $_SESSION['srch_dt']['locations'] . '">
                  <input type="submit" name="edittime" value="Edit" class="btn btn-info"/></form></td>';
                  echo "</tr>";
                }
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
          <div class="col-sm-8 text-center">
          <?php echo $_SESSION['srch_dt']['str_dt'].' to '.$_SESSION['srch_dt']['ed_dt']; ?>
          </div>
          
          <div class="col-sm-4 text-center">
          <?php if (!empty($data["total"])) {
              echo "Total HRS: " . $data['total'];
            } else {
              echo "Total HRS: 0.00";
            } ?>
          </div>
        </div>
    </section>

  </div>

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
        sort: false,
        pageLength: 15,
        buttons: ['excel', 'csv', 'pdf']
      });

      table.buttons().container()
        .appendTo('#example_wrapper');
    });
  </script>

</body>

</html>