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
          <a class="btn btn-outline-primary" aria-current="page" href="<?= ROOT ?>/Admin">Back</a>
          
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
            <form method="post">
            <input type="hidden" name="s_dt" value="<?=$data['s_dt'] ?>">
            <input type="hidden" name="e_dt" value="<?=$data['e_dt'] ?>">
            <input type="submit" name="order" value="Submit" class="btn btn-danger"/>
            </form>
            </div>
          <?php } ?>
          </div><br /><br />
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