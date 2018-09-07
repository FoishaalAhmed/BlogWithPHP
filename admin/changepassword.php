<?php include'inc/header.php'; ?>
<?php include'inc/sideber.php'; ?>
<?php 
    if (!isset($_GET['passid']) || $_GET['passid'] == NULL) {
        echo "<script>window.location = 'profile.php'; </script>";    
    } else {
        $passid = $_GET['passid'];
    }   
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Change Password</h2>
        <div class="block">  
        <?php 
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $oldpassword  = mysqli_real_escape_string($db->link, $_POST['oldpassword']);
                $newpass  = mysqli_real_escape_string($db->link, $_POST['newpass']);

                if($oldpassword == "" || $newpass == ""){
                    echo "<span class='error'>Field must not be empty!!</span>";
                } else{
                    $oldpassword = md5($oldpassword);
                    $newpass     = md5($newpass);
                    $query = "select password from tbl_user where id = '$passid' and  password = '$oldpassword'";
                    $passcheck = $db->select($query);
                    if ($passcheck == true) {
                        $query = "update tbl_user set 
                                password = '$newpass'
                                where id = '$passid'
                                ";
                        $Update_pass = $db->update($query);
                        if ($Update_pass) {
                         echo "<span class='success'>Password Updated Successfully.</span>";
                        }
                    } else{
                        echo "<span class='error'>Old Password Does Not Matched.</span>";
                    }
                }
            }

        ?>             
         <form action="" method="post">

            <table class="form">					
                <tr>
                    <td>
                        <label>Old Password</label>
                    </td>
                    <td>
                        <input type="password" placeholder="Enter Old Password..."  name="oldpassword" class="medium" />
                    </td>
                </tr>
				 <tr>
                    <td>
                        <label>New Password</label>
                    </td>
                    <td>
                        <input type="password" placeholder="Enter New Password..." name="newpass" class="medium" />
                    </td>
                </tr>
				 
				
				 <tr>
                    <td>
                    </td>
                    <td>
                        <input type="submit" name="submit" Value="Update" />
                    </td>
                </tr>
            </table>
            </form>
        </div>
    </div>
</div>
<?php include'inc/footer.php'; ?> 