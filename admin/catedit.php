<!-- update and edit catagory -->
<?php include'inc/header.php'; ?>
<?php include'inc/sideber.php'; ?>
<?php 
    if (!isset($_GET['catid']) || $_GET['catid'] == NULL) {
        echo "<script>window.location = 'catlist.php'; </script>";
        
    } else {
        $id = $_GET['catid'];
    }
    
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Update Category</h2>
       <div class="block copyblock"> 
    <?php 

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST['name'];
        $name = mysqli_real_escape_string($db->link, $name);

        if (empty($name)) {
            echo "<span class='error'>Field must not be empty!!</span>";
        } else {
            $query = "update tbl_catagory set name = '$name' where id = '$id'";
            $update_catagory = $db->update($query);
            if ($update_catagory) {
                echo "<span class='success'>Category Updated Successfully!!</span>";
            } else {
                echo "<span class='error'>Category Not Updated!!</span>";
            }
            
        }
        
    }
    ?>
    <?php 
        $query = "select * from tbl_catagory where id ='$id' order by id desc";
        $catagory = $db->select($query);
        while ($result = $catagory->fetch_assoc()) {
    ?>
     <form action="" method="post">
        <table class="form">					
            <tr>
                <td>
                    <input type="text" name = "name" value="<?php echo $result ['name'] ?>" class="medium" />
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
    <?php } ?>
        </div>
    </div>
</div>

<?php include'inc/footer.php'; ?>