<template>
    <div ref="toastContainer" class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 1050">
        <div class="toast" :class="`text-white ${toastType === 'success' ? 'bg-success' : 'bg-danger'}`" role="alert"
            aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body ">
                    <h6 class="text-center">{{ message }}</h6>
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                    aria-label="Close"></button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        message: {
            type: String,
            required: true
        },
        toastType: {
            type: String,
            default: 'success'
        }
    },
    mounted() {
        this.showToast()
    },
    methods: {
        showToast() {
            const toastElement = this.$el.querySelector('.toast')
            const toastInstance = new bootstrap.Toast(toastElement, {
                autohide: true,
                delay: 3000
            })
            toastInstance.show()
        }
    }
}
</script>

<style scoped>
.toast-container {
    z-index: 1050;
}
</style>
