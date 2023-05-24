/**
 * File notificationCf.js.
 *
 * Handles notification for mindplex plugins and messages.
 */

 let removeNotificationCf
 const profileTopcf = document.querySelector('.cf-right-section')
 const createNotificationCf = (el, text,type) => {
     const firstChildElement = el?.firstElementChild
     if (firstChildElement.outerHTML.includes("mp-notificationCf")) {
         return
     }
     const div = document.createElement('div')
     div.classList = "mp-notificationCf"
     type === "danger" &&  div.classList.add('notificationCf-error')
     const p = document.createElement('p')
     p.classList = 'mp-notificationCf-content'
     p.textContent = text
     const span = document.createElement('span')
     span.classList = 'close-mp-notificationCf'
     span.textContent = "X"
     div.appendChild(p)
     div.appendChild(span)
     el.prepend(div)
 }
 const hideNoifcf = (el) => {
    const firstChildElement = el?.firstElementChild
    if (firstChildElement.outerHTML.includes("mp-notificationCf")) {
        firstChildElement.remove()
    }
}
const showNotificationCf = (text, type) => {
    if (removeNotificationCf) {
        clearTimeout(removeNotificationCf);
    }
    createNotificationCf(profileTopcf, text,type)

    removeNotificationCf = setTimeout(() => {
        hideNoifcf(profileTopcf)
    }, 5000)
    // closeNotificationCf.
    const close = document.querySelector('.close-mp-notificationCf')

    close.addEventListener('click', () => hideNoifcf(profileTopcf))

}

