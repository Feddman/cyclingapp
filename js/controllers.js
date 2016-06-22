/**
 * Created by Fedde on 30-5-2016.
 */
app.controller('cycleCtrl', function(cycleData, $scope, $http){
    $scope.loaded = false;
    $scope.int = 1;
        setInterval(function(){
            cycleData.getGroups().then(function(groups){

                angular.forEach(groups.data, function(key, value){

                    cycleData.getMembersOfGroup(key.id).then(function(members){
                        // now access to members of group...
                        key.members = members.data;

                        angular.forEach(members.data, function(key, value){


                            cycleData.getLastPosition(key.id).then(function(position){
                                key.position = position.data;
                            });

                            cycleData.getStatsById(key.id).then(function(memberStats){
                                key.stats = memberStats.data;
                                cycleData.getLastPosition(key.id).then(function(position){
                                    key.position = position.data;
                                    $scope.groups = groups.data;

                                    $scope.loaded = true;
                                    $scope.int++;


                                });





                            });



                        });



                    });
                })
            });

        }, 15000)






});

