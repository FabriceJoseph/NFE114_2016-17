$(document).ready(function() {
    $('#avatar').click(displayWrapper);
    $('#createButton').click(displayRegisterForm);
    $('#search_icon').click(displaySearchBox);
    $('#submitSearch').click(function(event) {
        event.preventDefault();
        checkSearchInput();
    });
});

function displayWrapper() {
    if($('#connexion').is(':visible')) {
        $('#connexion').hide();
        $('#avatar').css('border-bottom', '1px solid grey');
        $('.arrow').attr('src', 'images/arrowDown.png');
        $('#connexion').find('#authentificationForm_wrapper').show();
        $('#connexion').find('#registerForm_wrapper').hide();
        var spans = document.querySelectorAll('.error');
        for(var el of spans) {
            addClass('invisible', el);
        }
        var textInputs = document.querySelectorAll("#connexion input[type='text']");
        for(var el of textInputs) {
            el.value = "";
            removeClass('invalide', el);
        }
        var passwordInputs = document.querySelectorAll("#connexion input[type='password']");
        for(var el of passwordInputs) {
            el.value = "";
            removeClass('invalide', el);
        }
    } else {
        $('#connexion').show();
        $('#avatar').css('border-bottom', 'none');
        $('.arrow').attr('src', 'images/arrow_up.png');
    }
}

function displayRegisterForm() {
    $(this).parents('#connexion').find('#authentificationForm_wrapper').hide();
    $(this).parents('#connexion').find('#registerForm_wrapper').show();
    
}


//display the Search form or hide it
function displaySearchBox() {
    console.log("ok je recois le click");   
    if($('#search_wrapper').is(':visible')) {
        $('#search_wrapper').hide();
    } else {
        $('#search_wrapper').show();
    }
}

function checkSearchInput() {
    var sValue = $('#searchBox').val();
    if(sValue.length != 0) {
        $('#search_wrapper').submit();    
    } else {
        console.log('sValue est vide');
    }
    
}

