'use strict';

/* Services */


// Demonstrate how to register services
// In this case it is a simple value service.
angular.module('myApp.services', []).
  factory('apiservice',['$http', function($http) {

    var API = {};

    API.getStops = function(lineID) {
      return $http({
        method: 'GET',
        url: 'api/getStops/?apiCall=getStops&data='+lineID
      });
    }

    API.getTimes = function(lineID,startID,endID) {
      return $http({
        method: 'GET',
        url: 'api/getTimes/?apiCall=getTimes&lineID='+lineID+'&startID='+startID+'&stopID='+endID
      });
    }

    return API;
  }]);
