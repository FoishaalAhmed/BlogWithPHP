<?php include'inc/header.php'; ?>
<?php include'inc/sideber.php'; ?>
<?php 
    if (!isset($_GET['editsliderid']) || $_GET['editsliderid'] == NULL) {
        echo "<script>window.location = 'sliderlist.php'; </script>";     
    } else {
        $sliderid = $_GET['editsliderid'];
    }  
?>
<div class="grid_10">

    <div class="box round first grid">
        <h2>Update Post</h2>
<?php 
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $link    = mysqli_real_escape_string($db->link, $_POST['link']);
        $title  = mysqli_real_escape_string($db->link, $_POST['title']);

        $permited  = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $_FILES['image']['name'];
        $file_size = $_FILES['image']['size'];
        $file_temp = $_FILES['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
        $uploaded_image = "upload/".$unique_image;

        if($link == "" || $title == ""){
            echo "<span class='error'>Field must not be empty!!</span>";
        }else{ 
            if (!empty($file_name)) {
                if ($file_size >1048567) {
             echo "<span class='error'>Image Size should be less then 1MB!
             </span>";
            } elseif (in_array($file_ext, $permited) === false) {
             echo "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";
            } else{
            move_uploaded_file($file_temp, $uploaded_image);
            $query = "update tbl_slider set
                       link    = '$link', 
                       title  = '$title', 
                       image  = '$uploaded_image'
                       where id = $sliderid";
            $update_row = $db->update($query);
            if ($update_row) {
             echo "<span class='success'>Slider Updated Successfully.
             </span>";
            }else {
             echo "<span class='error'>Slider Not Updated !</span>";
                }
            }

            } else {
                $query = "update tbl_slider set
                       link    = '$link', 
                       title  = '$title'
                       where id = $sliderid";
            $update_row = $db->update($query);
            if ($update_row) {
             echo "<span class='success'>Slider Updated Successfully.
             </span>";
            }else {
             echo "<span class='error'>Slider Not Updated !</span>";
                }
            }
            
         }
    }

?>
        <div class="block"> 
        <?php 
            $query = "select * from tbl_slider where id = '$sliderid' order by id desc";
            $slider = $db->select($query);
            if ($slider) {
                while ($sliderresult = $slider->fetch_assoc()) {
        ?>             
         <form action="" method="post" enctype="multipart/form-data">
            <table class="form">
               <tr>
                    <td>
                        <label>Link</label>
                    </td>
                    <td>
                        <input type="text" name="link" value="<?php echo $sliderresult ['link']; ?>" class="medium" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Title</label>
                    </td>
                    <td>
                        <input type="text" name="title" value="<?php echo $sliderresult ['title']; ?>" class="medium" />
                    </td>
                </tr>
             
                <tr>
                    <td>
                        <label>Upload Image</label>
                    </td>
                    <td>
                        <img src="<?php echo $sliderresult ['image']; ?>" height="80px" width="100px"><br/>
                        <input type="file"  name="image" />
                    </td>
                </tr>
                
				<tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Update" />
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
