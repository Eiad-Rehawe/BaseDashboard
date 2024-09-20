$(document).ready(function () {

    $("input[type='radio']").click(function () {
        var sim = $("input[type='radio']:checked").val();
        //alert(sim);
        if (sim < 3) {
            $('.myratings').css('color', 'red');
            $(".myratings").text(sim);
        } else {
            $('.myratings').css('color', 'green');
            $(".myratings").text(sim);
        }
    });


});

$(document).on('click', ".rating input[type='radio']", function (e) {
    e.preventDefault()
    var checkboxes = document.querySelectorAll('.rating input[type="radio"]:checked');
    
    $('.rating:not(:checked) > label:hover ~ label').css('color','#FFD700')
    // $('.rating:checked = label:hover ~ label').css('color','#FFD700')
       for (var i = 0; i <= checkboxes.length; i++) {
       
        $(`#${checkboxes[i].value}`).css('color','#FFD700')
        
        
        }
 
    var auth = $('#auth').attr('value');
   
    if(auth == ''){
        window.location.href = '/login';
    }
    var sim = $("input[type='radio']:checked").val();
    var token = $("meta[name='csrf-token']").attr("content");
    var length = $(this).attr('value')
    var product_id = window.location.href.substring(window.location.href.lastIndexOf('/') + 1);
    
    // var lang = location.pathname.split('/')[1]
    $.ajax({
        url: window.location.origin+'/review?product_id='+ product_id+'&star='+sim,
        type: "post",
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        dataType: 'JSON',
        data: {
            _method:"POST"
          },
        processData: false,
        contentType: false,
        success: function (data, textStatus, jqXHR, response) {
          
            // $('.rating').html(' ')
            // $('.rating').append(`  <input type="radio" id="star${length}" name="rating" value="${length}" /><label class="full" for="star${data.data}"
            // title="Awesome - ${length} stars" style="color:#FFD700"></label>`)
          
        },

        error: function (err, data, response, jqXhr, xhr) {
          console.log(err)
        },
       
    });
})   



$( ".rating input[type='radio']").hover(
    function () {
      $(this).addClass("result_hover");
    },
    function () {
      $(this).removeClass("result_hover");
    }
  );
