var existingArray = [];

// add to cart from li
$(document).on('click', '#btn-cart', function (e) {
  e.preventDefault();
  var th = $(this);

  th.parent('li').parent('.item__pic').find('#destroy').css('display', 'block')
  th.parent('li').parent('.item__pic').css('margin-left', '25px')
  var cart = parseInt($('#cart div').html()) + 1
  $('#cart div').text(cart)

  var id = parseInt($(this).attr('class'))
  var image = th.find('.image').attr('id')
  var name = th.find('.crt').attr('id')
  var price = th.find('.final_price').attr('id')
  var qty = 0;
  var lang = $(location).attr('pathname');
  var product_related = th.find('.product_related').attr('id')

  lang.indexOf(1);

  lang.toLowerCase();

  lang = lang.split("/")[1];
  $(this).parent('li').html(`<a href="#" class="${id}" id="btn-cart-plus">
    <div style="display:none" class="crt" id="${name}"></div>
    <div class="
                    final_price" id="${price}" style="display: none"></div>
                    <div style="display:none" class="product_related" id="${product_related}"></div>

    <i class="fa fa-plus">${qty + 1}</i>
</a>`)

  existingArray = JSON.parse(localStorage.getItem('cart')) || [];

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
    product_related: product_related,
    
  };

  let objectExists = existingArray.some(obj => obj.id === newObject.id || parseInt(obj.product_related) === newObject.id);


  // Step 3: If the object doesn't exist, push it into the array
  if (!objectExists) {
    existingArray.push(newObject);
  }
  // Push the new object to the array

  // Convert the updated array to a JSON string
  let updatedArray = JSON.stringify(existingArray);

  // Save the updated array back to local storage
  localStorage.setItem('cart', updatedArray);

  var msg = '';
  if (lang == 'ar') {
    msg = 'تمت الإضافة إلى السلة بنجاح';
  }
  if (lang == 'en') {
    msg = 'Add To Cart Successfully';
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
  let myArray = JSON.parse(localStorage.getItem('cart')) || [];

  myArray.forEach(item => {
    sum +=parseInt( item.qty)

  });
  $('.customizer-btn span').text(sum)
})
//add to cart from button

