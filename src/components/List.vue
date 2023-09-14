<template>
	<div class="list-section">
		<table class="table table-striped" v-if="list.length">
            <thead>
                <tr>
                    <th>Company Name</th>
                    <th>Employee Name</th>
                    <th>Email Address</th>
                    <th>Salary</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="value in list" :key="value.id">
                    <td>{{ value.company_name }}</td>
                    <td>{{ value.name }}</td>
                    <td>{{ value.email }}</td>
                    <td>{{ value.salary }}</td>
                    <td>Edit</td>
                </tr>
            </tbody>
        </table>
		<table class="table table-striped" v-else>
			<tbody>
                <tr>
					<td class="text-muted text-center" colspan="5">No Data Available. Please upload csv.</td>
                </tr>
            </tbody>
        </table>
		<input ref="file" type="file" class="d-none">
	</div>
</template>

<script>
export default {
    computed: {
        list() {
            return this.$store.state.employee.list;
        },
    },
	methods: {
    },
    mounted() {
        this.$store.dispatch('employee/get_list');
    },
}
</script>
