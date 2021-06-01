window.addEventListener('DOMContentLoaded', () => {
    const Url = new URL(window.location.href);
    switch (Url.pathname.replace(/^\/+|\/+$/g, '')) {
        case 'orders':
            orders();
            break
        case 'orders/editorderdetails':
            editOrderDetails();
            break
        case 'orders/editorder':
            editOrder();
            break
    }
})

function orders() {
    try{new bootstrap.Tooltip(document.querySelector('.partner-filter-info'), {
        container: 'body',
        html: true,
        title: `<code>"ID&nbsp;партнера") "Имя&nbsp;партнера" ("почта") ["реквизиты"]</code>`
    });} catch{}

    const modal = document.getElementById('addOrder');
    const modalSubmitButton = modal.querySelector('button[type=submit]')
    const addForm = modal.querySelector('form');
    modalSubmitButton.addEventListener('click', ()=>{addForm.submit()});
}

function editOrder() {
    const form = document.querySelector('form');
    const submitButton = form.querySelector('button[type=submit]')
    submitButton.addEventListener('click', submit);
    function submit(e){
        e.preventDefault();
        const data = {}
        Array.from(form.querySelectorAll('[name]')).forEach(e=>{
            data[e.name] = e.value;
        })
        fetch(form.action, {
            method: 'PUT',
            headers: {
                "Content-Type": "application/json;charset=utf-8",
            },
            body: JSON.stringify(data),
        }).then((response) => {
            if (response.ok) {
                showAlert('Сохранено', 'bg-success');
            }
        });

    }
}
function editOrderDetails() {
    const modal = document.getElementById('addOrderDetail');
    const modalSubmitButton = modal.querySelector('button[type=submit]')
    const addForm = modal.querySelector('form');
    modalSubmitButton.addEventListener('click', ()=>{addForm.submit()});

    const editForm = document.querySelector('form');
    const rows = editForm.querySelectorAll('tbody tr');
    editForm.addEventListener('submit', editSubmit);

    const deleteButtons = document.querySelectorAll('button.delete-order-detail');
    Array.from(deleteButtons).forEach(btn=>{
        btn.addEventListener( 'click', deleteOrderDetail);
    });

    rows.forEach((row)=>{
        row.addEventListener('change', calculateSum);
    })


    function calculateSum(e) {
        if (['ProductCostID', 'DiscountID', 'Quantity'].includes(e.target.name)) {
            const row = e.target.closest('tr');
            const productCostElement = row.querySelector('[name=ProductCostID]');
            const discountElement = row.querySelector('[name=DiscountID]');
            const priceElement = row.querySelector('[name=Price]');

            function getDiscount(discountElement){
                let discounts = Array.from(discountElement).filter(e=>e.value===discountElement.value);
                return discounts[0].dataset.discountValue;
            }
            function updatePrice(){
                let productCosts = Array.from(productCostElement).filter(e=>e.value===productCostElement.value);
                priceElement.value = productCosts[0].dataset.price;
            }
            updatePrice();
            const price = priceElement.value;
            const quantity = row.querySelector('[name=Quantity]').value;
            const discount = getDiscount(discountElement);
            row.querySelector('[name=Summa]').value = price * quantity * discount;
        }
    }
    function editSubmit(e) {
        e.preventDefault();
        const rows = e.target.querySelectorAll('tr');
        const data = Array();
        Array.from(rows).slice(1).forEach((row)=>{
            const rowData = {
                OrderDetailID: row.dataset.orderDetailId,
                ProductCostID: row.querySelector('[name=ProductCostID]').value,
                PrintID: row.querySelector('[name=PrintID]').value,
                SizeID: row.querySelector('[name=SizeID]').value,
                DiscountID: row.querySelector('[name=DiscountID]').value,
                Quantity: row.querySelector('[name=Quantity]').value,
            }
            data.push(rowData);
        })
        fetch(editForm.action, {
            method: 'PUT',
            headers: {
                "Content-Type": "application/json;charset=utf-8",
            },
            body: JSON.stringify(data),
        }).then((response) => {
            if (response.ok) {
                showAlert('Сохранено', 'bg-success');
            }
        });
    }

    function deleteOrderDetail(e) {
        e.preventDefault();

        const row = e.target.closest('tr');
        const OrderDetailID = row.dataset.orderDetailId;
        const formData = new FormData();
        formData.append('OrderDetailID', OrderDetailID);
        fetch('/orders/orderdetail?OrderDetailID=' + OrderDetailID, {
            method: 'DELETE',
            headers: {
                "Content-Type": "application/json;charset=utf-8",
            },
        }).then(() => {
            window.location.reload();
        });
    }
}