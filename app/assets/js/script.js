const showAlert = (text='Готово', classes='bg-secondary')=>{
    const alertElement = document.getElementById('alert');
    classes.split(' ').forEach(c=>{
        alertElement.classList.add(c);
    });
    alertElement.querySelector('.toast-body').innerHTML = text;
    const toast = new bootstrap.Toast(alertElement);
    toast.show();
}