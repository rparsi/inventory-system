var yolo = {
    init: function () {
        var self = this;
        $('ul.dropdown-menu li').click({ view: self }, function (event){
            var view = event.data.view;
            //view.showModal();
        });
    },
    showModal: function () {
        $('#myModal').modal('show');
    }
};
$(document).ready(function(){yolo.init();});
