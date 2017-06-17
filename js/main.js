$(document).ready(function() {
    $('#avatar').click(displayWrapper);
    $('#createButton').click(displayRegisterForm);
    $('#search_icon').click(displaySearchBox);
    $('#submitSearch').click(function(event) {
        event.preventDefault();
        checkSearchInput();
    });

    searchCriteraButton = document.getElementsByName('searchCritera');
    for(button of searchCriteraButton) {
         
         button.addEventListener('click', manageSlider, false);
    }

    document.getElementsByTagName('select')[0].addEventListener('click', function(){
        hideSlider();
        uncheckRadioButtons();
        var text = this.options[this.selectedIndex].value;
        document.getElementById('searchBox').value = text;
    }, false);

});

function displayWrapper() {
    if($('#connexion').is(':visible')) {
        $('#connexion').hide();
        $('#avatar').css('border-bottom', '1px solid grey');
        $('.arrow').attr('src', '/nfe114fab/images/arrowDown.png');
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
        $('.arrow').attr('src', '/nfe114fab/images/arrow_up.png');
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
    if($.trim(sValue).length != 0 && checkCritera()) {
        $('#search_wrapper').submit();    
    } else {
        console.log('les données de recherche ne sont pas valides');
    }
}

function checkCritera() {
    result = false;
    var radios = document.getElementsByName('searchCritera');
    var sel = document.getElementsByTagName('select')[0];
    var index = sel.options.selectedIndex;
    for(rad of radios) {
        if(rad.checked)
            result = true;
    }
    if(result)
        return (index!=1 && index!=2);
    else 
        return (index==1 || index==2);
}

function showValue(value) {
    document.getElementById('range').innerHTML = value;
    document.getElementById('searchBox').value = value;
    }


function manageSlider(el) {
    
    el.preventDefault;
    document.getElementById('searchBox').value = "";
    var newClass="";
    var oldClass="";
    if(el.target.isSameNode(document.getElementById('priceRadio'))) {
        showSlider();
    } else {
        hideSlider();
    }

    var options = [];
    for(elem of document.getElementsByTagName('option')) {
        options.push(elem);
    }
    var b = options.includes(el.target);
   
    if(!el.target.isSameNode(document.getElementsByTagName('select')[0]) && !b) {
        document.getElementsByTagName('select')[0].selectedIndex=0;
    }
}

function showSlider() {
     var rangeValue = document.getElementById('range');
     var range = rangeValue.previousElementSibling;
     rangeValue.classList.remove('invisible');
     range.classList.remove('invisible');
     rangeValue.classList.add('visibleInLine');
     range.classList.add('visibleInLine');
}

function hideSlider() {
     document.getElementById('priceRadio').checked = false;
     var rangeValue = document.getElementById('range');
     var range = rangeValue.previousElementSibling;
     rangeValue.classList.remove('visibleInLine');
     range.classList.remove('visibleInLine');
     rangeValue.classList.add('invisible');
     range.classList.add('invisible');
}

function uncheckRadioButtons() {
    var radios = document.getElementsByName('searchCritera');
    for(rad of radios) {
        rad.checked = false;
    }
}
