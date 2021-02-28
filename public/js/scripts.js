function ready(fn) {
    if (document.readyState != 'loading'){
        fn();
    } else {
        document.addEventListener('DOMContentLoaded', fn);
    }
}

function confirmBeforeCustomerRemove(event) {
    if (!confirm('¿Desea eliminar este cliente?')) {
        event.preventDefault()
        return false
    }
}

ready(() => {
    var elements = document.querySelectorAll('.js-delete-customer-form');
    Array.prototype.forEach.call(elements, function(el){
        el.addEventListener('submit', confirmBeforeCustomerRemove)
    });
})