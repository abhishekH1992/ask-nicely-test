<template>
    <div class="row my-4">
        <div class="col-3 m-auto">
            <input type="file" ref="file" accept=".csv" class="form-control" @change="upload"/>
        </div>
        <div class="alert text-center mx-2 d-flex" :class="cssClass" v-if="msg">
            <div class="text-center msg">{{ msg }}</div>
            <div class="close" @click="removeMsg">×</div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            msg: '',
            cssClass: ''
        }
    },
	methods: {
        upload() {
            this.$emit('show-loader', true);
            let formData = new FormData();
            formData.append('file', this.$refs.file.files[0]);
            this.$store
                .dispatch('employee/upload_file', formData).then((response) => {
                    this.$emit('show-loader', false);
                    if(response.data.status == 'success') {
                        this.msg = response.data.msg;
                        this.cssClass = "alert-success";
                        this.$store.dispatch('employee/get_list');
                    } else {
                        this.msg = response.data.msg;
                        this.cssClass = "alert-error";
                    }
                    this.$refs.file.reset();
                }).catch(() => {
                    this.$refs.file.reset();
                    this.msg = 'Something went wrong! Please reload the page.';
                    this.cssClass = "alert-error";
                });
        },
        removeMsg() {
            this.msg = '';
            this.cssClass = '';
        }
    },
}
</script>

<style scoped>
.alert {
    padding: 15px;
    margin: 0.5rem 0;
    border: 1px solid transparent;
    border-radius: 4px;
}
.alert-success {
    color: #3c763d;
    background-color: #dff0d8;
    border-color: #d6e9c6;
}

.alert-error {
    color: #a94442;
    background-color: #f2dede;
    border-color: #ebccd1;
}
.msg{
    width: 100%;
}
.close {
    margin-left: auto;
    cursor: pointer;
}
</style>