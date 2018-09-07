<?php include'inc/header.php'; ?>
<?php include'inc/sideber.php'; ?>
<style>
<style>
.change{margin-left: 10px }
.change a{border: 1px solid #ddd; color: #444;cursor: pointer;font-size: 20px; padding: 2px 10px; font-weight: normal; background: #F0F0F0}
</style>
<div class="grid_10">

    <div class="box round first grid">
        <h2>Update User</h2>
<?php 
    $userid   = Session::get("userId");
    $userrole = Session::get("userRole");

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name    = mysqli_real_escape_string($db->link, $_POST['name']);
        $username  = mysqli_real_escape_string($db->link, $_POST['username']);
        $email   = mysqli_real_escape_string($db->link, $_POST['email']);
        $details = mysqli_real_escape_string($db->link, $_POST['details']);

        if($name == "" || $username == "" || $email == "" || $details == ""){
            echo "<span class='error'>Field must not be empty!!</span>";
        }else{
           $query = "select * from tbl_user where email = '$email' limit 1";
            $mailcheck = $db->select($query);
            if ($mailcheck == true) {
               echo "<span class='error'>Email Allready Exist!!</span>"; 
            }elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    echo "<span class='error'>Email Address not Valid!!</span>";
            }else{
                $query = "update tbl_user set
                    name = '$name', 
                    username = '$username',
                    email = '$email', 
                    details = '$details'
                    where id = '$userid'";
                $update_rows = $db->update($query);
            if ($update_rows) {
             echo "<span class='success'>User Data Updated Successfully.</span>";
            }else {
             echo "<span class='error'>User Data not Updated !</span>";
                }
            }
    }
}

?>
        <div class="block">               
         <form action="" method="post">
            <?php 
        $query = "select * from tbl_user where id = '$userid' and role = '$userrole'";
        $getUser = $db->select($query);
        if ($getUser) {
            while ($result = $getUser->fetch_assoc()) {
    ?>
            <table class="form">
               
                <tr>
                    <td>
                        <label>Name</label>
                    </td>
                    <td>
                        <input type="text" readonly="" name="name" value="<?php echo $result['name']; ?>" class="medium" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Username</label>
                    </td>
                    <td>
                        <input type="text"  name="username" value="<?php echo $result['username']; ?>" class="medium" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Email</label>
                    </td>
                    <td>
                        <input type="text" name="email" value="<?php echo $result['email']; ?>" class="medium" />
                    </td>
                </tr>

                <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Details</label>
                    </td>
                    <td>
                        <textarea name="details" class="tinymce">
                            <?php echo $result['details']; ?>
                        </textarea>
                    </td>
                </tr>
                
				<tr>
                    <td></td>
                    <td>
                        <input type="submit"  Value="Update" />
                        <span class="change"> <a href="changepassword.php?passid=<?php echo $result['id']; ?>">Change Password</a> </span>
                    </td>
                </tr>
            </table>
            </form>
            <?php } } ?>
        </div>
    </div>
</div>
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<!-- Load TinyMCE -->
<?php include'inc/footer.php'; ?> 
