/**
 * Created by Fedde on 30-5-2016.
 */
app.controller('cycleCtrl', function(cycleData, $scope){

    cycleData.async().then(function(response){
        $scope.response = response;
    })

    $scope.addUser = function(username, password) {
        cycleData.addUser(username, password).then(function(response){
            $scope.response = response;
        })
    }


});

