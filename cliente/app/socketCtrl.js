app.controller('socketCtrl', function ($scope, $rootScope, $routeParams, $location, $http, Data, $window, $interval, $timeout) 
{


    $scope.data = {
        longitude:0,
        latitude:0
    };
    
    $scope.getData = function(){
        Data.get('actualizar_taxistas').then(function (results) {
            console.log('Fetched data!');
        });
    };

    $scope.actCabbieData = function(data){
        Data.post('actualizar_taxistas_location', {data:data}).then(function (results) {
            console.log('Location Fetched!');
        });
    };

    // Function to replicate setInterval using $timeout service.
    $scope.intervalFunction = function(){
        $timeout(function() {
            $scope.getData();
            $scope.intervalFunction();
        }, 5000)
    };

     $scope.intervalFunction();

});