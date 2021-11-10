//permet d'éxècuter le script au moment du rechargement de la page

document.addEventListener("DOMContentLoaded", () => {
 //récupère les paramètres de l'URL
  const queryString = window.location.search;
  //création objet qui va permettre de récupérer une valeur de paramètre dans l'URL
  const urlParams = new URLSearchParams(queryString);
  //récupère la valeur du paramètre
  const crudAction = urlParams.get('crudAction')
  if (crudAction === 'edit') {
    let selectAutocomplete = document.getElementById("Book_holder_autocomplete");
    //sélection du champ date
    let inputDateLoan = document.getElementById("Book_loan_date");
    let inputReturnDateLoan = document.getElementById("Book_returnLoanDate");

    //valeur de l'input date

    selectAutocomplete.addEventListener("change", () => {
      const dateLoan = new Date();
      const returnDateLoan = new Date();
      returnDateLoan.setDate(dateLoan.getDate() + 30)
      let index = selectAutocomplete.selectedIndex;
      if (index === 0) {
        inputDateLoan.value = null;
        inputReturnDateLoan.value = null;
      } else {
        inputDateLoan.valueAsDate = dateLoan;
        inputReturnDateLoan.valueAsDate = returnDateLoan;
      }
    });
    
    inputDateLoan.addEventListener('change', () => {

      if (inputDateLoan.value) {
        const dateLoan = new Date(inputDateLoan.value);
        const returnDateLoan = new Date();
        returnDateLoan.setDate(dateLoan.getDate() + 30)
        inputReturnDateLoan.valueAsDate = returnDateLoan;
      } else {
        inputReturnDateLoan.value = null;

      }
    })


  }
});