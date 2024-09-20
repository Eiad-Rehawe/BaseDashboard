// const { inProduction } = require("laravel-mix");



// const { then } = require("laravel-mix");

//select multi rows to delete
function toggle(source) {
    if(source.checked){
        var checkboxes = document.querySelectorAll('input[type="checkbox"]');
        for (var i = 0; i < checkboxes.length; i++) {
            if (checkboxes[i] != source) checkboxes[i].checked = source.checked;
        }
    }
   
}

$(document).on('click','.checkbox',function(){
    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
    for (var i = 0; i < checkboxes.length; i++) {
        if ($(this).is(':checked')) {
            checkboxes[i].checked = true;
            // $('div input').attr('checked', true);
        } else {
            checkboxes[i].checked = false;
        }
      
        // if (checkboxes[i] != source) checkboxes[i].checked = source.checked;
    }
})
//alert delete one row
$(document).on("click", "#warning", function (e) {


    e.preventDefault();
    var id = $(this).data("id");
    var href = $(this).attr("href");
    var token = $("meta[name='csrf-token']").attr("content");

    Swal.fire({
        title: "Do You Want To Delete This row?",
        icon: "question",
        iconHtml: "؟",
        confirmButtonText: "Yes",
        cancelButtonText: "No",
        showCancelButton: true,
        showCloseButton: true,
    })
    .then((result) => {
       
        if (result.value) {
            $.ajax({
                url: href,
                type: "DELETE",
                data: { id: id, _token: token },
                dataType: "json",

            })
                .done(function (response) {
                 
                    swal.fire(
                        response.title,
                        response.message,
                        response.status
                    ).then((result) => {
                        // Reload the Page
                        // $(".example").ajax.reload();
                        location.reload();
                    });
                })
                .fail(function(response) {
                    
                        swal.fire("Oops..."," Some Thing Went Wrong!","error");


                });
                // .error(function( data ) {
                //     // uh oh, something went wrong a 4xx response was returned (could be 400, 422 etc)
                //     // backend - return response()->json(['message' => 'Email is not in the proper format!'], 422);
                //     swal("Oops...", data.responseJSON.message, "error");
                // });
        }
    });
});



//update cart paid
$(document).on("click", "#update", function (e) {


    e.preventDefault();
    var id = $(this).data("id");
    var href = $(this).attr("href");
    var token = $("meta[name='csrf-token']").attr("content");

            $.ajax({
                url: href,
                type: "post",
                data: { id: id, _token: token },
                dataType: "json",

            })
                .done(function (response) {
                    swal.fire(
                        response.title,
                        response.message,
                        response.status
                    ).then((result) => {
                        // Reload the Page
                        // $(".example").ajax.reload();
                        location.reload();
                    });
                })
                .fail(function() {

                    swal.fire("Oops...","يوجد خطأ ما","error");

                });
                // .error(function( data ) {
                //     // uh oh, something went wrong a 4xx response was returned (could be 400, 422 etc)
                //     // backend - return response()->json(['message' => 'Email is not in the proper format!'], 422);
                //     swal("Oops...", data.responseJSON.message, "error");
                // });
        
   
});
// store and update

$(document).on("submit", ".submit", function (e) {

    //Some code 1
    e.preventDefault();

    var action = $(this).attr("action");
    var token = $("meta[name='csrf-token']").attr("content");
    var data = $(this).serialize();
    var type = $(this).attr("method");
    let form = $(this);
    $.ajax({
        type: type,
        url: action,
        data: data,
        dataType: "json",
        success: function (response) {
            swal.fire(response.title, response.message, response.status);
            form.trigger("reset");

        },
        error: function (err,data,response,jqXhr) {
            var elem = err.responseText;
            var ss = jQuery.parseJSON( '[' + elem + ']' );

            $.each(ss[0]['errors'], function (key, value) {

                $(`#${key}`).text(value[0]);

            });
        },
    });
});

