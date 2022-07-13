// modales
const editModal = document.querySelector('.edit-modal')
const addModal = document.querySelector('.add-modal')

// context menu
const btnEdit = document.querySelectorAll('.edit-btn')
for (let i = 0; i < btnEdit.length; i++){
    btnEdit[i].addEventListener('click', () => {
        let contextMenu = btnEdit[i].parentElement.nextElementSibling  
        contextMenu.classList.toggle('show')
    })
}
const contextMenuItem = document.querySelectorAll('.context-menu__sec')
for (let i = 0; i < contextMenuItem.length; i++){
    contextMenuItem[i].addEventListener('click', () => {
        // texto estado
        let state = contextMenuItem[i].parentElement.previousElementSibling.childNodes[0].childNodes[1]
        state.textContent = contextMenuItem[i].textContent
        // color estado
        let dot = contextMenuItem[i].parentElement.previousElementSibling.childNodes[0].childNodes[0]
        let fechaDiv = contextMenuItem[i].parentElement.previousElementSibling.previousElementSibling.previousElementSibling        

        try {
            dot.classList.remove('gray')
            dot.classList.remove('purple')
            dot.classList.remove('orange')
            dot.classList.remove('green')
            dot.classList.remove('blue')
            dot.classList.remove('red')

            fechaDiv.classList.remove('gray')
            fechaDiv.classList.remove('purple')
            fechaDiv.classList.remove('orange')
            fechaDiv.classList.remove('green')
            fechaDiv.classList.remove('blue')
            fechaDiv.classList.remove('red')
        } catch (error) {}
        
        let colorSel = ''
        if (state.textContent == 'En proceso'){
            dot.classList.add('gray')
            fechaDiv.classList.add('gray')
            colorSel='gray'
        }
        if (state.textContent == 'Cobrado'){
            dot.classList.add('purple')
            fechaDiv.classList.add('purple')
            colorSel='purple'
        }
        if (state.textContent == 'Por cobrar'){
            dot.classList.add('orange')
            fechaDiv.classList.add('orange')
            colorSel='orange'
        }
        if (state.textContent == 'Terminado'){
            dot.classList.add('green')
            fechaDiv.classList.add('green')
            colorSel='green'
        }
        if (state.textContent == 'Contabilizado'){
            dot.classList.add('blue')
            fechaDiv.classList.add('blue')
            colorSel='blue'
        }
        if (state.textContent == 'Atrasado'){
            dot.classList.add('red')
            fechaDiv.classList.add('red')
            colorSel='red'
        }
        contextMenuItem[i].parentElement.classList.toggle('show')

        //hacer cambio de estado
        let estadoId = contextMenuItem[i].getAttribute('data-id')
        const estadoForm = new FormData()
        estadoForm.append('id', estadoId)
        estadoForm.append('estado', state.textContent)
        estadoForm.append('dot', colorSel)
        fetch('php/estado.php', {
            method: 'post',
            body: estadoForm
        }).then(function(response) {
            if(response.ok) {
                return response.text()
            } else {
                throw "Error.";
            }         
        })
    })
}

// mostrar / cerrar modal agregar
try {
    const addBtn = document.querySelector('.add-btn')
    const closeModal = document.querySelector('#closeModal')
    addBtn.addEventListener('click', () => {
        addModal.classList.add('show')   
    })
    closeModal.addEventListener('click', () => {
        addModal.classList.remove('show')
    })   
} catch (error) {}

// mostrar / cerrar modal editar
const closeEditModal = document.querySelector('#closeEditModal')
closeEditModal.addEventListener('click', () => {
    editModal.classList.remove('show')
})

// guardar
try {
    const saveModal = document.querySelector('#saveModal')
    const formAdd = document.querySelector('#formAdd')
    const modalText = document.querySelector('.modal-text')

    saveModal.addEventListener('click', () => {
        if (modalText.value != ""){
            formAdd.submit()        
        }else{
            modalText.focus()
        }
    })
} catch (error) {}

// actualizar
const saveEditModal = document.querySelector('#saveEditModal')
const formEdit = document.querySelector('#formEdit')
const modalTextEdit = document.querySelector('.modal-text-edit')

saveEditModal.addEventListener('click', () => {
    if (modalTextEdit.value != ""){
        formEdit.submit()        
    }else{
        modalTextEdit.focus()
    }
})

// btn editar pedido (card)
const editBtn = document.querySelectorAll('.edit-pedido-btn')
for (let i = 0; i < editBtn.length; i++){
    editBtn[i].addEventListener('click', () => {
        let pedidoId = editBtn[i].getAttribute('data-id')
        let pedidoFecha = editBtn[i].getAttribute('data-fecha')
        let pedidoCliente = editBtn[i].getAttribute('data-cliente')
        let pedidoDetalle = editBtn[i].getAttribute('data-detalle')
        let pedidoValor = editBtn[i].getAttribute('data-valor')

        editModal.classList.add('show')
        
        let editFechaModal = document.querySelector('#editFecha')
        editFechaModal.value = pedidoFecha        

        let editDetalleModal = document.querySelector('.modal-text-edit')
        editDetalleModal.value = pedidoDetalle

        let editClienteModal = document.querySelector('#clienteEdit')
        editClienteModal.value = pedidoCliente

        let editValorModal = document.querySelector('#valorEdit')
        editValorModal.value = pedidoValor

        let inputId = document.querySelector('#inputId')
        inputId.value = pedidoId
    })
}

// buscar
try {
    const searchBtn = document.querySelector('.search-btn')
    const searchForm = document.querySelector('#searchForm')    
    
    searchBtn.addEventListener('click', () => {
        searchForm.submit()        
    })   
} catch (error) {}

// filtrar por fecha
try {
    const filFecha = document.querySelector('#filFecha')
    const filForm = document.querySelector('#filForm')

    filFecha.addEventListener("change", () => {
        filForm.submit()
    })
} catch (error) {
    console.log(error)
}

// filtrar por estado
const btnFilState = document.querySelectorAll('.btn-fil-state')
const filStateform = document.querySelector('#filStateForm')
const inputEstado = document.querySelector('#inputEstado')

for (let i = 0; i < btnFilState.length; i++){
    btnFilState[i].addEventListener('click', ()=> {        
        inputEstado.value = btnFilState[i].getAttribute('data-estado')        
        filStateform.submit()
    })
}

// ordenar

try {
    const sorterBtn = document.querySelector('.sorter-btn')
    const sorterMenu = document.querySelector('.sorter-menu')
    const container = document.querySelector('.container')

    sorterBtn.addEventListener('click', () => {
        sorterMenu.classList.toggle('show')
    })   
} catch (error) {}
