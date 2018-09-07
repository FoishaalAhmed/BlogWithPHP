<?php include'inc/header.php'; ?>
<?php include'inc/sideber.php'; ?>

<div class="grid_10">

    <div class="box round first grid">
        <h2>Update Social Media</h2>
        <?php 
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $fb  = $format->validation($_POST['fb']);
            $twtr = $format->validation($_POST['twtr']);
            $lnkin = $format->validation($_POST['lnkin']);
            $gplus = $format->validation($_POST['gplus']);

            $fb  = mysqli_real_escape_string($db->link, $fb);
            $twtr  = mysqli_real_escape_string($db->link, $twtr);
            $lnkin  = mysqli_real_escape_string($db->link, $lnkin);
            $gplus  = mysqli_real_escape_string($db->link, $gplus);

            if($fb == "" || $twtr == "" || $lnkin == "" || $gplus == ""){
                echo "<span class='error'>Field must not be empty!!</span>";
            } else{
                $query = "update tbl_social set 
                           fb  = '$fb', 
                           twtr  = '$twtr', 
                           lnkin   = '$lnkin',
                           gplus   = '$gplus'
                           where id = '1'";
                $update_row = $db->update($query);
                if ($update_row) {
                 echo "<span class='success'>Social Updated Successfully.
                 </span>";
                }else {
                 echo "<span class='error'>Social Not Updated !</span>";
                    }
            }
        }
        ?>
        <div class="block">
        <?php 
            $query = "select * from tbl_social where id = '1' ";
            $social = $db->select($query);
            if ($social) {
                while ($result = $social->fetch_assoc()) {
        ?>               
         <form action="" method="post">
            <table class="form">					
                <tr>
                    <td>
                        <label>Facebook</label>
                    </td>
                    <td>
                        <input type="text" name="fb" value="<?php echo $result['fb']; ?>" class="medium" />
                    </td>
                </tr>
				 <tr>
                    <td>
                        <label>Twitter</label>
                    </td>
                    <td>
                        <input type="text" name="twtr" value="<?php echo $result['twtr']; ?>" class="medium" />
                    </td>
                </tr>
				
				 <tr>
                    <td>
                        <label>LinkedIn</label>
                    </td>
                    <td>
                        <input type="text" name="lnkin" value="<?php echo $result['lnkin']; ?>" class="medium" />
                    </td>
                </tr>
				
				 <tr>
                    <td>
                        <label>Google Plus</label>
                    </td>
                    <td>
                        <input type="text" name="gplus" value="<?php echo $result['gplus']; ?>" class="medium" />
                    </td>
                </tr>
				
				 <tr>
                    <td></td>
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