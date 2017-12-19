$(document).ready(function () {

    $.validator.setDefaults({ ignore: ":hidden:not(select)" });
    $('#register_form').validate({
        rules:{
            full_name:{
                required: true,
                minlength: 10,
                maxlength: 40,
                normalizer: function(value) {
                    return $.trim(value);
                }
            },
            email:{
                required: true,
                email: true
            },
            region:{
                required:true
            },
            city:{
                required:true
            },
            district:{
                required:true
            }
        },
        messages:{
          full_name:{
              required:"Заполните поле",
              minlength: "Введите не меньше {0} символов",
              maxlength: "Введите не больше {0} символов"
          },
          email:{
              required:"Заполните поле",
              email: "Некорректный Email"
          },
           region:{
              required:"Выберите область"
           },
            city:{
              required:"Выберите город"
            },
            district:"Выберите район"
        },
        focusInvalid: false
    });
});


function get_city(id) {
            $.ajax({
                type: 'POST',
                url: 'ajax/',
                data: {action:'showCity',pid:id},
                dataType: "html",
                success: function (data) {
                    var sel = $('#city');
                    if (data !== '') {
                        sel.html('<option value="">--Выберите город--</option>');
                        sel.append(data);
                        $('div.form-group').eq(3).removeClass('d-none');
                        sel.chosen().trigger("chosen:updated");
                    }


                }
            });
}

function get_district(id) {
    $.ajax({
        type: 'POST',
        url: 'ajax/',
        data: {action:'showDistrict',pid:id},
        dataType: "html",
        success: function (data){
            var sel = $('#district');
            if(data !== ''){
                alert(data);
                sel.html('<option value="">--Выберите район--</option>');
                sel.append(data);
                $('div.form-group').eq(4).removeClass('d-none');
                sel.chosen().trigger("chosen:updated");
            }else {
                alert(data);
                var city = $("#city option:selected");
                sel.html('<option value="'+city.val()+'">'+ city.text() +'</option>').attr('selected', 'selected');
                $('div.form-group').eq(4).removeClass('d-none');
                sel.chosen().trigger("chosen:updated");
            }

        }
    });
}


$("#region").chosen().on("change",function () {
    $('div.form-group').eq(4).addClass('d-none');
    var valid = $(this).valid();
    if (valid){
        var region_id = $('select[name=region]').val();
        get_city(region_id);
    }
});

$("#city").on("change",function () {
    var valid = $(this).valid();
    if (valid){
        var city_id = $('select[name=city]').val();
        get_district(city_id);
    }
});


/**
 * Created by Vadim on 16.12.2017.
 */
