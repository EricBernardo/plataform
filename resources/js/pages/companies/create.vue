<template>
    <card :title="$t('your_info')">
        <form @submit.prevent="create" @keydown="form.onKeydown($event)">
            <alert-success :form="form" :message="$t('info_created')"/>
            <div class="form-group row">
                <label class="col-md-3 col-form-label text-md-right">{{ $t('title') }}</label>
                <div class="col-md-7">
                    <input v-model="form.title" :class="{ 'is-invalid': form.errors.has('title') }" class="form-control"
                           type="text" name="title">
                    <has-error :form="form" field="title"/>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-9 ml-md-auto">
                    <v-button :loading="form.busy" type="success">{{ $t('save') }}</v-button>
                </div>
            </div>
        </form>
    </card>
</template>

<script>

    import Form from 'vform'

    export default {

        scrollToTop: false,

        metaInfo() {
            return {title: this.$t('company')}
        },

        data: () => ({
            form: new Form({
                title: ''
            })
        }),

        methods: {
            async create() {
                await this.form.post('/api/company').then(response => {
                    if (response.status = 201) {
                        this.form.reset();
                    }
                });
            }
        }
    }

</script>
