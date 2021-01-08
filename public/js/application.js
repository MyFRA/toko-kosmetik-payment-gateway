function formatRupiah(bilangan) {
    let	number_string   = bilangan.toString(),
	sisa 	            = number_string.length % 3,
	rupiah 	            = number_string.substr(0, sisa),
	ribuan 	            = number_string.substr(sisa).match(/\d{3}/g);
    if (ribuan) {
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }

    return rupiah;
}

function insertAfter(referenceNode, newNode) {
    referenceNode.parentElement.insertBefore(newNode, referenceNode.nextElementSibling);
}

function createSimpleElement(tag, text) {
    const element       = document.createElement(tag);
    element.innerHTML   = text;  
    return element;
}