
function removeHTMLTags(htmlString) {
    // Create a new DOMParser instance
    const parser = new DOMParser();
    // Parse the HTML string into a DOM document
    const doc = parser.parseFromString(htmlString, 'text/html');
    // Extract the text content from the parsed document
    const textContent = doc.body.textContent || "";
    return textContent.trim(); // Trim any leading or trailing whitespace
}

function select_category_1(obj) {
    var id = obj.value
    var lang = $(location).attr('pathname');
    var name = '';
    lang.indexOf(1);
    lang.toLowerCase();
    lang = lang.split("/")[1];
    $.ajax({
        url: window.location.origin + `/${lang}/product/category/compare?id=${id}`, // Endpoint to submit form1
        type: 'GET',
        // data: formData1, // Data to submit
        success: function (response) {
            console.log(response.products)
            let products = response.products
            $('#product_1').html(' ')
            let direction = ''
            let name = ''
            if (lang == 'ar') {
                direction = 'rtl'

            }
            if (lang == 'en') {
                direction = 'ltr'
            }
            products.forEach(product => {
                if (lang == 'ar') {
                    name = product.name_ar
                }
                if (lang == 'en') {
                    name = product.name_en
                }
                $('#product_1').append(`
                    <option class="select-option_1" onclick="select_product_1(this)" value="${product.id}" style="${direction}">
                ${name}</option>
                    `)
            })

        },
        error: function (err, jqXHR, textStatus, errorThrown) {
            console.log(err)

        }
    });
}

function select_category_2(obj) {
    var id = obj.value
    var lang = $(location).attr('pathname');
    var name = '';
    lang.indexOf(1);
    lang.toLowerCase();
    lang = lang.split("/")[1];
    $.ajax({
        url: window.location.origin + `/${lang}/product/category/compare?id=${id}`, // Endpoint to submit form1
        type: 'GET',
        // data: formData1, // Data to submit
        success: function (response) {
            console.log(response.products)
            let products = response.products
            $('#product_2').html(' ')
            let direction = ''
            let name = ''
            if (lang == 'ar') {
                direction = 'rtl'

            }
            if (lang == 'en') {
                direction = 'ltr'
            }
            products.forEach(product => {
                if (lang == 'ar') {
                    name = product.name_ar
                }
                if (lang == 'en') {
                    name = product.name_en
                }
                $('#product_2').append(`
                    <option class="select-option_2" onclick="select_product_2(this)" value="${product.id}" style="${direction}">
                ${name}</option>
                    `)
            })

        },
        error: function (err, jqXHR, textStatus, errorThrown) {
            console.log(err)

        }
    });
}

function select_product_1(obj) {
  if(obj.value == " "){
    localStorage.removeItem("compare1");
  }
    var id = obj.value
    var lang = $(location).attr('pathname');
    var name = '';
    lang.indexOf(1);
    lang.toLowerCase();

    lang = lang.split("/")[1];
    $.ajax({
        url: window.location.origin + `/${lang}/compare/product?id=${id}`, // Endpoint to submit form1
        type: 'GET',
        // data: formData1, // Data to submit
        success: function (response) {
            console.log(response.product)
          
            displayData1(response.product)

            localStorage.setItem('compare1', JSON.stringify(response.product));

        },
        error: function (err, jqXHR, textStatus, errorThrown) {
            console.log(err)

        }
    });
}

function select_product_2(obj) {
    if(obj.value == " "){
        localStorage.removeItem("compare2");
      }
    var id = obj.value

    var lang = $(location).attr('pathname');
    var name = '';
    lang.indexOf(1);

    lang.toLowerCase();

    lang = lang.split("/")[1];
    $.ajax({
        url: window.location.origin + `/${lang}/compare/product?id=${id}`, // Endpoint to submit form1
        type: 'GET',
        // data: formData1, // Data to submit
        success: function (response) {
            console.log(response.product)
            displayData2(response.product)

            localStorage.setItem('compare2', JSON.stringify(response.product));

        },
        error: function (err, jqXHR, textStatus, errorThrown) {
            console.log(err)

        }
    });
}

