<?php wp_head(); ?>
<!DOCTYPE html>
<!--[if lt IE 7]>
	<html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>
	<html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>
	<html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<!--[if lt IE 9]>
	<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<html class="no-js">
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>
		<meta name="author" content="EvanHerman">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="shortcut icon" href="/favicon.ico">
		<link rel="apple-touch-icon" href="/favicon.png">
	</head>
	
<body <?php body_class(); ?> ng-app="tutorialWebApp">
<!-- Our Website Content Goes Here -->
<div ng-include='"<?php echo get_template_directory_uri(); ?>/templates/header.php"' <?php if( current_user_can( 'manage_options' ) ) { echo 'class="logged-in-navbar"'; } ?>></div>
<div ng-view></div>
<div ng-include='"<?php echo get_template_directory_uri(); ?>/templates/footer.html"'></div>

</body>
</html>

<?php wp_footer(); ?> 