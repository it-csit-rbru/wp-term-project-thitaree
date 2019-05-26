<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="wIDth=device-wIDth, initial-scale=1">
        <title>Project 6015261025</title>
        <!-- Bootstrap -->
        <link href="bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css">
        <link href="bootstrap/css/bootstrap-theme.css" rel="stylesheet" type="text/css">
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="bootstrap/js/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include indivIDual files as needed -->
        <script src="bootstrap/js/bootstrap.min.js"></script>        
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="bootstrap/js/html5shiv.min.js"></script>
            <script src="bootstrap/js/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>        
        <div class="container">
            <div class="row"> 
                <div class="jumbotron" style="background-color: cornflowerblue;">
                    <?php include 'topbanner.php';?>
                </div>
            </div>
            <div class="row">
                <?php include 'menu.php';?>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-3 col-lg-3">
                    <p>Login Area</p>
                </div>  
                <div class="col-sm-12 col-md-9 col-lg-9">
                    <h4>แก้ไขข้อมูลผู้ใช้</h4>
                    <?php
                        $user_id = $_REQUEST['user_id'];
                        if(isset($_GET['submit'])){
                            $user_id = $_GET['user_id'];
                            $user_ttl_id = $_GET['user_ttl_id'];
                            $user_fname = $_GET['user_fname'];
                            $user_lname = $_GET['user_lname'];
                            $user_tel = $_GET['user_tel'];
                            $user_ad = $_GET['user_ad'];
                            $sql = "update user set ";
                            $sql .= "user_fname='$user_fname',user_lname='$user_lname',user_ttl_id='$user_ttl_id',user_tel='$user_tel',user_ad='$user_ad' ";
                            $sql .="where user_id='$user_id' ";
                            include 'connectdb.php';
                            mysqli_query($conn,$sql);
                            mysqli_close($conn);
                            echo "แก้ไขข้อมูลผู้ใช้  $user_fname $user_lname $user_tel $user_ad  เรียบร้อยแล้ว<br>";
                            echo '<a href="user_list.php">แสดงรายชื่อผู้ใช้ทั้งหมด</a>';
                        }else{
                    ?>
                    <form class="form-horizontal" role="form" name="user_edit" action="<?php echo $_SERVER['PHP_SELF'];?>">
                        <div class="form-group">
                            <input type="hIDden" name="user_id" ID="user_id" value="<?php echo "$user_id";?>">
                            <label for="user_ttl_id" class="col-md-2 col-lg-2 control-label">คำนำหน้าชื่อ</label>
                            <div class="col-md-10 col-lg-10">
                                <select name="user_ttl_id" ID="user_ttl_id" class="form-control">
                                <?php
                                    include 'connectdb.php';
                                    $sql2 = "select * from user where user_id='$user_id'";
                                    $result2 = mysqli_query($conn,$sql2);
                                    $row2 = mysqli_fetch_array($result2,MYSQLI_ASSOC);
                                    $fuser_fname = $row2['user_fname'];
                                    $fuser_lname = $row2['user_lname'];
                                    $fuser_tel = $row2['user_tel'];
                                    $fuser_ad = $row2['user_ad'];
                                    $fuser_ttl_id = $row2['user_ttl_id'];
                                    $sql =  "SELECT * FROM title order by ttl_id";
                                    $result = mysqli_query($conn,$sql);
                                    while (($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) != NULL) {
                                        echo '<option value=';
                                        echo '"' . $row['ttl_id'].'"';
                                        if($row['ttl_id']==$fuser_ttl_id){
                                            echo ' selected="selected" ';
                                        }
                                        echo ">";
                                        echo $row['ttl_name'];
                                        echo '</option>';
                                    }
                                    mysqli_free_result($result);
                                    mysqli_close($conn);
                                ?>
                                </select>
                           </div>    
                        </div>
                        <div class="form-group">
                            <label for="user_fname" class="col-md-2 col-lg-2 control-label">ชื่อ</label>
                            <div class="col-md-10 col-lg-10">
                                <input type="text" name="user_fname" ID="user_fname" class="form-control" 
                                       value="<?php echo $fuser_fname;?>">
                            </div>    
                        </div>    
                        <div class="form-group">
                            <label for="user_lname" class="col-md-2 col-lg-2 control-label">นามสกุล</label>
                            <div class="col-md-10 col-lg-10">
                                <input type="text" name="user_lname" ID="user_lname" class="form-control" 
                                       value="<?php echo $fuser_lname;?>">
                            </div>    
                        </div>
                        <div class="form-group">
                            <label for="user_tel" class="col-md-2 col-lg-2 control-label">เบอร์โทร</label>
                            <div class="col-md-10 col-lg-10">
                                <input type="varchar" name="user_tel" ID="user_tel" class="form-control" 
                                       value="<?php echo $fuser_tel;?>">
                            </div>    
                        </div>
                        <div class="form-group">
                            <label for="user_ad" class="col-md-2 col-lg-2 control-label">ที่อยู่</label>
                            <div class="col-md-10 col-lg-10">
                                <input type="text" name="user_ad" ID="user_ad" class="form-control" 
                                       value="<?php echo $fuser_ad;?>">
                            </div>    
                        </div> 
                        <div class="form-group">
                            <div class="col-md-10 col-lg-10">
                                <input type="submit" name="submit" value="ตกลง" class="btn btn-default">
                            </div>    
                        </div> 
                    </form>
                    <?php
                        }
                    ?>
                </div>    
            </div>
            <div class="row">
                <address>คณะคอมพิวเตอร์ศึกษาปี 2 </address>
            </div>
        </div>    
    </body>
</html>