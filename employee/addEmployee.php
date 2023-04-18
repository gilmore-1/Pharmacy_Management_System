<?php
include "../menu/menu.php";
?>
<style>
  .is-active{
      z-index: 0;
    }
</style>
<div class="container">
<div style="margin-top: 0%; width:88%;">
    <div style="margin-top: 0.8%; height:900px;">
      <section class="section columns">
        <div class="column is-full-desktop is-full-mobile" style="margin-left: 18.5%; margin-top: 4%">
          <div class="tabs is-toggle is-fullwidth">
            <ul>
              <li class="is-active" >
                
                <a href="addEmployee.php">
                  <span>Add new Employee</span>
                </a>
              </li>

              <li>
                <a href="employeeList.php">
                  <span>Employee List</span>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </section>

    <section class="panel" style="margin-left: 19.8% ; margin-top: -30px; width: 96.5%;">
    <?php
        if($_POST["btnAdd"])
        {

          $input_date=$_POST['joined'];
          $date=date("Y-m-d",strtotime($input_date));
          $verificationCode = md5(uniqid());

          $sql = mysqli_query($Links, "INSERT INTO user(id, name, email,  password, email,  date_joined, salary, shifts,roleid,verification_code) VALUES(".mysqli_insert_id($Links).", '".$_POST["name"]."', '".$_POST["email"]."', '".$_POST["password"]."', '".$date."', '".$_POST["salary"]."', '".$_POST["shift"]."', 2, '".$_POST["verificationCode"]."')");
          if($sql)
          {
            $to = $_POST['email'];
            $subject = 'Verify your email address';
            $message = 'Hello ' . $email . '';
            $message .= 'Please click the following link to verify your email address:';
            $message .= '<a href="http://atest.recraft.ge/verify.php?code=' . $verificationCode . '">Click here to verify your email</a>';
            $headers = "From: atest@recraft.ge";
            mail($to, $subject, $message, $headers);
            echo "<script>alert('Employee added success!');</script>";

          }
          else echo "<script>alert('Fail to add new employee!');</script>";
        }
    ?>
    <?php if($_SESSION['roleid'] == 1){ ?>
  <p class="panel-heading" style="background-color:hsl(0, 0%, 88%) ;color:hsl(0, 0%, 21%)">
    Add Employee
  </p>
  <div class="panel-block" style="height: auto">
    <div  style="height: 900px; width: 87.5vw; padding: 2%;">

    <div style="overflow-y:auto ;overflow-x: hidden;height: 900px;">

<div class="spinner-box loadCenter">

<form method="post">

<div class="field">
  <label class="label" >EMPLOYEE name</label>
  <input type="text" class="is-center input" name="name" style="width: 100%;" placeholder="Seymour Butts" required/>
</div>

<div class="field">
  <label class="label" >EMPLOYEE email</label>
  <input type="email" class="is-center input" name="email" style="width: 100%;" placeholder="seymour@butts.com" required/>
</div>

<div class="field">
  <label class="label" >EMPLOYEE pasword</label>
  <input type="password" class="is-center input" name="password" style="width: 100%;" placeholder="test123" required/>
</div>

<div class="field">
  <label class="label" >DATE JOINED</label>
  <input type="date"  class="is-center input" name="joined" style="width: 100%;" required/>
</div>

<div class="field">
  <label class="label" >salary</label>
  <input type="number" class="is-center input" name="salary" style="width: 100%;" placeholder="1000" required/>
</div>

<div class="field">
  <label class="label">SHIFT</label>
  <input list="shifts" name= "shift">
  <datalist  id="shifts">
    <option value="Morning Shift">
    <option value="Afternoon Shift">
    <option value="Evening Shift">
    <option value="Night Shift">
  </datalist>
</div>


<div style="width: 100%;margin-top: 40px;">
  <input type="submit" class="button is-primary is-fullwidth" name="btnAdd" value="Insert">
</div>
</form>
</div>
    </div>
  </div>
    </section>
    <?php }
    else echo "No privilege to access this page"; ?>
</div>