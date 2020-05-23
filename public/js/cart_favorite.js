$.ajaxSetup({

    headers: {

        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

    }

});

$(document).on("click", '.btn-addToFavorite', function(e) {

    e.preventDefault();

    var id = $(this).data('value');;
    $.ajax({

        type: 'POST',

        url: "addToFavorite",

        data: { id: id },

        success: function(data) {

            $('#messaga').text(data.message)
            $('#errormessage').modal();
        }

    });
});

$(document).on("click", '.btn-addtocart', function(e) {

    e.preventDefault();

    var str = $(this).data('value');;
    $.ajax({

        type: 'POST',

        url: "add-to-cart",

        data: { name: str },

        success: function(data) {

            if (data.message === undefined) {

                $(".countCart").text(data.countCart);
                $('#messaga').text("Added Sucessfully")
                $('#errormessage').modal();
            } else {
                $('#messaga').text(data.message)
                $('#errormessage').modal();
            }

        }

    });
});