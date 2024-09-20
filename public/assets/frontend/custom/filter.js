$(document).on('submit', '#search', function (e) {
  
  e.preventDefault()
  var action = $(this).attr("action");
  var token = $("meta[name='csrf-token']").attr("content");
  var data = $(this).serialize();
  var type = $(this).attr("method");
  var search = $(this).find('#input-search').val()
  var first = $(location).attr('pathname');
  first.indexOf(1);
  first.toLowerCase();
  first = first.split("/")[1];
  var url = window.location.href;
  var urlObj = new URL(url);
  var categoryValue = urlObj.searchParams.get("category");
  
  if (categoryValue) {
     var url = window.location.origin + `/${first}/shop/search?search=${search}&category=${categoryValue}`
  } else {
     var url = window.location.origin + `/${first}/shop/search?search=${search}`
  }

  $.ajax({
    url: url,
    type: 'GET',
    data: data,
    dataType: 'JSON',
    // dataType: "json",
    success: function (response) {
 
      window.location.href = url;
      
      // $(this).find('#input-search').attr("placeholder",search);
      // var element = $('.product_filter');

      element.scrollIntoView({behavior: "smooth"});
      $('#products').html(' ')
      $('#count').html(' ')
      $('#products').append(response.html)
      $('#count').append(response.count)
    
      
      $(this).find('#input-search').attr("placeholder",search);
      var element = document.getElementById("products");

      element.scrollIntoView({behavior: "smooth"});
   
    },
    error: function (err) {
      console.log(err);
    }
   
  });
 
})
$(document).ready(function(){
  var first = $(location).attr('pathname');
  first.indexOf(1);
  first.toLowerCase();
  first = first.split("/")[1];
  let searchParams = new URLSearchParams(window.location.search)
  let search = searchParams.get('search')
  $(this).find('#input-search').val(search)

      if (search) {
    
        var targetUrl = location.origin + `/${first}/shop`;
        // Find the link with the matching href
        var links = document.querySelectorAll(`a[href='${targetUrl}']`);
        // Do something with the found link
        if (links.length > 0) {
          const parentElement = links[0].parentElement
          $(parentElement).addClass('active');
          console.log(parentElement);
            // Perform your desired action here
        } else {
            console.log('No link found with the href:', targetUrl);
        }
      } 
    
  
})
$(document).on('click', '#search-link', function (e) {
  e.preventDefault()

  var action =  $(this).attr("href");
  var token = $("meta[name='csrf-token']").attr("content");
  var data = $(this).serialize();
  var type = $(this).attr("method");
  var id = $(location).attr('pathname');
  id.indexOf(1);

  id.toLowerCase();
  var lang = id.split("/")[1]
  id = id.split("/")[3];
  if (window.location.href == window.location.origin + `/${lang}`
    || window.location.href == window.location.origin +`/${lang}/compare` 
    || window.location.href == window.location.origin + `/${lang}/product/${id}` 
    || window.location.href == window.location.origin +`/${lang}/cart` 
    || window.location.href == window.location.origin +`/${lang}/fav` 
    || window.location.href == window.location.origin +`/${lang}/checkout` 
    || window.location.href == window.location.origin +`/${lang}/contac_us` 
    || window.location.href == window.location.origin +`/${lang}/complaiment` 
    || window.location.href == window.location.origin +`/${lang}/about_us`
    ||window.location.href == window.location.origin + `/${lang}#` 
    ||window.location.href == window.location.origin + `/${lang}/` 
  ) {

     window.location.href =action;
  

  }else{
    action =action
  }
  $.ajax({
    url: action,
    type: 'GET',
    data: { _token: token },
    dataType: 'JSON',
    // dataType: "json",
    success: function (response) {
      $(document).find('.hero.hero-normal .hero__categories ul').css('display', 'none')
     
      $('#products').html(' ')
      $('#count').html(' ')
      $('#products').append(response.html)
      $('#count').append(response.count)
     
      var element = document.getElementById("products");

      element.scrollIntoView({behavior: "smooth"});
      
    },
    error: function (err) {
      console.log(err);
    },
  });
})
$(document).on('click', '#featured', function (e) {

  e.preventDefault()
  var token = $("meta[name='csrf-token']").attr("content");
  var data = $(this).serialize();
  var type = $(this).attr("method");
  var id = $(location).attr('pathname');
  id.indexOf(1);

  id.toLowerCase();
  var lang = id.split("/")[1]
  id = id.split("/")[3];
  var cat  = $(this).attr('data-filter');
var action = window.location.origin + `/${lang}/featured_cat?category=${cat}`

  $.ajax({
    url: action,
    type: 'GET',
    data: { _token: token },
    dataType: 'JSON',
    // dataType: "json",
    success: function (response) {
      console.log(response.html)
      $('#featured__filter').html(' ')
      $('#featured__filter').append(response.html)
      
    },
    error: function (err) {
      console.log(err);
    },
  });
})
$(document).ready(function() {
  // Function to get the value of a query parameter
  function getParameterByName(name, url) {
      if (!url) url = window.location.href;
      name = name.replace(/[\[\]]/g, "\\$&");
      var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
          results = regex.exec(url);
      if (!results) return null;
      if (!results[2]) return '';
      return decodeURIComponent(results[2].replace(/\+/g, " "));
  }

  // Get the category parameter from the URL
  
});
$(".price-range").slider({change: function(event, ui) {
      var first = $(location).attr('pathname');
   
    first.indexOf(1);

    first.toLowerCase();
  
    first = first.split("/")[1];
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const category = urlParams.get('category')

    var min = $('#minamount').val()
    var max = $('#maxamount').val()
   
    var token = $("meta[name='csrf-token']").attr("content");

    var filter = '';

    $("#spinner-border").show();
    $.ajax({
     url: window.location.origin+`/${first}/shop/search`,
    type: 'GET',
    data: {_token: token,min:min,max:max,filter:filter ,category:category},
    dataType: 'JSON',
   // dataType: "json",
    success: function (response) {
    $('#products').html(' ')
     $('#count').html(' ')

     $('#products').append(response.html)
     $('#count').append(response.count)
     var element = document.getElementById("products");

     element.scrollIntoView({behavior: "smooth"});
    },
    error: function (err) {
       console.log(err);
    },
    complete: function() {$("#spinner-border").hide(); }
});
}});

//   $(document).on('mouseup','.price-range',function(){

//     var first = $(location).attr('pathname');

//     first.indexOf(1);

//     first.toLowerCase();

//     first = first.split("/")[1];

//     var min = $('#minamount').val()
//     var max = $('#maxamount').val()
//     var token = $("meta[name='csrf-token']").attr("content");

//     var filter = '';

//     $("#spinner-border").show();
//     $.ajax({
//      url: window.location.origin+`/${first}/shop/search`,
//     type: 'GET',
//     data: {_token: token,min:min,max:max,filter:filter },
//     dataType: 'JSON',
//    // dataType: "json",
//     success: function (response) {
//     $('#products').html(' ')
//      $('#count').html(' ')

//      $('#products').append(response.html)
//      $('#count').append(response.count)
//     },
//     error: function (err) {
//        console.log(err);
//     },
//     complete: function() {$("#spinner-border").hide(); }
// });
//   })



window.onload = function() {
  setTimeout(() => {
    const targetElement = document.querySelector('#products');
    if (targetElement) {
      targetElement.scrollIntoView({ behavior: 'smooth' });
    }
  }, 100); // Delay to ensure the page is fully loaded
 }
