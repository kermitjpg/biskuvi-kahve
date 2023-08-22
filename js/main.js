



// Hamburger Script başlangıç

function openNav() {
    document.getElementById("myNav").style.height = "100%";
}

function closeNav() {
    document.getElementById("myNav").style.height = "0%";
}



// Hamburger Script bitiş



// Ürünler script başlangıç

window.sr = ScrollReveal();

sr.reveal('.anime-left', {
    origin: 'left',
    duration: 1000,
    distance: '25rem',
    delay: 300
});

sr.reveal('.anime-right', {
    origin: 'right',
    duration: 1000,
    distance: '25rem',
    delay: 600
});

sr.reveal('.anime-bottom', {
    origin: 'bottom',
    duration: 1000,
    distance: '25rem',
    delay: 600
});

sr.reveal('.anime-top', {
    origin: 'top',
    duration: 1000,
    distance: '25rem',
    delay: 600
});




ScrollReveal().reveal('.ani1', { delay: 250 });
ScrollReveal().reveal('.ani2', { delay: 500 });
ScrollReveal().reveal('.ani3', { delay: 750 });
ScrollReveal().reveal('.ani4', { delay: 1000 });
ScrollReveal().reveal('.ani5', { delay: 1250 });
ScrollReveal().reveal('.ani6', { delay: 1500 });
ScrollReveal().reveal('.ani7', { delay: 1750 });
ScrollReveal().reveal('.ani8', { delay: 2000 });

// ürünler script bitiş

