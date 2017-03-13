<template>
    <div class="admin-login">
        <h1 class="adminLoginTitle" @click="enterIndex">欢迎登录管理员后台</h1>
        <el-form :model="adminLogin" ref="adminLogin" label-width="100px" class="demo-ruleForm">
            <el-form-item label="邮箱" prop="email" :rules="[
                          { required: true, message: '请输入邮箱地址', trigger: 'blur' },
                { type: 'email', message: '请输入正确的邮箱地址', trigger: 'blur' }
            ]">
                <el-input type="email" v-model="adminLogin.email" auto-complete="off"></el-input>
            </el-form-item>
            <el-form-item label="密码" prop="pass" :rules="[{required:true,message:'请输入密码',trigger: 'blur'}]">
                <el-input type="password" v-model="adminLogin.pass" auto-complete="off"></el-input>
            </el-form-item>
            <el-form-item>
                <el-button type="primary" @click="submitForm('adminLogin')">提交</el-button>
                <el-button @click="resetForm('adminLogin')">重置输入</el-button>
            </el-form-item>
        </el-form>
    </div>
</template>


<script>
    export default {
        data() {
            return {
                adminLogin: {
                    pass: '',
                    email: '',
                    errmsg: ""
                },
                fromPath: ''
            };
        },
        methods: {
            enterIndex(){
                this.$router.push({name: 'index'})
            },
            submitForm(formName) {
                this.$refs[formName].validate((valid) => {
                    if (valid) {
                        axios.post('/admin/login', {
                            email: this.adminLogin.email,
                            password: this.adminLogin.pass
                        }).then(res => {
                            var time = new Date();
                            sessionStorage.setItem('admin-id', res.data.id)
                            sessionStorage.setItem('admin-email', res.data.email)
                            sessionStorage.setItem('admin-name', res.data.name)
                            sessionStorage.setItem('miss-hour', time.getHours())
                            sessionStorage.setItem('miss-minute', time.getMinutes())
                            this.$notify({
                                title: '登录成功',
                                message: '欢迎登录',
                                type: 'success',
                                duration: 2000,
                                onClose(){
                                    location.replace('/haso')
                                }
                            })
                        }).catch(err => {
                            this.errmsg = err.response.data.email
                            this.$notify({
                                title: '登录失败',
                                message: this.errmsg,
                                type: 'error',
                                duration: 2000,
                                onClose(){
                                    location.reload()
                                }
                            })
                        })

                    } else {
                        console.log('error submit!!');
                        return false;
                    }
                });
            },
            resetForm(formName) {
                this.$refs[formName].resetFields();
            }
        }
    }
</script>

<style>
    .admin-login {
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        margin: auto;
        height: 300px;
        width: 35%;
    }

    .adminLoginTitle {
        margin-bottom: 30px;
        text-align: center;
        margin-left: 85px;
    }
</style>
