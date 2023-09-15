<template>
    <div class="row my-4">
        <div class="col-3 m-auto">
            <input type="file" ref="file" accept=".csv" class="form-control" @change="upload"/>
        </div>
    </div>
</template>

<script>
export default {
	methods: {
        upload() {
            this.$emit('show-loader', true);
            let formData = new FormData();
            formData.append('file', this.$refs.file.files[0]);
            this.$store
                .dispatch('employee/upload_file', formData).then((response) => {
                    this.$emit('show-loader', false);
                    if(response.data.status == 'success') {
                        this.$notify({
                            group: 'success',
                            text: response.data.msg,
                            closeOnClick: false,
                        });
                        this.$store.dispatch('employee/get_list');
                        this.$store.dispatch('employee/avg_salary');
                    } else {
                        this.$notify({
                            group: 'error',
                            text: response.data.msg,
                            closeOnClick: false,
                        });
                    }
                    this.$refs.file.value = null;
                }).catch(() => {
                    this.$refs.file.value = null;
                    this.$notify({
                        group: 'error',
                        text: 'Something went wrong! Please reload the page.',
                        closeOnClick: false,
                    });
                });
        },
        removeMsg() {
            this.msg = '';
            this.cssClass = '';
        }
    },
}
</script>