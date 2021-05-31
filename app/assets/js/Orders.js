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
    const rows = document.querySelectorAll('tbody tr');

    rows.forEach((row)=>{
        row.addEventListener('change', calculateSum);
    })
    document.querySelector('.add_row').addEventListener('click', addRow())


    function calculateSum(e) {
        if (['Price', 'DiscountID', 'Quantity'].includes(e.target.name)) {
            function getDiscount(discountElement){
                let discounts = Array.from(discountElement).filter(e=>e.value===discountElement.value);
                return discounts[0].dataset.discountValue;
            }
            const row = e.target.closest('tr');
            const price = row.querySelector('[name=Price]').value;
            const quantity = row.querySelector('[name=Quantity]').value;
            const discount = getDiscount(row.querySelector('[name=DiscountID]'));
            row.querySelector('[name=Summa]').value = price * quantity * discount;
            console.table({price: price, quantity: quantity, discount: discount, summa: price * quantity * discount})
        }
    }
}