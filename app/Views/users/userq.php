<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
	<title></title>
</head>
<body>

<div ng-app="myApp"  ng-controller="myCtrl" >
  <p>My first expression: {{mine.list}}</p>

    <li *ngFor="let pp of group.mine">
    	{{pp.name}}
  </li>
</div>


<script>
var app = angular.module('myApp', []);
app.controller('myCtrl', function($scope, $http) {
  $http.get("http://localhost/codeigniter4/public/index.php/users/list/teste2")
  .then(function(response) {
    $scope.mine = response.data;
  });
});
</script>

</body>
</html>