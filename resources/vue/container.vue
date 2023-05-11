<template>
    <div class="body-table h-full">
        <div class="flow-root bg-gray-300 border-b-4">
            <div class="float-left bg-green-100 text-xl border border-green-400 text-green-900 ml-3 mr-3 w-fit p-5 px-4 py-3 rounded relative mt-2 mb-2" role="alert" v-if="message">
                <span class="block sm:inline">{{ message }}</span>
            </div>
            <button class="text-3xl ml-2 mr-10 bg-grey-100 p-5 float-right" @click="refreshData()">
                <font-awesome-icon icon="rotate-right" />
            </button>
        </div>
        <table class="w-full table-auto" v-if="!loader">
            <thead class="bg-gray-200 border-b-2 border-gray-200">
                <tr>
                    <th class="p-3 text-2xl font-semibold tracking-wide text-left">Nombre</th>
                    <th class="p-3 text-2xl font-semibold tracking-wide text-left">Network</th>
                    <th class="p-3 text-2xl font-semibold tracking-wide text-left">Running</th>
                    <th class="p-3 text-2xl font-semibold tracking-wide text-left">Status</th>
                    <th class="p-3 text-2xl font-semibold tracking-wide text-left">Acción</th>
                </tr>
            </thead>
            <tbody class="overflow-hidden" v-for="container in containers" v-if="containers">
                    <tr class="bg-gray-100">
                        <td class="p-2 text-gray-700 w-0 text-2xl">{{ container.name }}</td>
                        <td class="p-2 text-gray-700 w-0 text-2xl">{{ container.network }}</td>
                        <td class="p-2 text-gray-700 w-0 text-2xl">
                            <span class="span-running p-1.5 font-medium uppercase text-wider text-green-800 bg-green-200 rounded-lg bg-opacity-50" v-if="container.running">running</span>
                            <span class="span-stoped p-1.5 font-medium uppercase text-wider text-red-800 bg-red-200 rounded-lg bg-opacity-50" v-else>stoped</span>
                        </td>
                        <td class="p-2 text-gray-700 w-0 text-2xl">{{ container.state }}</td>
                        <td class="p-2 text-gray-700 w-0 text-2xl">
                            <button class="text-xl ml-2 mr-3 bg-grey-100 hover:bg-yellow-200 p-2 hover:rounded-lg hover:text-yellow-700" v-if="container.running" @click="updateContainer('stop', container.name)">
                                <font-awesome-icon icon="stop" />
                            </button>
                            <button class="text-xl ml-2 mr-3 bg-grey-100 hover:bg-green-200 p-2 hover:rounded-lg hover:text-green-800" v-else @click="updateContainer('start', container.name)">
                                <font-awesome-icon icon="play" />
                            </button>
                            <button class="text-xl ml-4 bg-grey-100 hover:bg-red-200 p-2 hover:rounded-lg hover:text-red-800" @click="updateContainer('rm', container.name)">
                                <font-awesome-icon icon="trash" />
                            </button>
                        </td>
                    </tr>
                </tbody>
                <tbody v-else>
                    <tr class="bg-gray-100 w-full text-2xl font-semibold ">
                        <td class="p-2 text-m text-gray-700 w-0">No hay containers</td>
                    </tr>
                </tbody>
        </table>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: 'containers',
    props: ['containers', 'loader'],
    data: function() {
        return {
            message: ""
        }
    },
    methods: {
        updateContainer(action, containerName) {
            axios.post('api/updateContainer', {
                action: action,
                name: containerName
            })
            .then( response => {
                this.message = response.data
                this.$emit('reloadContainers')
                setTimeout(() => {
                    this.message = ''
                }, 5000);
            })
            .catch( error => {
                console.error(error)
            })
        },
        refreshData() {
            this.$emit('reloadContainers')
            this.message = ''
        }
    }
}
</script>