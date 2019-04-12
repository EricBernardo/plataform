<template>
    <div>

        <router-link :to="{ name: 'companies.create' }">
            <button class="btn btn-success">
                {{ $t('register') }}
            </button>
        </router-link>

        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th style="width: 10px">#</th>
                <th>{{ $t('title') }}</th>
                <th>-</th>
                <th>-</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="item in items.data">
                <th scope="row">{{ item.id }}</th>
                <td>{{ item.title }}</td>
                <td>
                    <router-link :to="{ name: 'companies.edit', params: { id: item.id } }">
                        <button class="btn btn-info btn-sm">
                            <fa icon="edit" fixed-width/>
                            {{ $t('edit') }}
                        </button>
                    </router-link>
                </td>
                <td>
                    <button class="btn btn-danger btn-sm" @click.prevent="deleteRegister(item.id)">
                        <fa icon="trash" fixed-width/>
                        {{ $t('delete') }}
                    </button>
                </td>
            </tr>
            </tbody>
        </table>

        <pagination :data="items" @pagination-change-page="getResults"></pagination>

    </div>
</template>

<script>

    import axios from 'axios'

    import swal from 'sweetalert2'

    const http = axios

    export default {

        data() {
            return {
                items: {}
            }
        },

        mounted() {
            this.getResults();
        },

        methods: {
            getResults(page = 1) {

                http.get('/api/company?page=' + page)
                    .then(response => {
                        this.items = response.data;
                    });

            },
            deleteRegister(id) {

                let self = this;

                swal({
                    title: 'Are you sure?',
                    text: 'You will not be able to recover this post!',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, keep it',
                }).then(function (response) {

                        if (response.value === true) {

                            http.delete('/api/company/' + id).then(function (response) {

                                self.getResults();

                                swal(
                                    'Deleted!',
                                    'Your register has been deleted.',
                                    'success'
                                );

                            });

                        }

                    }, function (dismiss) {

                        if (dismiss === 'cancel') {
                            swal(
                                'Cancelled',
                                'Your register is safe',
                                'error'
                            );
                        }

                    }
                )
            }
        }

    }

</script>
