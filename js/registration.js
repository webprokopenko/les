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
    //Возвращаем в глобальную область видимости
    return{
        init: function(){
            setUpListeners();
        }
    }
}());

FormSender.init();