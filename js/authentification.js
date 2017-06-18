
var form;
var log;
var pass;
var correctData = true;

window.onload = function(){
    form = document.getElementById('authentificationForm');
    registerForm = document.getElementById('registerForm');
    form.addEventListener('submit', checkDataLogin, false);
    registerForm.addEventListener('submit', checkNewUser, false);
    addInputListener();
};


function checkDataLogin(e) {
    
    log = document.getElementById('log').value;
    pass = document.getElementById('pass').value;
    
    if(!log.match(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/) || pass.length < 8){
        e.preventDefault();
        if(!log.match(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/)) {
            document.getElementById('log').classList.add('invalide');
            var span = getElement(document.getElementById('log'), 'span');
            span.innerText = "L'adresse mail n'est pas valide";
            span.classList.remove('invisible');
        }    
        if(pass.length < 8) {
            document.getElementById('pass').classList.add('invalide');
            var span = getElement(document.getElementById('pass'), 'span');
            span.innerText = "Mot de passe invalide";
            span.classList.remove('invisible');
        }
            

    } else {
        return;
    }
}

function checkNewUser(e) {
    e.preventDefault();
    var name = document.getElementsByName('surname')[0].value;
    if(emptyString(name)) {
        correctData = false;
        document.getElementsByName('surname')[0].classList.add('invalide');
        var span = getElement(document.getElementsByName('surname')[0], 'span');
        span.textContent = "Vous devez renseigner ce champs";
        span.classList.remove('invisible');
    }
    var firstName = document.getElementsByName('firstname')[0].value;
    if(emptyString(firstName)) {
        correctData = false;
        document.getElementsByName('firstname')[0].classList.add('invalide');
        var span = getElement(document.getElementsByName('firstname')[0], 'span');
        span.textContent = "Vous devez renseigner ce champs";
        span.classList.remove('invisible');
    }
    var mail = document.getElementsByName('mail')[0].value;
    if(mail.match(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/)) {
        availableMail(mail, handler);
    } else {
        document.getElementsByName('mail')[0].classList.add('invalide');
        var span = getElement(document.getElementsByName('mail')[0], 'span');
        span.textContent = "L'adresse n'est pas valide";
        span.classList.remove('invisible');
    }
    var pass1 = document.getElementsByName('pass1')[0].value;
    if(pass1.length < 8) {
        correctData = false;
        document.getElementsByName('pass1')[0].classList.add('invalide');
        var span = getElement(document.getElementsByName('pass1')[0], 'span');
        span.textContent = "Le mot de passe doit avoir au moins 8 caractères";
        span.classList.remove('invisible');
    } else {
        var pass2 = document.getElementsByName('pass2')[0].value;
        if(pass2 != pass1) {
            correctData = false;
            document.getElementsByName('pass2')[0].classList.add('invalide');
            var span = getElement(document.getElementsByName('pass2')[0], 'span');
            span.textContent = "Les mots de passe ne correspondent pas";
            span.classList.remove('invisible');
        }
    }
    
}

function emptyString(s) {
    var len = s.trim().length;
    if(len == 0)
        return true;
    else
        return false;
}

function availableMail(m, callBack) {
    var xhr = new XMLHttpRequest();
    var url = "php/authentification.php";
    var params = "mailToVerify="+m;
    xhr.open('POST', url, true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xhr.onreadystatechange = function() {
        if(xhr.readyState == 4 && xhr.status == 200) {
            var response = xhr.responseText;
            if(response == '1')
                callBack(1);
            else 
                callBack(0);
        }
    }
    
    xhr.send(params);
}

function handler(response) {
    if(response == 1) {
        correctData = false;
        document.getElementsByName('mail')[0].classList.add('invalide');
        var span = getElement(document.getElementsByName('mail')[0], 'span');
        span.textContent = "Cette adresse n'est pas disponible";
        span.classList.remove('invisible');
    } else {
        if(correctData) {
            document.getElementById('registerForm').submit();
        }
            
    }
}

function getElement(pNode, searchedNode) {
    var regex = new RegExp(searchedNode, 'i');
    var el = pNode.nextElementSibling;
    while(!el.nodeName.match(regex)) {
        el = el.nextElementSibling;
    }

    return el;
}

function addInputListener() {
    var textInputs = document.querySelectorAll("input[type='text']");
    for(var el of textInputs) {
        el.addEventListener('focus', clearSpanError, false);
    }
    var passInputs = document.querySelectorAll("input[type='password']");
    for(var el of passInputs) {
        el.addEventListener('focus', clearSpanError, false);
    }
}

function clearSpanError(e) {
    var span = getElement(e.target, 'span');
    span.classList.add('invisible');
}

function addClass(c, el) {
    el.classList.add(c);
}

function removeClass(c, el) {
    el.classList.remove(c);
}