function displayData1(data) {
    if (typeof data === 'undefined') {
        $('#product_1_image').html(" ")
        
    $('#table_1 tr').find('#price').text(" ")
    $('#table_1 tr').find('#descrption').text("")
    $('#table_1 tr').find('#Weight').text("")
    $('#table_1 tr').find('#Weight_m').text("")
    }
    let html = '';
    var price = 0;
    var lang = $(location).attr('pathname');
    var name = '';
    lang.indexOf(1);

    lang.toLowerCase();

    lang = lang.split("/")[1];


    if (data.new_selling_price != null) {
        price = data.new_selling_price
    } else {
        price = data.selling_price
    }
    if (lang == 'ar') {
        name = data.name_ar
    }
    if (lang == 'en') {
        name = data.name_en
    }

    $('#table_1 tr').find('#price').text(price)
    if (lang == 'en') {
        let descrption = data.descrption_en
        $('#table_1 tr').find('#descrption').text(removeHTMLTags(descrption))
        $('#table_1 tr').find('#Weight').text(data.wight)
        $('#table_1 tr').find('#Weight_m').text(data.weight_measurement.name_en)

    }
    if (lang == 'ar') {
        
        let descrption = data.descrption_ar
        $('#table_1 tr').find('#descrption').text(removeHTMLTags(descrption))
        $('#table_1 tr').find('#Weight').text(data.wight)
        $('#table_1 tr').find('#Weight_m').text(data.weight_measurement.name_ar)

    }
    $('#table_1 tr').find('#Weight').text(data.wight)
    //  $('#product_1_image').html(' ')
    let result = parseInt(data.selling_price - data.new_selling_price) / (data.selling_price) * 100

    if (result && data.new_selling_price != null) {
        result = `  <div class="product__discount__percent" style="  height: 45px;
              width: 45px;
              background: #dd2222;
              border-radius: 50%;
              font-size: 14px;
              color: #ffffff;
              line-height: 45px;
              text-align: center;
              position: absolute;
              left: 15px;
              top: 15px;">
               ${parseInt(result)}%
              </div>`
    } else {
        result = `  <div class="product__discount__percent" style="  height: 45px;
              width: 45px;
              background: #dd2222;
              border-radius: 50%;
              font-size: 14px;
              color: #ffffff;
              line-height: 45px;
              text-align: center;
              position: absolute;
              left: 15px;
              top: 15px;display:none">
               ${parseInt(result)}%
              </div>`
    }
    var price_new = '';
    if (data.new_selling_price != null) {
        price_new = ` <div class="product__item__price d-flex justify-content-center"> ${data.new_selling_price}<span>${data.selling_price}</span>
              </div>`;
    } if (data.new_selling_price == null) {
        price_new = `<div class="product__item__price d-flex justify-content-center">${data.selling_price} </div>
`
    }
    let file = data.files[0].name
    if (data.files[0].path == null) {
        file
    } else {
        file = window.location.origin + `/uploads//products/${data.files[0].name}`
    }
    var url = window.location.origin + `/${lang}/getProductWhenClickCart/${data.id}`
    var product_url = window.location.origin + `/${lang}/product/${data.id}`
    var url_1=window.location.origin+`/${lang}/favourite?id=${data.id}`;
    $('#product_1_image').html(`
        <div class="product__item__pic set-bg" id="${data.id}" 
            style="margin-top: 20px; background:url(${file}); background-repeat: no-repeat; background-position: center; background-size: contain;" 
            data-setbg="${file}">
            ${result}
            <ul class="product__item__pic__hover item__pic" id="${data.id}" style="display:absolute;bottom:0px;">
                ${$('#auth').val() === '' ? `<li><a href="${url}" class="${data.id}" id="heart-btn-new"><i class="fa fa-heart"></i></a></li>` : ''}
                ${$('#auth').val() !== '' ? `<li><a href="${url_1}" data-id="${data.id}" id="heart-btn-new"><i class="fa fa-heart"></i></a></li>` : ''}
                <li><a id="view" href="${product_url}"><i class="fa fa-eye"></i></a></li>
                <li><a href="${url}" id="add-cart-new"><i class="fa fa-shopping-cart"></i></a></li>
                <li id="destroy" class="destroy_${data.id}" style="display:none"><a href="" class="destroy" id="${data.id}"><i class="fa fa-trash"></i></a></li>
            </ul>
        </div>
        <div class="product__item__text product__discount__item__text" style="margin-right:50px">
            <h6><a href="" class="d-flex justify-content-center">${name}</a></h6>
            ${price_new}
        </div>
    `);
    
    let myArray = JSON.parse(localStorage.getItem('cart')) || [];
    let fav = JSON.parse(localStorage.getItem('fav')) || [];
    var featured__item__pic__hover = document.querySelectorAll('.item__pic')
    featured__item__pic__hover.forEach(freture_item => {
        myArray.forEach(item => {
            if (item.id == data.id) {
                $(freture_item).find('#destroy').css('display', 'block')

                $(freture_item).find('#add-cart-new').remove()

                if (parseInt($(freture_item).attr('id')) == item.id && item.qty >= 1) {

                }

            }
        })
        fav.forEach(item => {
            if (item.id == data.id) {
                $(freture_item).find('#heart-btn-new .fa-heart').css('color', 'red')
            }
        })
    })
}

// Check if data exists in localStorage on page load
if (localStorage.getItem('compare1')) {
    const storedData = JSON.parse(localStorage.getItem('compare1'));
    displayData1(storedData);
}

