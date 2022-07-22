
// language form
let form = document.querySelector('form[action="/changeLanguage"]')
// language buttons
let cs = document.querySelector('form[action="/changeLanguage"] button:nth-of-type(1)')
let en = document.querySelector('form[action="/changeLanguage"] button:nth-of-type(2)')
// hidden input for selected language
let input = document.querySelector('form[action="/changeLanguage"] input[name="language"]')

cs.addEventListener('click', () => {
    input.value = 'cs'
    form.submit() // sends selected language = cs
})
en.addEventListener('click', () => {
    input.value = 'en'
    form.submit() // sends selected language = en
})
