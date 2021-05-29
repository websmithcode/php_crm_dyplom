let popover;
popover = new bootstrap.Popover(document.querySelector('.partner-filter-info'), {
    container: 'body',
    html: true,
    content: `\n<div class="d-flex justify-content-between">ID партнера: <code><Число>)</code></div>\n<hr>\n<div class="d-flex justify-content-between">Имя партнера: <code>) <Имя> (</code></div>\n<hr>\n<div class="d-flex justify-content-between">Email: <code>(<почта>)</code></div>\n<hr>\n<div class="d-flex justify-content-between">Реквизиты: <code>[<реквизиты>]</code></div>\n    `
});