let removeWarning
const validateError = (errorElements) => {
    errorElements.map(el => {
        const p = document.createElement('p')
        if (!el.element.nextElementSibling) {
            p.innerText = el.message
            el.element.classList.add('input-error')
            p.classList = 'error-txt'
            p.innerHTML = el.message
            el.element.insertAdjacentElement('afterend', p)
        } else {
            p.classList = 'error-txt'
            el.element.nextElementSibling.remove();
            p.innerHTML = el.message
            el.element.insertAdjacentElement('afterend', p)
        }
        // if (removeWarning) {
        //     clearTimeout(removeWarning);
        // }
        // removeWarning = setTimeout(() => {
        //     clean(errorElements)
        // }, 8000)
    })
}

const clean = (elm) => {
    elm.map(el => {
        if (!el.element.nextElementSibling) return;
        el.element.classList.remove('input-error')
        el.element.nextElementSibling.remove();
    })
}



function checkEmailIsFromTrustedProvider(email) {
    const emailDomain = email.split('@')[1]
    const trustedDomains = ['gmail.com', 'yahoo.com', 'hotmail.com', 'outlook.com', 'icloud.com', 'me.com', 'mac.com', 'singularitynet.io', 'icog-labs.com', 'aol.com', 'gmx.com', 'mailfence.com', 'protonmail.com', 'proton.me', 'pm.me', 'mail.yandex.ru', 'mail.yandex.com', 'yandex.ru', 'yandex.com', 'qq.com', 'tutanota.com', 'librem.com', 'thexyz.com', 'tencent.com']
    return trustedDomains.includes(emailDomain)
}

const validateFn = (...args) => {
    const errorElements = []
    const mailFormat = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
    args.forEach(elm => {
        console.log(elm.value)
        if (elm.value === "") {
            errorElements.push({
                element: elm,
                message: elm.placeholder + " should not be empty"
            })
        }
        // if (elm.name === 'cf-category') {
        //     errorElements.push({
        //         element: elm,
        //         message: 'Hey categories'
        //     })
        // }
    })

    if (errorElements.length) {
        validateError(errorElements)
    } else {
        return true
    }
}
const loader = (id, status, name) => {
    const elm = document.getElementById(id)

    if (status) {
        elm.value = ``
        elm.innerHTML = ` 
        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" class="loading-btn" style="width:20px;height:20px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
<circle cx="50" cy="50" fill="none" stroke="#fff" stroke-width="10" r="35" stroke-dasharray="164.93361431346415 56.97787143782138">
  <animateTransform attributeName="transform" type="rotate" repeatCount="indefinite" dur="1s" values="0 50 50;360 50 50" keyTimes="0;1"></animateTransform>
</circle>
        `
        elm.disabled = true

    } else {
        elm.innerHTML = name
        elm.value = name
        elm.disabled = false

    }
}
