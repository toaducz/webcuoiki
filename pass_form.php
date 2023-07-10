<?php include_once 'helpers/helper.php'; ?>
<?php subview('header.php'); ?>
<link rel="stylesheet" href="assets/css/form.css">
<style>
.main-col {
    padding: 30px;
    background-color: whitesmoke;
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);  
    margin-top: 50px;   
}
.pass-form {
    background-color: white;
    border: 5px dotted #607d8b;
    padding: 20px;
    margin-top: 30px;
}

body {
    background: #bdc3c7;  /* fallback for old browsers */
    background: -webkit-linear-gradient(to right,  #ff8b3d,   #ADD8E6); 
    background: linear-gradient(to right,  #ff8b3d, #ADD8E6 );

}
@font-face {
  font-family: "Times New Roman";
  src: url('assets/css/Product Sans Bold.ttf');
  }
  h1 {
    font-size: 42px !important;
    margin-bottom: 20px;  
    font-family :"Times New Roman" !important;
    font-weight: bolder;
  }
  input {
    border :0px !important;
    border-bottom: 2px solid #424242 !important;
    color :#424242 !important;
    border-radius: 0px !important;
    font-weight: bold !important;   
    margin-bottom: 10px;
  }
  label {
    color : #828282 !important;
    font-size: 19px;
  }  
@media screen and (max-width: 900px){
    body {
  background: #bdc3c7;  /* fallback for old browsers */
  background: -webkit-linear-gradient(to right, #2c3e50, #bdc3c7);  /* Chrome 10-25, Safari 5.1-6 */
  background: linear-gradient(to right, #2c3e50, #bdc3c7); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

}  
}
</style>
<?php
    if(isset($_GET['error'])) {
        if($_GET['error'] === 'invdate') {
          echo '<script>alert("Ngày tháng năm sinh không hợp lệ")</script>';
      } else if($_GET['error'] === 'moblen') {
          echo '<script>alert("Thông tin liên lạc không hợp lệ")</script>';
      } else if($_GET['error'] === 'sqlerror') {
          echo"<script>alert('Database lỗi')</script>";
      }
    }
    ?>
<?php if(isset($_SESSION['userId']) && isset($_POST['book_but'])) {   
    $flight_id = $_POST['flight_id'];
    $passengers = $_POST['passengers']; 
    $price = $_POST['price'];
    $class = $_POST['class'];
    $type = $_POST['type'];
    $code = $_POST['code'];
    if ($type === "round") {
        $ret_date = $_POST['ret_date'];
    }
   
?>    
<main>
    <div class="container mb-5">
    <div class="col-md-12 main-col">
        <h1 class="text-center text-secondary">Chi tiết khách hàng</h1>  
        <form action="includes/pass_detail.inc.php" class="needs-validation mt-4" 
            method="POST">

            <input type="hidden" name="type" value=<?php echo $type; ?>> 
            <input type="hidden" name="code" value=<?php echo $code; ?>> 
            <?php
                if ($type === "round") {?>
                    <input type="hidden" name="ret_date" value=<?php echo $ret_date; ?>>  
            <?php 
                }
            ?>  
            <input type="hidden" name="class" value=<?php echo $class; ?>>   
            <input type="hidden" name="passengers" value=<?php echo $passengers; ?>>   
            <input type="hidden" name="price" value=<?php echo $price; ?>>   
            <input type="hidden" name="flight_id" value=<?php echo $flight_id; ?>>   
        <?php for($i=1;$i<=$passengers;$i++) {
            $temp = "";
            for ($x = 0; $x < 10; $x++) {
                $temp .= $_SESSION['date'][$x];
            }
            echo'   
            <div class="pass-form">  
            <div class="form-row">
                <div class="col-md">
                    <div class="input-group">
                        <div for="firstname'.$i.'">Họ</div>
                        <input type="text" value ="'. $_SESSION['firstname'].'" name="firstname[]" id="firstname'.$i.'" class="pl-0 pr-0" 
                            required style="width: 100%;">
                    </div>
                </div>
                <div class="col-md">
                    <div class="input-group">
                        <div for="midname'.$i.'">Chữ lót</div>
                        <input type="text" value ="'. $_SESSION['midname'].'" name="midname[]" id="midname'.$i.'" class="pl-0 pr-0"
                            required style="width: 100%;">
                    </div>
                </div>

                <div class="col-md">
                    <div class="input-group">
                        <div for="lastname'.$i.'">Tên</div>
                        <input type="text" value ="'. $_SESSION['lastname'].'" name="lastname[]" id="lastname'.$i.'" class="pl-0 pr-0"
                             required style="width: 100%;">
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md">
                    <div class="input-group">
                        <div for="mobile'.$i.'">Số điện thoại</div>
                        <input type="number" value ="'. $_SESSION['phone'].'" name="mobile[]" min="0" id="mobile'.$i.'" 
                            required>
                    </div>
                </div>
                <div class="col-md">
                    <div class="form-group mt-3"> 
                        <div for="dob">Ngày sinh</div>
                        <input id="date" value="'. $temp.'" name="date[]" type="date"
                             required>
                    </div>
                </div>
            </div>
            </div>'; }  ?>    
            <div class="col text-center">
                <button name="pass_but" type="submit" 
                class="btn btn-success mt-4">
                <div style="font-size: 1.5rem;">
                <i class="fa fa-lg fa-arrow-right"></i> Tiếp tục  
                </div>
                </button>
            </div>         
        </form>              
    </div>
    </div>
    <?php subview('footer.php'); ?> 
<script>
$(document).ready(function(){
  $('.input-group input').focus(function(){
    me = $(this) ;
    $("label[for='"+me.attr('id')+"']").addClass("animate-label");
  }) ;
  $('.input-group input').blur(function(){
    me = $(this) ;
    if ( me.val() == ""){
      $("label[for='"+me.attr('id')+"']").removeClass("animate-label");
    }
  }) ;
});
</script>
</main>
<?php } ?>