function displayData2(data) {
        if (typeof data === 'undefined') {
        $('#product_2_image').html(" ")
        
    $('#table_2 tr').find('#price').text(" ")
    $('#table_2 tr').find('#descrption').text("")
    $('#table_2 tr').find('#Weight').text("")
    $('#table_2 tr').find('#Weight_m').text("")
    }
    let html = '';
    var price = 0;
    var lang = $(location).attr('pathname');
    var name = '';
    lang.indexOf(1);

    lang.toLowerCase();

    lang = lang.split("/")[1];

    if (data.new_selling_price != null) {
        price = data.new_selling_price
    } else {
        price = data.selling_price
    }
    if (lang == 'ar') {
        name = data.name_ar
    }
    if (lang == 'en') {
        name = data.name_en
    }

    $('#table_2 tr').find('#price').text(price)
    if (lang == 'en') {
        let descrption = data.descrption_en
        $('#table_2 tr').find('#descrption').text(removeHTMLTags(descrption))
        $('#table_2 tr').find('#Weight').text(data.wight).append(data.weight_measurement)
        $('#table_2 tr').find('#Weight_m').text(data.weight_measurement.name_en)

    }
    if (lang == 'ar') {
        let descrption = data.descrption_ar

        $('#table_2 tr').find('#descrption').text(removeHTMLTags(descrption))
        $('#table_2 tr').find('#Weight').text(data.wight).append(data.weight_measurement)
        $('#table_2 tr').find('#Weight_m').text(data.weight_measurement.name_ar)

    }
    $('#table_2 tr').find('#Weight').text(data.wight)
    //  $('#product_2_image').html(' ')
    let result = parseInt(data.selling_price - data.new_selling_price) / (data.selling_price) * 100

    if (result && data.new_selling_price != null) {
        result = `  <div class="product__discount__percent" style="  height: 45px;
              width: 45px;
              background: #dd2222;
              border-radius: 50%;
              font-size: 14px;
              color: #ffffff;
              line-height: 45px;
              text-align: center;
              position: absolute;
              left: 15px;
              top: 15px;">
               ${parseInt(result)}%
              </div>`
    } else {
        result = `  <div class="product__discount__percent" style="  height: 45px;
              width: 45px;
              background: #dd2222;
              border-radius: 50%;
              font-size: 14px;
              color: #ffffff;
              line-height: 45px;
              text-align: center;
              position: absolute;
              left: 15px;
              top: 15px;display:none">
               ${parseInt(result)}%
              </div>`
    }
    var price_new = '';
    if (data.new_selling_price != null) {
        price_new = ` <div class="product__item__price d-flex justify-content-center"> ${data.new_selling_price}<span>${data.selling_price}</span>
            </div>`;
    } if (data.new_selling_price == null) {
        price_new = `<div class="product__item__price d-flex justify-content-center">${data.selling_price} </div>
`
    }
    let file = data.files[0].name
    if (data.files[0].path == null) {
        file
    } else {
        file = window.location.origin + `/uploads//products/${data.files[0].name}`
    }
    var url = window.location.origin + `/${lang}/getProductWhenClickCart/${data.id}`
    var url_1=window.location.origin+`/${lang}/favourite?id=${data.id}`;
    var product_url = window.location.origin + `/${lang}/product/${data.id}`

    $('#product_2_image').html(`
        <div class="product__item__pic set-bg" id="${data.id}" 
            style="margin-top: 20px; background:url(${file}); background-repeat: no-repeat; background-position: center; background-size: contain;" 
            data-setbg="${file}">
            ${result}
            <ul class="product__item__pic__hover item__pic" id="${data.id}" style="display:absolute;bottom:0px;">
                ${$('#auth').val() === '' ? `<li><a href="${url}" class="${data.id}" id="heart-btn-new"><i class="fa fa-heart"></i></a></li>` : ''}
                ${$('#auth').val() !== '' ? `<li><a href="${url_1}" data-id="${data.id}" id="heart-btn-new"><i class="fa fa-heart"></i></a></li>` : ''}
                <li><a id="view" href="${product_url}"><i class="fa fa-eye"></i></a></li>
                <li><a href="${url}" id="add-cart-new"><i class="fa fa-shopping-cart"></i></a></li>
                <li id="destroy" class="destroy_${data.id}" style="display:none"><a href="" class="destroy" id="${data.id}"><i class="fa fa-trash"></i></a></li>
            </ul>
        </div>
        <div class="product__item__text product__discount__item__text" style="margin-right:50px">
            <h6><a href="" class="d-flex justify-content-center">${name}</a></h6>
            ${price_new}
        </div>
    `);

    let myArray = JSON.parse(localStorage.getItem('cart')) || [];
    let fav = JSON.parse(localStorage.getItem('fav')) || [];
    var featured__item__pic__hover = document.querySelectorAll('.item__pic')
    featured__item__pic__hover.forEach(freture_item => {
        myArray.forEach(item => {
            if (item.id == data.id) {
                $(freture_item).find('#destroy').css('display', 'block')

                $(freture_item).find('#add-cart-new').remove()

                if (parseInt($(freture_item).attr('id')) == item.id && item.qty >= 1) {

                }

            }
        })
        fav.forEach(item => {
            if (item.id == data.id) {
                $(freture_item).find('#heart-btn-new .fa-heart').css('color', 'red')
            }
        })
    })
}

// Check if data exists in localStorage on page load
if (localStorage.getItem('compare2')) {
    const storedData = JSON.parse(localStorage.getItem('compare2'));
    displayData2(storedData);
}
