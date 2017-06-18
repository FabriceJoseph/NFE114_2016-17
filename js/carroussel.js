window.onload = function() {

    var spec = document.getElementsByClassName('spectacleTop');
    var carrousselTop = new carroussel(spec);

    carrousselTop.init();
    carrousselTop.move();
}


function carroussel(elements) {
    this.spectacles = elements;
    this.len = elements.length;
    this.wi = 600;
    this.current = 0;
    this.nextOne = 1;
    this.frameId = 0;
    this.init = init;
    this.next = next;
    //this.go = go;
    this.move = move;
    this.stop = stop;
}

function init() {
    var that = this;
    for(var i = 0; i < this.len; i++) {
        this.spectacles[i].addEventListener('mouseover', that.stop.bind(that), false);
        this.spectacles[i].addEventListener('mouseout', that.move.bind(that), false);
        if(i != 0) {
            this.spectacles[i].style.left = '600px';
            this.spectacles[i].style.left = '600px';
        }
        
    }  
}

function next() {
    this.nextOne++;
    if(this.nextOne >= this.len) {
        this.nextOne = 0;
    }
}

/*function go() {
    var that = this; 
    this.frameId = requestAnimationFrame(that.move.bind(that));
}*/

function move() {
    //var that = this;
    var posFirst = parseInt(this.spectacles[this.current].style.left);
    if(!posFirst) {
        posFirst = 0;
        this.spectacles[this.current].style.left = posFirst+'px';
    }
    var step = 2;
    posFirst -= step;
    posSecond = parseInt(this.spectacles[this.nextOne].style.left);
    posSecond -= step;
    this.spectacles[this.current].style.left = posFirst+'px';
    this.spectacles[this.nextOne].style.left = posSecond+'px';

    /*if(posSecond > 0) {
        var that = this;
        this.frameId = requestAnimationFrame(that.move.bind(that));
    }*/

    if(posSecond == 0) {
        this.spectacles[this.current].style.left = '600px';
        this.current = this.nextOne;
        this.next();
        //var that = this;
        //this.frameId = requestAnimationFrame(that.move.bind(that));
    }
    var that = this;
    that.frameId = window.setTimeout(that.move.bind(that), 20);
}

function stop() {
    var that = this;
    window.clearTimeout(that.frameId);
}


