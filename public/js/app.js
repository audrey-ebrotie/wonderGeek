const mainMenu = document.querySelector('.mainMenu');
const closeMenu = document.querySelector('.closeMenu');
const openMenu = document.querySelector('.openMenu');

openMenu.addEventListener('click', show);
closeMenu.addEventListener('click', close);

function show(){
    mainMenu.style.display = 'flex';
    mainMenu.style.top = '0';

    document.body.classList.add('open');
}
function close(){
    mainMenu.style.top = '-100%';
    document.body.classList.remove('open');
}

const notifications = document.querySelectorAll('.notification-manager .notification');

setTimeout(() => {
    for(const notification of notifications){
        notification.style.opacity = 0;
        setTimeout(() => {
            notification.remove();
        }, 500);
    }
}, 5000);



