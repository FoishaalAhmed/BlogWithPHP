<?php include'inc/header.php'; ?>
<?php include'inc/sideber.php'; ?>
<?php 
    if (!Session::get("userRole") == '0') {
        echo "<script>window.location = 'index.php'; </script>";
    }
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Add New User</h2>
       <div class="block copyblock"> 
    <?php 

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $format->validation($_POST['name']);
        $password = $format->validation(md5($_POST['password']));
        $role = $format->validation($_POST['role']);

        $name = mysqli_real_escape_string($db->link, $name);
        $password = mysqli_real_escape_string($db->link, $password);
        $role = mysqli_real_escape_string($db->link, $role);

        if (empty($name) || empty($password) || empty($role)) {
            echo "<span class='error'>Field must not be empty!!</span>";
        }else{
            $query = "insert into tbl_user (name, password, role) values ('$name', '$password', '$role')";
            $insertUser = $db->insert($query);
            if ($insertUser) {
                echo "<span class='success'>User Created Successfully!!</span>";
            } else {
                echo "<span class='error'>User Not Created!!</span>";
            }
            
        }
    }

    ?>
         <form action="" method="post">
            <table class="form">					
                <tr>
                    <td>
                        <label for="">Name</label>
                    </td>
                    <td>
                        <input type="text" name = "name" placeholder="Enter User Name..." class="medium" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="">Password</label>
                    </td>
                    <td>
                        <input type="password" name = "password" placeholder="Enter Password..." class="medium" />
                    </td>
                </tr>

                <tr>
                    <td>
                        <label for="">Role</label>
                    </td>
                    <td>
                        <select name="role" id="select">
                            <option>Select User Role</option>
                            <option value="0">Admin</option>
                            <option value="1">Author</option>
                            <option value="2">Editor</option>
                        </select>
                    </td>
                </tr>
				<tr>
                    <td>
                        
                    </td> 
                    <td>
                        <input type="submit" name="submit" Value="Create" />
                    </td>
                </tr>
            </table>
            </form>
        </div>
    </div>
</div>

<?php include'inc/footer.php'; ?>