let huevos=["Huevos Pequeños","Huevos Medianos","Huevos Triple A","Huevos Doble Yema"];
let precio1=['10500'];
let precio2=['15400'];
let precio3=['18500'];
let precio4=['22000'];

let box1=document.getElementById("listproductos")
let box2=document.getElementById("listprecios")

function mostrar (combobox,valor){
    box2.innerHTML=''
    for(let index of valor){
        combobox.innerHTML+=`<option value="${index}">${index}</option>`
    }
}
function llenar(){
    mostrar(box1,huevos)
}
llenar()

box1.addEventListener('change',(e)=>{
    let data=e.target.value
    switch(data){
        case 'Huevos Pequeños':
            mostrar(box2,precio1.slice(0))
        break;
        case 'Huevos Medianos':
            mostrar(box2,precio2.slice(0))
        break;
        case 'Huevos Triple A':
            mostrar(box2,precio3.slice(0))
        break;
        case 'Huevos Doble Yema':
            mostrar(box2,precio4.slice(0))
        break;
    }
})

//CALCULO
function calcular(){
    try{
        var a = parseFloat(document.getElementById("listprecios").value) || 0;
        var b = parseFloat(document.getElementById("cantidad").value) || 0;
        document.getElementById("total").innerText = a * b;
    }catch(e){}
}