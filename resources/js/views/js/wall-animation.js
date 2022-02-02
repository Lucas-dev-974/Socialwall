document.addEventListener('DOMContentLoaded', () => {
    let backgroundImage = document.querySelectorAll('.card')
    handleResize(backgroundImage, "480px")
})

function handleResize(items, size){
    console.log(items);
}   

let time = 5000
 
window.excludeArray = []
window.freeId = []

setInterval(removeItem, time, '.card')

function removeItem(selector, starter = null,){
    let container = document.getElementById('background-container')
    let items = document.querySelectorAll(selector)
    let randomItems = Math.floor(Math.random() * items.length + 1)

    console.log(container.childNodes);
    if(container.childNodes[randomItems].nodeName == '#text'){
        container.childNodes[randomItems].remove()
        
        // removeItem(selector)
    }else{
        if(window.excludeArray.length == 24) window.excludeArray = []
        if(window.excludeArray.includes(randomItems)){
            removeItem(selector)
        }else{
            console.log(container.childNodes[randomItems].nodeName);
            container.childNodes[randomItems].classList.add('hidden')
            container.childNodes[randomItems].classList.add('fade-in-image')
            setTimeout(function() {
                container.childNodes[randomItems].classList.remove('hidden')
                container.childNodes[randomItems].style.opacity
            }, 2000)
            window.excludeArray.push(randomItems)
        }
    }
}
