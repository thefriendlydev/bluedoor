angular.module('hth', []);
angular.module('hth').controller('EntryCtrl',
  ['$scope', '$http', function($scope, $http) {

    $scope.submit = function() {
      var request = $http.post('/api/entries/submit');
      request.success(function(data, status, headers, config) {
        console.log(this, $scope);
      });
      request.error(function(data, status, headers, config) {
        console.log(this, $scope);
      });
    };

  }]
);
angular.module('hth').controller('EntryWidgetCtrl', ['$scope', '$http', 'GlobalVariables', function($scope, $http, GlobalVariables) {

  var eventId = GlobalVariables.get('current_event_id');
  if(eventId) {
    $scope.submitUrl = "/events/" + eventId + "/submit";
  }

  var request = $http.get('/api/get_posts/?post_type=entry');
  request.success(function(data, status, headers, config) {
    $scope.entries = data.posts;

  });
  request.error(function(data, status, headers, config) {

  });

}]);
angular.module('hth').controller('EventNavCtrl', ['$scope', '$http', function($scope, $http) {

  var request = $http.get('/api/get_posts/?post_type=event');
  request.success(function(data, status, headers, config) {
    $scope.events = data.posts;
  });
  request.error(function(data, status, headers, config) {

  });

}]);
angular.module('hth').controller('TourScheduleCtrl', ['$scope', '$http', function($scope, $http) {

  var request = $http.get('/api/get_posts/?post_type=event');
  request.success(function(data, status, headers, config) {
    $scope.events = data.posts;
  });
  request.error(function(data, status, headers, config) {

  });

}]);
angular.module('hth').service('GlobalVariables', ['$window', function($window) {

  return {
    get: function(name) {
      return $window.hth[name];
    }
  };

}]);