<?php include'inc/header.php'; ?>
<?php include'inc/sideber.php'; ?>
<?php 
    if (!isset($_GET['msgid']) || $_GET['msgid'] == NULL) {
        echo "<script>window.location = 'inbox.php'; </script>";        
    } else {
        $id = $_GET['msgid'];
    }
    
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Replay Email</h2>
<?php 
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $to      = mysqli_real_escape_string($db->link, $_POST['to']);
        $from    = mysqli_real_escape_string($db->link, $_POST['from']);
        $subject = mysqli_real_escape_string($db->link, $_POST['subject']);
        $message = mysqli_real_escape_string($db->link, $_POST['message']);

        $sendmail = mail($to, $subject, $message, $from);
        if ( $sendmail) {
            echo "<span class='success'>Email Send Successfully.</span>";
        } else {
            echo "<span class='error'>Email Not Send. Something went Wrong!!</span>";
        }

        echo "<script>window.location = 'inbox.php'; </script>";
        
    }

?>
        <div class="block">               
         <form action="" method="post">
            <?php 
        $query = "select * from tbl_contact where id ='$id' order by id desc";
        $msg = $db->select($query);
        if ($msg) {
        while ($result = $msg->fetch_assoc()) {
    ?>
            <table class="form">              
                <tr>
                    <td>
                        <label>To</label>
                    </td>
                    <td>
                        <input type="text" name="to" readonly="" value="<?php echo $result['email']; ?>" class="medium" />
                    </td>
                </tr> 
                <tr>
                    <td>
                        <label>From</label>
                    </td>
                    <td>
                        <input type="text" name="from" placeholder="Enter Sender Email Address" class="medium" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Subject</label>
                    </td>
                    <td>
                        <input type="text" name="subject" placeholder="Enter Your Subject" class="medium" />
                    </td>
                </tr>           
                <tr>
                    <td>
                        <label>Message</label>
                    </td>
                    <td>
                        <textarea name="message" class="tinymce">
                            
                        </textarea>
                    </td>
                </tr>
				<tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Send" />
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
