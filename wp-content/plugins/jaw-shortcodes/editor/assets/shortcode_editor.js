var shotcodeEditor = angular.module('shotcode_editor', ['jaw.gallerypicker']);


shotcodeEditor.controller('shotcodeEditorCrtl', ['$scope', function($scope) {

    $scope.edit = $scope.edit || new Object();

    $scope.init_edit = function(id, std) {
        if ($scope.edit[id] == undefined) {
            $scope.edit[id] = std;
        }

    }

    $scope.json_decode = function(json_str) {

        var decode = json_str.replace(/\'/ig, '\"');
        var ret = '';
        if (decode != '') {
            ret = JSON.parse(decode);
        }
        return(ret);

    }

}]);
