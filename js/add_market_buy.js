var pupups_market_sale = (function(){
    var setUpListners = function(){
            $('#add_market_buy').on('click', _openPopup);
            $('#market_buy_send').on('submit', _privateFunc_valid);
            console.log("popups_market INIT!!!");
        },
        _removeError = function(){
            var element = $(this);
            element.removeClass('error');
        },
        _clearAll = function(){
            var form=$(this);
            form.find('input, textarea').trigger('hideTooltip').removeClass('error').val('');
        },
    //Функция валидации
    //Валидируем
        _privateFunc_valid = function  (e) {
            e.preventDefault();
            var valid=true,
                empty=true,
                form = $(this),
                input_form = form.find('input').not('input[type="file"], input[type="hidden"]');

            for(var i=0, max=input_form.length; i<max; i+=1){
                var element = $(input_form[i]),
                    pos = element.attr('qtip-position');

                if(input_form[i].value.length === 0){
                    empty = false;
                    valid = false;
                    _createQtip(element,pos);
                }
            }
            if(empty==true) {
                console.log("empty true");

            }
            if(valid==true){
                _market_buy_add();
            }

        },
    //Создаем qtip
        _createQtip = function  (element, position) { // Создаем тултип
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
        },
    //Функция авторизации
        _market_buy_add = function(){
            var form = $("#market_buy_send"),
                url = 'ajax/ajax_add_market_buy.php',
                defObject = _ajaxForm(form,url);
            console.log(form);
            console.log("MARKET ADD BEGIN");
            defObject.done(function(ans){
                $(".popup__msg-buy").text(ans.msg).removeClass('error').addClass("sucess");
                window.location.href = "market_buy.php";
            })
        },
    //Универсальная функция ajax
        _ajaxForm =   function (form,url){
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
        },
        _openPopup = function(e){
            e.preventDefault();
            $('#modal_market_buy').bPopup({
                speed: 250,
                transition: 'slideDown',
                onClose: _clearAll
            });
        };
    return{
        init : function(){
            setUpListners();

        }
    }
}());

$(document).ready(function(){
    pupups_market_sale.init();

});