<!doctype html>
<html ng-app="transportApp">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
</head>
<body ng-controller="transportController">
<div class="page-header">
    <h1> Bus </h1>
</div>
<div class="panel">
    <table class="table table-striped">
        <thead>
          <tr>
              <th>id</th>
              <th>name</th>
          </tr>
        </thead>
        <tbody>
          <tr ng-repeat="item in bus_list">
              <td>{{item.bus_id}}</td>
              <td>{{item.number}}</td>
          </tr>
        </tbody>
    </table>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
<script>
    var transporApp = angular.module("transportApp", []);
    transporApp.controller("transportController", function ($scope, $http) {

        $http.get('/transport/bus/search_all.php')
            .then(function (res) {
                $scope.bus_list = res.data;
                return res.data;
            })
    });
</script>
</body>
</html>
