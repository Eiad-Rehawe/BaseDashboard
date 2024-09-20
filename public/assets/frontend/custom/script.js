// const { inProduction } = require("laravel-mix");



// const { then } = require("laravel-mix");

//select multi rows to delete
function toggle(source) {
    if (source.checked) {
        var checkboxes = document.querySelectorAll('input[type="checkbox"]');
        for (var i = 0; i < checkboxes.length; i++) {
            if (checkboxes[i] != source) checkboxes[i].checked = source.checked;
        }
    }

}

$(document).on('click', '.checkbox', function () {
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
    var path = $(location).attr('pathname');
    path.indexOf(1);
    path.toLowerCase();
    var lang = path.split("/")[1];
    var cat = path.split("/")[3];
    var msg = '';
    var yes = '';

    if (cat == 'categories') {
        if (lang == 'ar') {
            msg = 'هذا القسم يمكن أن يحتوي على منتجات وأقسام فرعية وطليات مستخدمين هل انت منأكد من الحذف؟'
            yes = 'نعم'
            no = 'لا'
        }
        if (lang == 'en') {
            msg = 'This Category may contain produts,child categories and orders are you sure you want delete it?'
            yes = 'Yes'
            no = 'No'
        }


    } if(cat == 'products')
    {
        if (lang == 'ar') {
            msg = 'هذا المنتج يمكن أن يحتوي على طليات مستخدمين هل انت منأكد من الحذف؟'
            yes = 'نعم'
            no = 'لا'
        }
        if (lang == 'en') {
            msg = 'This product may contain  orders... are you sure you want delete it?'
            yes = 'Yes'
            no = 'No'
        }
    }
    
    else {
        if (lang == 'ar') {
            msg = 'هل تريد حذف هذا السطر ؟'
            yes = 'نعم'
            no = 'لا'
        }
        if (lang == 'en') {
            msg = 'Do You Want To Delete This row?'
            yes = 'Yes'
            no = 'No'
        }
    }
    Swal.fire({
        title: msg,
        icon: "question",
        iconHtml: "؟",
        confirmButtonText: yes,
        cancelButtonText: no,
        showCancelButton: true,
        showCloseButton: true,
    }).then((result) => {
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
                .fail(function (error) {
                    console.log(error)
                    if (cat == 'products') {

                        if (lang == 'ar') {
                            msg = 'هذا المنتج يحوي طلبات مستخدمين'

                        }
                        if (lang == 'en') {
                            msg = 'this product have users orders'

                        }
                    }
                    if (cat == 'categories') {

                        if (lang == 'ar') {
                            msg = 'هذا القسم يحوي منتجات تحوي طلبات مستخدمين'

                        }
                        if (lang == 'en') {
                            msg = 'this category  have products which have users orders'

                        }
                        swal.fire("Oops...", msg, "error");
                    }
                    else {
                        swal.fire("Oops...", " Some Thing Went Wrong!", "error");

                    }

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
        .fail(function () {

            swal.fire("Oops...", "يوجد خطأ ما", "error");

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
        error: function (err, data, response, jqXhr) {
            var elem = err.responseText;
            var ss = jQuery.parseJSON('[' + elem + ']');

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
    var path = $(location).attr('pathname');
    path.indexOf(1);
    path.toLowerCase();
    var lang = path.split("/")[1];
    var msg = '';
    var yes = '';
    var no ='';
    if(lang == 'ar'){
        msg = 'هل تريد تحديث الحالة؟ ';
        yes = 'نعم'
        no = 'لا'
    }
    if(lang == 'en'){
        msg = 'Do You Want Update Status?'
        yes = 'YES'
        no = 'NO'
    }
    Swal.fire({
        title: msg,
        icon: "question",
        iconHtml: "؟",
        confirmButtonText: yes,
        cancelButtonText: no,
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
                    swal.fire("Oops...", " Some Thing Went Wrong", "error");
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
    var path = $(location).attr('pathname');
    path.indexOf(1);
    path.toLowerCase();
    var lang = path.split("/")[1];
    var cat = path.split("/")[3];
    var msg = '';
    var yes = '';

    if (cat == 'categories') {
        if (lang == 'ar') {
            msg = 'هذه الأقسام يمكن أن تحتوي على منتجات  وأقسام فرعية وطلبات مستخدمين هل انت منأكد من الحذف؟'
            yes = 'نعم'
            no = 'لا'
        }
        if (lang == 'en') {
            msg = 'These categories may contain products,child categories and orders users are you sure you want delete it?'
            yes = 'Yes'
            no = 'No'
        }
    } else {
        if (lang == 'ar') {
            msg = 'هل تريد حذف هذا الاسطر ؟'
            yes = 'نعم'
            no = 'لا'
        }
        if (lang == 'en') {
            msg = 'Do You Want To Delete This rows?'
            yes = 'Yes'
            no = 'No'
        }
    }
    Swal.fire({
        title: msg,
        icon: "question",
        iconHtml: "؟",
        confirmButtonText: yes,
        cancelButtonText: no,
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
                error: function (data, response) {
                    if (cat == 'products') {

                        if (lang == 'ar') {
                            msg = 'هذه المنتجات تحوي طلبات مستخدمين'

                        }
                        if (lang == 'en') {
                            msg = 'thses products have users orders'

                        }
                        swal.fire("Oops...", msg, "error");
                    }
                    if (cat == 'categories') {

                        if (lang == 'ar') {
                            msg = 'هذه الاقسام تحوي منتجات تحوي طلبات مستخدمين'

                        }
                        if (lang == 'en') {
                            msg = 'thses categories  have products which have users orders'

                        }
                        swal.fire("Oops...", msg, "error");
                    }
                    else {
                        swal.fire("Oops...", " Some Thing Went Wrong!", "error");

                    }
                },
            });
        } else {

            swal.fire("Oops...", "Some Thing Went Wrong!", "error");
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

            swal.fire("Oops...", "حدث خطأ ماg", "error");
        }
    });
});

//submit form store and update with upload img
$('body').on('submit', 'form.submit-form', function (e) {
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
        success: function (data, textStatus, jqXHR, response) {
            if (data.redirect) {
                //   return  window.location = data.redirect;
                swal.fire(data.title, data.message, data.status, window.location = data.redirect);

            }
            $('.modal').modal("hide");
            //    swal.fire(data.title, data.message, data.status);
            form.trigger("reset");



        },

        error: function (err, data, response, jqXhr, xhr) {
            if(response == 'Forbidden'){
                var lang = $(location).attr('pathname');
                lang.indexOf(1);
                lang.toLowerCase();
                lang = lang.split("/")[1];
                if(lang == 'en'){
                    swal.fire('error', 'please verify your email', 'error');
                }
                if(lang == 'ar'){
                    swal.fire('خطأ', 'يرجى تأكيد الحساب', 'error');
                }
               }
            if($('#auth').val() == ''){
                window.location.href = '/login'
            }
            var elem = err.responseText;

            var ss = jQuery.parseJSON('[' + elem + ']');

            $.each(ss[0]['errors'], function (key, value) {

                $(`#input-${key}`).text(value);



            });


        },

        complete: function () { form.parent().removeClass('load'); }
    });
});


$('body').on('submit', 'form.submit-form-complaiments', function (e) {
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
        success: function (data, textStatus, jqxhr, response) {
            // alert(textStatus)
            if (data.redirect) {
                //   return  window.location = data.redirect;
                swal.fire(data.title, data.message, data.status);

            }
            $('.modal').modal("hide");
            //    swal.fire(data.title, data.message, data.status);
            form.trigger("reset");



        },

        error: function (err, data, response, jqxhr, xhr) {
           if(response == 'Forbidden'){
            var lang = $(location).attr('pathname');
            lang.indexOf(1);
            lang.toLowerCase();
            lang = lang.split("/")[1];
            if(lang == 'en'){
                swal.fire('error', 'please verify your email', 'error');
            }
            if(lang == 'ar'){
                swal.fire('خطأ', 'يرجى تأكيد الحساب', 'error');
            }
           }
            if($('#auth').val() == ''){
                window.location.href = '/login'
            }
            var elem = err.responseText;
            var ss = jQuery.parseJSON('[' + elem + ']');
            console.log(ss)
            $.each(ss[0]['errors'], function (key, value) {

                $(`#input-${key}`).text(value);



            });


        },

        complete: function () { form.parent().removeClass('load'); }
    });
});




//تلوين السطر من جدول الاشعارات يلي برحلو من الجرس
$(document).on('click', '#href', function (e) {
    e.preventDefault();
    var route = $('#href').attr('href');
    var str = route.lastIndexOf('/');
    var id = route.substring(45, route.length);

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
            $(`#color_${id}`).css("background-color", "#5c8a8a");
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

    var input = $('input[type=file]').val();
    alert(input);

});

//show modal display images
$(document).on("click", "#modal-images", function (e) {
    e.preventDefault();
    var model = $(this).attr("href").slice(28);
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
            for (let i = 0; i < response.length; i++) {
                $(".form-body").append(`<img src="/storage/uploads/${name_model}/${response[i]['image']}" alt=""  height="150" width="150" style="margin:5px;">`);

            }


        },
        error: function (err) {
            console.log(err);
        },
    });
})

