<template>
    <div class="modal fade" :id="modalId" tabindex="-1" data-bs-backdrop="false">
        <div class="modal-dialog">
            <div class="modal-content bg-warning px-2 border-3 border-success rounded-4">
                <div class="modal-header border border-0">
                    <h3 class="modal-title text-center ">
                        {{ message }}
                    </h3>
                </div>

                <div class="modal-footer border border-0 d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Não, cancelar</button>
                    <button type="button" @click="onConfirm" class="btn btn-danger">Sim, excluir</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        modalId: {
            type: String,
            required: true
        },
        message: {
            type: String,
            default: 'Você tem certeza de que deseja excluir esse item?'
        }
    },
    emits: ['confirm'],
    methods: {
        onConfirm() {
            this.$emit('confirm');
        }
    }
}
</script>