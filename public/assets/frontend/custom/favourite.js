$(document).on('click', '#heart-btn', function (e) {
  e.preventDefault();
  let fav = JSON.parse(localStorage.getItem('fav')) || [];
  var th = $(this);

  var btn_cart = th.parent('li').parent('.item__pic').find('#btn-cart')
  var id = parseInt($(btn_cart).attr('class'))
  var image = $(btn_cart).find('.image').attr('id')

  var name = $(btn_cart).find('.crt').attr('id')
  var price = $(btn_cart).find('.final_price').attr('id')
  var qty = 0;

  var product_related = $(btn_cart).find('.product_related').attr('id')
  var lang = $(location).attr('pathname');
  lang.indexOf(1);
  lang.toLowerCase();
  lang = lang.split("/")[1];
  existingArray = JSON.parse(localStorage.getItem('fav')) || [];

  // Create a new object to push to the array
  let newObject = {
    id: id,
    image: image,
    name: name,
    price: price,
    qty: qty + 1,
    total: price,
    total_after_coupon: 0,
    coupon: "",
    lang: lang,
    product_related: product_related
  };
  if ($(this).css('color', ' ') && fav.length == 0) {


    th.css('color', 'red')
    let objectExists = existingArray.some(obj => obj.id === newObject.id || parseInt(obj.product_related) === newObject.id);


    // Step 3: If the object doesn't exist, push it into the array
    if (!objectExists) {
      existingArray.push(newObject);
    }
    // Push the new object to the array

    // Convert the updated array to a JSON string
    let updatedArray = JSON.stringify(existingArray);

    // Save the updated array back to local storage
    localStorage.setItem('fav', updatedArray);

    var msg = '';
    if (lang == 'ar') {
      msg = 'تمت الإضافة إلى المفضلة بنجاح';
    }
    if (lang == 'en') {
      msg = 'Add To Favourite Successfully';
    }
    Swal.fire({
      position: 'top-end', // Positioning the modal in the top-right corner
      title: msg,
      timer: 1000, // 2 seconds
      showConfirmButton: false,
      customClass: {
        popup: 'custom-width' // Applying a custom CSS class to the popup
      },


    });
    var sum = 0;
    let myArray = JSON.parse(localStorage.getItem('fav')) || [];

    myArray.forEach(item => {
      sum += item.qty

    });



  }
  if ($(this).css('color', 'red') && fav.length > 0) {
    let fav = JSON.parse(localStorage.getItem('fav')) || [];
    var featured__item__pic__hover = document.querySelectorAll('.item__pic')
    featured__item__pic__hover.forEach(freture_item => {

      fav.forEach(item => {

        if (item.id == parseInt($(freture_item).attr('id')) || parseInt(item.product_related) == parseInt($(freture_item).find('.product_related').attr('id'))) {

          fav = fav.filter(item => item.id !== parseInt(newObject.id));

          // Store the updated cart back in localStorage
          localStorage.setItem('fav', JSON.stringify(fav));
          th.css('color', ' ')

          if (lang == 'ar') {
            msg = 'تمت  الإزالة من المفضلة بنجاح';
          }
          if (lang == 'en') {
            msg = 'Remove From Favourite Successfully';
          }
          Swal.fire({
            position: 'top-end', // Positioning the modal in the top-right corner
            title: msg,
            timer: 1000, // 2 seconds
            showConfirmButton: false,
            customClass: {
              popup: 'custom-width' // Applying a custom CSS class to the popup
            },


          });
          location.reload()

        }


      })
    })
  }
})



