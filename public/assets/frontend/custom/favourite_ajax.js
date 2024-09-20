$(document).on("click", "#heart-btn-new", function (e) {


    e.preventDefault();
    var id = $(this).data("id");
    var href = $(this).attr("href");
    var token = $("meta[name='csrf-token']").attr("content");
    var th = $(this);
  
    var path = $(location).attr('pathname');
    path.indexOf(1);
    path.toLowerCase();
    var lang = path.split("/")[1];
    var hearts = document.querySelectorAll('#heart-btn-new');
    
  
  
    $.ajax({
      url: href,
      type: "POST",
      data: { id: id, _token: token },
      dataType: "json",
  
    })
      .done(function (response) {
        if (response.action == 'inseart') {
          th.css('color', 'red')
    
          hearts.forEach(item => {
            $(item).css('color', 'red')
          })
          
        }
        if (response.action == 'delete') {
          th.css('color', ' ')
          hearts.forEach(item => {
            $(item).css('color', ' ')
          })
          location.reload()
        }
        
        Swal.fire({
            position: 'top-end', // Positioning the modal in the top-right corner
            title:    response.message,
            timer: 1000, // 2 seconds
            showConfirmButton: false,
            customClass: {
              popup: 'custom-width' // Applying a custom CSS class to the popup
            },


          });
      })
  
    // .error(function( data ) {
    //     // uh oh, something went wrong a 4xx response was returned (could be 400, 422 etc)
    //     // backend - return response()->json(['message' => 'Email is not in the proper format!'], 422);
    //     swal("Oops...", data.responseJSON.message, "error");
    // });
  
  
  });
  $(document).on('click', '#btn-fav-button', function (e) {
    e.preventDefault();
    var id = $(this).data("id");
    var href = $(this).attr("href");
    var token = $("meta[name='csrf-token']").attr("content");
    var th = $(this);
    
    $.ajax({
        type: "POST",
        data: { id: id, _token: token },
         url: th.attr('href'),
      success: function (response) {
  
        if (response.action == 'inseart') {
            th.find('span').addClass('fa fa-heart full');
            th.find('span').css('color', 'red');
            th.find('span').removeClass('icon_heart_alt');
            
          }
          if (response.action == 'delete') {
         
            th.find('span').removeClass('fa fa-heart full');
            th.find('span').css('color', ' ');
            th.find('span').addClass('icon_heart_alt');
            location.reload()
          }
  
          Swal.fire({
            position: 'top-end', // Positioning the modal in the top-right corner
            title:    response.message,
            timer: 1000, // 2 seconds
            showConfirmButton: false,
            customClass: {
              popup: 'custom-width' // Applying a custom CSS class to the popup
            },


          });
      },
      error: function (error) {
        console.log(error)
      }
    });
  
  })
  $(document).ready(function() {
    // Get the language from the URL path
    var lang = $(location).attr('pathname').split("/")[1];
    var hearts = document.querySelectorAll('#heart-btn-new');
    // Make an AJAX request to fetch favorite products
    $.ajax({
        url: window.location.origin + `/${lang}/get/fav`,
        type: "GET",
        dataType: "json",
        success: function(response) {
            console.log(response);

            // Check if response.product_ids is defined and is an array
            if (response && Array.isArray(response)) {
                // Iterate over each heart icon
                $(hearts).each(function() {
                    var productId = $(this).data('id');
                    // Check if the current product is in the response
                    if (response.includes(productId)) {
                      
                        $(this).css('color', 'red');

                        $('#btn-fav-button').find('span').addClass('fa fa-heart full');
                        $('#btn-fav-button').find('span').css('color', 'red');
                        $('#btn-fav-button').find('span').removeClass('icon_heart_alt');
                    }
                });
            } else {
                console.error("Invalid response format: product_ids is not an array");
            }
        },
        error: function(xhr, status, error) {
            console.error("Error fetching favorite products:", error);
        }
    });
});


