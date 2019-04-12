<template>
    <div>

        <router-link :to="{ name: 'companies.create' }">
            <button class="btn btn-primary btn-sm">
                Cadastrar
            </button>
        </router-link>

        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th style="width: 10px">#</th>
                <th>Título</th>
                <th>-</th>
                <th>-</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="post in laravelData.data">
                <th scope="row">{{ post.id }}</th>
                <td>{{ post.title }}</td>
                <td>
                    <router-link :to="{ name: 'companies.edit', params: { id: post.id } }">
                        <button class="btn btn-primary btn-sm">
                            <fa icon="edit" fixed-width/>
                            Edit
                        </button>
                    </router-link>
                </td>
                <td>
                    <button class="btn btn-danger btn-sm">
                        <fa icon="trash" fixed-width/>
                        Del
                    </button>
                </td>
            </tr>
            </tbody>
        </table>

        <pagination :data="laravelData" @pagination-change-page="getResults"></pagination>

    </div>
</template>

<script>

    import axios from 'axios'

    const http = axios

    export default {

        data() {
            return {
                laravelData: {},
            }
        },

        mounted() {
            this.getResults();
        },

        methods: {
            getResults(page = 1) {
                http.get('/api/company?page=' + page)
                    .then(response => {
                        this.laravelData = response.data;
                    });
            }
        }

    }

</script>
