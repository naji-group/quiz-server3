$(document).ready(function() {
    $('h1').addClass('animate__fadeInDown');
    
    // التحقق من حجم الشاشة
    if ($(window).width() > 768) {
        // تطبيق التأثير على كل مجموعة من بطاقتين في الشاشات الكبيرة
        $('.card-container').children().each(function(index) {
            if (index % 2 === 0) {
                var cards = $(this).add($(this).next());
                cards.delay(index * 200).queue(function(next) {
                    cards.addClass('animate__fadeInUp');
                    next();
                });
            }
        });
    } else {
        // تطبيق التأثير على كل بطاقة على حدة في الشاشات الصغيرة
        $('.scard').each(function(index) {
            $(this).delay(index * 200).queue(function(next) {
                $(this).addClass('animate__fadeInUp');
                next();
            });
        });
    }
});