$(document).on('click', '#heart-btn-new', function (e) {
  e.preventDefault();
  var th = $(this);

  $.ajax({
    type: 'get',
    url: th.attr('href'),
    success: function (response) {

      var id = response.product.id
      var name_ar = response.product.name_ar
      var name_en = response.product.name_en
      var image = response.product.files[0]['name']
      var price = 0;
      if (response.product.new_selling_price == null) {
        price = response.product.selling_price
      } else {
        price = response.product.new_selling_price
      }
      var qty = 0;
      var lang = $(location).attr('pathname');

      var fav = JSON.parse(localStorage.getItem('fav')) || [];
      lang.indexOf(1);
      lang.toLowerCase();
      lang = lang.split("/")[1];

      existingArray = JSON.parse(localStorage.getItem('fav')) || [];

      // Create a new object to push to the array
      let newObject = {
        id: id,
        image: image,
        name_ar: name_ar,
        name_en: name_en,
        price: price,
        qty: qty + 1,
        total: price,
        total_after_coupon: 0,
        coupon: "",
        lang: lang,

      };

      if ($(th).find('.fa-heart').css("color") == 'rgb(255, 255, 255)') {
        // $(th).attr('class','fa fa-heart full')

        th.find('.fa-heart').css('color', 'rgb(255, 0, 0)')
        let objectExists = existingArray.some(obj => obj.id === newObject.id);


        // Step 3: If the object doesn't exist, push it into the array
        if (!objectExists) {
          existingArray.push(newObject);
        }
        // Push the new object to the array

        // Convert the updated array to a JSON string
        let updatedArray = JSON.stringify(existingArray);

        // Save the updated array back to local storage
        localStorage.setItem('fav', updatedArray);

        var msg = '';
        if (lang == 'ar') {
          msg = 'تمت الإضافة إلى المفضلة بنجاح';
        }
        if (lang == 'en') {
          msg = 'Add To Favourite Successfully';
        }
        Swal.fire({
          position: 'top-end', // Positioning the modal in the top-right corner
          title: msg,
          timer: 1000, // 2 seconds
          showConfirmButton: false,
          customClass: {
            popup: 'custom-width' // Applying a custom CSS class to the popup
          },


        });
        var sum = 0;
        let myArray = JSON.parse(localStorage.getItem('fav')) || [];

        myArray.forEach(item => {
          sum += item.qty

        });

      }

      if ($(th).find('.fa-heart').css("color") == 'rgb(255, 0, 0)' && fav.length > 0) {
        let fav = JSON.parse(localStorage.getItem('fav')) || [];
        fav.forEach(item => {

          if (item.id == id) {

            fav = fav.filter(item => item.id !== parseInt(newObject.id));

            // Store the updated cart back in localStorage
            localStorage.setItem('fav', JSON.stringify(fav));
            $(th).find('.fa-heart').css("color", "rgb(255, 255, 255)")

            if (lang == 'ar') {
              msg = 'تمت  الإزالة من المفضلة بنجاح';
            }
            if (lang == 'en') {
              msg = 'Remove From Favourite Successfully';
            }
            Swal.fire({
              position: 'top-end', // Positioning the modal in the top-right corner
              title: msg,
              timer: 1000, // 2 seconds
              showConfirmButton: false,
              customClass: {
                popup: 'custom-width' // Applying a custom CSS class to the popup
              },


            });
            location.reload()

          }


        })
      }



    },
    error: function (error) {
      console.log(error)
    }
  });
})
$(document).on('click', '#btn-fav-button', function (e) {
  e.preventDefault();
  var th = $(this);

  $.ajax({
    type: 'get',
    url: th.attr('href'),
    success: function (response) {

      var id = response.product.id
      var name_ar = response.product.name_ar
      var name_en = response.product.name_en
      var image = response.product.files[0]['name']
      var price = 0;
      if (response.product.new_selling_price == null) {
        price = response.product.selling_price
      } else {
        price = response.product.new_selling_price
      }
      var qty = 0;
      var lang = $(location).attr('pathname');

      var fav = JSON.parse(localStorage.getItem('fav')) || [];
      lang.indexOf(1);
      lang.toLowerCase();
      lang = lang.split("/")[1];

      existingArray = JSON.parse(localStorage.getItem('fav')) || [];

      // Create a new object to push to the array
      let newObject = {
        id: id,
        image: image,
        name_ar: name_ar,
        name_en: name_en,
        price: price,
        qty: qty + 1,
        total: price,
        total_after_coupon: 0,
        coupon: "",
        lang: lang,

      };

      let objectExists = existingArray.some(obj => obj.id === newObject.id);


      // Step 3: If the object doesn't exist, push it into the array
      if (!objectExists) {
        existingArray.push(newObject);
      }
      // Push the new object to the array

      // Convert the updated array to a JSON string
      let updatedArray = JSON.stringify(existingArray);

      // Save the updated array back to local storage
      localStorage.setItem('fav', updatedArray);
      // $(th).css('color','red')
      th.find('span').addClass('fa fa-heart full');
      th.find('span').css('color', 'red');
      th.find('span').removeClass('icon_heart_alt');
      var msg = '';
      if (lang == 'ar') {
        msg = 'تمت الإضافة إلى المفضلة بنجاح';
      }
      if (lang == 'en') {
        msg = 'Add To Favourite Successfully';
      }
      Swal.fire({
        position: 'top-end', // Positioning the modal in the top-right corner
        title: msg,
        timer: 1000, // 2 seconds
        showConfirmButton: false,
        customClass: {
          popup: 'custom-width' // Applying a custom CSS class to the popup
        },


      });
      var sum = 0;
      let myArray = JSON.parse(localStorage.getItem('fav')) || [];

      myArray.forEach(item => {
        sum += item.qty

      });

      if (objectExists) {
        let fav = JSON.parse(localStorage.getItem('fav')) || [];
        fav.forEach(item => {

          if (item.id == id) {

            fav = fav.filter(item => item.id !== parseInt(newObject.id));

            // Store the updated cart back in localStorage
            localStorage.setItem('fav', JSON.stringify(fav));
            // $(th).css("color"," ")
            th.find('span').removeClass('fa fa-heart full');
            th.find('span').css('color', ' ');
            th.find('span').addClass('icon_heart_alt');
            if (lang == 'ar') {
              msg = 'تمت  الإزالة من المفضلة بنجاح';
            }
            if (lang == 'en') {
              msg = 'Remove From Favourite Successfully';
            }
            Swal.fire({
              position: 'top-end', // Positioning the modal in the top-right corner
              title: msg,
              timer: 1000, // 2 seconds
              showConfirmButton: false,
              customClass: {
                popup: 'custom-width' // Applying a custom CSS class to the popup
              },


            });
            location.reload()

          }


        })
      }



    },
    error: function (error) {
      console.log(error)
    }
  });

})

