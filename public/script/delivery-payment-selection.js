
/* delivery-payment-selection.js */

const country = document.querySelector('form[action="/select-destination"] select')
const destinationForm = document.querySelector("main form[action='/select-destination']")
const orderSummary = document.querySelector("#order-summary")

// update postage
country.addEventListener("change", () => {
    // bind the FormData object and the form element
    const formData = new FormData( destinationForm )

    // set up the request
    const xhr = new XMLHttpRequest();
    xhr.open( "POST", "/select-destination", true )
    xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest")

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status == 200) {
                // update summary component
                orderSummary.innerHTML = xhr.responseText
            }
        }
    }

    // sent data provided in the form
    xhr.send( formData )
})
