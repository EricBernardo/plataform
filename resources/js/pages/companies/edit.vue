<template>
    <card :title="$t('your_info')">
        <form @submit.prevent="update" @keydown="form.onKeydown($event)">
            <alert-success :form="form" :message="$t('info_updated')"/>
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
                    <v-button :loading="form.busy" type="success">{{ $t('update') }}</v-button>
                </div>
            </div>
        </form>
    </card>
</template>

<script>

    import Form from 'vform'
    import axios from 'axios'

    const http = axios;

    export default {

        scrollToTop: false,

        metaInfo() {
            console.log(this.$router.params);
            return {title: this.$t('company')}
        },

        data: () => ({
            form: new Form({
                title: ''
            })
        }),

        created() {

            http.get(app_url + '/api/company/' + this.$route.params.id)
                .then(response => {
                    this.company = response.data;
                    this.form.keys().forEach(key => {
                        this.form[key] = this.company[key];
                    });
                });

        },

        methods: {
            async update() {
                await this.form.put('/api/company/update/' + this.$route.params.id);
            }
        }
    }
</script>
