window.addEventListener('DOMContentLoaded', () => {
    const Url = new URL(window.location.href);
    switch (Url.pathname.replace(/^\/+|\/+$/g, '')) {
        case 'handbook/prints':
            addRowHandler();
            break;
        case 'handbook/sizes':
            addRowHandler();
            break;
        case 'handbook/materials':
            addRowHandler();
            break;
        case 'handbook/partners':
            addRowHandler();
            break;
    }
})

function addRowHandler() {
    const modal = document.getElementById('addRowModal');
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