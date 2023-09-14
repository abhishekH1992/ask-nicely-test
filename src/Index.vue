<template>
    <div class="container">
        <List />
    </div>
</template>

<script>
import List from './components/List.vue'

export default {
    data() {
        return {
            employee: [],
        }
    },
	components: {
		List
	},
    computed: {
        
    },
    methods: {
        
    },
    mounted() {
        
    },
}
</script>

<style>
#app {
    font-family: Avenir, Helvetica, Arial, sans-serif;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    text-align: center;
    color: #2c3e50;
    margin-top: 60px;
}
</style>
