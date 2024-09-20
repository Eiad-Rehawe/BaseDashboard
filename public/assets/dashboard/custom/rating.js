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
    var sim = $("input[type='radio']:checked").val();
    var token = $("meta[name='csrf-token']").attr("content");
    
    var product_id = window.location.href.substring(window.location.href.lastIndexOf('/') + 1);
    
    // var lang = location.pathname.split('/')[1]
    $.ajax({
        url: 'review?product_id='+ product_id+'&star='+sim,
        type: "post",
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        dataType: 'JSON',
        data: {
            _method:"PUT"
          },
        processData: false,
        contentType: false,
        success: function (data, textStatus, jqXHR, response) {
            console.log('success')
        },

        error: function (err, data, response, jqXhr, xhr) {
          console.log(err)
        },
       
    });
})   