document.addEventListener('click', function (event) {
    var optionsModal = document.getElementById('optionsModal');

    // Verifică dacă click-ul a fost în afara ferestrei modale
    if (event.target === optionsModal) {
        optionsModal.style.display = 'none';
    }
});
// Adaugă funcția pentru deschiderea ferestrei modale de opțiuni
function openOptionsModal() {
    var optionsModal = document.getElementById('optionsModal');
    optionsModal.style.display = 'flex';
}

// Adaugă funcția pentru a naviga către o pagină specifică în funcție de opțiunea aleasă
function navigateToPage(option) {
    var pages = {
        'tuns': 'tuns.html',
        'epilat': 'epilat.html',
        'tratamente': 'tratamente.html'
    };

    // Redirecționează către pagina specificată
    window.location.href = pages[option];
}

// Adaugă un eveniment de click pentru butonul de programare online
var bookingButton = document.getElementById('bookingButton');
bookingButton.addEventListener('click', openOptionsModal);

//BUTON PROGRAMARE//
var bookingButton = document.getElementById('bookingButton');
var isPressed = false;

bookingButton.addEventListener('click', function () {
    isPressed = !isPressed;

    // Adaugă sau elimină clasa pressed în funcție de starea butonului
    bookingButton.classList.toggle('pressed', isPressed);

    setTimeout(function () {
        bookingButton.classList.remove('pressed');
    }, 300);
});
//bara navi//
document.querySelector('.toggleMenu').addEventListener('click', () => {
    document.querySelector('.navigation').classList.toggle('active')
  })








    

