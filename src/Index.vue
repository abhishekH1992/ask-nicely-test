<template>
    <div>
        <notifications position="top right" group="success" classes="success-notification"/>
        <notifications position="top right" group="error" classes="error-notification"/>
        <div class="container">
            <UploadFile @show-loader="showLoader"/>
            <List />
        </div>
        <div class="loader-container" v-if="setLoader">
            <div class="loader"></div>
        </div>
    </div>
</template>

<script>
import List from './components/List.vue'
import UploadFile from './components/UploadFile.vue'

export default {
    data() {
        return {
            setLoader: false,
        }
    },
	components: {
		List,
        UploadFile,
	},
    computed: {

    },
    methods: {
        showLoader(value) {
            this.setLoader = value;
        },
    },
    mounted() {
        
    },
}
</script>

<style scoped>
.loader-container {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(255, 255, 255, 0.7);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 9999;
}

.loader-container .loader {
    border: 6px solid #f3f3f3;
    border-top: 6px solid #425C81;
    border-radius: 50%;
    width: 50px;
    height: 50px;
    animation: spin 2s linear infinite;
}
</style>