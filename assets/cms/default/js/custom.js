$(document).ready(function () {
    //vazgeç işlemi ve yönlendirme
    $('#btn_cancel').click(function () {
        swal({
                title: "Emin misiniz?",
                text: "Yapılan değişiklikler kaybolacak.",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "green",
                confirmButtonText: "Evet",
                cancelButtonText: "Hayır",
                closeOnConfirm: true,
                closeOnCancel: true
            },
            function (isConfirm) {
                if (isConfirm) {
                    window.location.href = HTTP_REFERER;
                }
            });

        return false;
    });

    //silme işlemi ve yönlendirme
    $('.remove-data').click(function () {
        var url = $(this).attr('data-href');
        swal({
                title: "Emin misiniz?",
                text: "Silinen öğeler geri getirilemez",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "green",
                confirmButtonText: "Evet",
                cancelButtonText: "Hayır",
                closeOnConfirm: true,
                closeOnCancel: true
            },
            function (isConfirm) {
                if (isConfirm) {
                    document.location.href = url;
                }
            });

        return false;
    });

    //parola input görüntüleme
    $('.input-password').each(function (index, el) {
        var eye = $(this).parent().parent().find('.eye');
        $(this).find('.show-password').mousedown(function () {
            $(this).parent().parent().find('.password').attr('type', 'text');
            eye.addClass('fa-eye-slash');
            eye.removeClass('fa-eye');
        });
        $(this).find('.show-password').mouseup(function () {
            $(this).parent().parent().find('.password').attr('type', 'password');
            eye.removeClass('fa-eye-slash');
            eye.addClass('fa-eye');
        });
    });

    //bootstrap tooltip
    $('[data-toggle="tooltip"]').tooltip();

    //popup bir daha gösterme
    $('.dont_show').click(function () {

        var url = $(this).data('url');
        var id = $(this).data('id');

        var data = {
            url: url,
            id: id
        }

        var csrf_key = $(this).data("csrf-key");
        var csrf_value = $(this).data("csrf-value");

        data[csrf_key] = csrf_value;

        $.post(url, data, function () {

        })
    })

    //sidebar aktif class
    var i = $('.sidebar-menu li.active').parents('li').addClass('active');

    //Yukarı Çık
    $("#ScrollTop").click(function() {
        $("html,body").stop().animate({ scrollTop: "0" }, 1000);
    });
});

//Form Elemanlarını temizleme
function resetForm() {
    $('form input[type = text], form input[type = email], form input[type = number], form input[type = password], form textarea').val('');
    $('form textarea').text('');
    $('.data_file').val('');

    $('input.flat-red').each(function (index, element) {
        $(element).iCheck('uncheck');
    });
    $('.refresh-captcha').trigger('click');
}


//resim önizleme
function onizle(onizleme) {
    var preview = $("."+onizleme);
    $("."+onizleme).html("");
    var input = $(event.currentTarget);
    var file = input[0].files[0];
    var reader = new FileReader();
    reader.onload = function (e) {
        image_base64 = e.target.result;
        preview.append("<img class=\"img-responsive thumbnail\" src='" + image_base64 + "' width='350' height='217'/>");
    };
    reader.readAsDataURL(file);
}



function tc_kimlik_kontrol(tcno) {
    var tckontrol,toplam; tckontrol = tcno; tcno = tcno.value; toplam = Number(tcno.substring(0,1)) + Number(tcno.substring(1,2)) +
        Number(tcno.substring(2,3)) + Number(tcno.substring(3,4)) +
        Number(tcno.substring(4,5)) + Number(tcno.substring(5,6)) +
        Number(tcno.substring(6,7)) + Number(tcno.substring(7,8)) +
        Number(tcno.substring(8,9)) + Number(tcno.substring(9,10));
    strtoplam = String(toplam); onunbirlerbas = strtoplam.substring(strtoplam.length,strtoplam.length-1);

    if(onunbirlerbas == tcno.substring(10,11)) {
        $('.btn_save').show();
    } else{
        $('.btn_save').hide();
        $.notify("Tc Kimlik Numarasını Hatalı Girdiniz...", 'error');
    }
}

function hesapla(){

    var ft_fatura_tutar=parseFloat(document.getElementById("ft_fatura_tutar").value)
    var ft_doviz_kuru=parseFloat(document.getElementById("ft_doviz_kuru").value)
    var ft_odenecek_tutar=ft_fatura_tutar*ft_doviz_kuru
    if(!isNaN(ft_odenecek_tutar))(document.getElementById("ft_odenecek_tutar").value=ft_odenecek_tutar.toFixed(2))
}