//update status
$(document).on("click", ".toggle-class", function (e) {
    e.preventDefault();
    var token = $("meta[name='csrf-token']").attr("content");
    var id = $(this).data("id");
    var href = $(this).attr("href");
    Swal.fire({
        title:" Do You Want Update Status",
        icon: "question",
        iconHtml: "؟",
        confirmButtonText: "Yes",
        cancelButtonText: "No",
        showCancelButton: true,
        showCloseButton: true,
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: href,
                type: "post",
                data: { _token: token },
                dataType: "json",
            })
                .done(function (response, dataResult) {
                    swal.fire(
                        response.title,
                        response.message,
                        response.status
                    ).then((result) => {
                        // Reload the Page
                        location.reload()

                        // $(".example").refresh();
                    });
                    // $(".example").location.reload();
                })
                .fail(function () {
                    swal.fire("Oops..."," Some Thing Went Wrong", "error");
                });
        }
    });
});

//multi delete rows
$(document).on("click", ".multi-delete", function (e) {
    e.preventDefault();
    var id = [];
    var token = $("meta[name='csrf-token']").attr("content");
    var href = $(this).attr("href");
    $("#checkbox:checked").each(function () {
        id.push($(this).val());
    });
    console.log(id)
    Swal.fire({
        title: "Do You want Delete These Records?",
        icon: "question",
        iconHtml: "؟",
        confirmButtonText: "yes",
        cancelButtonText: "No",
        showCancelButton: true,
        showCloseButton: true,
    }).then((result) => {

        if (id.length > 0 && result.value == true) {
            $.ajax({
                type: "post",
                url: href,
                data: { id: id, _token: token },
                dataType: "json",
                success: function (response) {
                   
                    swal.fire(
                        response.title,
                        response.message,
                        response.status
                    ).then((result) => {
                        // Reload the Page
                        location.reload();
                    });
                },
                error: function (data) {

                   swal.fire("Oops...", data.responseJSON.message, "error");
                },
            });
        } else {

            swal.fire("Oops...","Some Thing Went Wrong!", "error");
        }
    });
});


//multi update status
$(document).on("click", ".multi-upadte-status", function (e) {
    e.preventDefault();
    var id = [];
    var token = $("meta[name='csrf-token']").attr("content");
    var href = $(this).attr("href");
    $(".checkbox:checked").each(function () {
        id.push($(this).val());
    });
    Swal.fire({
        title: "هل تريد تحديث حالة الأسطر المحددة؟ ",
        icon: "question",
        iconHtml: "؟",
        confirmButtonText: "نعم",
        cancelButtonText: "لا",
        showCancelButton: true,
        showCloseButton: true,
    }).then((result) => {

        if (id.length > 0 && result.value == true) {
            $.ajax({
                type: "post",
                url: href,
                data: { id: id, _token: token },
                dataType: "json",
                success: function (response) {
                   
                    swal.fire(
                        response.title,
                        response.message,
                        response.status
                    ).then((result) => {
                        // Reload the Page
                        location.reload();
                    });
                },
                error: function (data) {

                   swal.fire("Oops...", data.responseJSON.message, "error");
                },
            });
        } else {

            swal.fire("Oops...","حدث خطأ ماg", "error");
        }
    });
});

//submit form store and update with upload img
$('body').on('submit', 'form.submit-form', function(e) {
    e.preventDefault();

    let form = $(this);
    form.find('span.error').fadeOut(200);
    form.parent().addClass('load');
    var token = $("meta[name='csrf_token']").attr("content");
    $.ajax({
        url: form.attr('action'),
        type: "POST",
        data: new FormData($(this)[0]), "_token": "{{ csrf_token() }}",
        dataType: 'JSON',
        processData: false,
        contentType: false,
        success: function (data, textStatus, jqXHR,response) {
           if (data.redirect) {
            //   return  window.location = data.redirect;
                swal.fire(data.title, data.message, data.status,window.location = data.redirect);
           
           }
            $('.modal').modal("hide");
        //    swal.fire(data.title, data.message, data.status);
            form.trigger("reset");



        },
     
        error: function (err,data,response,jqXhr,xhr,error) {
           console.log(data)
           console.log(response)
           
           var elem = err.responseText;
          
           var ss = jQuery.parseJSON( '[' + elem + ']' );
        console.log(ss[0]['errors'])
           $.each(ss[0]['errors'], function (key, value) {
               
                  $(`#input-${key}`).text(value);
                

           });
           
          
        },
      
        complete: function() { form.parent().removeClass('load'); }
    });
});



