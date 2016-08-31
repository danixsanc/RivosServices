var app = angular.module('myApp', ['ngRoute', 'ngAnimate', 'toaster', 'uiGmapgoogle-maps']);

app.config([
    '$routeProvider', 
    function ($routeProvider) {
        $routeProvider
            .when('/login', {
                title: 'Login',
                templateUrl: 'partials/login.html',
                controller: 'loginCtrl'
            })
            .when('/', {
                title: 'Login',
                templateUrl: 'partials/login.html',
                controller: 'loginCtrl',
                role: '0'
            })
            .when('/logout', {
                title: 'Logout',
                templateUrl: 'partials/login.html',
                controller: 'loginCtrl'
            })
            //Partials
            .when('/dashboard', {
                title: 'Dashboard',
                templateUrl: 'partials/dashboard.html',
                controller: 'dashboardCtrl'
            })

            .when('/cabbie', {
                title: 'Cabbie',
                templateUrl: 'partials/cabbie.html',
                controller: 'cabbieCtrl'
            })
            .when('/realTime', {
                title: 'Real Time',
                templateUrl: 'partials/realTime.html',
                controller: 'realTimeCtrl'
            })




            .otherwise({
                redirectTo: '/login'
            });
  }])



.config(function(uiGmapGoogleMapApiProvider) {
    uiGmapGoogleMapApiProvider.configure({
        key: 'AIzaSyCSGDg5Si6gvM8VKApwIiM8K9AUjzD9P_E',
        v: '3.20', //defaults to latest 3.X anyhow
        libraries: 'weather,geometry,visualization'
    });
})



    .run(function ($rootScope, $location, Data) {
        $rootScope.$on("$routeChangeStart", function (event, next, current) {
            $rootScope.authenticated = false;
            Data.get('session').then(function (results) {
                if (results.uid) {
                    $rootScope.authenticated = true;
                    $rootScope.uid = results.uid;
                    $rootScope.name = results.name;
                    $rootScope.email = results.email;
                } else {
                    var nextUrl = next.$$route.originalPath;
                    if (nextUrl == '/signup' || nextUrl == '/login') {

                    } else {
                        $location.path("/login");
                    }
                }
            });
        });
    });


    