<template>
    <div class="card">
        <div class="card-header">
            <div class="text-center px-5 my-3 d-flex gap-4 justify-content-between">
                <h3>Lista de Livros</h3>

                <div class="d-flex gap-3 w-50">
                    <RouterLink to="/livros/criar" class="d-grid w-75 text-decoration-none">
                        <button class="btn btn-primary">Cadastrar Livro</button>
                    </RouterLink>
                    <RouterLink to="/autores/criar" class="d-grid w-50 text-decoration-none">
                        <button class="btn btn-info">Cadastrar Autor</button>
                    </RouterLink>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="body">
                <div class="table-responsive" v-if="livros.length > 0">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center fw-bold fs-5">ID</th>
                                <th class="text-center fw-bold fs-5">Título</th>
                                <th class="text-center fw-bold fs-5">Preço</th>
                                <th class="text-center fw-bold fs-5">Autor</th>
                                <th class="text-center fw-bold fs-5">Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr v-for="(livro, index) in livros" :key="index">
                                <td class="text-center">{{ livro.id }}</td>
                                <td class="text-center">{{ livro.title }}</td>
                                <td class="text-center">{{ formatPrice(livro.price) }}</td>
                                <td class="text-center">{{ livro.rel_users.name }}</td>

                                <td class="text-center">
                                    <RouterLink :to="{ path: '/livros/' + livro.id + '/editar' }" class="btn btn-info">
                                        Editar
                                    </RouterLink>

                                    <button type="button" @click="openModal(livro.id)" class="btn btn-danger ms-2"
                                        data-bs-toggle="modal" data-bs-target="#modalExcluir">
                                        Apagar
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div v-else-if="!loading && livros.length === 0" class="text-center">
                    <div class="card">
                        <div class="card-body">
                            <h5>Nenhum livro foi encontrado</h5>
                        </div>
                    </div>
                </div>

                <div v-if="loading" class="text-center">
                    <div class="spinner-border" role="status">
                        <span class="visually-hidden">Carregando...</span>
                    </div>
                    <div>
                        <h6>Buscando Livros...</h6>
                    </div>
                </div>
            </div>
        </div>

        <Toast v-if="showToast" :message="successMessage" :toastType="toastType" />

        <ConfirmModal modalId="modalExcluir" :message="'Você tem certeza de que quer excluir esse livro?'"
            @confirm="confirmdDeleteLivro" />
    </div>
</template>

<script>
import { ref, onMounted } from 'vue'
import axios from 'axios'
import ConfirmModal from '../../components/ConfirmModal.vue'
import Toast from '../../components/Toast.vue'

export default {
    components: { ConfirmModal, Toast },
    name: 'livros',
    setup() {
        const successMessage = ref('')
        const showToast = ref(false)
        const toastType = ref('success')
        const loading = ref(true)
        const livros = ref([])
        const livroIdToDelete = ref(null)

        function displayToast(message, type = 'success') {
            successMessage.value = message
            toastType.value = type
            showToast.value = true

            setTimeout(() => {
                showToast.value = false
            }, 2500)
        }

        async function getLivros() {
            loading.value = true

            axios
                .get('http://127.0.0.1:8000/api/books')

                .then((res) => {
                    livros.value = res.data || []
                    console.log(res.data)
                })
                .catch(() => {
                    livros.value = []
                })
                .finally(() => {
                    loading.value = false
                })
        }

        function openModal(bookId) {
            livroIdToDelete.value = bookId
        }

        async function confirmdDeleteLivro() {
            if (livroIdToDelete.value !== null) {
                try {
                    await axios.delete(
                        `http://127.0.0.1:8000/api/books/${livroIdToDelete.value}`
                    )
                    displayToast('Livro excluído com sucesso!', 'success')

                    getLivros()
                    livroIdToDelete.value = null

                    const modalElement = document.getElementById('modalExcluir')
                    if (modalElement) {
                        const modal = bootstrap.Modal.getInstance(modalElement)
                        if (modal) {
                            modal.hide()
                        }
                    }
                } catch (error) {
                    console.error('Erro ao excluir livro:', error)
                    displayToast('Livro excluído com sucesso!', 'error')
                }
            }
        }

        function formatPrice(value) {
            return 'R$ ' + parseFloat(value).toFixed(2).replace('.', ',')
        }

        onMounted(() => {
            getLivros()
        })

        return {
            loading,
            livros,
            confirmdDeleteLivro,
            formatPrice,
            openModal,
            successMessage,
            displayToast,
            toastType, showToast
        }
    }
}
</script>
