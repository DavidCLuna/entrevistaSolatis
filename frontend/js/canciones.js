//load page jquery
$(document).ready(function () {
    //load page
    loadPage();
})


async function loadPage() {

    showLoadingAlert(true)

    // Cargar la lista de canciones al cargar la página
    await getCanciones();

    // function para detectar el envio de formulario de registro
    $('#cancion-form').submit(function (e) {
        e.preventDefault();
        if($('#btn-agregar').text() == 'Registrar'){
            crearCancion();
        }else{
            editarCancion();
        }
    })

    showLoadingAlert(false)
}

// Función para obtener la lista de canciones y mostrar en la interfaz
async function getCanciones() {
    const data = await axiosFunctionUtil('get', 'index');

    const cancionesLista = document.getElementById('canciones-lista');
    cancionesLista.innerHTML = '';
    data.data.forEach(cancion => {
        const listItem = document.createElement('li');
        listItem.className = 'list-group-item d-flex justify-content-between align-items-center';
        listItem.innerHTML = `
                <span>${cancion.titulo} - ${cancion.artista}</span>
                <div>
                    <button class="btn btn-info btn-sm btn-margin" onclick="openEditForm(${cancion.id})">Editar</button>
                    <button class="btn btn-danger btn-sm ml-2" onclick="eliminarCancionPost(${cancion.id})">Eliminar</button>
                </div>
            `;
        cancionesLista.appendChild(listItem);
    });
}


// Función para crear una nueva canción
async function crearCancion() {
    const titulo = document.getElementById('titulo').value;
    const artista = document.getElementById('artista').value;

    if (titulo === '' || artista === '') {
        showErrorAlert('Debes ingresar el titulo y el artista de la canción.');
        return;
    }

    showLoadingAlert(true)

    const data = { titulo, artista };
    
    const response = await axiosFunctionUtil('post', 'store', data)
    
    if (response.status == 201) {
        await showSuccessAlert('Canción creada exitosamente.');
        
        await getCanciones();

        $('#cancionModal').modal('hide');
        
        $('#cancion-form').trigger('reset');

    }else {
        await showErrorAlert('Error al crear la canción.');
    }

    showLoadingAlert(false)

}

// Función para eliminar una canción
async function eliminarCancionPost(id) {

    //confirmacion
    const confirm = await showConfirmAlert('¿Estás seguro de eliminar la canción?');
    if(!confirm){
        return;
    }

    showLoadingAlert(true)
    const response = await axiosFunctionUtil('delete', `destroy&id=${id}`)
    
    if (response.status == 204) {
        await showSuccessAlert('Canción eliminada exitosamente.');
        await getCanciones();
    }else {
        await showErrorAlert('Error al eliminar la canción.');
    }
    showLoadingAlert(false)
}


// Función para abrir el formulario de registro
async function openAddForm(){
    $('#cancionModal').modal('show');
    $('#cancion-form').trigger('reset');
    $('#btn-agregar').text('Registrar');
}

// Función para abrir el formulario de edición
async function openEditForm(id) {
    showLoadingAlert(true)
    const {data} = await axiosFunctionUtil('get', `show&id=${id}`)
    
    $('#cancionModal').modal('show');
    $('#idEditar').val(data.id);
    $('#titulo').val(data.titulo);
    $('#artista').val(data.artista);
    $('#btn-agregar').text('Actualizar');
    showLoadingAlert(false)
}


// Función para actualizar una canción
async function editarCancion() {
    const titulo = document.getElementById('titulo').value;
    const artista = document.getElementById('artista').value;
    const idEditar = document.getElementById('idEditar').value;

    if (titulo === '' || artista === '') {
        showErrorAlert('Debes ingresar el titulo y el artista de la canción.');
        return;
    }
    
    if(idEditar == '') window.location.reload();

    showLoadingAlert(true)

    const response = await axiosFunctionUtil('put', `update&id=${idEditar}`, {titulo, artista})

    if (response.status == 200) {
        await showSuccessAlert('Canción actualizada exitosamente.');
        await getCanciones();
        $('#cancionModal').modal('hide');
        $('#cancion-form').trigger('reset');
    }else{
        await showErrorAlert('Error al actualizar la canción.');
    }
}
