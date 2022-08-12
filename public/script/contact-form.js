
/* contact-form.js */

const billingCheckbox = document.querySelector('input[name="sameBilAddress"]')
const billingFieldset = document.querySelector('main form fieldset:last-of-type')
const billingLine1 = document.querySelector('main form fieldset:last-of-type input[name="bilAddressLine1"]')
const billingCity = document.querySelector('main form fieldset:last-of-type input[name="bilCity"]')
const billingPcd = document.querySelector('main form fieldset:last-of-type input[name="bilPostcode"]')
const billingCountry = document.querySelector('main form fieldset:last-of-type input[name="bilCountry"]')

// hide/show billing details fieldset
if (billingCheckbox.checked) {
    billingFieldset.style.display = "none"
}

billingCheckbox.addEventListener("change", () => {
    if (billingCheckbox.checked) {
        billingFieldset.style.display = "none"
        billingLine1.required = false
        billingCity.required = false
        billingPcd.required = false
        billingCountry.required = false
    }
    else {
        billingFieldset.style.display = "block"
        billingLine1.required = true
        billingCity.required = true
        billingPcd.required = true
        billingCountry.required = true
    }
})