$(document).on('click', '#btn-cart-button', function (e) {
  e.preventDefault();
  var th = $(this);
  var id = parseInt($(this).attr('href'))
  var image = th.find('.image').attr('id')
  var name = th.find('.crt').attr('id')
  var price = th.find('.final_price').attr('id')
  var product_related = th.find('.product_related').attr('id')
  var qty = parseInt($('.pro-qty input').val());
  let myArray = JSON.parse(localStorage.getItem('cart')) || [];
  var lang = $(location).attr('pathname');

  lang.indexOf(1);

  lang.toLowerCase();

  lang = lang.split("/")[1];
  var cart_total = 1;

  if (myArray.length == 0 || myArray.length == 1) {

    $('.customizer-btn span').text(qty)
  } 
  if (myArray.length > 1) {
    myArray.forEach(item => {
      cart_total += parseInt(item.qty)

    })
  
    $('.customizer-btn span').text(cart_total)
  }

  var product_page_id = $(location).attr('pathname');
  product_page_id.indexOf(1);
  product_page_id.toLowerCase();
  product_page_id = product_page_id.split("/")[3];
  existingArray = JSON.parse(localStorage.getItem('cart')) || [];

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

  let objectExists = existingArray.some(obj => obj.id === newObject.id || parseInt(obj.product_related) === newObject.id);


  if (!objectExists) {

    existingArray.push(newObject);
    // $('.customizer-btn span').text(qty)

  }

  let updatedArray = JSON.stringify(existingArray);

  // Save the updated array back to local storage
  localStorage.setItem('cart', updatedArray);

  let tt = 0;
  if (objectExists) {
    myArray.forEach(item => {

      if (product_page_id == item.id || item.product_related == product_related) {
        tt += parseInt(item.qty)
        tt = qty
        item.qty = tt
        item.total = parseInt(item.price * item.qty)
        localStorage.setItem('cart', JSON.stringify(myArray));

      }
      cart_total += parseInt(item.qty)



    });
  }

  // var sum =0;
  // myArray.forEach(item => {
  //   if(product_page_id=item.id){
  //     item.qty=sum
  //     sum +=parseInt(item.qty)

  //   }

  // });
  // $('.customizer-btn span').text(sum)

  var msg = '';
  if (lang == 'ar') {
    msg = 'تمت الإضافة إلى السلة بنجاح';
  }
  if (lang == 'en') {
    msg = 'Add To Cart Successfully';
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



})
$(document).on('click', '#btn-cart-button-new', function (e) {
  e.preventDefault();

  var th = $(this);
  var myArray = JSON.parse(localStorage.getItem('cart')) || [];
  var lang = $(location).attr('pathname');
  var cart_total = 1;

  lang.indexOf(1);

  lang.toLowerCase();

  lang = lang.split("/")[1];

  $.ajax({
    type: 'get',
    url: th.attr('href'),
    success: function (response) {

      var id = response.product.id
      var name_ar = response.product.name_ar
      var name_en = response.product.name_en
      var image = response.product.files[0]['name']
      var price = 0;
      if(response.product.new_selling_price == null){
        price = response.product.selling_price
      }else{
        price = response.product.new_selling_price
      }
      var qty =parseInt($(`#pro_${id}`).val());
     
      var lang = $(location).attr('pathname');
    
      lang.indexOf(1);

      lang.toLowerCase();
    
      lang = lang.split("/")[1];
     
    existingArray = JSON.parse(localStorage.getItem('cart')) || [];

    // Create a new object to push to the array
    let newObject = {
      id: id,
      image: image,
      name_ar: name_ar,
      name_en:name_en,
      price: price,
      qty: qty,
      total: price,
      total_after_coupon: 0,
      coupon: "",
      lang: lang,
   
    };
   
    let objectExists = existingArray.some(obj => obj.id === newObject.id );


    // Step 3: If the object doesn't exist, push it into the array
    if (!objectExists) {
      existingArray.push(newObject);
    }
    if(existingArray.length == 1){
      $('.customizer-btn span').text(qty)
    }
    var tt = 0;
   var cart_total=0;
    if (objectExists) {
    
      existingArray.forEach(item => {
  
        if (id == item.id ) {
          
          tt += parseInt(item.qty)
          tt = qty
          item.qty = tt
         
          item.total = parseInt(item.price * item.qty)
        
        }
    
        cart_total += parseInt(item.qty)
      
      });

      $('.customizer-btn span').text(cart_total)
    
    }
    // Push the new object to the array
  
    // Convert the updated array to a JSON string
    let updatedArray = JSON.stringify(existingArray);
  
    // Save the updated array back to local storage
    localStorage.setItem('cart', updatedArray);

    var msg = '';
    if (lang == 'ar') {
      msg = 'تمت الإضافة إلى السلة بنجاح';
    }
    if (lang == 'en') {
      msg = 'Add To Cart Successfully';
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
 
    },
    error: function (err) {
       console.log(err);
    },
});

})
//increse quantity on cart
$(document).on('click', '#btn-cart-plus', function (e) {

  e.preventDefault();
  var th = $(this)

  let myArray = JSON.parse(localStorage.getItem('cart')) || [];
  var qty = 0;
  var lang = $(location).attr('pathname');
 

  lang.indexOf(1);

  lang.toLowerCase();

  lang = lang.split("/")[1];
  
  // var plus = parseInt(th.find('.fa-plus').text())
  var count = 1
  // th.find('.fa-plus').text(count)

  myArray.forEach(item => {
 
    if (item.id == $(this).attr('class') ) {
      count += parseInt(item.qty)
      th.find('.fa-plus').text(count)
      var btn_cart_plus = document.querySelectorAll('#btn-cart-plus')
      btn_cart_plus.forEach(plus=>{
        if(parseInt($(plus).attr('class')) == item.id ){
          $(plus).find('.fa-plus').text(count)
        }
        
      })
      item.qty = count
      item.total = parseInt(item.qty * item.price)
    }
   
   
   
    localStorage.setItem('cart', JSON.stringify(myArray));

  });
  
  th.parent('li').parent('.product__item__pic__hover').find('#destroy').css('display', 'block')
  if (lang == 'en') {
  // th.parent('li').parent('.product__item__pic__hover').css('margin-left', '25px')

  }
  if (lang == 'ar') {
    // th.parent('li').parent('.product__item__pic__hover').css('margin-right', '25px')
    th.parent('li').parent('.product__item__pic__hover').find('#destroy').css('margin-right', '20px')

    }
  var msg = '';
  if (lang == 'ar') {
    msg = 'تمت الإضافة إلى السلة بنجاح';
  }
  if (lang == 'en') {
    msg = 'Add To Cart Successfully';
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
  myArray.forEach(item => {
    sum += parseInt(item.qty)

  });
  $('.customizer-btn span').text(sum)
})

$(document).on('click', '.destroy', function (e) {
  e.preventDefault()
  let cart = JSON.parse(localStorage.getItem('cart')) || [];

  if (Array.isArray(cart)) {
    // Remove the item with id = 4

    cart = cart.filter(item => item.id !== parseInt($(this).attr('id')));

    // Store the updated cart back in localStorage
    localStorage.setItem('cart', JSON.stringify(cart));

  }
  var lang = $(location).attr('pathname');

  lang.indexOf(1);

  lang.toLowerCase();

  lang = lang.split("/")[1];
  var msg = '';
  if (lang == 'ar') {
    msg = 'تمت الإزالة من السلة بنجاح';
  }
  if (lang == 'en') {
    msg = 'Remove From Cart Successfully';
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

$(document).on('click','#add-cart-new',function(e){
  e.preventDefault()
  var th = $(this);
  var myArray = JSON.parse(localStorage.getItem('cart')) || [];
  var lang = $(location).attr('pathname');
 

  lang.indexOf(1);

  lang.toLowerCase();

  lang = lang.split("/")[1];
  th.parent('li').parent('.item__pic').find('#destroy').css('display', 'block')
  if(lang == 'en'){
    // th.parent('li').parent('.item__pic').css('margin-left', '25px')
    // th.parent('li').parent('.item__pic').find('#destroy').css('margin-left', '60px')
  }
  if(lang == 'ar'){
    // th.parent('li').parent('.item__pic').css('margin-right', '25px')
    // th.parent('li').parent('.item__pic').find('#destroy').css('margin-right', '20px')
  }
  $.ajax({
    type: 'get',
    url: th.attr('href'),
    success: function (response) {

      var id = response.product.id
      var name_ar = response.product.name_ar
      var name_en = response.product.name_en
      var image = response.product.files[0]['name']
      var price = 0;
      if(response.product.new_selling_price == null){
        price = response.product.selling_price
      }else{
        price = response.product.new_selling_price
      }
      var qty = 0;
      var lang = $(location).attr('pathname');
    
      lang.indexOf(1);

      lang.toLowerCase();
    
      lang = lang.split("/")[1];
     
      var carts_button = document.querySelectorAll('#add-cart-new');
      carts_button.forEach(element=>{
        
         
          if($(element).parent('li').parent('ul').attr('id')== id){
            
            $(element).html(' ')
            $(element).parent('li').html(`<a href="#" class="${id}" id="btn-cart-plus">
            <div style="display:none" class="crt" id="${name}"></div>
            <div class="
                            final_price" id="${price}" style="display: none"></div>
        
            <i class="fa fa-plus">${qty + 1}</i>
        </a>`)
        $(element).parent('li').parent('ul').find(`destroy_${id}`).css('display', 'block')
        $(element).parent('li').parent('ul').css('margin-left', '25px')
           }
       
      })
      $(th).parent('li').html(`<a href="#" class="${id}" id="btn-cart-plus">
      <div style="display:none" class="crt" id="${name}"></div>
      <div class="
                      final_price" id="${price}" style="display: none"></div>
  
      <i class="fa fa-plus">${qty + 1}</i>
  </a>`)
   

    existingArray = JSON.parse(localStorage.getItem('cart')) || [];

    // Create a new object to push to the array
    let newObject = {
      id: id,
      image: image,
      name_ar: name_ar,
      name_en:name_en,
      price: price,
      qty: qty + 1,
      total: price,
      total_after_coupon: 0,
      coupon: "",
      lang: lang,
   
    };
   
    let objectExists = existingArray.some(obj => obj.id === newObject.id );


    // Step 3: If the object doesn't exist, push it into the array
    if (!objectExists) {
      existingArray.push(newObject);
    }
    // Push the new object to the array
  
    // Convert the updated array to a JSON string
    let updatedArray = JSON.stringify(existingArray);
  
    // Save the updated array back to local storage
    localStorage.setItem('cart', updatedArray);
  
    var msg = '';
    if (lang == 'ar') {
      msg = 'تمت الإضافة إلى السلة بنجاح';
    }
    if (lang == 'en') {
      msg = 'Add To Cart Successfully';
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
    var sum = 1;
   
  
    myArray.forEach(item => {
      sum +=parseInt( item.qty)
  
    });
    $('.customizer-btn span').text(sum)
    },
    error: function (err) {
       console.log(err);
    },
});
})
$(document).ready(function () {

  var featured__item__pic__hover = document.querySelectorAll('.item__pic')
  let myArray = JSON.parse(localStorage.getItem('cart')) || [];
  let input_qty = $('#pro_4').attr('value')
  var product_page_id = $(location).attr('pathname');
  product_page_id.indexOf(1);
  product_page_id.toLowerCase();
  product_page_id = product_page_id.split("/")[3];
  var lang = $(location).attr('pathname');
  var qq =0;
  lang.indexOf(1);

  lang.toLowerCase();

  lang = lang.split("/")[1];
  myArray.forEach(item => {
  qq+=parseInt(item.qty)
  })
  $('.customizer-btn span').text(qq)
  
  featured__item__pic__hover.forEach(freture_item => {
  
    myArray.forEach(item => {
    
      if (item.qty >= 1 && item.id == parseInt($(freture_item).attr('id'))) {
       
        qq += parseInt(item.qty);
        $(freture_item).find('#destroy').css('display', 'block')
       if(lang == 'en'){
        // $(freture_item).css('margin-left', '25px')
        // $(freture_item).find('#destroy').css('margin-left', '60px')

       }
       if(lang == 'ar'){
        // $(freture_item).css('margin-right', '25px')
        // $(freture_item).find('#destroy').css('margin-right', '20px')

       }
       $(freture_item).find('#add-cart-new').parent('li').html(' ')
   
        $(freture_item).append(`<li>
        <a href="#" class="${item.id}" id="btn-cart-plus">
        <div style="display:none" class="crt" id="${item.name}"></div>
        <div class="
                        final_price" id="${item.price}" style="display: none"></div>
    
        <i class="fa fa-plus">${item.qty}</i>
    </a>
        </li>`)
        // $(freture_item).find('#add-cart-new').remove()
      }
    
    
      if (item.id == parseInt(product_page_id)) {
       
       var id__ = '';
        if(item.id == parseInt(product_page_id) ){
          id__ =item.id
         
        }
      
       
        $(`#pro_${id__}`).attr('value', item.qty)

      }


    })

  })

})