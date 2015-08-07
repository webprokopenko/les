var FormSender = (function(){
    //Подключаем прослушку событий
    function setUpListeners(){
        $('#add_group').on('submit', _showResult);
        $('#del_group_form').on('submit', _group_del);
        $('#update_group_form').on('submit', _group_update);
        $('#add_tovar_form').on('submit', _add_tovar);
        $('#del_tovar_form').on('submit', _tovar_del);


        //$(document).on('ready', function(){console.log("LOADED")});
        $(document).ready(function(){
            _list_group();
            _list_group_del();
            _list_group_update();
            _list_group_add_tovar();
            _list_color_del();
            _list_tovar_del();
        });

    };
    //Обработка сабмита формы #add_group
    function _showResult(ev){
        ev.preventDefault();
        var form = $(this),
            url = 'ajax/ajax_add_group.php',
            defObject = _ajaxForm(form,url),
            message_group = $('.message__group-init');
        defObject.done(function(ans){
            var ul = $('.list');
            for(var item in ans){
                var markup = '<li>'+ item +':' + ans[item] + '</li>';
                ul.append(markup);
            }
            _list_group();
            _list_group_del();
            _list_group_update();
            _list_group_add_tovar();
            message_group.text('Группа успешно добавлена').removeClass('error').addClass('sucess');
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
        })
    }
    //Вызываем список групп
    function _list_group(){
        //ev.preventDefault();
        var form = $(this),
            url = 'ajax/ajax_select_group.php',
            defObject = _ajaxForm(form,url);
        defObject.done(function(ans){
            var ul = $('.list__group');
                ul.text('');
            for(var item in ans){
                var markup = '<li>' + ans[item] + '</li>';
                ul.append(markup);
            }
        })
    }
    //Вызываем список групп для удаления
    function _list_group_del(){
        var form = $(this),
            url = 'ajax/ajax_select_group_del.php',
            defObject = _ajaxForm(form,url);
        defObject.done(function(ans){
            var ul = $('#del_group');
            ul.text('');
            for(var item in ans){
                var markup = '<option value="'+ans[item]['id'] +'">' + ans[item]['name'] + '</option>';
                ul.append(markup);
            }
        })
    }
    // список цветов
    function _list_color_del(){
        var form = $(this),
            url = 'ajax/ajax_select_tovar_del.php',
            defObject = _ajaxForm(form,url);
        defObject.done(function(ans){
            var ul = $('#f_k_color_tovar');
            ul.text('');
            for(var item in ans){
                var markup = '<option value="'+ans[item]['id'] +'">' + ans[item]['name'] + '</option>';
                ul.append(markup);
            }
        })
    }
    //Список товаров
    function _list_tovar_del(){
        var form = $(this),
            url = 'ajax/ajax_select_del.php',
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

    //Вызываем список групп для добавления товара
    function _list_group_add_tovar(){
        var form = $(this),
            url = 'ajax/ajax_select_group_del.php',
            defObject = _ajaxForm(form,url);
        defObject.done(function(ans){
            var ul = $('#f_k_category');
            ul.text('');
            for(var item in ans){
                var markup = '<option value="'+ans[item]['id'] +'">' + ans[item]['name'] + '</option>';
                ul.append(markup);
            }
        })
    }
    //Вызываем список групп для изменения
    function _list_group_update(){
        var form = $(this),
            url = 'ajax/ajax_select_group_del.php',
            defObject = _ajaxForm(form,url);
        defObject.done(function(ans){
            var ul = $('#group_id');
            ul.text('');
            for(var item in ans){
                var markup = '<option value="'+ans[item]['id'] +'">' + ans[item]['name'] + '</option>';
                ul.append(markup);
            }
        })
    }
    //Функция удаления групп
    function _group_del(ev){
        ev.preventDefault();
        var form = $(this),
            url = 'ajax/ajax_del_group.php',
            message_group = $('.message__group-init'),
            defObject = _ajaxForm(form,url);
        defObject.done(function(){
            _list_group();
            _list_group_del();
            _list_group_update();
            _list_group_add_tovar();
           message_group.text('Группа успешно удалена').removeClass('error').addClass('sucess');
        });
    }
    //Функция удаления товара
    function _tovar_del(ev){
        ev.preventDefault();
        var form = $(this),
            url = 'ajax/ajax_del_tovar.php',
            message_group = $('.message__tovar-init'),
            defObject = _ajaxForm(form,url);
        defObject.done(function(){
            message_group.text('Товар успешно удален').removeClass('error').addClass('sucess');
            _list_tovar_del();
        });
    }
    //Функция изменения групп
    function _group_update(ev){
        ev.preventDefault();
        var form = $(this),
            url = 'ajax/ajax_update_group.php',
            message_group = $('.message__group-init'),
            defObject = _ajaxForm(form,url);
        defObject.done(function(){
            _list_group();
            _list_group_del();
            _list_group_update();
            _list_group_add_tovar();
            message_group.text('Группа успешно изменена').removeClass('error').addClass('sucess');
        });
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