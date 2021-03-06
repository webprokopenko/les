var FormSender = (function(){
    //Подключаем прослушку событий
    function setUpListeners(){
        $('#add_tovar_form').on('submit', _privateFunc_valid);
        $(document).ready(function(){
            $("#data_actuality").inputmask("d.m.y",{ "placeholder": "dd.mm.yyyy" });
            _list_tovari();
            _list_category();
            _list_country();
        });
    }
    //Валидация
    //Создаем qtip
    function _createQtip (element, position) { // Создаем тултип
        var contents = element.attr('qtip-content');
        // позиция тултипа
        if (position === 'right'){
            position = {
                my: 'left center',
                at: 'right center'
            }
        }else{
            position = {
                my: 'right center',
                at: 'left center',
            }
        }
        // инициализация тултипа
        element.qtip({
            content:{
                text: contents
            },
            show:{
                event: 'show'
            },
            hide:{
                event: 'keydown hideTooltip'
            },
            position: position,
            style:{
                classes: 'qtip-red',
                tip: {
                    height: 10,
                    width: 16
                }
            }
        }).trigger('show');
    }
        //Валидируем
      function  _privateFunc_valid(e) {
            e.preventDefault();
            var valid=true,
                form = $(this),
                input_form = form.find('input, textarea').not('input[type="file"], input[type="hidden"]'),
                //email =  form.find('input[type="email"]'),
                input = form.find('input').not('input[type="file"], input[type="hidden"]');
                //message = $('textarea'),
                //pattern_email = /^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,4}\.)?[a-z]{2,4}$/i;

            for(var i=0, max=input_form.length; i<max; i+=1){
                var element = $(input_form[i]),
                    pos = element.attr('qtip-position');

                if(input_form[i].value.length === 0){
                    valid = false;
                    _createQtip(element,pos);
                    element.addClass('error');
                }
            }

            if(valid===true){
                _add_tovar();
            }
        }
    //Конец валидации

    //Список категорий
    function _list_category(){
        var form = $(this),
            url = 'ajax/ajax_select_category.php',
            defObject = _ajaxForm(form,url);
        defObject.done(function(ans){
            var ul = $('#category_f_k');
            ul.text('');
            for(var item in ans){
                var markup = '<option value="'+ans[item]['id'] +'">' + ans[item]['name'] + '</option>';
                ul.append(markup);
            }
        })
    }
    //Список товаров
    function _list_tovari(){
        var form = $(this),
            url = 'ajax/ajax_select_tovari.php',
            defObject = _ajaxForm(form,url);
        defObject.done(function(ans){
            var ul = $('#del_tovar');
            ul.text('');
            for(var item in ans){
                var markup = '<option value="'+ans[item]['id'] +'">' + ans[item]['name'] + '</option>';
                ul.append(markup);
            }
        })
    }
    //Список стран
    function _list_country(){
        var form = $(this),
            url = 'ajax/ajax_select_country.php',
            defObject = _ajaxForm(form,url);
        defObject.done(function(ans){
            var ul = $('#country_proish');
            ul.text('');
            for(var item in ans){
                var markup = '<option value="'+ans[item]['id'] +'">' + ans[item]['name'] + '</option>';
                ul.append(markup);
            }
        })
    }
    //Обработка сабмита формы #add_tovar_form
    function _add_tovar(){
        var form = $('#add_tovar_form'),
            url = 'ajax/ajax_add_tovar.php',
            defObject = _ajaxForm(form,url),
            message_group = $('.message__tovar-init');
        defObject.done(function(ans){
            message_group.text('Товар успешно добавлен').removeClass('error').addClass('sucess');
            _list_tovari();
        })
    }
    //Универсальная функция ajax
    function _ajaxForm(form,url){
        var data = form.serialize(),
            defObj = $.ajax({
                type: "POST",
                url: url,
                dataType: "JSON",
                data: data
            }).fail(function(){
                console.log('Проблемы на стороне сервера');
            });
        console.log(data);
        return defObj;
    }
    //Возвращаем в глобальную область видимости
    return{
        init: function(){
            setUpListeners();
        }
    }
}());

FormSender.init();