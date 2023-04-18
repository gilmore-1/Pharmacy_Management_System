<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<link rel="stylesheet" type="text/css" href="../css/jquery_dataTables.css">
<script type="text/javascript" charset="utf8" src="../js/jquery_dataTables.js"></script>
<head>
<style>
  .is-active{
      z-index: 0;
    }
</style>
<script>
  $(document).ready(function(){
    $.noConflict(true);
    $('#employee_table').DataTable();

    //when the edit button is clicked and data is automatically loaded in the form
    // Global variable for id
    var id ;

     $(".btnShowEdit").click(function(){
      id = $(this).attr("id");
      var name = $(this).attr("name");
      var email = $(this).attr("email");
      var date_joined = $(this).attr("date_joined");
      var salary = $(this).attr("salary");
      var shifts = $(this).attr("shifts");

      
      $('#empname').val(name);
      $('#email').val(email);
      $('#joined').val(date_joined);
      $('#salary').val(salary);
      $("#shift").val(shifts);
    });

    //updating data
    $(".btnEditEmployee").click(function(){
      var form_data = new FormData();
      form_data.append('name', $("#empname").val());
      form_data.append('email', $("#email").val());
      form_data.append('date_joined', $("#joined").val());
      form_data.append('salary', $("#salary").val());
      form_data.append('shifts', $('[name="Shift"]').val());
      form_data.append('action', 'editEmployee');
      form_data.append('id', id);
      $.ajax({
        url: "../ajax/ajax.php",
        method: "POST",
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        success: function(result){
          alert(result);
          location.reload(true);
        }
      });
    });

    //delete function
    $(".btnRemove").click(function(){
      var id = $(this).attr("id");
      var form_data = new FormData();
      form_data.append('action', 'deleteEmployee');
      form_data.append('id', id);
      var choice = confirm("Are you sure want to remove?");
      if(choice)
      {
        $.ajax({
          url: "../ajax/ajax.php",
          type: "POST",
          cache: false,
          contentType: false,
          processData: false,
          data: form_data,
          success: function(result){
            alert(result);
            location.reload(true);
          }
        });
      }
    });
  });
</script>
</head>
<?php
include "../menu/menu.php";
echo "<script type='text/javascript'> console.log('Role ID: " .  $_SESSION['roleid'] . "' ); </script>";
?>
<div class="container">
<div style="margin-top: 0%; width:88%;">
    <div style="margin-top: 0.8%; height:900px;">
      <section class="section columns">
        <div class="column is-full-desktop is-full-mobile" style="margin-left: 18.5%; margin-top: 4%">
          <div class="tabs is-toggle is-fullwidth">
            <ul>
              <li>
                <a href="addEmployee.php">
                  <span>Add new Employee</span>
                </a>
              </li>

              <li class="is-active">
                <a href="employeeList.php">
                  <span>Employee List</span>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </section>

      
<section class="panel" style="margin-left: 19.8% ; margin-top: -30px; width: 96.5%;">
<?php if($_SESSION['roleid'] == 1 || $_SESSION["roleid"] == 2){ ?>
  <p class="panel-heading" style="background-color:hsl(0, 0%, 88%) ;color:hsl(0, 0%, 21%)">
    Employee List
  </p>
  <div class="panel-block" style="height: auto">
    <div  style="height: 660px; width: 87.5vw; padding: 0%;">
    <div style="overflow-y:auto ;overflow-x: hidden;height: 500px;">
                <table id="employee_table" class="table is-full" style="width: 100%;">
                  <thead style="font-weight: bold;">
                    <td>EMPLOYEE ID</td>
                    <td>EMPLOYEE name</td>
                    <td>EMPLOYEE email</td>
                    <td>DATE JOINED</td>
                    <td>salary (RM)</td>
                    <td>SHIFT</td>
                    <td></td>
                  </thead>

                  <tbody>
                  <?php 
                  $sql = mysqli_query($Links, "SELECT * FROM user WHERE roleid == 2");
                  if(mysqli_num_rows($sql) > 0)
                  {
                    for($i = 0; $i < mysqli_num_rows($sql); $i++)
                    {
                      $row = mysqli_fetch_array($sql);
                      echo '<tr>
                      <td style="width: 20%;">'.$row["id"].'</td>
                      <td style="width: 20%;">'.$row["name"].'</td>
                      <td style="width: 20%;">'.$row["email"].'</td>
                      <td style="width: 20%;">'.$row["date_joined"].'</td>
                      <td style="width: 20%;">'.$row["salary"].'</td>
                      <td style="width: 20%;">'.$row["shifts"].'</td>';
                      if($_SESSION['roleid'] == 1){
                        echo'
                        <td class="level-right">
                          <nobr><button class="btnShowEdit button is-small is-primary" name="'.$row['name'].'" email="'.$row['email'].'" date_joined="'.$row['date_joined'].'" salary="'.$row['salary'].'" shifts="'.$row['shifts'].'" id="'.$row["id"].'" style="font-weight: bold;margin-right: 1%;" type="button" data-toggle="modal" data-backdrop="false" data-target="#editModal">Edit </button>
                          <button class="btnRemove button is-small is-danger" id="'.$row["id"].'" style="font-weight: bold;">Delete</button></nobr>
                        </td>
                        </tr>
                        ';
                      }
                    }
                  }
                  ?>
                  </tbody>
                </table>
          <br>
      </div>
  </div>
    </div>
  </div>
    </section>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModal">Edit Employee</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" enctype="multipart/form-data">

          <div class="field">
            <label class="label" >EMPLOYEE name</label>
            <input id="empname" type="text" class="manufacturer is-center input" name="name" style="width: 100%;" required/>
          </div>

          <div class="field">
            <label class="label" >EMPLOYEE email</label>
            <input id="email" type="text" class="name is-center input" name="email" style="width: 100%;"required/>
          </div>

          <div class="field">
            <label class="label" >DATE JOINED</label>
            <input id="joined" type="date" class="scientificname is-center input" name="joined" style="width: 100%;" required/>
          </div>

          <div class="field">
            <label class="label" >salary (RM)</label>
            <input id="salary" type="number" class="dosage is-center input" name="salary" style="width: 100%;" required/>
          </div>

          <div class="field">
            <label class="label">SHIFT</label>
            <input list="shift" name= "Shift" id="shift" class="category is-center input" style="width: 100%;" required>
            <datalist id="shift">
              <option value="Morning Shift">
              <option value="Afternoon Shift">
              <option value="Evening Shift">
              <option value="Night Shift">
            </datalist>
          </div>

          <div style="width: 100%;margin-top: 40px;">
            <input type="submit" class="btnEditEmployee button is-primary is-fullwidth" name="btnEditEmployee" value="Edit">
          </div>


        </form>
      </div>
    </div>
  </div>
  <?php }
  else echo "No privilege to access this page"; ?>
</div>