app.controller('cabbieCtrl', function ($scope, $rootScope, $routeParams, $location, $http, Data, $window) 
{

	$scope.listaCabbies = {};
    $scope.ClienteById = {};
    $scope.checked = true;

	$scope.getCabbies = function () {
        Data.get('get_cabbies').then(function (results) {
            if (results.Message == "OK") {
                $scope.listaCabbies = results.Data;
            } });
    };

    $scope.guardarCliente = function (data){
    	Data.post('save_cliente', {data:data}).then(function (results){
    		$location.path('clientes');
    	});
    };

    $scope.guardarClienteMod = function (data){
        var id = $routeParams.idCliente;
        Data.post('update_cliente/'+id, {data:data}).then(function (results){
            $location.path('clientes');
        });
    };

    
    $scope.detalleCliente = function () {
        var id = $routeParams.idCliente;
        Data.get('get_cliente_by_id/'+id).then(function (results) 
        {
            if (results.Message) {
                $scope.cliente = results.Data[0];
            } 
        });
    };

    $scope.editarCliente = function () {
        $scope.checked = false;
    }



    
    $scope.eliminarCliente = function(data) {
        var deleteUser = $window.confirm('¿SEGURO QUE DESEA ELIMINAR AL CLIENTE "' + data.Name + '" ?');

        if (deleteUser) {
            Data.get('delete_cliente/'+data.idCliente).then(function (results) 
            {
                if (results.Message) {
                    $location.path('clientes');
                } 
            });
        }
  }


   


});