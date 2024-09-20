<script src="{{ asset('assets/frontend/js/jquery-3.3.1.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>

<script src="{{ asset('assets/frontend/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/frontend/js/jquery.nice-select.min.js') }}"></script>
<script src="{{ asset('assets/frontend/js/jquery-ui.min.js') }}"></script>
<script src="{{ asset('assets/frontend/js/jquery.slicknav.js') }}"></script>
<script src="{{ asset('assets/frontend/js/mixitup.min.js') }}"></script>
<script src="{{ asset('assets/frontend/js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('assets/frontend/js/main.js') }}"></script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="{{ asset('assets/frontend/custom/script.js') }}"></script>
<script src="{{ asset('assets/frontend/custom/cart.js') }}"></script>
@auth
<script src="{{ asset('assets/frontend/custom/favourite_ajax.js') }}"></script>
    @else
    <script src="{{ asset('assets/frontend/custom/favourite.js') }}"></script>
@endauth

<script src="{{ asset('assets/frontend/custom/filter.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-star-rating/4.0.7/js/star-rating.min.js"></script>
<script src="{{ asset('assets/frontend/js/rating.js') }}"></script>
<script src="https://unpkg.com/@zxing/library@latest"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script src="//unpkg.com/javascript-barcode-reader"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/js/bootstrap-select.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/quagga/0.12.1/quagga.min.js"></script>
<script src="{{ asset('assets/frontend/custom/scanners.js') }}"></script>


<script>
    $(document).on('click','#view',function(e){
      
        e.preventDefault()
        window.location.href = $(this).attr('href')
    })
   
</script>
<script>
 
$(document).on('click', '#all', function (e) {
  e.preventDefault();
  $(this).addClass("active");
  var featured__item= document.querySelectorAll('.featured__item')
  featured__item.forEach(element => {
    $(element).show();
  })
})


</script>

<script>
  $(document).ready(function() {
      $("#myList li").click(function() {
          $("#myList li").removeClass("active");
          $(this).addClass("active");
      });
  });
</script>

<script>
   function dropdown()
        {
            if(document.getElementById(window.event.srcElement.id+'menu').style.display=='block'){
                document.getElementById(window.event.srcElement.id+'menu').style.display='none';
            }
            else{ 
                document.getElementById(window.event.srcElement.id+'menu').style.display='block';
            }
        };
</script>
  {{-- <script>
    $(document).ready(function(){
        $('.dropdown-toggle').on('click', function(e){
            e.stopPropagation();
            $(this).next('.dropdown-menu').toggleClass('show');
        });

        $('.dropdown-submenu .dropdown-toggle').on('click', function(e){
            e.stopPropagation();
        
            $(this).next('.dropdown-menu .dropdown-item').toggleClass('show');
        });

        // Handle closing dropdowns when clicking outside
        $(document).on('click', function(){
            $('.dropdown-menu').removeClass('show');
        });
    });
</script>   --}}


<script>
function myFunction() {
  $(".dropdown .dropdown-content ").css('display','block')
      // document.getElementById("myDropdown").classList.toggle("show");
}


// إغلاق القائمة المنسدلة إذا نقر المستخدم في أي مكان خارجها
window.onclick = function(event) {
    if (!event.target.matches('.dropbtn')) {
        var dropdowns = document.getElementsByClassName("dropdown-content");
        var i;
        for (i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (openDropdown.classList.contains('show')) {
                openDropdown.classList.remove('show');
            }
        }
    }
}

// function showDiv(id) {
//     document.getElementById(`dropdownContent_${id}`).style.display = "block";
// }

// function hideDiv(id) {
//     document.getElementById(`dropdownContent_${id}`).style.display = "none";
// }


  </script>





@stack('scripts')