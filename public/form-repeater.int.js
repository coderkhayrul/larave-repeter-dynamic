$(document).ready(function () {
    "use strict";
    $(".repeater").repeater({
        defaultValues: {
            "textarea-input": "foo",
            "text-input": "bar",
            "select-input": "B",
            "checkbox-input": ["A", "B"],
            "radio-input": "B"
        },
        show: function () {
            $(this).slideDown()
        },
        hide: function (e) {
            // $(this).slideUp(e)
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $(this).slideUp(e)
                }
            })
            // confirm("Are you sure you want to delete this element?") && $(this).slideUp(e)
        },
        ready: function (e) {}
    }), window.outerRepeater = $(".outer-repeater").repeater({
        defaultValues: {
            "text-input": "outer-default"
        },
        show: function () {
            console.log("outer show"), $(this).slideDown()
        },
        hide: function (e) {
            console.log("outer delete"), $(this).slideUp(e)
        },
        repeaters: [{
            selector: ".inner-repeater",
            defaultValues: {
                "inner-text-input": "inner-default"
            },
            show: function () {
                console.log("inner show"), $(this).slideDown()
            },
            hide: function (e) {
                console.log("inner delete"), $(this).slideUp(e)
            }
        }]
    })
});
