<template>
    <div class="user-login">
        <h1 class="userLoginTitle" @click="enterIndex">欢迎登录</h1>
        <el-form :model="userLogin" ref="userLogin" label-width="100px" class="demo-ruleForm">
            <el-form-item label="email" prop="email" :rules="[
                          { required: true, message: '请输入邮箱地址', trigger: 'blur' },
                { type: 'email', message: '请输入正确的邮箱地址', trigger: 'blur' }
            ]">
                <el-input type="email" v-model="userLogin.email" auto-complete="off"></el-input>
            </el-form-item>
            <el-form-item label="密码" prop="pass" :rules="[{required:true,message:'请输入密码',trigger: 'blur'}]">
                <el-input type="password" v-model="userLogin.pass" auto-complete="off"></el-input>
            </el-form-item>
            <el-form-item>
                <el-button type="primary" @click="submitForm('userLogin')">提交</el-button>
                <el-button @click="resetForm('userLogin')">重置表单</el-button>
            </el-form-item>
        </el-form>
    </div>
</template>


<script>
    export default {
        data() {
            return {
                userLogin: {
                    pass: '',
                    email: ''
                },
                fromPath: '',
                errmsg:""
            };
        },
        methods: {
            enterIndex(){
                this.$router.push({name: 'index'})
            },
            submitForm(formName) {
                this.$refs[formName].validate((valid) => {
                    if (valid) {
                        axios.post('/login', {
                            email: this.userLogin.email,
                            password: this.userLogin.pass
                        }).then(res => {
                            sessionStorage.setItem('user-id', res.data.id)
                            sessionStorage.setItem('user-email', res.data.email)
                            sessionStorage.setItem('user-name', res.data.name)
                            sessionStorage.setItem('user-nickname',res.data.user_info[0].nickname)
                            this.$notify({
                                title: '登录成功',
                                message: '欢迎登录',
                                type: 'success',
                                duration: 2000,
                                onClose(){
                                    location.reload()
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
        },
        created(){

        }
    }
</script>

<style>
    .user-login {
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        margin: auto;
        height: 300px;
        width: 35%;
    }

    .userLoginTitle {
        margin-bottom: 40px;
        text-align: center;
        margin-left: 85px;
    }
</style>