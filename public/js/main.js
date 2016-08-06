/**
 * Created by oleh on 11.05.16.
 */

function getAjaxData(){
    $.post('/users/get-ajax-data/', function(data) {
        $('#ajaxBlock').html(data).show();
    });
}

function search(){
    var search = $('#textSearch').val();
    $.ajax({
        type: 'POST',
        url: '/publication/search/',
        data: {'search':search},
        dataType: 'json',
        success: function (json) {
            $(".block__list_words ").html('');// очистка div
            $.each(json, function (i, item) {
                if (typeof item == 'object') {
                    $(".block__list_words ")
                        .append("<li><input type='hidden' id='" + item.id + "' value='" + item.id + "'/>"
                            + item.title + "</li>");
                }
                else {
                    return false;
                }
            }); // end $.each() loop
        }
    });
}

var startFrom = 5;// номер запису, з якого починається вибірка з БД

/**
 * функція підвантаження нових записів
 * з БД
 */
function loadPublications() {

    $.ajax({
        type: 'POST',
        url: '/publication/showadditionallydata/',
        data: {'startFrom':startFrom},
        dataType: 'json',
        success: function (json) {
            $.each(json, function (i, item) {
                if (typeof item == 'object') {
                    $(".block__list_words ")
                        .append("<li><input type='hidden' id='" + item.id + "' value='" + item.id + "'/>"
                         + item.title + "</li>");
                }
                else {
                    return false;
                }
            }); // end $.each() loop
        }
    });
    startFrom += 3;
}

/**
 * функція для зберігання обраних
 * користувачем елементів
 */
function selectInputs(){

    var len=document.favoriteForm.elements.length-1;
    var mas=[];
    var paste=document.getElementById('saveChangeStatus');
    for(var i=0;i<len;i++){
        var val=document.favoriteForm.elements[i].value;
        if (val!=0 && val!=undefined && val!=null){
            mas.push(val);
        }
    }
    document.cookie="selectedItems=" + mas;
    paste.innerHTML= "Зміни збережено в куки";
}

/**
 * зчитування cookie
 * @param name - назва cookie
 * @returns {*}
 */
function readCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
}