$(document).on('click', '.destroy_fav', function (e) {
  e.preventDefault()
  let cart = JSON.parse(localStorage.getItem('fav')) || [];

  if (Array.isArray(cart)) {
    // Remove the item with id = 4

    cart = cart.filter(item => item.id !== parseInt($(this).attr('id')));

    // Store the updated cart back in localStorage
    localStorage.setItem('fav', JSON.stringify(cart));

  }
  var lang = $(location).attr('pathname');

  lang.indexOf(1);

  lang.toLowerCase();

  lang = lang.split("/")[1];
  var msg = '';
  if (lang == 'ar') {
    msg = 'تمت الإزالة من المفضلة بنجاح';
  }
  if (lang == 'en') {
    msg = 'Remove From Favourite Successfully';
  }
  Swal.fire({
    position: 'top-end', // Positioning the modal in the top-right corner
    title: msg,
    timer: 1000, // 2 seconds
    showConfirmButton: false,
    customClass: {
      popup: 'custom-width' // Applying a custom CSS class to the popup
    },
  });
  location.reload()
})
$(document).ready(function () {

  var featured__item__pic__hover = document.querySelectorAll('.item__pic')
  let myArray = JSON.parse(localStorage.getItem('fav')) || [];
  let input_qty = $('#pro_4').attr('value')
  var product_page_id = $(location).attr('pathname');
  product_page_id.indexOf(1);
  product_page_id.toLowerCase();
  product_page_id = product_page_id.split("/")[3];

  featured__item__pic__hover.forEach(freture_item => {

    myArray.forEach(item => {

      if (item.qty >= 1 && item.id == parseInt($(freture_item).attr('id'))) {
        $(freture_item).find('#heart-btn-new i').removeClass('fa-heart')
        $(freture_item).find('#heart-btn-new i').addClass('fa-heart full')
        $(freture_item).find('#heart-btn-new i').css('color', 'red')
        // $(freture_item).find('#heart-btn-new .fa-heart').css('color', 'red')
        if (item.id == parseInt(product_page_id)) {
          // $('#btn-fav-button .icon_heart_alt').css('color', 'red')
          $('#btn-fav-button').find('span').addClass('fa fa-heart full');
          $('#btn-fav-button').find('span').css('color', 'red');
          $('#btn-fav-button').find('span').removeClass('icon_heart_alt');
        }

      }


    })
  })
})




