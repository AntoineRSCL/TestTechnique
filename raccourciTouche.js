const monInput = document.querySelector("#number")
const buttonSend = document.querySelector("#btnSubmit")
monInput.focus()
monInput.addEventListener('keypress', (event) => {
    if (event.key === "Enter") {
        buttonSend.click();
    }
})

const mesBoutonsPreFait = document.querySelectorAll(".btn")
mesBoutonsPreFait.forEach(btn => {
    btn.addEventListener('click', () => {
        monInput.value = btn.innerHTML;
        monInput.focus()
    })
})