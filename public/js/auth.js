$(document).ready(function () {
    var sign_in_btn = document.querySelector("#sign-in-bton");
    var sign_up_btn = document.querySelector("#sign-up-bton");
    var sign_in_btpn = document.querySelector("#sign-in-btpn");
    var sign_up_btpn = document.querySelector("#sign-up-btpn");
    const container = document.querySelector(".containers");

    sign_in_btn.addEventListener("click", () => {
        container.classList.remove("sign-up-mode");
    });

    sign_in_btpn.addEventListener("click", () => {
        container.classList.remove("sign-up-mode");
    });

    sign_up_btn.addEventListener("click", () => {
        container.classList.add("sign-up-mode");
    });

    sign_up_btpn.addEventListener("click", () => {
        container.classList.add("sign-up-mode");
    });

    $('#customFile').on("change", function () {
        var file = $('#customFile')[0].files[0].name;
        $(this).prev('label').text(file.substring(0, 50));

        if (file == null) {
            $('#fileInvalid').show();
        } else {
            $('#fileInvalid').hide();
        }
    });

    // ------------ Check passwords similarity --------------
    $('#pwdId, #cPwdId').on('keyup', function () {
        if ($('#pwdId').val().length >= 2 && $('#pwdId').val().length < 30) {
            $('#pwdInValid').hide();
            $('#pwdValid').show();
        } else {
            $('#pwdValid').hide();
            $('#pwdInValid').show();
        }

        if ($('#pwdId').val() != '' && $('#cPwdId').val() != '' && $('#pwdId').val() == $('#cPwdId').val()) {
            $('#cPwdValid').show();
            $('#cPwdInvalid').hide();
            $('#cPwdInvalid').html('Passwords Match').css('color', 'green');
            $('.myCpwdClass').addClass('is-valid');
            $('.myCpwdClass').removeClass('is-invalid');
            $("#submitBtn").attr("disabled", false);
            $('#submitBtn').addClass('bton').removeClass('btn-secondary');
        } else {
            $('#cPwdValid').hide();
            $('#cPwdInvalid').show();
            $('#cPwdInvalid').html('Not Matching').css('color', 'red');
            $('.myCpwdClass').removeClass('is-valid');
            $('.myCpwdClass').addClass('is-invalid');
            $("#submitBtn").attr("disabled", true);
            $('#submitBtn').addClass('btn-secondary').removeClass('btn-primary');
        }
    });

    // ----------------- Validate on submit -----------------
    let currForm1 = document.getElementById('myForm1');
    currForm1.addEventListener('submit', function (event) {
        if (currForm1.checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
        } else {
            $("#submitBtn").attr("disabled", false);
            $('#submitBtn').addClass('bton').removeClass('btn-secondary');
            currForm1.classList.add('was-validated');
        }
    }, false);

    // ----------------- Validate on input -----------------
    currForm1.querySelectorAll('.form').forEach(input => {
        input.addEventListener(('input'), () => {
            if (input.checkValidity()) {
                input.classList.remove('is-invalid');
                input.classList.add('is-valid');
            } else {
                input.classList.remove('is-valid');
                input.classList.add('is-invalid');
            }
            var is_valid = $('.form').length === $('.form.is-valid').length;
            // $("#submitBtn").attr("disabled", !is_valid);
            if (is_valid) {
                $("#submitBtn").attr("disabled", false);
                $('#submitBtn').addClass('bton').removeClass('btn-secondary');
            } else {
                $("#submitBtn").attr("disabled", true);
                $('#submitBtn').addClass('btn-secondary').removeClass('btn-primary');
            }
        });
    });
    // ------------------------------------------------------

});
// if (windowWidth == 763) {
//   $(".pass").addClass("dropdown-menu");
//   $(".navbar-nav li", ".navbar-nav ul").removeClass("parent", "nav-child");
// }
