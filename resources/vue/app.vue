<template class="bg-gray-700">
    <div class="p-1 pb-2 pt-2 bg-gray-700 flex flex-row">
        <img class="w-12" src="../images/dockerLogo.png">
        <h1 class="pt-2 ml-3 text-4xl text-slate-200 font-semibold">Monitoreo contenedores docker</h1>
    </div>
    <containers
        :containers='containers'
        v-on:reloadContainers="getItems()"
        :loader='loader'
    />
    <div class="p-5 bg-gray-700 text-xl text-slate-200 font-semibold fixed bottom-0 left-0 w-full">
        <span>Lucas Cordasco {{ current_date }}</span>
    </div>
</template>

<script>
import containers from './container.vue'

export default {
    name: 'app',
    components: {
        containers
    },
    data: function() {
        return {
            containers: [],
            current_date: new Date().getFullYear(),
            fullPage: false,
            loader: false
        }
    },
    methods: {
        getItems() {
            this.loader = true
            let loader = this.$loading.show({
                // Optional parameters
                container: false,
                canCancel: false,
                opacity: 0.1,
            });
            axios.get('api/containers')
            .then( response => {
                this.containers = response.data
                this.loader = false
                loader.hide()
            })
            .catch( error => {
                console.error( error )
                loader.hide()
            })
        }
    },
    created() {
        this.getItems()
    }
}
</script>