//close modal by button x
$(document).on("click", ".close", function (e) {
    $("#load-form").hide();
});

$(document).on("click", '.close', function () {
    $("#load-form-email").hide();
})

function upload_video() {
    var upload_video = document.getElementById("upload_video");
    upload_video.style.display = "block";
}

function video_link() {
    var video_link = document.getElementById("video_link");
    video_link.style.display = "block";
}


$('body').on('submit', 'form#search-form', function (e) {
    e.preventDefault();
    $.ajax({
        url: $(this).attr('action'),
        type: "POST",
        data: new FormData($(this)[0]), "_token": "{{ csrf_token() }}",
        dataType: 'JSON',
        processData: false,
        contentType: false,
        success: function (data, response) {

            $('tbody').html(data);
        },
        error: function (err) {
            console.log(err);
        }
    });
})

function showUser(obj) {
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

$(document).on("click", "#replay", function (e) {

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

$(document).ready(function () {
    var links = document.querySelectorAll('#active_li')
    for (let j = 0; j < links.length; j++) {
        const parentElement = links[j].parentElement
        if (window.location.href == links[j].href) {

            $(parentElement).addClass('active');
        } else {
            $(parentElement).removeClass('active');
        }
    }

})

$('#loginButton').on('submit',function(){
    localStorage.removeItem('fav');
})

$('body').on('click','.view_order',function(e){
    e.preventDefault()
    var route = $(this).attr('href');
    $.ajax({
        type: 'get',
        url: route,

        success: function (response) {
            $('#details').html(' ')
            $('#details').append(response.html)
        

        },
        error: function (err) {
            console.log(err);
        },
    });

})

$('body').on('change','#select_qty',function(e){
    e.preventDefault()
    var id = parseInt($(this).val())
    var path = $(location).attr('pathname');
    path.indexOf(1);
    path.toLowerCase();
    var lang = path.split("/")[1];

    $.ajax({
        type: 'get',
        url: window.location.origin+`/${lang}/editOrder?id=${id}`,

        success: function (response) {
            console.log(response)
            $('#qty_product_order').val(response.quantity)
            $('#product_order').val(response.product_id)

        },
        error: function (err) {
            console.log(err);
        },
    });
})


//   $(document).ready(function() {
//     $('#saveChanges').click(function() {
//       var selectedProducts = [];
//       $('#exampleModalAdd input[type="checkbox"]:checked').each(function() {
//         var productId = $(this).val();
//         var quantity = $(this).closest('tr').find('input[type="number"]').val();
//         selectedProducts.push({ productId: productId, quantity: quantity });
//       });
//       console.log(selectedProducts); // You can handle the data as needed
//       $('#exampleModalAdd').modal('hide');
//     });
//   });

$('body').on('click','#exampleModalAddbutton',function(e){
    e.preventDefault()
    $('#exampleModalAdd').css('display','block')
    var order_id = $(this).data('id')
    $('body').on('submit', 'form.submit-form-add-to-order', function (e) {
        e.preventDefault();

        const checkedValues = [];
        const ch= [];
        const rows = document.querySelectorAll('.submit-form-add-to-order tr');
       
            rows.forEach(row => {
                const checkbox = row.querySelector('input[type=checkbox]');
               
                if (checkbox && checkbox.checked) {
                    const cc = row.querySelector('input[type=checkbox]').value;
                    ch.push(cc)
                
                    const inputNumber = row.querySelector('input[type=number]').value;
                    checkedValues.push(inputNumber);
                }
            });
   
        var path = $(location).attr('pathname');
        path.indexOf(1);
        path.toLowerCase();
        var lang = path.split("/")[1];
        let route = window.location.origin+`/${lang}/add_products_to_order?id=${order_id}&product_id=${ch}&qty=${checkedValues}`
        let form = $(this);
        form.find('span.error').fadeOut(200);
        form.parent().addClass('load');
        var token = $("meta[name='csrf-token']").attr("content");
            console.log(token)
        $.ajax({
            url:route,
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': token
            },
           
             dataType: 'JSON',
            processData: false,
            contentType: false,
            success: function (data, textStatus, jqXHR, response) {
                if (data.redirect) {
                    //   return  window.location = data.redirect;
                    swal.fire(data.title, data.message, data.status, window.location = data.redirect);
    
                }
                $('.modal').modal("hide");
                //    swal.fire(data.title, data.message, data.status);
                form.trigger("reset");
    
    
    
            },
    
            error: function (err, data, response, jqXhr, xhr) {
                if(response == 'Forbidden'){
                    var lang = $(location).attr('pathname');
                    lang.indexOf(1);
                    lang.toLowerCase();
                    lang = lang.split("/")[1];
                    if(lang == 'en'){
                        swal.fire('error', 'please verify your email', 'error');
                    }
                    if(lang == 'ar'){
                        swal.fire('خطأ', 'يرجى تأكيد الحساب', 'error');
                    }
                   }
                if($('#auth').val() == ''){
                    window.location.href = '/login'
                }
                var elem = err.responseText;
    
                var ss = jQuery.parseJSON('[' + elem + ']');
    
                $.each(ss[0]['errors'], function (key, value) {
    
                    $(`#input-${key}`).text(value);
    
    
    
                });
    
    
            },
    
            complete: function () { form.parent().removeClass('load'); }
        });
    });
})


