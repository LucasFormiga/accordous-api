<template>
  <div>
      <table class="table">
          <thead>
              <tr>
                  <th>#</th>
                  <th>Nome</th>
                  <th>E-mail</th>
                  <th>Custo</th>
              </tr>
          </thead>

          <tbody>
              <tr v-for="provider in providers" :key="provider.id">
                  <td>{{ provider.id }}</td>
                  <td>{{ provider.name }}</td>
                  <td>{{ provider.email }}</td>
                  <td>R$ {{ provider.payment }}</td>
              </tr>

              <tr v-if="providers.length < 1">
                <td colspan="5">
                    <center>Nenhum fornecedor encontrado</center>
                </td>
              </tr>
          </tbody>
      </table>
  </div>
</template>

<script>
import axios from "axios";

export default {
    name: "list-providers",
    props: {
        token: {
            required: true,
            type: String
        }
    },
    data: function () {
        return {
            providers: []
        }
    },
    methods: {
        getProviders: function () {
            axios
                .get('/api/providers', {
                    "Authorization": this.token
                })
                .then(response => {
                    this.providers = response.data;
                })
                .catch(error => {
                    console.log(error);
                });
        }
    },
    mounted: function () {
        this.getProviders();
    }
}
</script>

<style>

</style>
