const modalElements = document.querySelectorAll('.modal')
const editProfileError = document.getElementById('error-profile')
const addTodoError = document.getElementById('error-todo')
const addItemError = document.getElementById('error-item')
const notify = document.getElementById('notify')

const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    showCloseButton: true,
})

if (notify && notify.value) Toast.fire({
    icon: notify.dataset.name,
    title: notify.value
})

for (const modalElement of modalElements) {
    const modal = bootstrap.Modal.getOrCreateInstance(modalElement)

    if (editProfileError && editProfileError.value === '1' && modalElement.id === 'edit-profile-modal') modal.show()

    if (addTodoError && addTodoError.value === '1' && modalElement.id === 'add-todo-modal') modal.show()

    if (addItemError && addItemError.value === '1' && modalElement.id === 'add-item-modal') modal.show()
}

document.addEventListener('alpine:init', () => {
    Alpine.data('todoItems', (done, id) => ({
        done,

        async mark() {
            this.done = !this.done

            await fetch(`/item/${id}/mark`, { method: 'POST' })
        }
    }))
})