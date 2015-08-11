<?php wp_head(); ?>
<!DOCTYPE html>
<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js"> <!--<![endif]-->
<head>

    <!-- Meta-Information -->
    <title>ACME Inc.</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="description" content="ACME Inc.">
    <meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<body ng-app="tutorialWebApp">
<!--[if lt IE 7]>
<p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade
    your browser</a> to improve your experience.</p>
<![endif]-->

<!-- Our Website Content Goes Here -->
<div ng-include='"<?php echo get_template_directory_uri(); ?>/templates/header.php"' <?php if( current_user_can( 'manage_options' ) ) { echo 'class="logged-in-navbar"'; } ?>></div>
<div ng-view></div>
<div ng-include='"<?php echo get_template_directory_uri(); ?>/templates/footer.html"'></div>

<?php wp_footer(); ?> 

</body>
</html>