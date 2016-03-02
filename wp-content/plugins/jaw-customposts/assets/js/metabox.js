
(function ($, angular, undefined) {

    angular.module('customPostAdmin', ['jaw.gallerypicker', 'jaw.simplemediapicker'])
        .controller('customPostAdminCtrl', ['$scope', function ($scope) {

            $scope.edit = $scope.edit || {};

            $scope.init_edit = function (id, std) {
                    console.log($scope.edit[id]);
                    console.log(std);
                if ($scope.edit[id] == undefined) {
                    $scope.edit[id] = std;
                }
            }



            $scope.json_decode = function (json_str) {

                var decode = json_str.replace(/\'/ig, '\"');
                var ret = '';
                if (decode != '') {
                    ret = JSON.parse(decode);
                }
                return ret;
            }


            $scope.add_edit = function (item) {
                if ($scope.edit[item] === undefined || $scope.edit[item] === '') {
                    $scope.edit[item] = [];
                }
                $scope.edit[item].push($.extend({}, {}));
            };
    
            //DELETE 
            $scope.del_edit = function (object, ide) {
                $scope.edit[object].splice(ide, 1);
            };

        }]);

    $(document).ready(function () {

        angular.bootstrap($('#jaw_portfolio_meta_box'), ['customPostAdmin']);
        angular.bootstrap($('#jaw_team_meta_box'), ['customPostAdmin']);
        angular.bootstrap($('#jaw_testimonial_meta_box'), ['customPostAdmin']);
        angular.bootstrap($('#jaw_gallery_meta_box'), ['customPostAdmin']);

        var portfolio_metabox = function () {
            switch ($('#portfolio_type').val()) {
                case 'image':
                    $('#jaw_portfolio_meta_box').find('.form-table tr').eq(1).show();
                    $('#jaw_portfolio_meta_box').find('.form-table tr').eq(2).hide();
                    $('#jaw_portfolio_meta_box').find('.form-table tr').eq(3).hide();
                    $('#jaw_portfolio_meta_box').find('.form-table tr').eq(4).hide();
                    $('#jaw_portfolio_meta_box').find('.form-table tr').eq(5).hide();
                    $('#jaw_portfolio_meta_box').find('.form-table tr').eq(6).hide();
                    break;
                case 'gallery':
                    $('#jaw_portfolio_meta_box').find('.form-table tr').eq(1).hide();
                    $('#jaw_portfolio_meta_box').find('.form-table tr').eq(2).show();
                    $('#jaw_portfolio_meta_box').find('.form-table tr').eq(3).hide();
                    $('#jaw_portfolio_meta_box').find('.form-table tr').eq(4).hide();
                    $('#jaw_portfolio_meta_box').find('.form-table tr').eq(5).hide();
                    $('#jaw_portfolio_meta_box').find('.form-table tr').eq(6).hide();
                    break;
                case 'video':
                    $('#jaw_portfolio_meta_box').find('.form-table tr').eq(1).show();
                    $('#jaw_portfolio_meta_box').find('.form-table tr').eq(2).hide();
                    $('#jaw_portfolio_meta_box').find('.form-table tr').eq(3).show();
                    $('#jaw_portfolio_meta_box').find('.form-table tr').eq(4).hide();
                    $('#jaw_portfolio_meta_box').find('.form-table tr').eq(5).hide();
                    $('#jaw_portfolio_meta_box').find('.form-table tr').eq(6).hide();
                    break;
                case 'link':
                    $('#jaw_portfolio_meta_box').find('.form-table tr').eq(1).show();
                    $('#jaw_portfolio_meta_box').find('.form-table tr').eq(2).hide();
                    $('#jaw_portfolio_meta_box').find('.form-table tr').eq(3).hide();
                    $('#jaw_portfolio_meta_box').find('.form-table tr').eq(4).show();
                    $('#jaw_portfolio_meta_box').find('.form-table tr').eq(5).show();
                    $('#jaw_portfolio_meta_box').find('.form-table tr').eq(6).hide();
                    break;
                case 'audio':
                    $('#jaw_portfolio_meta_box').find('.form-table tr').eq(1).show();
                    $('#jaw_portfolio_meta_box').find('.form-table tr').eq(2).hide();
                    $('#jaw_portfolio_meta_box').find('.form-table tr').eq(3).hide();
                    $('#jaw_portfolio_meta_box').find('.form-table tr').eq(4).hide();
                    $('#jaw_portfolio_meta_box').find('.form-table tr').eq(5).hide();
                    $('#jaw_portfolio_meta_box').find('.form-table tr').eq(6).show();
                    break;
            }

        };
        portfolio_metabox();
        $('#portfolio_type').change(portfolio_metabox);


    });

})(jQuery, angular);
