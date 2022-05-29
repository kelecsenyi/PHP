const menuBtn = document.querySelector('.menu-btn');
let menuOpen = false;
menuBtn.addEventListener('click', () =>{
    if (!menuOpen) {
        menuBtn.classList.add('open');
        menuOpen = true;
    }  else  {
        menuBtn.classList.remove('open');
        menuOpen = false;
    }

    window.onscroll = function() {myFunction()};

    function myFunction() {
        if (document.documentElement.scrollTop > 100) {
            menuBtn.classList.remove('open');
            menuOpen = false;
        } 
    }
});