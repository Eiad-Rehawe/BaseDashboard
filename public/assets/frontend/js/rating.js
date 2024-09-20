   document.addEventListener('DOMContentLoaded', function() {
    var ratingElements = document.querySelectorAll('.rating .fa-star');
    var token = $("meta[name='csrf-token']").attr("content");
    var productId=$('#productId').attr('class');
    var product_related = $('#product_related').attr('class');
    // for(let j=0; j<$('#count_products').attr('value'); j++){
    //      productId = $(`#rating_${j}`).attr('class')
    //             }
    //             console.log(productId)
    ratingElements.forEach(function(star) {
        star.addEventListener('click', function(e) {
            e.preventDefault()
            var rating = this.getAttribute('data-value');
            var ratingContainer = this.parentElement;
           
            // Update the filled stars
            ratingContainer.setAttribute('data-rating', rating);
            
            ratingElements.forEach(function(innerStar) {
                var starValue = innerStar.getAttribute('data-value');
                console.log(starValue)
                if (starValue <= rating && $('#auth').val() != '') {
                    
                    // innerStar.classList.remove('fa-star-o');
                    innerStar.classList.add('text-warning');
                    // $('.fa-star').css('background','yellow')
                
                } 
               
                else {
                    console.log(2)
                    // innerStar.style.color= '#fff'
                    // innerStar.classList.remove('fa-star');
                    innerStar.classList.remove('text-warning');
                    // $('.fa-star').css('background','yellow')
                    
                   
                }
            });
            $.ajax({
            url: window.location.origin+'/rating/store',
            method: 'POST',
            data: {
                _token: token,
                product_id: productId,
                rating: rating
            },
            success: function(response) {
                if (response.success) {
                    swal.fire(response.message);

                }
            },
            error: function(error,response,xhr,jqXHR) {
                if(xhr == 'Forbidden'){
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
            }
        });
            console.log("User rating: " + rating);
        });
    });
});
  

