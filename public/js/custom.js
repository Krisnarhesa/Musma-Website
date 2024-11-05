$(document).ready(function () {
    var btnSubmitModal = $('#btn-submit-modal');
    var btnSubmit = $('#btn-submit');
    var btnSee = $('#btn-See');
    btnSee.hide();

    btnSubmit.click(function () {
        var flag = true;
        $(':radio').each(function () {
            name = $(this).attr('name');
            if (flag && !$(':radio[name="' + name + '"]:checked').length) {
                $('#alert-vote').modal().show();
                $('#text-modal').html('<strong>Harap Lengkapi Pilihan Vote!</strong>');

                flag = false;
            } else {

            }
        });
        return flag;
    });

    btnSubmitModal.click(function () {
        btnSubmit.fadeOut();
        btnSee.fadeIn();
    });

    var jumboHeight = $('.jumbotron').outerHeight();

    function parallax() {
        var scrolled = $(window).scrollTop();
        $('.jumbotron').css('height', (jumboHeight - scrolled) + 'px');
    }

    $(window).scroll(function (e) {
        parallax();
    });
});
