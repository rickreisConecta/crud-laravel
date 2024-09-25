<template>
    <div>
        <div class="card">
            <div class="card-header">
                <h3>Cadastrar Livro</h3>
            </div>

            <form class="card-body container mt-3">
                <div class="mb-3">
                    <label for="nome">Título</label>
                    <input type="text" v-model="model.livro.title" id="nome" class="form-control" />
                </div>

                <div class="mb-3">
                    <label for="price">Preço</label>
                    <input type="text" v-model="model.livro.price" id="price" class="form-control"
                        @input="onPriceInput" />
                </div>

                <div class="mb-3">
                    <label for="id_user">Autor</label>
                    <select v-model="selectedUserId" class="form-control" id="id_user" required>
                        <option value="" disabled>Selecione um autor</option>
                        <option v-for="user in users" :key="user.id" :value="user.id">
                            {{ user.name }}
                        </option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="pages">Páginas</label>
                    <input type="number" v-model="model.livro.pages" id="pages" class="form-control" />
                </div>

                <div class="d-flex justify-content-between mb-3">
                    <button type="button" @click="criarLivro" class="btn btn-primary">
                        Enviar
                    </button>

                    <RouterLink to="/livros" class="btn btn-info">
                        Voltar
                    </RouterLink>
                </div>
            </form>

            <div v-if="successMessage" class="toast-container position-fixed top-0 end-0 text-center">
                <div id="successToast" class="toast bg-success text-white fs-6 me-3 mt-3 custom-toast" role="alert">
                    {{ successMessage }}
                </div>
            </div>

            <div v-if="errorMessage" class="toast-container position-fixed top-0 end-0 text-center">
                <div id="errorToast" class="toast bg-danger text-white fs-6 me-3 mt-3 custom-toast" role="alert">
                    {{ errorMessage }}
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { ref } from 'vue'
import axios from 'axios';

export default {
    name: 'livroCriar',
    setup() {
        const successMessage = ref('')
        const errorMessage = ref('')

        function showToast(id, message) {
            const toastElemment = document.getElementById(id)

            if (toastElemment) {
                toastElemment.innerHTML = message
                const toast = new bootstrap.Toast(toastElemment, {
                    autohide: true,
                    delay: 3000
                })
                toast.show()
            }
        }
        return {
            successMessage,
            errorMessage,
            showToast
        }
    },
    data() {
        return {
            bookId: '',
            model: {
                livro: {
                    id_user: '',
                    title: '',
                    price: '',
                    autor: '',
                    pages: ''
                }
            },
            users: [],
            selectedUserId: ''
        }
    },
    mounted() {
        this.bookId = this.$route.params.id

        this.getAutors()
    },
    methods: {
        getAutors() {
            axios
                .get('http://127.0.0.1:8000/api/users')
                .then((res) => {
                    this.users = res.data
                })
                .catch((error) => {
                    console.error('Erro ao buscar autores: ', error)
                })
        },

        onPriceInput(event){
            const value = event.target.value;
            const numericValue = value.replace(/[^0-9,]/g, '');
            this.model.livro.price = numericValue;
        },

        async criarLivro() {

            if (
                !this.model.livro.title ||
                !this.model.livro.price ||
                !this.selectedUserId ||
                !this.model.livro.pages
            ) {
                this.errorMessage = 'Por favor, preencha todos os campos!'
                this.$nextTick(() => {
                    this.showToast('errorToast', this.errorMessage)
                })
                return
            }

            try {
                this.model.livro.id_user = this.selectedUserId

                const formattedPrice = this.model.livro.price.replace(',', '.');

                const payload = {
                    ...this.model.livro,
                    autor: this.selectedUserId,
                    price: parseFloat(formattedPrice).toFixed(2)
                }
                
                const response = await axios.post(
                    `http://127.0.0.1:8000/api/books`,
                    payload,

                )
                this.successMessage = "Livro cadastrado com sucesso!"
                this.$nextTick(() => {
                    this.showToast('successToast', this.successMessage)
                    setTimeout(() => {
                        this.$router.push('/livros')
                    }, 2500)
                })
            } catch (error) {
                console.error('Erro ao adicionar livro', error)
                this.successMessage = ''
            }
        }
    },
}
</script>