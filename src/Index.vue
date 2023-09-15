<template>
    <div>
        <notifications position="top right" group="success" classes="success-notification"/>
        <notifications position="top right" group="error" classes="error-notification"/>
        <div class="container">
            <UploadFile @show-loader="showLoader"/>
            <List @show-loader="showLoader"/>
        </div>
        <div class="loader-container" v-if="setLoader">
            <div class="loader"></div>
        </div>
    </div>
</template>

<script>
import '../public/app.css';
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