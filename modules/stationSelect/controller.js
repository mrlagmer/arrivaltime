angular.module('myApp.controllers', [])
  	.controller('MyCtrl1', ['$scope','apiservice',function($scope,apiservice) {
  		$scope.lineID = 0;
  		$scope.startID = 0;
  		$scope.endID = 0;
  		$scope.Lines = [
  			{
  				id:6,
  				lineName:'Frankston'
  			}
  		];
  		$scope.getStopData = function() {
  			  apiservice.getStops($scope.lineID).success(function (response) {
        		$scope.stops = response;
    		});
  		};
          $scope.getTrainTimes = function() {
                  apiservice.getTimes($scope.startID,$scope.endID).success(function (response) {
                  $scope.times = response;
              });
          };
  }]);
