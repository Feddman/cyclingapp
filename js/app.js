/**
 * Created by Fedde on 30-5-2016.
 */
var app = angular.module('CyclingApp', []);

app.factory('cycleData', function($http, $httpParamSerializerJQLike){
   return {
       async: function() {
           return $http.get('test.php');
       },

       addUser: function(username, password) {
            return $http({
                method      : 'post',
                url         : 'test.php',
                headers     : {'Content-Type': 'application/x-www-form-urlencoded'},
                data        : {
                    "username" : username,
                    "password" : password
                }
            });
       }
   }
});