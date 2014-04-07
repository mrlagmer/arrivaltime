angular.module('myApp.controllers', [])
  	.controller('MyCtrl1', ['$scope','apiservice',function($scope,apiservice) {
  		$scope.lineID = 6;
  		$scope.Lines = [
  			{
  				id:6,
  				lineName:'Frankston'
  			}
  		];

  		apiservice.getStops($scope.lineID).success(function (response) {
        	$scope.stops = response; 
    	});
  		
  		$scope.selectedLine = 0;
		$scope.selectedGenre = null;
		$scope.people = [
			{
				id: 0,
				name: 'Frankston',
				music: [
					'Rock',
					'Metal',
					'Dubstep',
					'Electro'
				]
			},
			{
				id: 1,
				name: 'Chris',
				music: [
					'Indie',
					'Drumstep',
					'Dubstep',
					'Electro'
				]
			},
			{
				id: 2,
				name: 'Harry',
				music: [
					'Rock',
					'Metal',
					'Thrash Metal',
					'Heavy Metal'
				]
			},
			{
				id: 3,
				name: 'Allyce',
				music: [
					'Pop',
					'RnB',
					'Hip Hop'
				]
			}
		];
  }])
  .controller('MyCtrl2', [function() {

  }]);