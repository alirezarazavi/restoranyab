$(window).load(function(){

    // Index > Partners
    $('.partner').BlackAndWhite({
        hoverEffect : true, // default true
        // set the path to BnWWorker.js for a superfast implementation
        webworkerPath : false,
        // for the images with a fluid width and height 
        responsive:true,
        // to invert the hover effect
        invertHoverEffect: true,
        // this option works only on the modern browsers ( on IE lower than 9 it remains always 1)
        intensity:1,
        speed: { //this property could also be just speed: value for both fadeIn and fadeOut
            fadeIn: 200, // 200ms for fadeIn animations
            fadeOut: 800 // 800ms for fadeOut animations
        },
        onImageReady:function(partner) {
        	// this callback gets executed anytime an image is converted
        }
    });

    // Index > Categories
    $('.category a').click(function(e){
        var catId = $(this).attr('id');
        $.ajax({
            type    :   'GET',
            data    :   'catId='+catId,
            success :   function(data){
                window.location.reload();
            }
        });
        e.preventDefault();
    });
    // $('.subCategories li a').click(function(e) {
    //     alert($(this).attr('id'));
    //     e.preventDefault();
    // });


    // List > Checkbox
    $('input').iCheck({
        checkboxClass: 'icheckbox_minimal-red',
        radioClass: 'iradio_minimal-red'
    });

    // Single > Add to Favs
    $('.prevent').click(function(e){
        alert('برای اضافه کردن این رستوران به علاقه‌مندی‌ها باید ابتدا وارد حساب کاربری خود شوید.');
        e.preventDefault();
    });
    $('#fav').click(function(e){
        $.ajax({
            type:   'GET',
            data:   'fav=fav',
            success: function(){ 
                if ($('#fav').text() == 'حذف از علاقه‌مندی‌ها') {
                    $('#fav').text('افزودن به علاقه‌مندی‌ها');
                    $('#fav').removeClass('remove_fav');
                    $('#fav').addClass('add_fav');
                } else {
                    $('#fav').text('حذف از علاقه‌مندی‌ها');
                    $('#fav').removeClass('add_fav');
                    $('#fav').addClass('remove_fav');
                }
            }
        });
        e.preventDefault();
    });

    // Single > Rating
    $('.rate').raty({ 
        path    : '../assets/images/stars',
        starOff : 'bar-off.png',
        starOn  : 'bar-on.png',
        starHalf: 'bar-half.png',
        hints   : ['خیلی بد','بد','متوسط','خوب','خیلی خوب'],
        width   :  150,
        half    : true,
        score   : function() { 
                    return $(this).attr('data-score');
                },
        click   : function(score, evt) {
            $.ajax({
                type    : 'GET',
                data    : 'type='+$(this).attr('id')+'&score='+score,
                error   : function(data){
                    alert ('برای ثبت امتیاز ابتدا باید وارد حساب کاربری خود شوید.');
                }
            })

        }
    });

    // Single > Total Score
    $(".total_score").knob({
        'skin': 'tron',
        'width': 100,
        'height': 100,
        'cursor': false,
        'readOnly': true,
        'bgColor': '#A1A1A1',
        'fgColor': '#FEB914',
        'font': 'yekan',
        
    });

    // disable rate
    // if($('.place_rate').hasClass('read')) {
    //     $('.rate').raty({
    //         path    : '/assets/images/stars',
    //         starOff : 'star-off.png',
    //         starOn  : 'star-on.png',
    //         half    : true,
    //         // readOnly: true,
    //         // noRatedMsg: 'برای ثبت امتیاز ابتدا باید وارد حساب کاربری خود شوید',
    //     });
    // }

});