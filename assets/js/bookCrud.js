import './../styles/bookCrud.css';
//permet d'éxècuter le script au moment du rechargement de la page
document.addEventListener("DOMContentLoaded", () => {
 
  //récupère les paramètres de l'URL
  const queryString = window.location.search;
  //création objet qui va permettre de récupérer une valeur de paramètre dans l'URL
  const urlParams = new URLSearchParams(queryString);
  //récupère la valeur du paramètre
  const crudAction = urlParams.get('crudAction')
  
  if (crudAction === 'edit') {
    //sélection du titre
    let bookTitle = document.getElementById("Book_title");
    // sélection du label réservé
    let labelBookReserved = document.querySelector("#content-2 > div > div:nth-child(2) > div > label");
    // sélection du champ holder
    let selectAutocomplete = document.getElementById("Book_holder_autocomplete");
    //sélection des champ dates
    let inputDateLoan = document.getElementById("Book_loan_date");
    let inputReturnDateLoan = document.getElementById("Book_returnLoanDate");
    
    let radioAvailable = document.getElementById("Book_available");
    let isRadioAvailable = document.getElementById('Book_disableAvailable').checked;
    //sélection de l'adresse email de l'utilisateur connecté
    let userEmailConnected = document.querySelector("a.user-details>span.user-name").innerHTML;
    let bookReservedFor = document.getElementById("Book_reservedFor");
    bookReservedFor.setAttribute("readonly", "readonly");

    let reservedByAnother = userEmailConnected !== bookReservedFor.value;
    console.log(reservedByAnother);
    // let inputReservedFor = bookReservedFor.innerHTML;
    // console.log(inputReservedFor);
    // bookReservedFor = userEmailConnected;
    // console.dir(userEmailConnected);
    // console.log(bookReservedFor);
    // console.dir(bookReservedFor);

    //valeur de l'input date
    //à chaque fois que la valeur du détenteur change...
    if (selectAutocomplete) {
      selectAutocomplete.addEventListener("change", () => {
        //on créer un objet date pour récupèrer la date du jour
        const dateLoan = new Date();
       
        //on créer un objet date pour la date de retour
        const returnDateLoan = new Date();
        //on inscrit la date dans le champ date de retour en prenant la valeur de date d'emprunt + 30 jours
        returnDateLoan.setDate(dateLoan.getDate() + 30)
        
        let index = selectAutocomplete.selectedIndex;
        //La valeur index à 0 c'est lorsqu'il n'y a pas de détenteur renseigné
        if (index === 0) {
          inputDateLoan.value = null;
          inputReturnDateLoan.value = null;
          radioAvailable.disabled = false;
          bookTitle.classList.remove("notAvailable");
          labelBookReserved.classList.remove("notAvailable");
          
        } else {
          inputDateLoan.valueAsDate = dateLoan;
          inputReturnDateLoan.valueAsDate = returnDateLoan;
          radioAvailable.disabled = true;
          radioAvailable.checked = false;
          bookReservedFor.value = null;
          bookTitle.classList.add("notAvailable");
          labelBookReserved.classList.add("notAvailable");

        }
      });
    }
    // Lorsque l'évènement date d'emprunt change...
    inputDateLoan.addEventListener('change', () => {
      // 
      if (inputDateLoan.value) {
        const dateLoan = new Date(inputDateLoan.value);
        const returnDateLoan = new Date();
        returnDateLoan.setDate(dateLoan.getDate() + 30)
        inputReturnDateLoan.valueAsDate = returnDateLoan;
      } else {
        inputReturnDateLoan.value = null;

      }
    })

    radioAvailable.disabled = isRadioAvailable
    // Lorsque le bouton de réservation est activé...
  //   if (reservedByAnother) {
    
  // }
    
    radioAvailable.addEventListener('change',() => {
    if (radioAvailable.checked === true) {
      bookReservedFor.value = userEmailConnected;
    } else if (radioAvailable.checked === false){
      bookReservedFor.value = null;
    };
  })
  }


})
  