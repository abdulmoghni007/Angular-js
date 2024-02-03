var myApp = angular.module('myApp', []);
myApp.controller('Formcontroller', ['$scope', function($scope) {
    $scope.register = function() {
        $scope.mag = 'Welcome' + $scope.user.firstname + 'you are signed in';
    }
}]);