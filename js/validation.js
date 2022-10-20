/*SOLO LETRAS*/
function sololetras(e){
    key=e.keyCode || e.which;
    teclado=String.fromCharCode(key).toLowerCase();
    letras=" abcdefghijklmnñopqrstuvwxyz";
    especiales="8-37-38-46-164";
    teclado_especial=false;
    for(var i in especiales){
        if(key==especiales[i]){
            teclado_especial==true;break;
        }
    }
    if(letras.indexOf(teclado)==-1 && !teclado_especial){
        return false;
    }
}
/*SOLO NUMEROS*/
function solonumeros(e){
    key=e.keyCode || e.which;
    teclado=String.fromCharCode(key).toLowerCase();
    numero="1234567890";
    especiales="8-37-38-46-164";
    teclado_especial=false;
    for(var i in especiales){
        if(key==especiales[i]){
            teclado_especial==true;break;
        }
    }
    if(numero.indexOf(teclado)==-1 && !teclado_especial){
        return false;
    }
}

/*--------------------------------------------------SIGNUP--------------------------------------------------*/
function signup(e){
    const name = document.getElementById("nombre1").value;
    const email = document.getElementById("correo1").value;
    const pass = document.getElementById("contraseña1").value;
    var expresion;

    expresion = /\w+@\w+\.+[a-z]/;

    /*CAMPOS VACIOS*/
    if(name===""){
        alert("El campo NOMBRE esta vacio");
        return false;
    }
    else if (email===""){
        alert("El campo CORREO esta vacio");
        return false;
    }
    else if(pass===""){
        alert("El campo CONTRASEÑA esta vacio");
        return false;
    }

    /*LONGITUD*/
    if(name.length>30){
        alert("El nombre es muy largo");
        return false;
    }

    /*VALIDAR CORREO*/
    if(!expresion.test(email)){
        alert("El correo debe contener @ y un dominio");
        return false;
    }
    return true;
}

/*--------------------------------------------------LOGIN--------------------------------------------------*/
function login(e){
    const name = document.getElementById("nombre2").value;
    const pass = document.getElementById("contraseña2").value;
    var expresion;

    expresion = /\w+@\w+\.+[a-z]/;

    /*CAMPOS VACIOS*/
    if(name===""){
        alert("El campo NOMBRE esta vacio");
        return false;
    }
    else if(pass===""){
        alert("El campo CONTRASEÑA esta vacio");
        return false;
    }

    /*LONGITUD*/
    if(name.length>30){
        alert("El nombre es muy largo");
        return false;
    }
}

/*--------------------------------------------------PQRS--------------------------------------------------*/
function pqrs(e){
    const tel = document.getElementById("tel").value;
    const msg = document.getElementById("text").value;

    if(tel===""){
        alert("El campo TELEFONO esta vacio");
        return false;
    }else if(msg===""){
        alert("El campo MENSAJE esta vacio");
        return false;
    }

    if(msg.length<50){
        alert("El mensaje es muy corto");
        return false;
    }else if(tel.length<10){
        alert("Numero NO valido");
        return;
    }
}