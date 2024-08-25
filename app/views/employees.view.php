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
          <a class="btn btn-outline-primary" aria-current="page" href="<?= ROOT ?>/admin">Home</a>
          <a class="btn btn-outline-primary" aria-current="page" href="<?= ROOT ?>/signup">Create New Employee</a>
        </div>
      </div>
      <hr />
      <div class="table-responsive">
        <table id="example" class="table table-hover dt-responsive display table-bordered nowrap" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th>Employee Name</th>
              <th>Email</th>
              <th>Status</th>
              <th>Phone</th>
              <th>Regular Rate</th>
              <th>Bonus Rate</th>
              <th>Base Hours</th>
              <th>Create Date</th>
              <th></th>
            </tr>
          </thead>

          <tbody>
            <?php
            if (!empty($data['emps'])) {
              foreach ($data['emps'] as $dts) {
                echo "<tr>";
                echo "<td>" . $dts->u_fname . " " . $dts->u_lname . "</td>";
                echo "<td>" . $dts->email . "</td>";
                echo "<td>" . $dts->s_name . "</td>";
                echo "<td>" . $dts->tel . "</td>";
                echo "<td>" . number_format($dts->u_reg_pay, 2) . "</td>";
                echo "<td>" . number_format($dts->u_pay, 2) . "</td>";
                echo "<td>" . $dts->u_base_hrs . "</td>";
                echo "<td>" . $dts->create_dt . "</td>";
                echo '<td><form method="post"><input type="hidden" name="users_id" value="' . $dts->u_id . '">
                  <input type="submit" name="edit" value="Edit" class="btn btn-info"/>
                  <input type="submit" name="deleter" value="Delete" class="btn btn-danger"/></form></td>';
                echo "</tr>";
              }
            } else {
              echo "<tr class='table-primary'>";
              echo "<td colspan='7'>No Data Available</td>";
              echo "</tr>";
            }
            ?>

          </tbody>
        </table>
        <hr />

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
        searching: false,
        buttons: ['excel', 'csv', 'pdf']
      });

      table.buttons().container()
        .appendTo('#example_wrapper');
    });
  </script>

</body>

</html>