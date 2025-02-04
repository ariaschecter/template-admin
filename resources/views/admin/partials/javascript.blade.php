<!-- Core Js -->
<script src="{{ asset('backend/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('backend/js/rt-plugins.js') }}"></script>
<script src="{{ asset('backend/js/popper.js') }}"></script>
<script src="{{ asset('backend/js/SimpleBar.js') }}"></script>
<script src="{{ asset('backend/js/iconify.min.js') }}"></script>

<!-- Jquery Plugins -->

<!-- app js -->
<script src="{{ asset('backend/js/sidebar-menu.js') }}"></script>
<script src="{{ asset('backend/js/app.js') }}"></script>

<script>
    function checkForm() {
        let isValid = true;

        $("#form-el input, #form-el select, #form-el textarea").each(function() {
            if ($(this).prop("required") && !$(this).val()) { // Pastikan nilai tidak null atau undefined
                // console.log("Element kosong atau tidak ditemukan:", $(this));
                isValid = false;
            }
        });

        $("#submit-button").prop("disabled", !isValid);
    }
</script>
