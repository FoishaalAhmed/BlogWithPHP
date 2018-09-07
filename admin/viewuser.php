<?php include'inc/header.php'; ?>
<?php include'inc/sideber.php'; ?>
<?php 
    if (!isset($_GET['userid']) || $_GET['userid'] == NULL) {
        echo "<script>window.location = 'userlist.php'; </script>";        
    } else {
        $userid = $_GET['userid'];
    }
    
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>View User</h2>
<?php 
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        echo "<script>window.location = 'userlist.php'; </script>";
    }

?>
        <div class="block">               
         <form action="" method="post">
            <?php 
        $query = "select * from tbl_user where id ='$userid'";
        $msg = $db->select($query);
        if ($msg) {
        while ($result = $msg->fetch_assoc()) {
    ?>
            <table class="form">              
                <tr>
                    <td>
                        <label>Name</label>
                    </td>
                    <td>
                        <input type="text" readonly="" value="<?php echo $result['name']; ?>" class="medium" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Username</label>
                    </td>
                    <td>
                        <input type="text" readonly="" value="<?php echo $result['username']; ?>" class="medium" />
                    </td>
                </tr> 
                <tr>
                    <td>
                        <label>Email</label>
                    </td>
                    <td>
                        <input type="text" readonly="" value="<?php echo $result['email']; ?>" class="medium" />
                    </td>
                </tr> 
                           
                <tr>
                    <td>
                        <label>Details</label>
                    </td>
                    <td>
                        <textarea readonly="" class="tinymce">
                            <?php echo $result['details']; ?>
                        </textarea>
                    </td>
                </tr>
                <!--<tr>
                    <td>
                        <label>Role</label>
                    </td>
                    <td>
                        <input type="text" readonly="" value="
                        <?php 
                        /*if ($result['role'] == '0') {
                                echo "Admin";
                             } elseif ($result['role'] == '1') {
                                echo "Author";
                             } elseif ($result['role'] == '2') {
                                echo "Editor";
                             } */
                        ?>" class="medium" />
                    </td>
                </tr>-->
				<tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Ok" />
                    </td>
                </tr>
            </table>
            <?php } } ?>
            </form>
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
