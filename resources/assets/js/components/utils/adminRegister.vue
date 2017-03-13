<template>

    <div class="admin-register">
        <h1 class="adminRegisterTitle" @click="enterIndex">管理员后台注册</h1>

        <el-form :model="adminRegister" :rules="rules2" ref="adminRegister" label-width="100px"
                 class="demo-ruleForm">

            <el-form-item label="用户名" prop="adminname" :rules="
             [{ required: true, message: '请输入用户名', trigger: 'blur' }]">

                <el-input v-model.trim="adminRegister.adminname"></el-input>

            </el-form-item>

            <el-form-item label="邮箱" prop="email" :rules="[
                           { required: true, message: '请输入邮箱地址', trigger: 'blur' },
                 { type: 'email', message: '请输入正确的邮箱地址', trigger: 'blur' }
             ]">

                <el-input v-model.trim="adminRegister.email"></el-input>

            </el-form-item>

            <el-form-item label="密码" prop="pass" :rules="[{required:true, message: '请输入密码', trigger: 'blur'}]">

                <el-input type="password" v-model="adminRegister.pass" auto-complete="off"></el-input>

            </el-form-item>

            <el-form-item label="确认密码" prop="checkPass"
                          :rules="[{required:true, message: '请再次输入密码', trigger: 'blur'}]">

                <el-input type="password" v-model="adminRegister.checkPass" auto-complete="off"></el-input>

            </el-form-item>


            <el-form-item>

                <el-button type="primary" @click="submitForm('adminRegister')">提交</el-button>

                <el-button @click="resetForm('adminRegister')">重置</el-button>

            </el-form-item>

        </el-form>
    </div>
</template>


<script>

    export default
    {
        data()
        {

            var validatePass = (rule, value, callback) => {

                if (value === '') {
                    callback(new Error('请输入密码'));

                } else {

                    if (this.adminRegister.checkPass !== '') {
                        this.$refs.adminRegister.validateField('checkPass');

                    }
                    callback();

                }

            };

            var validatePass2 = (rule, value, callback) => {

                if (value === '') {
                    callback(new Error('请再次输入密码'));

                } else if (value !== this.adminRegister.pass) {
                    callback(new Error('两次输入密码不一致!'));

                } else {
                    callback();

                }

            };

            return {
                adminRegister: {
                    pass: '',
                    checkPass: '',
                    adminname: '',
                    email: '',
                    errmsg: ''

                }
                ,
                rules2: {
                    pass: [
                        {validator: validatePass, trigger: 'blur'}
                    ],
                    checkPass: [
                        {validator: validatePass2, trigger: 'blur'}
                    ]

                }

            }
                ;
        }
        ,
        methods: {
            enterIndex()
            {
                this.$router.push({path: '/index'})

            }
            ,
            submitForm(formName)
            {

                this.$refs[formName].validate((valid) => {

                        if (valid) {
                            axios.post('/admin/register', {
                                email: this.adminRegister.email,
                                name: this.adminRegister.adminname,
                                password: this.adminRegister.pass,
                                password_confirmation: this.adminRegister.checkPass

                            }).then(res => {

                                var time = new Date();
                                sessionStorage.setItem('admin-id', res.data.id)
                                sessionStorage.setItem('admin-email', res.data.email)
                                sessionStorage.setItem('admin-name', res.data.name)
                                sessionStorage.setItem('miss-hour', time.getHours())
                                sessionStorage.setItem('miss-minute', time.getMinutes())
                                this.$notify({
                                    title: '注册成功',
                                    message: '欢迎注册',
                                    type: 'success',
                                    duration: 2000

                                })
                                this.$router.push({path: 'haso'})

                            }).catch(error => {
                                this.errmsg = error.response.data.email['0']
                                this.$notify.error({
                                    title: '失败',
                                    message: this.errmsg,
                                    duration: 3000,
                                    onClose()
                                    {
                                        location.reload()

                                    }

                                })

                            })

                        } else {
                            console.log('error submit!!');

                            return false;

                        }

                    }
                )
                ;

            }
            ,
            resetForm(formName)
            {
                this.$refs[formName].resetFields();

            }
        }
    }
</script>

<style>
    .admin-register {
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        margin: auto;
        height: 240px;
        width: 35%;
    }

    .adminRegisterTitle {
        margin-bottom: 40px;
        text-align: center;
        margin-left: 30px;

    }
</style>
