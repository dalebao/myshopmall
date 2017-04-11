<template>
    <el-menu class="el-menu-demo" mode="horizontal" router @select="handleSelect">
        <el-row>
            <el-col :span="6">
                <div class="grid-content bg-purple">
                    <el-menu-item index="/index">商城首页</el-menu-item>
                    <el-menu-item index="/category">商品分类</el-menu-item>
                    <el-menu-item index="/3">商品分类</el-menu-item>
                </div>
            </el-col>

            <el-col :span="3">
                <div class="nav-input">
                    <el-input v-model="input" placeholder="搜索商品"></el-input>
                </div>
            </el-col>
            <el-col :span="3">
                <div class="nav-search-btn">
                    <el-button type="primary" icon="search">搜索</el-button>
                </div>
            </el-col>
            <el-col :span="6" :offset="6">
                <div class="grid-content bg-purple">
                    <el-submenu index="4">
                        <template slot="title">{{username?username:'我'}}的工作台</template>
                        <el-menu-item index="4-1">
                            <el-button
                                    type="text"
                            >个人管理
                            </el-button>
                        </el-menu-item>
                        <el-menu-item index="/user-login" v-if="!isLogin">
                            <el-button
                                    type="text"
                            >登录
                            </el-button>
                        </el-menu-item>
                        <el-menu-item index="/user-register" v-if="!isLogin">
                            <el-button
                                    type="text"
                            >注册
                            </el-button>
                        </el-menu-item>
                        <el-menu-item index="" v-if="1">
                            <el-button
                                    type="text"
                                    @click="handleLogout">
                                退出登录
                            </el-button>
                        </el-menu-item>
                    </el-submenu>
                    <el-menu-item index="5">订单详情</el-menu-item>
                    <el-menu-item index="/admin-login" v-if="!admin">我是管理员</el-menu-item>
                    <el-menu-item index="/haso" v-if="admin">进入管理员后台</el-menu-item>

                </div>
            </el-col>
        </el-row>
    </el-menu>

</template>
<style>
    .nav-input {
        margin-top: 13px;
    }

    .nav-search-btn {
        margin-top: 13px;
        margin-left: 13px;
    }

    .nav-menu {
        /*width: 100%;*/
    }

</style>
<script>
    export default {
        name: 'nav-menu',
        data() {
            return {
                input: '',
                username: '',
                isLogin: false,
                admin:''
            }
        },

        methods: {
            handleSelect(key, keyPath)
            {
//                console.log(key, keyPath);
            },
            handleLogout(){
                axios.post('/logout').then(res => {
                    if (res.data.code == '200') {
                        sessionStorage.clear()
                        this.$notify({
                            title: '退出成功',
                            message: '感谢使用',
                            type: 'success',
                            duration: 2000,
                            onClose(){
                                location.reload()
                            }
                        })
                    } else {
                        this.$notify.error({
                            title: '操作失败',
                            message: '退出失败',
                            duration: 2000,
                            onClose(){
                                location.reload()
                            }
                        })

                    }
                })
                axios.post('admin/logout').then(res=>{
                    console.log(res)
                })

            }
        },
        created(){
            this.username = sessionStorage.getItem('user-name')
            this.admin = sessionStorage.getItem('admin-name')
            if (this.username) {
                this.isLogin = true;
            }
        }
    }
</script>
