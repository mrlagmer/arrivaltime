'use strict';

/* Services */


// Demonstrate how to register services
// In this case it is a simple value service.
angular.module('myApp.services', []).
  factory('apiservice',['$http', function($http) {

    var API = {};

    API.getStops = function(lineID) {
      return $http({
        method: 'JSONP', 
        url: 'api/Lines/?apiCall=getStops&data='+lineID
      });
    }

    return API;
  }]);
