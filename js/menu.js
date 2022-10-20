let menu = document.querySelector('#btn-menu');
let sidebar = document.querySelector('.sidebar');
let content = document.querySelector('.content');
let logo = document.querySelector('#logo');

menu.onclick = () =>{
    sidebar.classList.toggle('active');
    content.classList.toggle('active');
    logo.classList.toggle('active');
};