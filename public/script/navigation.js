/**************** Navigation Bar for Small Screens **********************/
const menuIcon = document.querySelector('nav figure:nth-of-type(1)')
const closeIcon = document.querySelector('nav figure:nth-of-type(2)')
const navItems = document.querySelector('nav ul:first-of-type')
//const translateIcon = document.querySelector('nav figure:nth-of-type(4)')
//const languageList = document.querySelector('nav ul:last-of-type')


menuIcon.addEventListener("click", () => {
    //languageList.style.display = "block"
    menuIcon.style.display = "none"
    closeIcon.style.display = "block"
    navItems.style.top = "42px"
    //languageList.style.top = "60px"
})

closeIcon.addEventListener("click", () => {
    menuIcon.style.display = "block"
    closeIcon.style.display = "none"
    navItems.style.top = "-300px"
    //languageList.style.top = "-50px"
})


/************** Languages *********************************/
// language preferences
/*
const updateCookies = (language) => {
    const csrf = document.querySelector('meta[name="csrf-token"]').content

    const formData = new FormData()
    formData.append('_token', csrf)
    formData.append('language', language)

    // set up the request
    const xhr = new XMLHttpRequest();
    xhr.open( "POST", "/language-change", true )

    // sent data provided in the form
    xhr.send( formData )
}*/
/*
const languageItems = languageList.children
for (const item of languageItems) {
    item.addEventListener("click", () => {
        const language = item.innerText.toLowerCase()
        //console.log(item.innerText)
        updateCookies(language)
    })
}*/

// on small screen nav bar open, on large screen click languages, go to small screen - make sure languages still visible
//if (menuIcon.style.display == "block") languageList.style.top = "60px"


/*const languageList = document.querySelector('nav ul:first-of-type')

console.log(languageList)

*/
//const languageListLarge = document.querySelector('nav ul:nth-of-type(1)')


/*translateIcon.addEventListener("click", () => {
    console.log(window.getComputedStyle(languageList).opacity)
    if (window.getComputedStyle(languageList).display == "none") {
        //languageList.style.top = "40px"
        languageList.style.cssText = "display:block !important"
    }
    else if (window.getComputedStyle(languageList).display == "block") {
        //languageList.style.top = "-100px"
        languageList.style.display = "none"
    }
})*/
