<?php 
	include 'config/config.php';
	include 'lib/Database.php';
	include 'helpers/Format.php';
?>
<?php 
	$db = new Database();
	$format = new Format();
 ?>
<!DOCTYPE html>
<html>
<head>
	<?php 
// database page title start
    if (isset($_GET['pageid'])) {
        $pagetitleid = $_GET['pageid']; 
        $query = "select * from tbl_page where id = '$pagetitleid'";
        $pagetitle = $db->select($query);
        if ($pagetitle) {
            while ($result = $pagetitle->fetch_assoc()) { ?>
            	<title><?php echo $result['name']; ?>-<?php echo TITLE; ?></title>

           <?php } } }/* database page title end */ /* Catagory post title start */elseif (isset($_GET['catagory'])) {
        $cattitleid = $_GET['catagory']; 
        $query = "select * from tbl_catagory where id = '$cattitleid'";
        $cattitle = $db->select($query);
        if ($cattitle) {
            while ($result = $cattitle->fetch_assoc()) { ?>
            	<title><?php echo $result['name']; ?>-<?php echo TITLE; ?></title>

           <?php } } }/* Catagory post title end */ /* post title start */ elseif (isset($_GET['id'])) {
        $posttitleid = $_GET['id']; 
        $query = "select * from tbl_post where id = '$posttitleid'";
        $posttitle = $db->select($query);
        if ($posttitle) {
            while ($result = $posttitle->fetch_assoc()) { ?>
            	<title><?php echo $result['title']; ?>-<?php echo TITLE; ?></title>

           <?php } } }/* post title end */ /* normal page title start */else{ ?>
           	<title><?php echo $format->title(); ?>-<?php echo TITLE; ?></title>
           	<?php  } /* normal page title end */?>
	<meta name="language" content="English">
	<meta name="description" content="It is a website about education">
	<?php 
		// for individual meta tag for post start
		if (isset($_GET['id'])) {
			$tagsid = $_GET['id'];
			$query = "select * from tbl_post where id = '$tagsid'";
        	$tags = $db->select($query);
			if ($tags) {
				while ($result = $tags->fetch_assoc()) { ?>
				<meta name="keywords" content="<?php echo $result['tag']; ?>">
	<?php } } } else{ ?>
		<meta name="keywords" content="<?php echo TAGS; ?>">

	<?php }// for individual meta tag for post end ?>

	

	<meta name="author" content="Delowar">
	<link rel="stylesheet" href="font-awesome-4.5.0/css/font-awesome.css">	
	<link rel="stylesheet" href="css/nivo-slider.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="style.css">
	<script src="js/jquery.js" type="text/javascript"></script>
	<script src="js/jquery.nivo.slider.js" type="text/javascript"></script>

<script type="text/javascript">
$(window).load(function() {
	$('#slider').nivoSlider({
		effect:'random',
		slices:10,
		animSpeed:500,
		pauseTime:5000,
		startSlide:0, //Set starting Slide (0 index)
		directionNav:false,
		directionNavHide:false, //Only show on hover
		controlNav:false, //1,2,3...
		controlNavThumbs:false, //Use thumbnails for Control Nav
		pauseOnHover:true, //Stop animation while hovering
		manualAdvance:false, //Force manual transitions
		captionOpacity:0.8, //Universal caption opacity
		beforeChange: function(){},
		afterChange: function(){},
		slideshowEnd: function(){} //Triggers after all slides have been shown
	});
});
</script>
</head>

<body>
	<div class="headersection templete clear">
		<a href="index.php">
			<?php 
            $query = "select * from tbl_title_slogan where id = '1' ";
            $titleslogan = $db->select($query);
            if ($titleslogan) {
                while ($result = $titleslogan->fetch_assoc()) {
        ?>
			<div class="logo">
				<img src="admin/<?php echo $result['logo']; ?>" alt="Logo"/>
				<h2><?php echo $result['title']; ?></h2>
				<p><?php echo $result['slogan']; ?></p>
			</div>
		<?php } } ?>
		</a>
		<div class="social clear">
			<div class="icon clear">
				<?php 
		            $query = "select * from tbl_social where id = '1' ";
		            $social = $db->select($query);
		            if ($social) {
		                while ($result = $social->fetch_assoc()) {
		        ?>
				<a href="<?php echo $result['fb']; ?>" target="_blank"><i class="fa fa-facebook"></i></a>
				<a href="<?php echo $result['twtr']; ?>" target="_blank"><i class="fa fa-twitter"></i></a>
				<a href="<?php echo $result['lnkin']; ?>" target="_blank"><i class="fa fa-linkedin"></i></a>
				<a href="<?php echo $result['gplus']; ?>" target="_blank"><i class="fa fa-google-plus"></i></a>
				<?php } } ?>
			</div>
			<div class="searchbtn clear">
			<form action="search.php" method="post">
				<input type="text" name="search" placeholder="Search keyword..."/>
				<input type="submit" name="submit" value="Search"/>
			</form>
			</div>
		</div>
	</div>
<div class="navsection templete">
	<?php 
		$path = $_SERVER['SCRIPT_FILENAME']; // for file path
		$currentpage = basename($path, '.php');
	?>
	<ul>
		<li><a <?php if ($currentpage == 'index') {echo "id=active";}  ?> href="index.php">Home</a></li>
		<?php 

            $query = "select * from tbl_page";
            $page = $db->select($query);
            if ($page) {
                while ($result = $page->fetch_assoc()) {
            ?>
                <li><a <?php if (isset($_GET['pageid']) && $_GET['pageid'] == $result ['id']) {echo "id=active";}?>
                	href="page.php?pageid=<?php echo $result ['id'];  ?>"><?php echo $result ['name'];  ?></a> </li>
            <?php } } ?>	
		<li><a <?php if ($currentpage == 'contact') {echo "id=active";}  ?> href="contact.php">Contact</a></li>
	</ul>
</div>