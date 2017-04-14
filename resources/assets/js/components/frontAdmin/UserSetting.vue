<template>
    <el-form ref="form" :model="form" label-width="100px">
        <el-form-item label="昵称：">
            <el-input v-model="form.nickname"></el-input>
        </el-form-item>
        <el-form-item label="联系方式：">
            <el-input v-model="form.tel"></el-input>
        </el-form-item>
        <el-form-item label="收货地址：">
            <!--<el-col :span="2">-->
            <!--<el-button type="primary" icon="edit" size="mini" @click="editEnable"></el-button>-->
            <!--</el-col>-->
            <el-col :span="22">
                <select-address
                        @change="handleChange">
                </select-address>
            </el-col>
        </el-form-item>
        <el-form-item>
            <el-button type="primary" @click="onSubmit">立即创建</el-button>
            <el-button>取消</el-button>
        </el-form-item>
    </el-form>
</template>
<script>
    //    import { Loading } from 'element-ui';
    import SelectAddress from './selectAddress.vue'
    //    let loadingInstance = Loading.service({ fullscreen: true });

    export default {
        components: {SelectAddress},
        data() {
            return {
                form: {
                    nickname: '',
                    tel: ''
                }
            }
        },
        methods: {
            onSubmit() {
                axios.post('/api/user/user_info', {
                    'tel': this.form.tel,
                    'nickname': this.form.nickname,
                }).then(res => {
                    if (res.data.code == '200') {
                        this.$notify({
                            title: '保存成功',
                            message: '个人信息更新成功',
                            type: 'success'
                        });
                        this.disabled = true
                    } else if (res.data.code !== '200') {
                        this.$notify({
                            title: '保存失败',
                            message: res.data.err_msg,
                            type: 'error'
                        });
                    }
                }).catch(err => {
                    this.$notify({
                        title: '保存失败',
                        message: '保存数据失败',
                        type: 'error'
                    });
                })
            },
            handleChange: function (val) {
                console.log(val);
            }
        },
        created(){
            axios.get('/api/user/user_info').then(res => {
                this.form.nickname = res.data.nickname
                this.form.tel = res.data.tel
            })
        }
    }
</script>