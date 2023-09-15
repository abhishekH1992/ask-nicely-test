<template>
	<div class="section">
		<div class="row">
            <div class="col-md-4 mt-2" v-for="(salary, key) in salaryList" :key="key">
                <div class="card p-3">
                    <div class="flex">
                        <h3 class="text-center">${{ salary.salary }}</h3>
                        <div class="text-muted text-center">{{ salary.company_name }}</div>
                    </div>
                </div>
            </div>
        </div>
	</div>
</template>

<script>
export default {
    computed: {
        salaryList() {
            return this.$store.state.employee.salaryList;
        },
    },
    mounted() {
        this.$store.dispatch('employee/avg_salary');
    },
}
</script>
