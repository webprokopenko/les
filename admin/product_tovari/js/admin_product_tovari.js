var FormSender = (function(){
    //Подключаем прослушку событий
    function setUpListeners(){
        $('#add_tovar_form').on('submit', _add_tovar);
        $(document).ready(function(){
            _list_tovari();
            _list_category();
            _list_country();
        });
    };
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
    function _add_tovar(ev){
        ev.preventDefault();
        var form = $(this),
            url = 'ajax/ajax_add_tovar.php',
            defObject = _ajaxForm(form,url),
            message_group = $('.message__tovar-init');
        defObject.done(function(ans){
            _list_tovar_del();
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
            })
        console.log(data);
        return defObj;
    };
    //Возвращаем в глобальную область видимости
    return{
        init: function(){
            setUpListeners();
        }
    }
}());

FormSender.init();