//تلوين السطر من جدول الاشعارات يلي برحلو من الجرس
$(document).on('click','#href',function(e){
    e.preventDefault();
    var route = $('#href').attr('href');
    var str = route.lastIndexOf('/');
    var id = route.substring(45,route.length);

    // const url = new URL(route);
    // let id = url.pathname.slice(24);
    var count = $('#notifications_count').text();

    $.ajax({
        type: 'get',
        url: route,
       // data: data,
       // dataType: "json",
        success: function (response) {
            count--;
            $(`#color_${id}`).css("background-color", "#5c8a8a") ;
            location.reload(false);
        },
        error: function (err) {
           console.log(err);
        },
    });

  });

  //auto update table after insert rows into db
//   function updateTable() {

//     $.ajax({
//         success: function (data) {

//             $(".example_complain").DataTable().ajax.reload()
//         }

//     });
// }
//   $(document).ready(function (e) {
//     updateTable();
//     setInterval(updateTable , 3000);
// });


$(document).on("click", "#upload_link", function (e) {

    e.preventDefault();

    var input= $('input[type=file]').val();
    alert(input);

});

//show modal display images
$(document).on("click","#modal-images",function(e){
    e.preventDefault();
    var model =  $(this).attr("href").slice(28);
    var name_model = model.split('/')[0];
   
    var route = $(this).attr("href");
    
    var token = $("meta[name='csrf-token']").attr("content");
    var data = $("input[name='file']").val();

    var type = $(this).attr("method");
    let form = $(this);
    $.ajax({
        type: 'get',
        url: route,
       // data: data,
       // dataType: "json",
        success: function (response) {
           
           $("#load-form").show();
           $(".form-body").html(" ");
           for(let i =0; i<response.length; i++){
            $(".form-body").append(`<img src="/storage/uploads/${name_model}/${response[i]['image']}" alt=""  height="150" width="150" style="margin:5px;">`);

           }


        },
        error: function (err) {
           console.log(err);
        },
    });
})

//close modal by button x
$(document).on("click",".close",function(e){
    $("#load-form").hide();
});

$(document).on("click",'.close',function(){
    $("#load-form-email").hide();
})

function upload_video(){
    var upload_video=document.getElementById("upload_video");
    upload_video.style.display ="block";
}

function video_link(){
    var video_link=document.getElementById("video_link");
    video_link.style.display ="block";
}


$('body').on('submit','form#search-form',function(e){
    e.preventDefault();
   $.ajax({
    url: $(this).attr('action'),
    type: "POST",
   data: new FormData($(this)[0]), "_token": "{{ csrf_token() }}",
   dataType: 'JSON',
   processData: false,
   contentType: false,
   success:function(data,response){
   
   $('tbody').html(data);
   },
   error:function(err){
    console.log(err);
   }
   });
   })

   function showUser(obj)
   {
    var route = obj.href
    $.ajax({
        type: 'get',
        url: route,
        success: function (response) {
         Swal.fire(`<div class="card-body"><p>Name:${response[0].user.name}</p><p>Email:${response[0].user.email}</p><p>Phone${response[0].user.phone_number}</p></div>`)
        },
        error: function (err) {
           console.log(err);
        },
    });
   }



   //load form

   $(document).on("click","#replay",function(e){
    
    e.preventDefault();
    
    var route = $(this).attr('href');
 
    $.ajax({
        type: 'get',
        url: route,
      
        success: function (response) {
         
           $("#load-form").show();
           $("#load-form .form-body #form-email .card-body").html(" ");
            $("#load-form .form-body #form-email .card-body").append(`
          <input type="hidden" name="id" value="${response.data.id}"/>
        <div class="form-group">
        <input type="text" class="form-control" name="email"
            value="${response.data.email}" id="email" disabled>
    </div>
    <div class="form-group col-lg-6">
    <label for="recipient-desc_en" class="col-form-label">نص الرد</label>
    <textarea name="replay" id="summernote-1" class="textarea-2" cols="50" rows="5" class="form-control col-lg-6"></textarea>
    </div>
            `)
         
        },
        error: function (err) {
           console.log(err);
        },
    });
    
})

//get notifications

var getNewNotifications = function () {
  
    $.getJSON('', function (data) {
        $("#notificatio_div").html(" ");
        $("#notificatio_div").append(data.html)
    });
};

// setInterval(getNewNotifications, 3000)