<!-- Including Jquery -->
<script src="{{ asset('assets/frontend/assets') }}/js/vendor/jquery-min.js"></script>
<script src="{{ asset('assets/frontend/assets') }}/js/vendor/js.cookie.js"></script>
<!--Including Javascript-->
<script src="{{ asset('assets/frontend/assets') }}/js/plugins.js"></script>
<script src="{{ asset('assets/frontend/assets') }}/js/main.js"></script>

{{-- toster js --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

<!-- Photoswipe Gallery -->
<script src="{{ asset('assets/frontend/assets') }}/js/vendor/photoswipe.min.js"></script>

{{-- jquery autocompleate --}}
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

<!--Newsletter Popup Cookies-->
{{-- <script>
                function newsletter_popup() {
                    var cookieSignup = "cookieSignup", date = new Date();
                    if ($.cookie(cookieSignup) != 'true' && window.location.href.indexOf("challenge#newsletter-modal") <= -1) {
                        setTimeout(function () {
                            $.magnificPopup.open({
                                items: {
                                    src: '#newsletter-modal'
                                }
                                , type: 'inline', removalDelay: 300, mainClass: 'mfp-zoom-in'
                            }
                            );
                        }
                        , 5000);
                    }
                    $.magnificPopup.instance.close = function () {
                        if ($("#dontshow").prop("checked") == true) {
                            $.cookie(cookieSignup, 'true', {
                                expires: 1, path: '/'
                            }
                            );
                        }
                        $.magnificPopup.proto.close.call(this);
                    }
                }
                newsletter_popup();
            </script> --}}
<!--End Newsletter Popup Cookies-->
<script>
    $(document).ready(function() {
        // $(document).on('change', '#amount', function(){
        //     alert('dsfasf');
        // });
        // alert($('#amount').val());
        // alert($('#amount').val().split(' ')[0].split('$')[1]);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        // price filter in shop page
        $('#frice_filter_form').submit(function(e) {
            e.preventDefault();


            // let filet_price_data = new FormData($('#frice_filter_form')[0]);
            var amount = $('#amount').val();


            $.ajax({
                type: 'get',
                url: "{{ route('product.price.filter') }}",
                data: {
                    'amount': amount
                },
                success: function(response) {
                    console.log(response);
                    $('.shop_product').hide();
                    if (response.not_pound) {
                        $('.not_found').removeClass('d-none');
                        $('.price_filter_product').html(' ');
                    } else {

                        $('.price_filter_product').html(response);
                        $('.not_found').addClass('d-none');
                    }

                }
            });
        });

        // remove product form cart
        $('.remove_cart').click(function() {
            var id = $(this).attr('id');
            $.ajax({
                type: 'get',
                url: "{{ route('frontend.cart.product.remove') }}",
                data: {
                    'id': id
                },

                success: function(response) {
                    if (response.success) {
                        //     $('#header').load(location.href + ' #header');
                        //    $('#cart-drawer').load(location.href + ' #cart-drawer');
                        //    $('#cart_table').load(location.href + ' #cart_table');
                        location.reload();
                    }
                }
            });

        });


        // jquery autocompleate
        $.ajax({
            type:'get',
            url:"{{ route('featch.product') }}",
            success:function(response){
                console.log(response);
                setAutocomplete(response);
            }
        });

        function setAutocomplete(products_name){
            $("#product_search").autocomplete({
                source: products_name
        });
        }



    });
</script>
{{-- partial login --}}
