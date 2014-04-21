'use strict';


// Declare app level module which depends on filters, and services
angular.module('myApp', [
  'ngRoute',
  'ngResource',
  'myApp.filters',
  'myApp.services',
  'myApp.directives',
  'myApp.controllers'
]).
config(['$routeProvider', function($routeProvider) {
  $routeProvider.when('/Line', {templateUrl: 'modules/stationSelect/views/line.html', controller: 'MyCtrl1'});
  $routeProvider.when('/Times', {templateUrl: 'modules/times/views/time.html', controller: 'MyCtrl2'});
  $routeProvider.otherwise({redirectTo: '/Line'});
}]);
