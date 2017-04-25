<template>
    <div class="main_admin">
        <div class="admin_nav">
            <el-menu theme="dark" class="el-menu-demo" mode="horizontal">
                <el-submenu index="2">
                    <template slot="title"><span class="iconfont icon-wxbbiaowang"></span> {{admin}} 的工作台</template>
                    <!--<el-menu-item index="2-1">设置</el-menu-item>-->
                    <!--<el-menu-item index="2-2">选项2</el-menu-item>-->
                    <el-menu-item index="" @click="handleLogout">退出</el-menu-item>
                </el-submenu>
            </el-menu>
        </div>
        <div class="admin_body">
            <el-row class="admin_body">
                <el-col :span="18">
                    <div class="router_view">
                        <transition>
                            <router-view></router-view>
                        </transition>
                    </div>
                </el-col>

                <admin-menu></admin-menu>
            </el-row>
        </div>
        <el-row class="footer">
            <p class="footerMsg">Copyright © 2017 baoxulong.当前呈现版本 1.0.0;2017级本科毕业设计题目</p>
        </el-row>
    </div>


</template>

<script>
    import AdminMenu from './adminMenu.vue'
    export default{
        data(){
            return {
                admin: ''
            }
        },
        methods: {
            handleLogout(){
                axios.post('admin/logout').then(res => {
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
            }
        },

        components: {
            AdminMenu
        },
        created()
        {
            this.admin = sessionStorage.getItem('admin-name');
        }
    }
</script>

<style>
    .el-row {
        margin-bottom: 20px;

    &
    :last-child {
        margin-bottom: 0;
    }

    }
    .el-col {
        border-radius: 4px;
    }

    .footer {
        position: relative;
        bottom: -180px;
        width: 100%;
        height: 100px;
        background-color: #ffc0cb;

    }

    .router_view {
        margin: 10px;
    }
</style>