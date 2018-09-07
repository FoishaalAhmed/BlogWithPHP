<?php include'inc/header.php'; ?>
<?php include'inc/sideber.php'; ?>
<?php 
    if (!Session::get("userRole") == '0') {
        echo "<script>window.location = 'index.php'; </script>";
    }
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Inbox</h2>
        <?php 
        	if (isset($_GET['seenid'])) {
        		$seenid = $_GET['seenid'];
        		$query = "update tbl_contact set status = '1' where id = '$seenid'";
            	$update_contact = $db->update($query);
            if ($update_contact) {
                echo "<span class='success'>Email Send to Seen Box!!</span>";
            } else {
                echo "<span class='error'>Something went Wrong!!</span>";
            }
        	}
        ?>
        <div class="block">        
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th width="10%">Serial No.</th>
					<th width="10%">Name</th>
					<th width="15%">Email</th>
					<th width="30%">Message</th>
					<th width="20%">Date</th>
					<th width="15%">Action</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$query = "select * from tbl_contact where status = '0' order by id desc";
					$contact = $db->select($query);

					if ($contact) {
						$i = 0;
						while ($result = $contact->fetch_assoc()) {
						$i++;			
				?>
				<tr class="odd gradeX">
					<td><?php echo $i; ?></td>
					<td><?php echo $result['name']; ?></td>
					<td><?php echo $result['email']; ?></td>
					<td><?php echo $format->textShort($result['body'], 40); ?></td>
					<td><?php echo $format->formatDate($result['date']); ?></td>
					<td>
						<a href="viewmsg.php?msgid=<?php echo $result['id']; ?>">View</a> || 
						<a href="replymsg.php?msgid=<?php echo $result['id']; ?>">Reply</a> || 
						<a onclick = "return confirm('Are You Sure to Send It to Seen??');" href="?seenid=<?php echo $result['id']; ?>">Seen</a>
					</td>
				</tr>
				<?php } } ?>
			</tbody>
		</table>
       </div>
    </div>
</div>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Seen Message</h2>
        <?php 
        	if (isset($_GET['delid'])) {
        		$deletemsg = $_GET['delid'];
        		$query = "delete from tbl_contact where id = '$deletemsg'";
            	$delete_contact = $db->delete($query);
            if ($delete_contact) {
                echo "<span class='success'>Email Deleted Successfully!!</span>";
            } else {
                echo "<span class='error'>Email not Deleted!!</span>";
            }
        	}
        ?>

        <?php 
        	if (isset($_GET['unseenid'])) {
        		$unseenid = $_GET['unseenid'];
        		$query = "update tbl_contact set status = '0' where id = '$unseenid'";
            	$update_contact = $db->update($query);
            if ($update_contact) {
                echo "<span class='success'>Email Send to Inbox!!</span>";
            } else {
                echo "<span class='error'>Something went wrong!!</span>";
            }
        	}
        ?>
        <div class="block">        
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th width="10%">Serial No.</th>
					<th width="10%">Name</th>
					<th width="15%">Email</th>
					<th width="30%">Message</th>
					<th width="15%">Date</th>
					<th width="20%">Action</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$query = "select * from tbl_contact where status = '1' order by id desc";
					$contact = $db->select($query);

					if ($contact) {
						$i = 0;
						while ($result = $contact->fetch_assoc()) {
						$i++;			
				?>
				<tr class="odd gradeX">
					<td><?php echo $i; ?></td>
					<td><?php echo $result['name']; ?></td>
					<td><?php echo $result['email']; ?></td>
					<td><?php echo $format->textShort($result['body'], 40); ?></td>
					<td><?php echo $format->formatDate($result['date']); ?></td>
					<td>

						<a href="viewmsg.php?msgid=<?php echo $result['id']; ?>">View</a> ||
						<a onclick = "return confirm('Are You Sure to Send It to Inbox??');" href="?unseenid=<?php echo $result['id']; ?>">Unseen</a> ||
						<a onclick = "return confirm('Are You Sure to Delete??');" href="?delid=<?php echo $result['id']; ?>">Delete</a>
					</td>
				</tr>
				<?php } } ?>
			</tbody>
		</table>
       </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
    setupLeftMenu();

    $('.datatable').dataTable();
    setSidebarHeight();
});
</script>
<?php include'inc/footer.php'; ?>
