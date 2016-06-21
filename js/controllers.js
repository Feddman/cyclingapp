/**
 * Created by Fedde on 30-5-2016.
 */
app.controller('cycleCtrl', function(cycleData, $scope, $http){

    cycleData.getToken().then(function(token){
        $scope.token = token.data;


        console.log($scope.token); 
    })



});

