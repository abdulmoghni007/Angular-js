var myApp = angular.module("myList", []);
myApp.controller("myListcontroller", function($scope) {
    $scope.items = ["Angularjs", "Reactjs", "underScorejs"];
    $scope.newItem = "";
    $scope.pushItem = function() {
        if ($scope.newItem != "") {
            $scope.items.push($scope.newItem);
            $scope.newItem = "";
        }
    }
    $scope.deleteItem = function(index) {
        $scope.items.splice(index, 1);
    }


});