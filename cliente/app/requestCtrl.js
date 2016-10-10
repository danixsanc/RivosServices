app.controller('requestCtrl', function ($scope, $rootScope, $routeParams, $location, $http, Data, $window) 
{  

	$scope.listRequests = [];

    $scope.getRequests = function () {
        Data.get('get_Requests').then(function (results) {
            if (results.Message == "OK") {
                $scope.listRequests = results.Data;
            } 
        }); 
    };

});