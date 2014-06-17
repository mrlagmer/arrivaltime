angular.module('myApp.controllers', ['chieffancypants.loadingBar'])
  	.controller('MyCtrl1', ['$scope','apiservice',function($scope,apiservice) {
  		$scope.lineID = 0;
  		$scope.startID = 0;
  		$scope.endID = 0;
  		$scope.Lines = [
              {
                  id:1,
                  lineName:'Alamein'
              },
              {
                  id:2,
                  lineName:'Belgrave'
              },
              {
                  id:3,
                  lineName:'Craigieburn'
              },
              {
                  id:4,
                  lineName:'Cranbourne'
              },
              {
                  id:5,
                  lineName:'Flemington'
              },
  			{
  				id:6,
  				lineName:'Frankston'
  			},
              {
                  id:7,
                  lineName:'Glen Waverley'
              },
              {
                  id:8,
                  lineName:'Hurstbridge'
              },
              {
                  id:9,
                  lineName:'Lilydale'
              },
              {
                  id:11,
                  lineName:'Pakenham'
              },
              {
                  id:12,
                  lineName:'Sandringham'
              },
              {
                  id:5,
                  lineName:'South Morang'
              },
              {
                  id:14,
                  lineName:'Sunbury'
              },
              {
                  id:15,
                  lineName:'Upfield'
              },
              {
                  id:16,
                  lineName:'Werribee'
              },
              {
                  id:17,
                  lineName:'Williamstown'
              }
  		];
  		$scope.getStopData = function() {
  			  apiservice.getStops($scope.lineID).success(function (response) {
        		$scope.stops = response;
    		});
  		};
          $scope.getTrainTimes = function() {
                  $scope.times = {};
                  apiservice.getTimes($scope.startID,$scope.endID).success(function (response) {
                  $scope.times = response;
              });
          };
  }]);
