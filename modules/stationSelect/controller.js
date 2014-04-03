angular.module('myApp.controllers', [])
  .controller('MyCtrl1', ['$scope',function($scope) {
  		$scope.selectedLine = 0;
		$scope.selectedGenre = null;
		$scope.people = [
			{
				id: 0,
				name: 'Leon',
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