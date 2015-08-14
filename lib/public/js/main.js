/**
 * Main AngularJS Web Application
 */
var app = angular.module('tutorialWebApp', ['ngRoute','ngSanitize']);

/**
 * Configure the Routes
 */
app.config(['$routeProvider', function ($routeProvider) {
  $routeProvider
    /* Home */
    .when("/", {templateUrl: themeularData.root+"partials/home.html", controller: "HomeCtrl"})
	.when("/page/:pageID", {templateUrl: themeularData.root+"partials/page-template.html", controller: "PageCtrl"})
    /* Pages */
    .when("/about", {templateUrl: themeularData.root+"partials/about.html", controller: "PageCtrl"})
    .when("/faq", {templateUrl: themeularData.root+"partials/faq.html", controller: "PageCtrl"})
    .when("/pricing", {templateUrl: themeularData.root+"partials/pricing.html", controller: "PageCtrl"})
    .when("/services", {templateUrl: themeularData.root+"partials/services.html", controller: "PageCtrl"})
    .when("/contact", {templateUrl: themeularData.root+"partials/contact.html", controller: "PageCtrl"})
    /* Blog */
    .when("/blog", {templateUrl: themeularData.root+"partials/blog.html", controller: "BlogCtrl"})
    .when("/blog/post", {templateUrl: themeularData.root+"partials/blog_item.html", controller: "BlogCtrl"})
    /* else 404 */
    .otherwise("/404", {templateUrl: themeularData.root+"partials/404.html", controller: "PageCtrl"});
}]);

/**
 * Controls the Blog
 */
app.controller('BlogCtrl', function (/*$scope, $location, $http*/) {
  console.log("Blog Controller reporting for duty.");
});


/**
 * Controls the Page
 */
app.controller( 'PageCtrl', [ '$scope', '$route', '$routeParams', '$http', '$location', function ($scope, $route, $routeParams, $http, $location) {

  console.log("Page Controller reporting for duty.");
 	/*
	*	Custom alert function
	*	@since 1.0
	*/
	$scope.deletePage = function( ID, title, message, type ) {
		swal({   
			title: title,   // Title
			text: message,   // Message
			type: type,   // warning/error/success
			showCancelButton: true,   
			confirmButtonColor: "#DD6B55",   
			confirmButtonText: "Yes, delete it!",   
			cancelButtonText: "Cancel",   
			closeOnConfirm: false,   
			closeOnCancel: false 
		}, 
		function(isConfirm){  			
			if (isConfirm) {  
				// Ajax request to delete the post/page
				$http.post( themeularData.ajax_url+'?_wp_json_nonce='+themeularData.nonce, $scope, {
					params:{
						action: 'delete_post_type',
						post_id: $scope.page_data.id,
						nonce: themeularData.nonce
					}
				}).then(function(response) {
					console.log( response );
					if( response.data == '1' ) {
						swal({   
							type: "success",
							title: "Page Deleted",   
							text: "",   
							timer: 1500,   
							showConfirmButton: false 
						});
						// redirect						
						setTimeout( function() {
							$location.path("/");
							$scope.$apply();
						}, 1500);
					} else {
						swal({   
							type: "error",
							title: "Security Error",   
							text: response.data
						});
					}
				});
			} else {     
				swal(
					"Cancelled", 
					"Delete cancelled.", 
					"error"
				);   
			} 
		});
		return false;
	}
	
	// Check if the user is logged in and authenticated to edit/delete a post
	$http.post( themeularData.ajax_url, $scope, {
		params:{
			action: 'user_authenticated'
		}
	}).then(function(response){
		$scope.user_authenticated = response;
	});
			
	// Get the page data
	$http.get( themeularData.site_url + 'wp/v2/pages/'+$routeParams.pageID+'?_wp_json_nonce='+themeularData.nonce )
		.success(function(response) { 
			$scope.page_data = response; 
			console.log( $scope );
		}); 
		
	// Check if the user is logged in and authenticated to edit/delete a post
	$http.post( themeularData.ajax_url, $scope, {
		params:{
			action: 'user_authenticated'
		}
	}).then(function(response){
		$scope.user_authenticated = response;
	});
	
}]);

/*	
*	Main nav controller
*/
app.controller('navCtrl', [ '$scope', '$http', function ($scope, /*$location,*/ $http) {
  console.log("Main Nav Controller reporting for duty.");
  console.log( $scope );
   // console.log( themeularData.site_url + 'wp-themeular/v1/menus' );
    $http.get( themeularData.site_url + 'wp-themeular/v1/menu-location/main_nav' )
		.success(function(response) { 
			$scope.menu_items = response; 
			console.log( response ); 
		}); 
}]);

/**
 * Controls all other Pages
 */
app.controller('HomeCtrl', [ '$scope', function ( $scope ) {

  console.log("Home Controller reporting for duty.");
  // console.log( $scope );
  
  /* Activates the Carousel */
  jQuery('.carousel').carousel({
    interval: 5000
  });

  /* Activates Tooltips for Social Links */
  jQuery('.tooltip-social').tooltip({
    selector: "a[data-toggle=tooltip]"
  })
  
}]);


/**
*	Custom filters
**/
app.filter('reverseOrder', function() {
  return function(items) {
	// confirm there are items to reverse
    if( typeof( items ) !== 'undefined' ) {
		return items.slice().reverse();
	}
  };
});


jQuery(document).ready(function () {
        jQuery('body').midgardCreate({
          url: function () {
            return 'javascript:false;';
          },
          collectionWidgets: {
            'default': 'midgardCollectionAdd',
            'skos:related': null
          },
          stanbolUrl: 'http://dev.iks-project.eu:8081'/*,
          language: 'pt_BR'*/
        });

        // Set a simpler editor for title fields
        jQuery('body').midgardCreate('configureEditor', 'title', 'halloWidget', {
          plugins: {
            halloformat: {},
            halloblacklist: {
              tags: ['br']
            }
          }
        });
        jQuery('body').midgardCreate('setEditorForProperty', 'dcterms:title', 'title');

        // Disable editing of author fields
        jQuery('body').midgardCreate('setEditorForProperty', 'dcterms:author', null);

});
// Fake Backbone.sync since there is no server to communicate with
Backbone.sync = function(method, model, options) {
    if (console && console.log) {
       console.log('Model contents', model.toJSONLD());
    }
    options.success(model);
};