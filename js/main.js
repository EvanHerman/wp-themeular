/**
 * AngularJS Tutorial 1
 * @author Nick Kaye <nick.c.kaye@gmail.com>
 */

/**
 * Main AngularJS Web Application
 */
var app = angular.module('tutorialWebApp', [
  'ngRoute'
]);

/**
 * Configure the Routes
 */
app.config(['$routeProvider', function ($routeProvider) {
  $routeProvider
    // Home
    .when("/", {templateUrl: themeularData.root+"partials/home.html", controller: "PageCtrl"})
    // Pages
    .when("/about", {templateUrl: themeularData.root+"partials/about.html", controller: "PageCtrl"})
    .when("/faq", {templateUrl: themeularData.root+"partials/faq.html", controller: "PageCtrl"})
    .when("/pricing", {templateUrl: themeularData.root+"partials/pricing.html", controller: "PageCtrl"})
    .when("/services", {templateUrl: themeularData.root+"partials/services.html", controller: "PageCtrl"})
    .when("/contact", {templateUrl: themeularData.root+"partials/contact.html", controller: "PageCtrl"})
    // Blog
    .when("/blog", {templateUrl: themeularData.root+"partials/blog.html", controller: "BlogCtrl"})
    .when("/blog/post", {templateUrl: themeularData.root+"partials/blog_item.html", controller: "BlogCtrl"})
    // else 404
    .otherwise("/404", {templateUrl: themeularData.root+"partials/404.html", controller: "PageCtrl"});
}]);

/**
 * Controls the Blog
 */
app.controller('BlogCtrl', function (/* $scope, $location, $http */) {
  console.log("Blog Controller reporting for duty.");
});

/**
 * Controls all other Pages
 */
app.controller('PageCtrl', function (/* $scope, $location, $http */) {
  console.log("Page Controller reporting for duty.");

  // Activates the Carousel
  jQuery('.carousel').carousel({
    interval: 5000
  });

  // Activates Tooltips for Social Links
  jQuery('.tooltip-social').tooltip({
    selector: "a[data-toggle=tooltip]"
  })
});