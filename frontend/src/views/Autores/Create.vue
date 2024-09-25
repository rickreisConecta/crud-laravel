<template>
    <div>
        <div class="card">
            <div class="card-header">
                <h3>Cadastrar Autor</h3>
            </div>

            <form class="card-body container mt-3">
                <div class="mb-3">
                    <label for="nome">Nome</label>
                    <input type="text" v-model="model.autor.name" id="name" class="form-control" />
                </div>

                <div class="mb-3">
                    <label for="email">E-mail</label>
                    <input type="email" v-model="model.autor.email" id="email" class="form-control" />
                </div>

                <div class="mb-3">
                    <label for="password">Senha</label>
                    <input type="password" v-model="model.autor.password" id="password" class="form-control">
                </div>

                <div class="d-flex justify-content-between mb-3">
                    <button type="button" @click="criarAutor" class="btn btn-primary">
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
                autor: {
                    name: '',
                    email: '',
                    password: ''
                }
            }
        }
    },
    methods: {
        async criarAutor() {
            if (
                !this.model.autor.name ||
                !this.model.autor.email ||
                !this.model.autor.password
            ) {
                this.errorMessage = 'Por favor, preencha todos os campos!'
                this.$nextTick(() => {
                    this.showToast('errorToast', this.errorMessage)
                })
                return
            }

            try {
                const payload = {
                    ...this.model.autor,
                }

                const response = await axios.post(
                    'http://127.0.0.1:8000/api/users',
                    payload,

                )
                this.successMessage = "Autor cadastrado com sucesso!"
                this.$nextTick(() => {
                    this.showToast('successToast', this.successMessage)
                    setTimeout(() => {
                        this.$router.push('/livros')
                    }, 2500)
                })
            } catch (error) {
                console.error('Erro ao adicionar autor', error)
                this.successMessage = ''
            }
        }
    },
}
</script>