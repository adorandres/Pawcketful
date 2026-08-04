const sidebarLinks = document.querySelectorAll('.sidebar a');

const sideMenu = document.querySelector('aside');
const menuBtn = document.querySelector('#menu_bar');
const closeBtn = document.querySelector('#close_btn');

const themeToggler = document.querySelector('.theme-toggler')



menuBtn.addEventListener('click',()=>{
    sideMenu.style.display = "block"
})
closeBtn.addEventListener('click',()=>{
    sideMenu.style.display = "none"
})



themeToggler.addEventListener('click',()=>{

    document.body.classList.toggle('dark-theme-variables')

    themeToggler.querySelector('span:nth-child(1)').classList.toggle('active')
    themeToggler.querySelector('span:nth-child(2)').classList.toggle('active')
})




sidebarLinks.forEach(link => {
    link.addEventListener('click', () => {
        sidebarLinks.forEach(l => l.classList.remove('active'));
        link.classList.add('active');
    });
});



function toggleForm() {
    const form = document.getElementById('customerForm');
    form.classList.toggle('show');
    form.classList.toggle('hide');
}


