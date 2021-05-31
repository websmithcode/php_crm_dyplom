window.addEventListener('DOMContentLoaded', () => {
    const Url = new URL(window.location.href);
    switch (Url.pathname.replace(/^\/+|\/+$/g, '')) {
        case 'orders':
            orders();
            break
        case 'orders/editorder':
            editOrder();
            break
    }
})

function orders() {
    new bootstrap.Tooltip(document.querySelector('.partner-filter-info'), {
        container: 'body',
        html: true,
        title: `<code>"ID&nbsp;партнера") "Имя&nbsp;партнера" ("почта") ["реквизиты"]</code>`
    });
}

function editOrder() {
    const form = document.querySelector('form');
    const rows = form.querySelectorAll('tbody tr');
    form.addEventListener('submit', submit);

    rows.forEach((row)=>{
        row.addEventListener('change', calculateSum);
    })
    // document.querySelector('.add_row').addEventListener('click', addRow())


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
    function submit(e) {
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
        fetch(form.action, {
            method: form.method,
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