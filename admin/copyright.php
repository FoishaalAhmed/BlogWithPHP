<?php include'inc/header.php'; ?>
<?php include'inc/sideber.php'; ?>

<div class="grid_10">

    <div class="box round first grid">
        <h2>Update Copyright Text</h2>
        <?php 
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $text  = $format->validation($_POST['text']);
            $text  = mysqli_real_escape_string($db->link, $text);

            if($text == ""){
                echo "<span class='error'>Field must not be empty!!</span>";
            } else{
                $query = "update tbl_footer set 
                           text  = '$text'
                           where id = '1'";
                $update_row = $db->update($query);
                if ($update_row) {
                 echo "<span class='success'>Copyright Updated Successfully.
                 </span>";
                }else {
                 echo "<span class='error'>Copyright Not Updated !</span>";
                    }
            }
        }
        ?>
        <div class="block copyblock"> 
        <?php 
            $query = "select * from tbl_footer where id = '1' ";
            $copyright = $db->select($query);
            if ($copyright) {
                while ($result = $copyright->fetch_assoc()) {
        ?>    
         <form action="" method="post">
            <table class="form">					
                <tr>
                    <td>
                        <input type="text" value="<?php echo $result['text']; ?>" name="text" class="large" />
                    </td>
                </tr>
				
				 <tr> 
                    <td>
                        <?php if (Session::get("userRole") == '0') { ?>
                        <input type="submit" name="submit" Value="Update" />
                        <?php } ?>
                    </td>
                </tr>
            </table>
            </form>
        <?php } } ?>
        </div>
    </div>
</div>
<?php include'inc/footer.php'; ?>
