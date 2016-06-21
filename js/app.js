/**
 * Created by Fedde on 30-5-2016.
 */
var app = angular.module('CyclingApp', []);

app.factory('cycleData', function($http, $httpParamSerializerJQLike){

    var base = 'http://52.28.145.71:8080';

   return {
       getToken : function() {
           return $http.get('test.php?token=1')
       },

       getGroups : function() {
           return $http.get('')
       }
   }
});