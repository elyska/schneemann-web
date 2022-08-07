
/* cart.js */

/* Changing quantity */
const quantityInputs = document.querySelectorAll('form[action="/change-quantity"] input[name="quantity"]')
const changeForms = document.querySelectorAll('form[action="/change-quantity"]')

for (let i = 0; i < quantityInputs.length; i++) {
    quantityInputs[i].addEventListener("change", () => {
        if (quantityInputs[i].value < 1) quantityInputs[i].value = 1

        // bind the FormData object and the form element
        const formData = new FormData( changeForms[i] )

        // set up the request
        const xhr = new XMLHttpRequest();
        xhr.open( "POST", "/change-quantity", true )
        xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest")

        // sent data provided in the form
        xhr.send( formData )
    })
}
