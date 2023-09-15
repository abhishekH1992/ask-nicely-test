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
                    <td>${{ value.salary }}</td>
                    <td><div class="text-muted edit" @click="edit(value.id, value.email)">Edit Email</div></td>
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
        <div class="modal" :class="{show: showModal}">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Email</h5>
                    <button type="button" class="btn-close" @click="showModal = false"></button>
                </div>
                <div class="modal-body">
                    <input type="email" v-model="email" class="form-control"/>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" @click="showModal = false">Close</button>
                    <button type="button" class="btn btn-dark" @click="submit">Save changes</button>
                </div>
                </div>
            </div>
        </div>
	</div>
</template>

<script>
export default {
    data() {
        return {
            showModal: false,
            email: null,
            id: 0,
        }
    },
    computed: {
        list() {
            return this.$store.state.employee.list;
        },
    },
	methods: {
        edit(id, email) {
            this.showModal = true;
            this.id= id;
            this.email = email;
        },
        submit() {
            this.$emit('show-loader', true);
            let formData = new FormData();
            formData.append('id', this.id);
            formData.append('email', this.email);
            this.$store
                .dispatch('employee/update_email', formData).then((response) => {
                    this.$emit('show-loader', false);
                    console.log(response);
                    if(response.data.status == 'success') {
                        this.$notify({
                            group: 'success',
                            text: response.data.msg,
                            closeOnClick: false,
                        });
                        this.$store.dispatch('employee/get_list');
                    } else {
                        this.$notify({
                            group: 'error',
                            text: response.data.msg,
                            closeOnClick: false,
                        });
                    }
                    this.id = 0;
                    this.email = null;
                    this.showModal = false;
                }).catch(() => {
                    this.$notify({
                        group: 'error',
                        text: 'Something went wrong! Please reload the page.',
                        closeOnClick: true,
                    });
                    this.id = 0;
                    this.email = null;
                    this.showModal = false;
                });
        }
    },
    mounted() {
        this.$store.dispatch('employee/get_list');
    },
}
</script>
<style scoped>
.edit{
    cursor: pointer;
}
.show {
    display: block;
}
</style>