/**
 * Created by Fedde on 30-5-2016.
 */
var app = angular.module('CyclingApp', ['ngMap']);

app.factory('cycleData', function($http, $httpParamSerializerJQLike){

    var base = 'http://52.28.145.71:8080';

   return {
       getToken : function() {
           return $http.get('test.php?token=1')
       },

       getGroups : function() {
           return $http.get('test.php?groups=all');
       },

       getUsers : function() {
           return $http.get('test.php?users=all');
       },

       getMembersOfGroup : function(id){
           return $http.get('test.php?membersofgroup=' + id);
       },

       getStatsById : function(id) {
           return $http.get('test.php?stats=' + id);
       },

       getLastPosition: function(id) {
           return $http.get('test.php?getpositionfrom=' +id);
       }

   }
});