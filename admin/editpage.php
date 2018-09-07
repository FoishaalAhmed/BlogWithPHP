<?php include'inc/header.php'; ?>
<?php include'inc/sideber.php'; ?>
<style>
.delete{margin-left: 10px }
.delete a{border: 1px solid #ddd; color: #444;cursor: pointer;font-size: 20px; padding: 2px 10px; font-weight: normal; background: #F0F0F0}
</style>
<?php 
    if (!isset($_GET['pageid']) || $_GET['pageid'] == NULL) {
        echo "<script>window.location = 'catlist.php'; </script>";
        
    } else {
        $id = $_GET['pageid'];
    }
    
?>
<div class="grid_10">

    <div class="box round first grid">
        <h2>Update Page</h2>
<?php 
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name  = mysqli_real_escape_string($db->link, $_POST['name']);
        $body  = mysqli_real_escape_string($db->link, $_POST['body']);

        if($name == "" || $body == ""){
            echo "<span class='error'>Field must not be empty!!</span>";
        }  else{
            $query = "update tbl_page set 
                    name = '$name', 
                    body = '$body'
                    where id = '$id'
                    ";
        $Update_rows = $db->update($query);
        if ($Update_rows) {
         echo "<span class='success'>Page Updated Successfully.
         </span>";
        }else {
         echo "<span class='error'>Page Not Updated !</span>";
            }
        }
    }

?>
        <div class="block">               
         <form action="" method="post">
            <?php 

                            $query = "select * from tbl_page where id = '$id'";
                            $page = $db->select($query);
                            if ($page) {
                                while ($result = $page->fetch_assoc()) {
                            ?>
            <table class="form">
               
                <tr>
                    <td>
                        <label>Name</label>
                    </td>
                    <td>
                        <input type="text" name="name" value="<?php echo $result['name']; ?>" class="medium" />
                    </td>
                </tr>           
                <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Content</label>
                    </td>
                    <td>
                        <textarea name="body" class="tinymce">
                            <?php echo $result['body']; ?>
                        </textarea>
                    </td>
                </tr>
				<tr>
                    <td></td>
                    <td>
                        <?php if (Session::get("userRole") == '0') { ?>
                        <input type="submit" name="submit" Value="Update" />
                        <span class="delete"> <a  onclick = "return confirm('Are you sure to delete this Page??');"href="deletepage.php?delpage=<?php echo $result['id']; ?>">Delete</a> </span>
                        <?php } ?>
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
