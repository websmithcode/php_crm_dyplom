window.addEventListener('DOMContentLoaded', () => {
    const Url = new URL(window.location.href);
    switch (Url.pathname.replace(/^\/+|\/+$/g, '')) {
        case 'prices':
            prices();
            break
    }
})

function prices() {
    const modal = document.getElementById('addPrice');
    const modalSubmitButton = modal.querySelector('button[type=submit]')
    const addForm = modal.querySelector('form');
    modalSubmitButton.addEventListener('click', submit);

    function submit(e){
        e.preventDefault();
        const data = {}
        Array.from(addForm.querySelectorAll('[name]')).forEach(e=>{
            data[e.name] = e.value;
        })
        fetch(addForm.action, {
            method: 'POST',
            headers: {
                "Content-Type": "application/json;charset=utf-8",
            },
            body: JSON.stringify(data),
        }).then((response) => {
            if (response.ok) {
                showAlert('Сохранено', 'bg-success');
                window.location.reload()
            }
        });

    }
}